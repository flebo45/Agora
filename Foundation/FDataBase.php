<?php

class FDataBase{

    private static $instance;
    private $connection;

    private function __construct()
    {
        // Private constructor to prevent direct instantiation
        // Initialize your database connection here
        $this->connection = new PDO(/* Database configuration */);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // Other methods for executing queries, transactions, etc.
    // ...

    public function getConnection()
    {
        return $this->connection;
    }
}