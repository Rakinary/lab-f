<?php

namespace App\Model;

use App\Service\Config;
use PDO;

/**
 * Simple PDO connection holder.
 * Keeps a single PDO instance per request.
 */
class DB
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $dsn  = (string) Config::get('db_dsn');
            $user = (string) Config::get('db_user');
            $pass = (string) Config::get('db_pass');

            self::$pdo = new PDO(
                $dsn,
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }

        return self::$pdo;
    }
}
