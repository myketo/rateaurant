<?php

class Database
{
    protected PDO $connection;

    public function __construct()
    {
        $connection = include('app/config/connection.env.php');
        if (!$connection) {
            var_dump('Couldn\'t load connection env file'); die();
        }

        $dsn = "mysql:host={$connection['serverName']};dbname={$connection['dbName']}";

        try {
            $this->connection = new PDO($dsn, $connection['userName'], $connection['password']);

            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            var_dump('Database connection error'); die();
        }
    }
}
