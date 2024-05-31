<?php

namespace inc\v1\router;

use JetBrains\PhpStorm\Pure;

class RouterParser
{
//    public static function getScheme()
//    {
//        $scheme = $_SERVER['REQUEST_SCHEME'];
//
//        if ($scheme === "http" and $_SERVER["HTTPS"] === "on") {
//            $scheme = "https";
//        }
//
//        return $scheme;
//    }

    public static function getRootDirectory()
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    public static function getFirstUrlCatalog(): ?string
    {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $path = explode("/", $path);

        return (!empty($path[1]) and !str_contains($path[1], ".")) ? $path[1] : null;
    }

    public static function getPath(): array
    {
        $path = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        return array_filter($path, fn($value) => !is_null($value) and $value !== '' and !str_contains($value, '.'));
    }

    #[Pure] public static function getInternalRootPath(): string
    {
        return self::getRootDirectory()
            . DIRECTORY_SEPARATOR
            . "src"
            . DIRECTORY_SEPARATOR
            . "public";
    }

    public static function getFile(): string|null
    {
        $path = explode("/", $_SERVER["REQUEST_URI"]);
        $last_element = end($path);
        return str_contains($last_element, '.') ? $last_element : null;
    }

    //parse path to right directory separator for system
    public static function parseDirectorySeparator(string $path): string
    {
        return str_replace("/", DIRECTORY_SEPARATOR, $path);
    }

}