<?php


namespace inc\v1\development_mode;


class DevelopmentMode
{
    private static bool $isActive = false;

    public static function isActive(): bool
    {
        return self::$isActive;
    }

    public static function on(): void
    {
        self::$isActive = true;
        self::removeCache();
        self::showPhpErrors();
    }

    public static function off(): void
    {
        self::addCache();
        self::$isActive = false;
    }

    private static function removeCache(): void
    {
        header('cache-control: max-age=0, no-cache, no-store, must-revalidate', true); // HTTP 1.1.
        header('Pragma: no-cache', true);                                              // HTTP 1.0.
        header('Expires: 0', true);                                                    // Proxies.
        header('Access-Control-Max-Age: 0', true);
    }

    public static function addCache(): void
    {
        header('cache-control: max-age=120000, cache, store, must-revalidate', true); // HTTP 1.1.
        header('Pragma: cache', true);                                              // HTTP 1.0.
        header('Expires: 120000', true);                                                    // Proxies.
        header('Access-Control-Max-Age: 120000', true);
    }

    private static function showPhpErrors(): void
    {
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
    }
}