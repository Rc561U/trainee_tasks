<?php

namespace Crud\Mvc\core;

class Controller
{
    protected function render($page, $content = null)
    {
        if (isset($content)) {
            $result = $content;
        }

        require_once "src/view/header.php";
        require_once "src/view/templates/$page";
        require_once "src/view/footer.php";
    }
}