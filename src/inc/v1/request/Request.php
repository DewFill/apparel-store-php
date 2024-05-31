<?php


namespace inc\v1\request;

use inc\v1\data_type_parser\DataTypeParser;
use inc\v1\development_mode\DevelopmentMode;
use inc\v1\json_output\JsonOutput;
use JetBrains\PhpStorm\ExpectedValues;
use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Translation\Dumper\IniFileDumper;
use const FILTER_SANITIZE_SPECIAL_CHARS;

#[Immutable]
/**
 * Усовершенствованный механизм получения HTTP методов
 */
class Request
{
    /**
     * Имя метода
     */
    private static string|null $method_name;

    /**
     * Массив с мета данными (метод GET)
     */
    private static array $get_body;

    /**
     * Массив с телом данных дополнительного метода, выбранного клиентом
     */
    public static array $method_body;

    const PARSE_NONE = 1;
    const PARSE_VALUES = 2;

    public function __construct(#[ExpectedValues(self::PARSE_VALUES, self::PARSE_NONE)] $flag = self::PARSE_VALUES)
    {
        self::$method_name = filter_var(empty($_SERVER["REQUEST_METHOD"]) ? null : $_SERVER["REQUEST_METHOD"],
                                        FILTER_SANITIZE_SPECIAL_CHARS);

        self::$get_body = array_map(function ($value) {
            return filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }, $_GET);

        if (!empty(self::$get_body) and str_ends_with(self::$get_body[array_key_last(self::$get_body)], "/")) {
            self::$get_body[array_key_last(self::$get_body)] = substr(self::$get_body[array_key_last(self::$get_body)], 0, -1);
        }

        self::$method_body = (function () {
            $lines = (function () {
                $input = file('php://input');

                return ($input === false) ? array() : $input;
            })();
            $array = [];
            //оно работало с так до установки cloudflare
//            $keyLinePrefix = 'Content-Disposition: form-data; name="';
//            foreach ($lines as $key => $line) {
//                if (str_contains($line, $keyLinePrefix)) {
//                    $name = substr($line, 38, -3);
//                    $value = mb_substr($lines[$key + 2], 0, -2, 'UTF-8');
//                    $array += [$name => filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS)];
//                }
//            }

            ////теперь оно работает так
            if (!empty($_POST)) return $_POST;
            if ($_SERVER['REQUEST_METHOD'] === "PUT") {
                if (!empty(_PUT)) return _PUT;
            }

            if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
                return array();
            }

            if (!empty(apache_request_headers()["Content-Type"]) and apache_request_headers()["Content-Type"] === "application/json") {
                return json_decode(file_get_contents("php://input"), true);
            }

            if (!empty($lines)) {
                foreach (explode("&", $lines[0]) as $item) {
//                    if ($item === null) {
//                        continue;
//                    }
                    $key = filter_var(urldecode($item[0]), FILTER_SANITIZE_SPECIAL_CHARS);
                    if ($item[1] === null) {
                        continue;
                    }
                    $value = filter_var(urldecode($item[1]), FILTER_SANITIZE_SPECIAL_CHARS);
                    $array[$key] = $value;
                }
            }
            return $array;
        })();

        if ($flag === self::PARSE_VALUES) {
            self::$get_body = DataTypeParser::parse(self::$get_body);
            self::$method_body = DataTypeParser::parse(self::$method_body);
        }
    }

    /**
     * Возвращает название отправленного метода.
     * Если метод не был отправлен - возвращает "GET"
     */
    public function getMethodName(): string|null
    {
        return self::$method_name;
    }

    public function checkRequestVariables(...$variables): bool
    {
        $missingVariables = array();
        foreach ($variables as $variable) {
            if (!array_key_exists($variable, self::$method_body)) {
                $missingVariables[] = $variable;
            }

        }

        if (!empty($missingVariables)) {
            return false;
        }

        return true;
    }

    /**
     * Проверяет на наличие всех переменных в теле метода.
     */
    public function checkRequestVariablesOrError(...$variables): bool
    {
        $missingVariables = array();
        foreach ($variables as $variable) {
            if (!array_key_exists($variable, self::$method_body)) {
                $missingVariables[] = $variable;
            }

        }

        if (!empty($missingVariables)) {
            if (DevelopmentMode::isActive()) {
                JsonOutput::wrongRequest("BAD REQUEST 400. Missing this variables: [" . implode(", ", $missingVariables) . "]");
            } else {
                JsonOutput::wrongRequest();
            }
        }

        return true;
    }

    /**
     * Получение значения с помощью ключа из переданного
     * метода из тела запроса.
     * @param string $key
     * @return mixed|null
     */
    public function getData(string $key): mixed
    {
        if (isset(self::$method_body[$key])) {
            return self::$method_body[$key];
        }

        return null;
    }

    /**
     * По какой-то там расширенной REST API конвенции разрешено
     * дополнительно передавать Meta метод GET в строке запроса
     * даже если другой метод существует в теле запроса.
     * @param string $key
     * @return mixed|null
     */
    public function getMeta(string $key): mixed
    {
        if (isset(self::$get_body[$key])) {
            return self::$get_body[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @return mixed|null
     * @see Request::getData()
     *      или выкидывание ошибки
     */
    public function getDataOrThrow(string $key): mixed
    {
        if (isset(self::$method_body[$key])) {
            return self::$method_body[$key];
        }

        JsonOutput::wrongRequest("BAD REQUEST 400. Missing this variable: [$key]");
    }

    /**
     * @param string $key
     * @return mixed|null
     * @see Request::getMeta()
     *      или выкидывание ошибки
     */
    public function getMetaOrThrow(string $key): mixed
    {
        if (isset(self::$get_body[$key])) {
            return self::$get_body[$key];
        }

        JsonOutput::wrongRequest("BAD REQUEST 400. Missing this variable: [$key]");
    }
}