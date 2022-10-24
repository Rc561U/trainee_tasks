<?php

namespace Crud\Mvc\core\traits;

use Crud\Mvc\models\User;

trait Validator
{
    public function validate($email,$name,$gender,$status, $id=null):bool
    {
        if ($this->checkEmail($email) && $this->checkName($name) &&
            $this->checkGender($gender) && $this->checkStatus($status) && $this->compareTwoEmail($email, $id))
        {
            return true;
        }
        else {
            return false;
        }
    }

    public function checkEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function checkName($name): bool
    {
        if (preg_match("/^[\w]{2,}\ [\w]{2,}$/", $name)) {
            return true;
        }
        return false;
    }

    public function checkGender($gender): bool
    {
        if (!empty($gender) && ($gender === "Male" || $gender === "Female")) {
            return true;
        }
        return false;
    }

    public function checkStatus($status): bool
    {
        if (!empty($status) && ($status === "Active" || $status === "Inactive")) {
            return true;
        }
        return false;
    }

    private function findEmailById($id): string
    {
        $connectToModel = new User();
        return $connectToModel->getEmailById($id);
    }

    private function isEmailExist($email): bool
    {
        $connectToModel = new User();
        if (!$connectToModel->getEmail($email))
        {
            return true;
        }
        return false;
    }

    public function compareTwoEmail($emailNew, $id)
    {
        $emailOld = $this->findEmailById($id);
        if ($emailOld === $emailNew || $this->isEmailExist($emailNew))
        {
            return true;
        }
        return false;
    }



}