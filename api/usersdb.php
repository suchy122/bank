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

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET Stan_konta=Stan_konta+:Stan_konta WHERE Nr_konta=:Nr_konta";
        $stmt = $this->conn->prepare($query);

        $this->Nr_konta = htmlspecialchars(strip_tags($this->Nr_konta));
        $this->Stan_konta = htmlspecialchars(strip_tags($this->Stan_konta));

        $stmt->bindParam(":Nr_konta", $this->Nr_konta);
        $stmt->bindParam(":Stan_konta", $this->Stan_konta);



        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update2()
    {
        $query = "UPDATE " . $this->table_name . " SET Stan_konta=Stan_konta-:Stan_konta WHERE Nr_konta=:Nr_konta";
        $stmt = $this->conn->prepare($query);

        $this->Nr_konta = htmlspecialchars(strip_tags($this->Nr_konta));
        $this->Stan_konta = htmlspecialchars(strip_tags($this->Stan_konta));

        $stmt->bindParam(":Nr_konta", $this->Nr_konta);
        $stmt->bindParam(":Stan_konta", $this->Stan_konta);



        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
