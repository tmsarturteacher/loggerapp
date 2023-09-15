<?php

use PDO;
use PDOException;

class Connections
{
    private static $instance;
    private $connection;

    private $connectionParams = [
        'host' => '',
        'dbname' => '',
        'userName' => '',
        'userPass' => ''
    ];

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host={$this->connectionParams['host']};
            dbname={$this->connectionParams['dbname']}",
                $this->connectionParams['userName'],
                $this->connectionParams['userPass']
            );
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}