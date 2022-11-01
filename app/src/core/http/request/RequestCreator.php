<?php

namespace Crud\Mvc\core\http\request;

use Crud\Mvc\core\exception\RouterException;

class RequestCreator implements RequestCreatorInterface
{
    public const URI = 'REQUEST_URI';
    public const METHOD = 'REQUEST_METHOD';
    public const AUTHORIZATION = 'Authorization';
    public const HTTP_AUTHORIZATION = 'HTTP_AUTHORIZATION';
    public const CONTENT_TYPE = 'CONTENT_TYPE';

    /**
     * @return RequestInterface
     * @throws RouterException
     */
    public function create(): RequestInterface
    {
        $server = $this->validateServer($_SERVER);

        return new Request(
            $this->clearUri($server[self::URI]),
            $server[self::METHOD],
            $this->getBearerToken(),
            $server[self::CONTENT_TYPE],
            $_GET,
            $_POST
        );
    }

    /**
     * @param array $request
     * @return array
     * @throws RouterException
     */
    public function validateServer(array $request): array
    {
        if (!isset($request[self::URI])) {
            throw new RouterException('No Url');
        }
        if (!isset($request[self::METHOD])) {
            throw new RouterException('No Method');
        }
        if (!isset($request[self::CONTENT_TYPE])) {
            $request[self::CONTENT_TYPE] = null;
        }
        return $request;
    }

    /**
     * @return string|null
     */
    private function getAuthorizationHeader(): ?string
    {
        $headers = null;
        if (isset($_SERVER[self::AUTHORIZATION])) {
            $headers = trim($_SERVER[self::AUTHORIZATION]);
        } else {
            if (isset($_SERVER[self::HTTP_AUTHORIZATION])) { //Nginx or fast CGI
                $headers = trim($_SERVER[self::HTTP_AUTHORIZATION]);
            } elseif (function_exists('apache_request_headers')) {
                $requestHeaders = apache_request_headers();
                // Server-side fix for bug in old Android versions
                // (a nice side-effect of this fix means we don't care about capitalization for Authorization)
                $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)),
                    array_values($requestHeaders));
                if (isset($requestHeaders['Authorization'])) {
                    $headers = trim($requestHeaders['Authorization']);
                }
            }
        }
        return $headers;
    }

    /**
     * @return string|null
     */
    private function getBearerToken(): ?string
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers) && preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
        return null;
    }


    private function clearUri(string $uri): string
    {
        $uri = preg_replace('(/$)', '', $uri);
        $uri = preg_replace('(^/)', '', $uri);
        return preg_replace('(\?.*$)', '', $uri);
    }
}
