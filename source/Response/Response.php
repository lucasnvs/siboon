<?php
namespace Source\Response;
use Source\Response\Code;

class Response
{
    private static function back (array $response, int $code = 200) : void
    {
        http_response_code($code);
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public static function success(array $response = null, string $message = null, int $code = null): void
    {
        $back = ["type" => "success"];
        if(isset($message)) $back["message"] = $message;
        if(isset($response)) $back["data"] = $response;

        self::back($back, $code);
    }

    public static function error(string $type_error, string $message = "Unknown", int $code = null): void
    {
        if(!isset($code)) $code = Code::$UNKNOWN_ERROR;

        self::back([
            "type" => "error",
            "type_error" => $type_error,
            "message" => $message,
        ], $code);
    }
}