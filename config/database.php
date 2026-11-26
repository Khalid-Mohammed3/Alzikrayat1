<?php

/**
 * Database Connection Class
 * Responsible for connecting to MySQL database.
 */

class Database {

    private static $host = "localhost";
    private static $dbName = "alzikrayat_db";
    private static $username = "root";
    private static $password = "";

    /**
     * Create and return database connection.
     */
    public static function connect() {

        try {

            $dsn = "mysql:host=" . self::$host .
                   ";dbname=" . self::$dbName .
                   ";charset=utf8mb4";

            $pdo = new PDO(
                $dsn,
                self::$username,
                self::$password
            );

            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $pdo->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

            return $pdo;

        } catch (PDOException $e) {

            die("Database Connection Failed: " . $e->getMessage());

        }
    }
}