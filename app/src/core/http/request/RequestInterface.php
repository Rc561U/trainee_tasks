<?php

namespace Crud\Mvc\core\http\request;

interface RequestInterface
{
    /**
     * @return string|null
     */
    public function getUri(): ?string;

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void;

    /**
     * @return string|null
     */
    public function getMethod(): ?string;

    /**
     * @param string $method
     */
    public function setMethod(string $method): void;

    /**
     * @return string|null
     */
    public function getAuthorization(): ?string;

    /**
     * @param string $authorization
     */
    public function setAuthorization(string $authorization): void;

    /**
     * @return string|null
     */
    public function getContentType(): ?string;

    /**
     * @param string $contentType
     */
    public function setContentType(string $contentType): void;

    /**
     * @return array
     */
    public function getParams(): array;

    /**
     * @param array $params
     */
    public function setParams(array $params): void;
}
