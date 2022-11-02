<?php
namespace Crud\Mvc\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\request\RequestCreator;
use Crud\Mvc\core\traits\Validator;
use Crud\Mvc\models\Authentication;
use Crud\Mvc\models\User;

class AuthenticationController extends AbstractController
{
    use Validator;

    private Authentication $database;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->database = new Authentication();
        session_start();
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
            if (!empty($_SESSION)){
                $result = $_SESSION['session'];
            }

            $result = ['template' => 'registration_templates/registration.html.twig', 'data' => $result];
            $this->response->setBody($result);
            return $this->response;
        }
    }

    public function login()
    {
        if ($this->request->getMethod() == "POST") {
            $resultMsg = $this->enter();
            if (array_key_exists("session",  $resultMsg)){
                $resultMsg['session'] = $_SESSION['session'];
            }
            if (array_key_exists("success",  $resultMsg))
            {
                $this->response->setHeaders(["Location: /"]);
                $result = ['template' => 'home_templates/home.html.twig', 'data' => $resultMsg];
            }else{
                $result = ['template' => 'registration_templates/login.html.twig', 'data' => $resultMsg];
            }
            $this->response->setBody($result);
            return $this->response;
        }
        if ($this->request->getMethod() == "GET") {
            $result = null;
            if (!empty($_SESSION)){
                $result = $_SESSION['session'];
            }
            $result = ['template' => 'registration_templates/login.html.twig', 'data' => $result];
            $this->response->setBody($result);
            return $this->response;
        }
    }

    // session
    public function destroy()
    {
        session_destroy();
        $result = ['template' => 'home_templates/home.html.twig', 'data' => null];
        $this->response->setBody($result);
        return $this->response;
    }

    private function save()
    {
        $request = $this->getPostData();
        $email = $request['email'];
        $name = $request['name'];
        $password = $request['password'];
        $resultMessage = $this->UserSignInValidation($email, $name, $password);
        if (!$resultMessage) {
            $passwordHash = $this->convertPassword($password);
            $this->database->saveUser($email, $name, $passwordHash);
            return ["success" => "New User successfully created"];
        }
        $resultMessage["request"] = ['email' => $email, 'name' => $name, 'password' => $password ];
        return $resultMessage;
    }


    private function convertPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }


    private function UserSignInValidation($email, $name, $password)
    {
        $validator = $this->authorizationValidate($email, $password, $name);
        if (count($validator)) {
            $this->userRequestResult["status"] = $validator;
            return $validator;
        }
        return false;
    }

    /// 2.11.login
    private function UserLoginValidation($email, $password)
    {
        $validator = $this->authorizationValidate($email, $password);
        if (count($validator)) {
            $this->userRequestResult["status"] = $validator;
            return $validator;
        }
        return false;
    }

    private function comparePassword($EnteredPassword,$DbPassword)
    {
        if (password_verify($EnteredPassword,$DbPassword)) {
            return true;
        }
        return false;
    }

    private function getPostData()
    {
        $request = $this->request->getPost();
        $email = $request['email'];
        $name = $request['name'] ?? null;
        $password = $request['password'];
        return ['email' => $email, "name" => $name, 'password' => $password];
    }

    private function checkIfUserExists($email)
    {
        $result = $this->database->getUserDataByEmail($email);
        if ($result)
        {
            return $result;
        }
    }

    private function enter()
    {
        $request = $this->getPostData();
        $email = $request['email'];
        $password = $request['password'];

        $resultMessage = $this->UserLoginValidation($email, $password);
        $resultMessage["request"] = ['email' => $email, 'password' => $password];
        if (key_exists('email',$resultMessage)) {
            $resultMessage['email'] = '';
            $checkEmail = $this->checkIfUserExists($email);
            if ($checkEmail){
                $checkPassword = $this->comparePassword($password,$checkEmail['password']);
                if ($checkPassword){
                    $resultMessage['success'] = true;
                    $this->startSession($checkEmail['name']);
                    return $resultMessage;
                }
                $resultMessage["password"] =  "Password is not correct!";
                return $resultMessage;
            }
            return $resultMessage;
        }
        $resultMessage["email"] = "User with this email is not exists!";
        return $resultMessage;
    }

    private function startSession($name)
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        else
        {
            session_destroy();
            session_start();
            $_SESSION['session'] = ['username' => $name];
        }
    }
}
