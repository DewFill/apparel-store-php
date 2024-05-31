<?php

namespace inc\v1\environment_variable;

class EnvironmentVariable
{
    private static self $object;
    private static array $variables = [];

    private function __construct($array)
    {
        self::$variables = $array;
    }

    public static function init($filename): bool
    {
        $vars = parse_ini_file($filename);
        if ($vars === false) {
            self::$variables = [];
        } else {
            self::$variables = $vars;
        }
        self::$object = new self($vars);
        return true;
    }

    static function instance(): EnvironmentVariable
    {
        return self::$object;
    }

    function get($variable)
    {
        if ($this->hasVariable($variable)) {
            return self::$variables[$variable];
        }

        return null;
    }

    function hasVariable($variable): bool
    {
        return array_key_exists($variable, self::$variables);
    }

    function getVariablesStartsWith($starts_with): array
    {
        $array = [];
        var_dump(self::$variables);
        foreach (array_keys(self::$variables) as $key) {
            if (str_starts_with($key, $starts_with)) {
                $array[$key] = self::$variables[$key];
            }
        }

        return $array;
    }

    function toArray(): array
    {
        return self::$variables;
    }
}