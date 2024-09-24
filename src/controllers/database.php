<?php

class Database
{
    private static $instance = null;
    private $connection;
    private $host = 'db';
    private $db_name = 'crypto_db';
    private $db_user = 'crypto_user';
    private $password = 'password';

    private function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db_name;";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->connection = new PDO($dsn, $this->db_user, $this->password, $options);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
