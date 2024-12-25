<?php
namespace Source\Support\Response;

/**
 *  Build a response object.
 */
class Response
{
    /**
     * @param $response
     * @param int $code
     * @return void
     */
    private static function back ($response, int $code = 200) : void
    {
        header('Content-Type: application/json; charset=UTF-8');

        http_response_code($code);
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Returns a success response.
     *
     * @param $response
     * @param string|null $message
     * @param int $code
     * @return void
     */
    public static function success($response = null, string $message = null, int $code = 200): void
    {
        $back = ["type" => "success"];
        if(isset($message)) $back["message"] = $message;
        if(isset($response)) $back["data"] = $response;

        self::back($back, $code);
    }

    /**
     * Returns a error response.
     *
     * @param string $type_error
     * @param string $message
     * @param int $code
     * @return void
     */
    public static function error(string $type_error, string $message = "Unknown", int $code = 500): void
    {
        self::back([
            "type" => "error",
            "data" => $type_error,
            "message" => $message,
        ], $code);
    }

    /**
     * Returns a response with the pattern sent.
     *
     * @param array $response
     * @param int|null $code
     * @return void
     */
    public static function pattern(array $response, int $code = null): void
    {
        if(!isset($code)) $code = Code::$UNKNOWN_ERROR;

        self::back($response, $code);
    }
}