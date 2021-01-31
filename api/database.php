<?php

class Database
{
    private $host = 'localhost';
    private $dbname = 'bank';
    private $user = 'root';
    private $password = '';
    public $pdo;

    public function getConnection()
    {
        $this->pdo = null;
        try {
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
            $this->pdo->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->pdo;
    }
}
