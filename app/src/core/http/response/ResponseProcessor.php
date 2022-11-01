<?php

namespace Crud\Mvc\core\http\response;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ResponseProcessor
{
    public object $twig;

    /**
     * @param ResponseInterface $response
     * @return void
     */
    public function process(ResponseInterface $response): void
    {


        $this->clearHeaders();
        $this->processHeaders($response->getHeaders());
        $this->setCode($response->getCode());
        if ($response->getBody()) {
            $this->renderBody($response->getBody());
        } else {
            $this->renderBodyJson($response->getBodyJson());
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
    protected function renderBody(mixed $body): void
    {
        $template = $body['template'];
        $data = $body['data'];
        echo $this->twig->render($template, ['files' => $data]);

    }

    protected function renderBodyJson(mixed $body): void
    {
        echo json_encode($body);
    }
}