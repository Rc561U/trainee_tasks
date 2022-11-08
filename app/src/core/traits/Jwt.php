<?php

namespace Crud\Mvc\core\traits;

trait Jwt
{

    private $headers;
    private $secret;
    public $payload;

    public function create()
    {
        $this->headers = [
            'alg' => 'HS256',
            'typ' => 'JWT',
            'iss' => 'http://localhost/',
            'aud' => 'http://localhost/'
        ];
        $this->secret = 'secret';
    }

    public function generate(array $payload): string
    {
        $this->create();
        $headers = $this->encode(json_encode($this->headers));
        $payload["exp"] = strtotime("+1 week");
        $payload = $this->encode(json_encode($payload));
        $signature = hash_hmac('SHA256', "$headers.$payload", $this->secret,true);
        $signature = $this->encode($signature);

        return "$headers.$payload.$signature";
    }


    private function encode(string $str): string
    {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }
    public function getPayload(){
        return $this->payload;
    }

    public function is_valid(string $jwt): bool
    {
        $this->create();
        $token = explode('.', $jwt);
        if (!isset($token[1]) && !isset($token[2])) {
            return false;
        }
        $headers = base64_decode($token[0]);
        $payload = base64_decode($token[1]);
        $this->payload = json_decode($payload,true);
        $clientSignature = $token[2];

        if (!json_decode($payload)) {
            return false;
        }

        if ((json_decode($payload)->exp - time()) < 0) {
            return false;
        }

        if (isset(json_decode($payload)->iss)) {
            if (json_decode($headers)->iss != json_decode($payload)->iss) {
                return false;
            }
        } else {
            return false;
        }

        if (isset(json_decode($payload)->aud)) {
            if (json_decode($headers)->aud != json_decode($payload)->aud) {
                return false;
            }
        } else {
            return false;
        }

        $base64_header = $this->encode($headers);
        $base64_payload = $this->encode($payload);

        $signature = hash_hmac('SHA256', $base64_header . "." . $base64_payload, $this->secret, true);
        $base64_signature = $this->encode($signature);

        return ($base64_signature === $clientSignature);
    }
}