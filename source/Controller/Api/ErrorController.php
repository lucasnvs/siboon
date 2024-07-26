<?php
namespace Source\Controller\Api;

use Exception;
use Source\Response\Response;

class ErrorController
{

    private static function getExceptions()
    {
        return [
            'PDOException' => "database",
            'InvalidArgumentException' => "invalid_argument",
            'Source\Exceptions\RouterException' => "router",
            'Source\Exceptions\AuthorizationException' => "authorization"
        ];
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