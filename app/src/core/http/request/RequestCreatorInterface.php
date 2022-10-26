<?php

namespace Crud\Mvc\core\http\request;


interface RequestCreatorInterface
{
    /**
     * @throws RouterException
     */
    public function create(): RequestInterface;

    /**
     * @param array $request
     * @return array
     */
//    public function validateServer(array $request): array;
}
