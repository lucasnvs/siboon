<?php

namespace Source\Support\Response;

class Code
{
    // 200 Family
    public static int $OK = 200;
    public static int $CREATED = 201;
    public static int $NO_CONTENT = 204;

    // 400 Family
    public static int $BAD_REQUEST = 400;
    public static int $UNAUTHORIZED = 401;
    public static int $FORBIDDEN = 403;
    public static int $NOT_FOUND = 404;
    public static int $CONFLICT = 409;

    // 500 Family
    public static int $INTERNAL_SERVER_ERROR = 500;
    public static int $NOT_IMPLEMENTED = 501;
    public static int $BAD_GATEWAY = 502;
    public static int $SERVICE_UNAVAILABLE = 503;
    public static int $UNKNOWN_ERROR = 520;
}