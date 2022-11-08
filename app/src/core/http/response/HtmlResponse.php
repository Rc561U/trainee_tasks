<?php

namespace Crud\Mvc\core\http\response;


class HtmlResponse extends AbstractResponse
{
    public function __construct()
    {
        $this->headers = ["Content-Type: text/html"];
        $this->protocol = self::DEFAULT_PROTOCOL;
        $this->body = null;
        $this->code = 200;
        $this->cookie = null;
        parent::__construct($this->headers, $this->protocol, $this->body, $this->cookie, $this->code );
    }

    /**
     * @param mixed $body
     */
    public function setBody(mixed $body): void
    {
        $this->body = $body;
    }
    /**
     * @param mixed $cookie
     */
    public function setCookie(mixed $cookie): void
    {
        $this->cookie = $cookie;
    }
}