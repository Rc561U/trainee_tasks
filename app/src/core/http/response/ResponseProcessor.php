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
        $this->renderBody($response->getBody());
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
     * @param string $body
     * @return void
     */
    protected function renderBody(string $body): void
    {
        echo $body;
    }
}
