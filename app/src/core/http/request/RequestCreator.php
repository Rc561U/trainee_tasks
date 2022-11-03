<?php

namespace Crud\Mvc\core\http\request;

use Crud\Mvc\core\exception\RouterException;

class RequestCreator implements RequestCreatorInterface
{
    public const URI = 'REQUEST_URI';
    public const METHOD = 'REQUEST_METHOD';
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


    private function clearUri(string $uri): string
    {
        $uri = preg_replace('(/$)', '', $uri);
        $uri = preg_replace('(^/)', '', $uri);
        return preg_replace('(\?.*$)', '', $uri);
    }
}
