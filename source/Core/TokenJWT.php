<?php
namespace Source\Core;

use DateTimeImmutable;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class TokenJWT
{
    public $token;
    private $secretKey = JWT_SECRET_KEY;

    private const algorithm = 'HS256';

    public function create (array $dataInfo) : string
    {
        $tokenId    = base64_encode(random_bytes(16));
        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify('+24 hour')->getTimestamp();
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

    public function verify (string $token) : bool
    {
        try {
            $this->token = JWT::decode($token, new Key($this->secretKey, self::algorithm));
            $now = new DateTimeImmutable();
            $serverName = url();
            if ($this->token->iss !== $serverName || $this->token->nbf > $now->getTimestamp() || $this->token->exp < $now->getTimestamp()) {
                return false;
            }
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    public function decode (string $token): stdClass
    {
        return JWT::decode($token, new Key($this->secretKey, self::algorithm))->data;
    }
}