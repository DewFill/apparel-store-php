<?php
declare(strict_types=1);

use Delight\Auth\Role;
use inc\v1\auth\Auth;
use inc\v1\development_mode\DevelopmentMode;
use inc\v1\environment_variable\EnvironmentVariable;
use inc\v1\output\FileNotFoundException;
use inc\v1\output\MethodNotImplementedException;
use inc\v1\output\Output;
use inc\v1\put\Put;
use inc\v1\router\Router;
use inc\v1\router\RouterParser;

require "vendor/autoload.php";
require "generated-conf/config.php";

EnvironmentVariable::init(realpath('.env'));
DevelopmentMode::off();
//DevelopmentMode::addCache();

if (RouterParser::getFirstUrlCatalog() === "admin" and !Auth::getUser()->hasRole(Role::ADMIN)) {
    header("Location: /404/");
}

if (RouterParser::getFile() === null and !str_ends_with($_SERVER["REQUEST_URI"], "/")) {
    header("Location: " . $_SERVER["REQUEST_URI"] . "/");
}

//подключение API страницы
if (Router::isApi()) {
//    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    define('_PUT', Put::parsePut());
//    }
    try {
        Output::outputApi();
    } catch (FileNotFoundException $e) {
        Output::outputError404();
    } catch (MethodNotImplementedException $e) {
        Output::outputError501();
    }
}

//подключение статического файла
if (Router::isStatic()) {
    try {
        Output::outputStatic();
    } catch (FileNotFoundException $e) {
        Output::outputError404();
    }
}

//подключение обычной страницы
if (Router::isPage()) {
    try {
        Output::outputPage();
    } catch (FileNotFoundException $e) {
        Output::outputError404();
    }
}

ob_end_flush();