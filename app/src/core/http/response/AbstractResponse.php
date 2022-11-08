<?php

namespace Crud\Mvc\core\http\response;

abstract class AbstractResponse implements ResponseInterface
{
    public const DEFAULT_PROTOCOL = 'HTTP/2';

    protected array $headers;
    protected ?string $protocol;
    protected mixed $body;
    protected int $code;
    protected mixed $cookie;

    /**
     * @param array $headers
     * @param string|null $protocol
     * @param mixed $body
     * @param int $code
     * @param mixed $cookie
     */
    public function __construct(array $headers, ?string $protocol, mixed $body, mixed $cookie, int $code = 200 )
    {
        $this->headers = $headers;
        $this->protocol = $protocol;
        $this->body = $body;
        $this->code = $code;
        $this->cookie = $cookie;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return string|null
     */
    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    /**
     * @param string|null $protocol
     */
    public function setProtocol(?string $protocol): void
    {
        $this->protocol = $protocol;
    }

    /**
     * @return mixed
     */
    public function getBody(): mixed
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody(mixed $body): void
    {
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getCookie(): mixed
    {
        return $this->cookie;
    }

    /**
     * @param int $cookie
     */
    public function setCookie(mixed $cookie)
    {
        $this->cookie = $cookie;
    }

    public function setBodyJson(mixed $body): void
    {
        $this->renderBodyJson = $body;
    }

    public function getBodyJson()
    {
        return $this->renderBodyJson;
    }
}
