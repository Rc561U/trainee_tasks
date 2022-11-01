<?php

namespace Crud\Mvc\core\traits;

use Crud\Mvc\models\File;
use Crud\Mvc\models\User;

trait Validator
{
    public array $errors = [];

    public function validate($email, $name, $gender, $status, $id = null)
    {
        $this->checkEmail($email);
        $this->checkName($name);
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

    public function checkEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'No valid email';
        }
        if ($this->isEmailExist($email)) {
            $this->errors['email'] = 'Email already exists';
        }
    }

    public function checkName($name)
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

    private function isEmailExist($email): bool
    {
        $connectToModel = new User();
        if ($connectToModel->getEmail($email)) {
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

}