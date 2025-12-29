<?php

require_once __DIR__ . '/config.php';

class Database
{
    private static $connection = null;

    public static function connect()
    {
        if (self::$connection === null) {
            self::$connection = new PDO(
                "mysql:host=" . Config::DB_HOST() .
                ";port=" . Config::DB_PORT() .
                ";dbname=" . Config::DB_NAME() .
                ";charset=utf8mb4",
                Config::DB_USER(),
                Config::DB_PASSWORD(),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/ca-certificate.crt",
                    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
                ]
            );
        }

        return self::$connection;
    }
}
?>