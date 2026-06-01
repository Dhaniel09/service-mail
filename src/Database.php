<?php

class Database
{
    private static $instance = null;

    public static function getConnection()
    {
        if (self::$instance === null) {

            $dsn =
                "pgsql:host=" . $_ENV['DB_HOST'] .
                ";port=" . $_ENV['DB_PORT'] .
                ";dbname=" . $_ENV['DB_NAME'];

            self::$instance = new PDO(
                $dsn,
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD']
            );

            self::$instance->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }

        return self::$instance;
    }
}
