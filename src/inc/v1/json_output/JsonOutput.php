<?php


namespace inc\v1\json_output;


use inc\v1\http_response_code_handler\HTTPResponse;
use inc\v1\router\Router;
use JetBrains\PhpStorm\NoReturn;

class JsonOutput
{
    private static function status(string $status_name, $status_variables = array()): string
    {
        if (Router::isApi()) {
            $array = ["status" => $status_name];
            if (count($status_variables) === 0) {
                return json_encode($array, JSON_UNESCAPED_UNICODE);
            } else {
                return json_encode(array_merge($array, $status_variables), JSON_UNESCAPED_UNICODE);
            }
        }

        header("Location: /404/");
        return "";
    }

    #[NoReturn] public static function success($successList = array()): void
    {
        http_response_code(HTTPResponse::OK->value);
        die(self::status("success", ["data" => $successList]));
    }

    #[NoReturn] public static function error(string|array $errorList = "", HTTPResponse $HTTPResponse = HTTPResponse::UNPROCESSABLE_ENTITY): void
    {
        http_response_code($HTTPResponse->value);
        die(self::status("error", ["error_message" => $errorList]));
    }

    #[NoReturn] public static function instruction(array $instructions): void
    {
        die(self::status("error", ["instruction" => $instructions]));
    }


    #[NoReturn] public static function wrongRequest($errorList = "BAD REQUEST 400. Missing some variables"): void
    {
        self::error($errorList, HTTPResponse::BAD_REQUEST);
    }

    #[NoReturn] public static function wrongURL(): void
    {
        self::error("NOT FOUND 404", HTTPResponse::NOT_FOUND);
    }
}