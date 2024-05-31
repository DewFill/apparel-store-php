<?php

namespace inc\v1\router;

class Router
{
    private function __construct()
    {
    }

    public static function isApi(): bool
    {
        return RouterParser::getFirstUrlCatalog() === 'api';
    }

    public static function isStatic(): bool
    {
        return RouterParser::getFirstUrlCatalog() === 'static';
    }

    public static function isPage(): bool
    {
        return self::isApi() === false and self::isStatic() === false;
    }
}