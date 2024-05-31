<?php

namespace MysqlCredentials;

use Exception;
use inc\v1\environment_variable\EnvironmentVariable;
use PDO;

class MysqlCredentials
{
    private static $object = null;
    private static $pdo = null;

    private readonly string $host;
    private readonly string $database;
    private readonly string $user;
    private readonly string $password;
    private readonly string $port;
    private readonly string $charset;


    /**
     * Возвращает PDO соединение. Синглетон.
     * @return PDO
     * @throws Exception
     */
    public static function getPDO(): PDO
    {
        $object = new self();
        if (is_null(self::$pdo)) {
            self::$pdo = new PDO(
                "mysql:dbname=$object->database;host=$object->host;port=$object->port;charset=$object->charset",
                $object->user,
                $object->password);
            return self::$pdo;
        }

        return self::$pdo;
    }


    /**
     * @throws Exception
     */
    public static function getDSN(): string
    {
        $object = new self();
        return "mysql:host=$object->host;port={$object->port};dbname={$object->database}";
    }

    /**
     * @throws Exception
     */
    private function __construct()
    {
//        EnvironmentVariable::init(realpath('.env'));
        $env = parse_ini_file(".env");
//        var_dump($env);
        if (
            empty($env["DATABASE_HOST"]) or
            empty($env["DATABASE_NAME"]) or
            empty($env["DATABASE_USER"]) or
            empty($env["DATABASE_PASSWORD"]) or
            empty($env["DATABASE_PORT"]) or
            empty($env["DATABASE_CHARSET"])
        ) {
            throw new Exception("Not all required DATABASE environment variables have been passed");
        }

        $this->host = $env["DATABASE_HOST"];
        $this->database = $env["DATABASE_NAME"];
        $this->user = $env["DATABASE_USER"];
        $this->password = $env["DATABASE_PASSWORD"];
        $this->port = $env["DATABASE_PORT"];
        $this->charset = $env["DATABASE_CHARSET"];
    }

    public static function init(): MysqlCredentials
    {
        if (is_null(self::$object)) {
            self::$object = new self();
        }
        return self::$object;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getDatabase(): string
    {
        return $this->database;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPort(): string
    {
        return $this->port;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }
}