<?php

namespace inc\v1\auth;


use inc\v1\json_output\JsonOutput;
use inc\v1\router\Router;
use MysqlCredentials\MysqlCredentials;

final class Auth
{
    private static Auth $object;
    private static \Delight\Auth\Auth $auth;

    private function __construct()
    {
        if (!isset(self::$auth)) self::$auth = new \Delight\Auth\Auth(MysqlCredentials::getPDO());
    }

    private static function init(): Auth
    {
        if (!isset(self::$object)) self::$object = new Auth();
        return self::$object;
    }

    public static function getUser(): Auth
    {
        return self::init();
    }

    /**
     * @throws \Exception
     */
    public static function getUserOrThrow(): Auth
    {
        self::init();

        if (!self::$object->isLoggedIn()) {
//            var_dump(Router::isApi());
            if (Router::isApi()) {
//                throw new \Exception("User is not logged in");
                JsonOutput::instruction(["goto" => "/login/"]);
            }

            if (Router::isPage()) {
                header("Location: /login/");
                die();
            }
        }
        return self::$object;
    }

    public function isAdmin(): bool
    {
        $id = $this->id();
        if ($id === null) return false;

        $user = \DB\UsersQuery::create()->findOneById($this->id());
        if ($user === null) return false;

        return $user->getIsAdmin();
    }

    public function __call(string $name, array $arguments)
    {
        return self::$auth->$name(...$arguments);
    }
}