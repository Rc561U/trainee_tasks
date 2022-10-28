<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\traits\FileInfo;
use Crud\Mvc\core\traits\Validator;
use Crud\Mvc\models\User;

class UploadController extends AbstractController
{
    use Validator;
    use FileInfo;

    public object $database;
    private array $success;
    private array $error;


    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->database = new User();

    }

    public function upload()
    {
        if ($_POST) {

            $this->createDir();
            $this->getinfo();

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//            echo "<pre>";
//            $exif = exif_read_data($target_dir.$_FILES["fileToUpload"]["name"]);
//            print_r($exif);
//            echo "<pre>";

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $this->database->saveUploadFile($this->name,$this->size,$this->mime,$this->path,$this->imageWeight, $this->imageHeight,$this->date_original);
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }


//            $this->response->setBody($_FILES);
//            return $this->response;
        } else {
//            $file = 'uploads/canon_hdr_YES.jpg';

//            var_dump( disk_free_space($_SERVER["DOCUMENT_ROOT"]));    //bytes
//
//            echo "<pre>";
//            print_r( getimagesize("uploads/photo_2022-10-27_16-15-28.jpg"));
//            echo "<pre>";
//            echo round(filesize("uploads/photo_2022-10-27_16-15-28.jpg")/(1024**2),2)." MB";
//            $file = filesize($file);
//            var_dump($this->isEnoughFreeSpace($file));
            $this->response->setBodyHtml("src/views/upload/create.php");
            return $this->response;
        }

    }

    private function createDir()
    {
        $root = $_SERVER["DOCUMENT_ROOT"];
        $dir = $root . '/uploads/';
        if( !file_exists($dir) ) {
            mkdir($dir, 0755, true);
        }
    }

    private function isEnoughFreeSpace($file)
    {
        if ($file > disk_free_space($_SERVER["DOCUMENT_ROOT"]) )
        {
            return "Not enough free space";
        }
        return true;
    }



}