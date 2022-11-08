<?php

namespace Crud\Mvc\core\http\response;

interface ResponseInterface
{
    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void;

    /**
     * @return string|null
     */
    public function getProtocol(): ?string;

    /**
     * @param string|null $protocol
     */
    public function setProtocol(?string $protocol): void;

    /**
     * @return mixed
     */
    public function getBody(): mixed;

    /**
     * @param mixed $body
     */
    public function setBody(mixed $body): void;

    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @param int $code
     */
    public function setCode(int $code): void;

    /**
     * @param mixed $cookie
     */
    public function setCookie(mixed $cookie);

    /**
     * @return mixed
     */
    public function getCookie(): mixed;
}
