<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\traits\LogCreator;
use Crud\Mvc\models\Authentication;
use Exception;

class BlockUserController extends AbstractController
{
    use LogCreator;

    private $database;
    private $date;
    private $expiredTime;
    private $ip;
    private $currentTime;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->database = new Authentication();
        $this->date = new \DateTime();
        $this->currentTime = $this->date->format('Y-m-d H:i:s');
    }

    /**
     * @throws Exception
     */
    public function saveBannedUser()
    {
        $this->getExpiredDate();
        $this->getUserIP();
        $this->database->saveBlockedUser($this->ip,$this->expiredTime);
        $this->setLogs($this->ip,$this->currentTime,$this->expiredTime);
        $_SESSION['banned'] = 1;
        $result = ['template' => 'block_template/block_user.html.twig', 'data' => $this->timer()];
        $this->response->setBody($result);
        return $this->response;
    }

    public function banUser(){
        $this->getExpiredDate();
        $this->getUserIP();


        if ($this->isStealBanned($this->ip)) {
            $result = ['template' => 'block_template/block_user.html.twig', 'data' => $this->timer()];
        } else {
            unset($_SESSION['visit_counter']);
            unset($_SESSION['banned']);
            $result = ['template' => 'home_templates/home.html.twig', 'data' => null];
        }
        $this->response->setBody($result);
        return $this->response;

    }

    private function getUserIP()
    {
        //check ip from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        //to check ip is pass from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        $this->ip = $ip;
    }

    private function getExpiredDate(){

        $this->date->modify('+15 minute');
        $this->expiredTime = $this->date->format('Y-m-d H:i:s');
    }

    public function isStealBanned($ip): bool
    {
        $res = $this->database->getLastBannedUserIp($ip);
        if ($res){
            return $res["expired_date"] > $this->currentTime;
        }
        return false;
    }



    private function timer(){
        $res = $this->database->getLastBannedUserIp($this->ip);
        $datetime1 = \DateTime::createFromFormat('Y-m-d H:i:s', $res["expired_date"]);
        $datetime2 = \DateTime::createFromFormat('Y-m-d H:i:s', $this->currentTime);
        return ["timer" => $datetime1->diff($datetime2)->format('%i minutes, %s seconds')];
    }

    private function setLogs($ip,$currentTime,$expiredTime)
    {
        $request = $this->request->getPost();
        $email = $request["email"] ?? "Email not found";
        $logMsg = "$ip  $email  $currentTime  $expiredTime";
        $this->wh_log($logMsg,'authentication_logs','/auth');

    }
}