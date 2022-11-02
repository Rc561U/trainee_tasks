<?php

namespace Crud\Mvc\core\traits;

use Crud\Mvc\models\File;
use Crud\Mvc\models\User;
use Crud\Mvc\models\Authentication;

trait Validator
{
    public array $errors = [];

    public function validate($email, $name, $gender, $status, $id = null)
    {
        $model = new User();
        $this->checkEmail($email, $model );
        $this->checkFullName($name);
        $this->checkGender($gender);
        $this->checkStatus($status);
        return $this->errors;
    }

    public function uploadValidate($db, $name, $size)
    {
        $this->checkUploadName($db, $name);
        $this->checkUploadSize($size);
        $this->checkUploadType($name);
        return $this->errors;
    }

    public function authorizationValidate($email, $password, $name=null)
    {
        $model = new Authentication();
        $this->checkEmail($email, $model);
        $this->checkUserPassword($password);
        if ($name){
            $this->checkUsername($name);
        }
        return $this->errors;
    }

    public function checkEmail($email, $model)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'No valid email';
        }
        if ($this->isEmailExist($email, $model)) {
            $this->errors['email'] = 'Email already exists';
        }
    }

    public function checkFullName($name)
    {
        if (!preg_match("/^[\w]{2,}\ [\w]{2,}$/", $name)) {
            $this->errors['name'] = 'Name has unsupported type';
        }
    }

    public function checkGender($gender)
    {
        if (!($gender === "Male" or $gender === "Female")) {
            $this->errors['gender'] = 'Gender false';
        }
    }

    public function checkStatus($status)
    {
        if (!($status == "Active" or $status == "Inactive")) {
            $this->errors['status'] = 'Status false';
        }
    }

    private function isEmailExist($email,$model): bool
    {
        if ($model->getEmail($email)) {
            return true;
        }
        return false;
    }

    public function getUserById($id)
    {
        $connectToModel = new User();
        return $connectToModel->getUserById($id);
    }


    // uploads

    private function checkUploadName(File $db, $name): void
    {
        $ns = $db->isFileNameExists($name);
        if ($ns) {
            $this->errors['status'] = 'File with this name already exists';
        }
    }

    private function checkUploadSize($size): void
    {

        if ($size > 10485760) {
            $this->errors['status'] = 'File is too large';
        }
    }

    private function checkUploadType($name): void
    {
        $path_parts = pathinfo($name);
        $allowedExt = ['jpg', 'txt', 'jpeg'];
        if (!in_array($path_parts['extension'], $allowedExt)) {
            $this->errors['status'] = 'Only JPG, JPEG and TXT files are allowed';
        }
    }

    // authentication

    private function checkUsername($name)
    {
        if (!(3 <= strlen($name) && strlen($name) <= 20)) {
            $this->errors['name'] = 'Name must be more then 3 and les then 20 char';
        }
    }

    private function checkUserPassword($password)
    {
        $pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{3,}$/";
        if (!preg_match($pattern, $password)) {
            $this->errors['password'] = 'Minimum 3 characters, at least one letter and one number';
        }
    }

}