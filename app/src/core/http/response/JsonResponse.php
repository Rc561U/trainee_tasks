<?php

namespace Crud\Mvc\core\http\response;

use JsonException;

class JsonResponse extends AbstractResponse
{
    public function __construct()
    {
        $this->headers = ["Content-Type: application/json"];
        $this->protocol = self::DEFAULT_PROTOCOL;
        $this->body = null;
        $this->code = 200;
        parent::__construct($this->headers, $this->protocol, $this->body, $this->code);
    }

    /**
     * @param mixed $body
     * @throws JsonException
     */
    public function setBody(mixed $body): void
    {
        $this->body = $this->encodeBody($body);
    }

    /**
     * @throws JsonException
     */
    private function encodeBody(mixed $body): bool|string
    {
        return json_encode($body, JSON_THROW_ON_ERROR);
    }
}
