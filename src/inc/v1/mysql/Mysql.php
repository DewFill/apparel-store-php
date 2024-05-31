<?php

namespace inc\v1\mysql;

use MysqlCredentials\MysqlCredentials;
use PDO;

class Mysql
{
    private static PDO|null $pdo = null;

    /**
     * Возвращает PDO соединение. Синглетон.
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        if (is_null(self::$pdo)) {
            self::$pdo = new PDO("mysql:dbname=" . MysqlCredentials::getDatabase() . ";host=" . MysqlCredentials::getHost() . ";port=" . MysqlCredentials::getPort() . ";charset=" . MysqlCredentials::getCharset(), MysqlCredentials::getUser(), MysqlCredentials::getPassword());
            return self::$pdo;
        }

        return self::$pdo;
    }
}