<?php

namespace Crud\Mvc\core;

class Controller
{
    protected function render($page, $content = null)
    {
        if (isset($content)) {
            $result = $content;
        }

        require_once "src/views/header.php";
        require_once "src/views/user/$page";
        require_once "src/views/footer.php";
    }
}