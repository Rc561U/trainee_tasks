<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\traits\FileInfo;
use Crud\Mvc\core\traits\LogCreator;
use Crud\Mvc\core\traits\Validator;
use Crud\Mvc\models\Authentication;
use Crud\Mvc\models\File;
use Crud\Mvc\models\User;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
class UserApiController extends AbstractController
{
    use Validator;
    use FileInfo;
    use LogCreator;

    public object $database;
    private array $success;
    private array $error;


    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->database = new User();
        $this->success = ["status" => "true", "response" => null];
        $this->error = ["status" => "false", "response" => null];
    }

    /**
     * @OA\Get(
     *     path="/api/v1/users",
     *     summary="Get info about all users",
     *     tags={"Users"},
     *     @OA\Response(response="200", description="An example resource")
     * )
     */

    public function getUsers(): ResponseInterface
    {
        $result = $this->database->readUserApi();
        $this->response->setBodyJson($this->success["response"] = $result);
        return $this->response;
    }


    /**
     * @OA\Get(
     *     path="/api/v1/user/{id}",
     *     tags={"User"},
     *     summary="Get user by ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @param int $user_id
     *
     * @return ResponseInterface
     */
    public function getUser(int $user_id): ResponseInterface
    {
        if ($this->isUserExists($user_id)) {
            $result = $this->database->getUserPageById($user_id);
            $this->response->setBodyJson($this->success["response"] = $result);
        }
        return $this->response;
    }


    /**
     * @OA\Patch(
     *     path="/api/v1/user/{id}",
     *     tags={"Update"},
     *     summary="Update user by ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The user ID",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="gender",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *              ),
     *           ),
     *        ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *     ),
     * )
     *
     * Update the specified resource in storage.
     *
     * @param int $user_id
     *
     * @return ResponseInterface
     */
    public function patchUser($user_id): ResponseInterface
    {
        $inputData = ($this->request->getJsonRequest());
        if ($this->isUserExists($user_id)) {
            if (!$this->database->getEmail($inputData["email"]) || $this->database->getEmailById($user_id) === $inputData["email"]) {
                if ($this->isUserDataValid($inputData["email"],$inputData["name"],$inputData["gender"],$inputData["status"])){
                    $this->database->updateUserById($inputData["email"], $inputData["name"], $inputData["gender"], $inputData["status"], $user_id);
                    $this->success["response"] = "User has been successfully updated";
                    $this->response->setBodyJson($this->success);
                }
            } else {
                $this->error["response"] = "Email already exists";
                $this->response->setBodyJson($this->error);
            }
        }
        return $this->response;
    }


    /**
     * @OA\Delete(
     *     path="/api/v1/user/{id}",
     *     tags={"Delete"},
     *     summary="Delete user by ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The user ID",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="202",
     *         description="Deleted",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param int $user_id
     *
     * @return ResponseInterface
     */
    public function deleteUser(int $user_id): ResponseInterface
    {
        if ($this->isUserExists($user_id)) {
            $this->database->deleteUserById($user_id);
            $this->success["response"] = "User has been successfully deleted";
            $this->response->setBodyJson($this->success);
        }
        return $this->response;
    }


    /**
     * @OA\Post(
     *     path="/api/v1/user",
     *     tags={"Create"},
     *     summary="Create new user",
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="gender",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *              ),
     *           ),
     *        ),
     *     ),
     *     @OA\Response(
     *         response="202",
     *         description="Created successfully",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     * @return ResponseInterface
     */
    public function postUser(): ResponseInterface
    {
        $inputData = $this->request->getPost();
        $email = $inputData["email"];
        $name = $inputData["name"];
        $gender = $inputData["gender"];
        $status = $inputData["status"];

        if ($this->isUserDataValid($email, $name, $gender, $status)) {
            $lastId = $this->database->createUserApi($email, $name, $gender, $status);
            $this->success["response"] = "New user successfully created";
            $this->success["id"] = $lastId;
            $this->response->setBodyJson($this->success);
            $this->response->setCode(201);
        }
        return $this->response;
    }


    private function isUserExists($user_id): bool
    {
        if (!$this->getUserById($user_id)) {
            $this->error["response"] = "User is not exists";
            $this->response->setCode(404);
            $this->response->setBodyJson($this->error);
            return false;
        }
        return true;
    }

    private function isUserDataValid($email, $name, $gender, $status): bool
    {
        $validator = $this->validate($email, $name, $gender, $status);
        if (count($validator)) {
            $this->error["errors"] = $validator;
            $this->response->setCode(400);
            $this->response->setBodyJson($this->error);
            return false;
        }

        return true;
    }

    // validation update page with disabled JS
    public function postValidate(): ResponseInterface
    {
        $jsonRequest = ($this->request->getJsonRequest());
        if (isset($jsonRequest['signup'])) {
            $authenticationModel = new Authentication();
            if ($authenticationModel->getEmail($jsonRequest["email"])) {
                $this->response->setBodyJson(["available" => false]);
            } else {
                $this->response->setBodyJson(["available" => true]);
            }
        } elseif (!isset($jsonRequest["user_id"])) {
            if ($this->database->getEmail($jsonRequest["email"])) {
                $this->response->setBodyJson(["available" => false]);
            } else {
                $this->response->setBodyJson(["available" => true]);
            }
        } elseif (isset($jsonRequest["user_id"])) {
            $oldEmail = $this->database->getEmailById($jsonRequest["user_id"]);
            $newEmail = $jsonRequest["email"];
            if ($oldEmail === $newEmail || !$this->database->getEmail($newEmail)) {
                $this->response->setBodyJson(["available" => true]);
            } else {
                $this->response->setBodyJson(["available" => false]);
            }
        }
        return $this->response;
    }

    /////////////////////////// upload ///
    public function getUploads(): ResponseInterface
    {
        $bd = new File();
        $result = $bd->getUploads();
        $this->response->setBodyJson($result);
        return $this->response;
    }

    public function postUploads(): ResponseInterface
    {

        if ($this->isUploadFileValid()) {
            $this->upload();
            $this->success["response"] = "File successfully uploaded";
            $this->response->setBodyJson($this->success);
            $this->response->setCode(201);
        }
        return $this->response;
    }

    private function isUploadFileValid(): bool
    {
        $name = $_FILES["fileToUpload"]['name'];
        $size = $_FILES["fileToUpload"]['size'];
        $db = new File();
        $validator = $this->uploadValidate($db, $name, $size);
        if (count($validator)) {
            $this->error["errors"] = $validator;
            $this->response->setBodyJson($this->error);
            $this->wh_log($this->logMsg($name, $size, $validator));
            return false;
        }
        $this->wh_log($this->logMsg($name, $size, "INFO File was uploaded successfully"));
        return true;

    }

    private function upload()
    {
        $this->createDir();
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $this->getinfo();
            $this->database->saveUploadFile($this->name, $this->size, $this->mime, $this->path, $this->imageWeight, $this->imageHeight, $this->date_original);
        }
    }

    private function createDir()
    {
        $root = $_SERVER["DOCUMENT_ROOT"];
        $dir = $root . '/uploads/';
//        if (!file_exists($dir)) {
//        }
        @mkdir($dir, 0755, true);   // sign (@) is Error Control Operators. I use it to suppress diagnostic errors
    }

    private function logMsg($name, $size, $status): string
    {
        $date = date('H:i:s d-m-Y');
        if (is_array($status)) {
            $status = "ERROR " . implode(",", $status);
        }
        return "$date $name $size $status";
    }


}