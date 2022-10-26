<?php

namespace Crud\Mvc\core\traits;

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


}