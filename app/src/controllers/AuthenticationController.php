<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseProcessor;
use Crud\Mvc\core\traits\Jwt;
use Crud\Mvc\core\traits\Validator;
use Crud\Mvc\models\Authentication;

class AuthenticationController extends AbstractController
{
    use Validator;
    use Jwt;

    private Authentication $database;
    private string $email;
    private ?string $first_name;
    private ?string $last_name;
    private string $password;
    private ?string $email_check;
    private ?string $password_check;
    private ?string $token;
    private  $expiredStr;
    private  $expiredUnix;
    private mixed $userNameFromDb;
    private mixed $remember;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->database = new Authentication();
    }

    public function registration()
    {
        if ($this->request->getMethod() == "POST") {
            $resultMsg = $this->save();
            $result = ['template' => 'registration_templates/registration.html.twig', 'data' => $resultMsg];
            $this->response->setBody($result);
            return $this->response;
        }
        if ($this->request->getMethod() == "GET") {
            $result = null;
            if($this->isAuthoritize()){
                $result['username'] = $this->payload['name'];
            }

            $result = ['template' => 'registration_templates/registration.html.twig', 'data' => $result];
            $this->response->setBody($result);
            return $this->response;
        }
    }

    private function save()
    {
        $this->getPostData();
        $resultMessage["errors"] = $this->validateSignUp($this->email, $this->email_check, $this->first_name, $this->last_name, $this->password, $this->password_check);
        if (empty($resultMessage['errors'])) {
            $passwordHash = $this->convertPassword($this->password);
            $this->database->saveUser($this->email, $this->first_name, $this->last_name, $passwordHash);
            return ["success" => "New User successfully created"];
        }
        $resultMessage["request"] = ['email' => $this->email, 'first_name' => $this->first_name, 'last_name' => $this->last_name, 'password' => $this->password];
        return $resultMessage;
    }


    public function login()
    {
        if ($this->request->getMethod() == "POST") {
            @$_SESSION['visit_counter'] += 1;
            $resultMsg = $this->enter();
            if (array_key_exists("session", $resultMsg)) {
                $resultMsg['session'] = $_SESSION['session'];
            }
            if (array_key_exists("success", $resultMsg)) {
                $this->response->setHeaders(["Location: /"]);
                $result = ['template' => 'home_templates/home.html.twig', 'data' => $resultMsg];
            } else {
                $result = ['template' => 'registration_templates/login.html.twig', 'data' => $resultMsg];
            }
            $this->response->setBody($result);
            return $this->response;
        }
        if ($this->request->getMethod() == "GET") {
            $result = null;

            if($this->isAuthoritize()){
                $result['username'] = $this->payload['name'];
            }

            $result = ['template' => 'registration_templates/login.html.twig', 'data' => $result];
            $this->response->setBody($result);
            return $this->response;
        }
    }

    private function enter(): array
    {
        $this->getPostData();
        $resultMessage = $this->validateSignIn($this->email, $this->password);
        $userDataFromDb = $this->checkIfUserExists($this->email);
        $resultMessage["request"] = ['email' => $this->email];
        if ($userDataFromDb && $this->comparePassword($this->password, $userDataFromDb["password"])) {
            $resultMessage['success'] = true;
            unset($_SESSION['visit_counter']);
            if($this->remember){
                $this->expired();
                $this->generateUserToken($userDataFromDb);
            }else{
                $this->userNameFromDb = $userDataFromDb['first_name'];
                $_SESSION['session'] = ['username' => $this->userNameFromDb];
            }
        } else {
            $resultMessage["password"] = "Password is not correct";
        }
        return $resultMessage;
    }

    // session
    public function destroy()
    {
        unset($_SESSION['visit_counter']);
        unset($_SESSION['session']);
        $this->response->setCookie(["name" => "User-Token", "token" => '', "expire" => time() - 3600 * 60]);
        $this->response->setHeaders(["Location: /"]);
        $result = ['template' => 'home_templates/home.html.twig', 'data' => null];
        $this->response->setBody($result);
        return $this->response;
    }

    private function startSession()
    {
        $_SESSION['session'] = ['username' => $this->userNameFromDb];
    }


    private function convertPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }


    private function comparePassword($EnteredPassword, $DbPassword)
    {
        if (password_verify($EnteredPassword, $DbPassword)) {
            return true;
        }
        return false;
    }

    private function getPostData()
    {
        $request = $this->request->getPost();
        $this->email = $request['email'];
        $this->email_check = $request['email_check'] ?? null;
        $this->first_name = $request['last_name'] ?? null;
        $this->last_name = $request['first_name'] ?? null;
        $this->password = $request['password'];
        $this->password_check = $request['password_check'] ?? null;
        $this->remember = $request['remember'] ?? null;
    }

    private function checkIfUserExists($email)
    {
        $result = $this->database->getUserDataByEmail($email);
        if ($result) {
            return $result;
        }
    }

    private function generateUserToken($data)
    {
        $payload = [
            'id' => $data["id"],
            'name' => $data['first_name'],
            'iss' => 'http://localhost/',
            'aud' => 'http://localhost/'
        ];
        $token = $this->generate($payload);
        $this->response->setHeaders(["Authorization: Bearer ".$token]);
        $this->database->saveUserToken($data["id"],$token,$this->expiredStr);
        $this->response->setCookie(["name" => "User-Token", "token" => $token, "expire" => $this->expiredUnix]);
    }
    private function expired()
    {
        $dateTime = new \DateTime();
        $dateTime->modify('+1 week');
        $this->expiredStr = $dateTime->format('Y-m-d H:i:s');
        $this->expiredUnix = strtotime($this->expiredStr);
    }
}
