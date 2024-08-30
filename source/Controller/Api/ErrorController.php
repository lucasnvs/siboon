<?php
namespace Source\Controller\Api;

use Exception;
use Source\Support\Response\Response;

class ErrorController
{

    private static function getExceptions()
    {
        return [
            'PDOException' => "database",
            'InvalidArgumentException' => "invalid_argument",
            'Source\Exceptions\RouterException' => "router",
            'Source\Exceptions\AuthorizationException' => "authorization",
            'Source\Exceptions\PaymentException' => "payment"
        ];
    }

    public static function getUnavailable()
    {
        return Response::pattern([
            "message" => "Service Unavailable: The server is temporarily unable to service your request due to maintenance downtime or capacity problems. Please try again later.",
        ]);
    }

    public static function getErrorMessage(Exception $e)
    {
        $exceptions = self::getExceptions();
        $exceptionName = get_class($e);

        return Response::error(
            type_error: $exceptions[$exceptionName] ?? "unknown",
            message: $e->getMessage(),
            code: $e->getCode() ?? null,
        );
    }

    public static function getExceptionName(Exception $e) {
        $exceptions = self::getExceptions();
        $exceptionName = get_class($e);

        return $exceptions[$exceptionName] ?? "unknown";
    }
}