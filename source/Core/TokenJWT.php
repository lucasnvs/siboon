<?php
namespace Source\Core;

use DateTimeImmutable;
use Firebase\JWT\JWT;
use Exception;
use Firebase\JWT\Key;
use stdClass;

class TokenJWT
{
    public $token;
    private $secretKey = 'my_secret_sequence_siboon_token_api';

    private const algorithm = 'HS256';

    public function create (array $dataInfo) : string
    {
        $tokenId    = base64_encode(random_bytes(16));
        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify('+90 minutes')->getTimestamp();
        $serverName = url();

        $data = [
            'iat'  => $issuedAt->getTimestamp(),
            'jti'  => $tokenId,
            'iss'  => $serverName,
            'nbf'  => $issuedAt->getTimestamp(),
            'exp'  => $expire,
            'data' => $dataInfo
        ];

        return JWT::encode(
            $data,
            $this->secretKey,
            self::algorithm
        );
    }

    public function verify (string $token) : bool | stdClass
    {
        try {
            $this->token = JWT::decode($token, new Key($this->secretKey, self::algorithm));
            $now = new DateTimeImmutable();
            $serverName = url();
            if ($this->token->iss !== $serverName || $this->token->nbf > $now->getTimestamp() || $this->token->exp < $now->getTimestamp()) {
                return false;
            }
            return $this->token->data;
        } catch (Exception $exception) {
            return false;
        }
    }

}