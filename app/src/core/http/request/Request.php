<?php

namespace Crud\Mvc\core\http\request;;

class Request implements RequestInterface
{
    private ?string $uri;
    private ?string $method;
    private ?string $authorization;
    private ?string $contentType;
    private array $params;
    private array $post;

    /**
     * @param string|null $uri
     * @param string|null $method
     * @param string|null $authorization
     * @param string|null $contentType
     * @param array $params
     * @param array $post
     */
    public function __construct(
        ?string $uri,
        ?string $method,
        ?string $authorization,
        ?string $contentType,
        array $params,
        array $post
    ) {
        $this->uri = $uri;
        $this->method = $method;
        $this->authorization = $authorization;
        $this->contentType = $contentType;
        $this->params = $params;
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getAuthorization(): string
    {
        return $this->authorization;
    }

    /**
     * @param string $authorization
     */
    public function setAuthorization(string $authorization): void
    {
        $this->authorization = $authorization;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /**
     * @param array $post
     */
    public function getJsonRequest()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}
