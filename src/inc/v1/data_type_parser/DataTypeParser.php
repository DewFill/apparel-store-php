<?php

namespace inc\v1\data_type_parser;

use JetBrains\PhpStorm\ExpectedValues;

class DataTypeParser
{
    const PARSE_EMPTY_STRING_TO_NULL = 1;
    const PARSE_STRING_WITH_VALUE_NULL_TO_NULL = 2;
    const PARSE_STRING_WITH_NUMBER_TO_INT = 3;
    const PARSE_STRING_WITH_BOOLEAN_TO_BOOLEAN = 4;
    const REMOVE_WHITESPACES_AT_THE_SIDES = 5;
    const REMOVE_MULTIPLE_OCCURRENCES_OF_WHITESPACE = 6;
    const PARSE_DEFAULT = [
        self::PARSE_EMPTY_STRING_TO_NULL,
        self::PARSE_STRING_WITH_VALUE_NULL_TO_NULL,
        self::PARSE_STRING_WITH_NUMBER_TO_INT,
        self::PARSE_STRING_WITH_BOOLEAN_TO_BOOLEAN,
        self::REMOVE_WHITESPACES_AT_THE_SIDES,
        self::REMOVE_MULTIPLE_OCCURRENCES_OF_WHITESPACE
    ];

    /**
     * Принимает массив данных и парсит значения в соответствии с флагами.
     * Флаг можно передать один или несколько в массиве.
     * @param           $array
     * @param array|int $flags
     * @return array
     */
    public static function parse($array,
                                 #[ExpectedValues([
                                     self::PARSE_DEFAULT,
                                     self::PARSE_EMPTY_STRING_TO_NULL,
                                     self::PARSE_STRING_WITH_VALUE_NULL_TO_NULL,
                                     self::PARSE_STRING_WITH_NUMBER_TO_INT,
                                     self::PARSE_STRING_WITH_BOOLEAN_TO_BOOLEAN,
                                     self::REMOVE_WHITESPACES_AT_THE_SIDES
                                 ])] array|int $flags = self::PARSE_DEFAULT): array
    {
        $flags = (function () use ($flags) {
            if (is_int($flags)) {
                return [$flags];
            }
            return $flags;
        })();

        /**
         * Функция.
         * Проверяет на наличие флага.
         */
        $hasFlag = function (int $flag) use ($flags) {
            return in_array($flag, $flags);
        };

        /**
         * Функция.
         * Парсит каждое значение.
         */
        $parseValue = function ($value) use ($hasFlag) {
            if (is_string($value)) {
                if ($hasFlag(self::REMOVE_WHITESPACES_AT_THE_SIDES)) {
                    @$value = trim(preg_replace("/\s/u", " ", $value));
                }

                if ($hasFlag(self::REMOVE_MULTIPLE_OCCURRENCES_OF_WHITESPACE)) {
                    $value = preg_replace('!\s+!', ' ', $value);
                }

                if ($hasFlag(self::PARSE_STRING_WITH_NUMBER_TO_INT)) {
                    if (is_numeric($value)) $value = intval($value);
                }

                if ($hasFlag(self::PARSE_STRING_WITH_BOOLEAN_TO_BOOLEAN)) {
                    if (strtolower($value) === "true") {
                        $value = true;
                    } elseif (strtolower($value) === "false") {
                        $value = false;
                    }
                }

                if ($hasFlag(self::PARSE_STRING_WITH_VALUE_NULL_TO_NULL)) {
                    if (strtolower($value) === "null") $value = null;
                }

                if ($hasFlag(self::PARSE_EMPTY_STRING_TO_NULL)) {
                    if ($value === "") $value = null;
                }
            }
            return $value;
        };

        foreach ($array as $key => $value) {
            $array[$key] = $parseValue($value);
        }

        return $array;
    }
}