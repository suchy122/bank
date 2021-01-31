<?php

class users
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $imie;
    public $nazwisko;
    public $email;
    public $PESEL;
    public $Nr_konta;
    public $Stan_konta;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function read()
    {
        $query = "SELECT id, imie, nazwisko, email, PESEL, Nr_konta, Stan_konta FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
