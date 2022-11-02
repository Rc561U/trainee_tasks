<?php

namespace Crud\Mvc\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\traits\FileInfo;
use Crud\Mvc\core\traits\Validator;
use Crud\Mvc\models\User;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UploadController extends AbstractController
{
    use Validator;
    use FileInfo;

    public object $database;
    private array $success;
    private array $error;
    public object $twig;


    public function __construct($request, $response)
    {
        $loader = new FilesystemLoader('src/views/twig_templates');
        $this->twig = new Environment($loader);

        parent::__construct($request, $response);
        $this->database = new User();

    }

    public function upload()
    {
        $allUploads = $this->database->getUploads();
        $result = ['template' => 'upload_templates/upload.html.twig', "data" => $allUploads];
        $this->response->setBody($result);
        return $this->response;
    }
}
