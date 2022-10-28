<?php

namespace Crud\Mvc\core\http\response;

class ResponseProcessor
{
    /**
     * @param ResponseInterface $response
     * @return void
     */
    public function process(ResponseInterface $response): void
    {
        $this->clearHeaders();
        $this->processHeaders($response->getHeaders());
        $this->setCode($response->getCode());
        if ($response->getBody())
        {
            $this->renderBody($response->getBody());
        }else{
            $this->renderBodyHtml($response->getBodyHtml());
        }
    }

    /**
     * @return void
     */
    protected function clearHeaders(): void
    {
        header_remove();
    }

    /**
     * @param array $headers
     * @return void
     */
    protected function processHeaders(array $headers): void
    {
        foreach ($headers as $header) {
            header($header);
        }
    }

    /**
     * @param int $code
     * @return void
     */
    protected function setCode(int $code): void
    {
        http_response_code($code);
    }

    /**
     * @param mixed $body
     * @return void
     */
    protected function renderBody( mixed $body): void
    {
        echo $body;
    }

    protected function renderBodyHtml( mixed $body): void
    {
        require_once "src/views/header.php";
        require $body;
        require_once "src/views/footer.php";
    }
}
