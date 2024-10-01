<?php

class Database
{
    private static $instance = null;
    private $connection;
    private $host;
    private $db_name;
    private $db_user;
    private $password;

    private function __construct()
    {
        $this->host = getenv('DB_HOST') ?: '127.0.0.1';
        $this->db_name = 'crypto_db';
        $this->db_user = 'crypto_user';
        $this->password = 'password';

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
