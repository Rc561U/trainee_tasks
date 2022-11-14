<?php

namespace Crud\Mvc\core\traits;

use Crud\Mvc\models\File;
use Crud\Mvc\models\User;

trait Validator
{
    public array $errors = [];

    public function validate($email, $name, $gender, $status, $id = null)
    {
        $model = new User();
        $this->checkEmail($email);
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

    public function validateSignUp($email, $email_check, $first_name, $last_name, $password, $password_check)
    {
        $this->checkEmail($email);
        $this->checkUserPassword($password);
        $this->checkUsername($first_name, "first_name");
        $this->checkUsername($last_name, "last_name");
        $this->matchEmail($email, $email_check);
        $this->matchPassword($password, $password_check);

        return $this->errors;
    }

    public function validateSignIn($email, $password)
    {
        $this->checkEmail($email, true);
        $this->checkUserPassword($password);
        return $this->errors;
    }

    public function checkEmail($email, $flag = false): void
    {
        if ($flag && !$this->isEmailExist($email)) {
            $this->errors['email'] = 'User with this email is not exists';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'No valid email';
        }
        if ($this->isEmailExist($email) && !$flag) {
            $this->errors['email'] = 'Email already exists';
        }
    }

    public function checkFullName($name): void
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

    private function isEmailExist($email)
    {
        if ($this->database->getEmail($email)) {
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

    private function checkUsername($name, $key = null)
    {
        $pattern1 = "/^[a-zA-Z]*$/";
        $pattern2 = "/^[a-zA-Z]{3,20}$/";
        if (!preg_match($pattern2, $name)) {
            $this->errors[$key] = 'The name must have more than 3 and less than 20 letters.';
        }
        if (!preg_match($pattern1, $name)) {
            $this->errors[$key] = 'Only letters allowed.';
        }
    }

    private function checkUserPassword($password)
    {
        $pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{3,}$/";
        if (!preg_match($pattern, $password)) {
            $this->errors['password'] = 'Minimum 6 characters, at least one number, one upper and lower case letter';
        }
    }

    private function matchEmail($email, $email_check)
    {
        if (!($email == $email_check)) {
            $this->errors['email_check'] = "Email does not match";
        }
    }

    private function matchPassword($password, $password_check)
    {
        if (!($password == $password_check)) {
            $this->errors['password_check'] = "Password does not match";
        }
    }
}