<?php

class payments
{
    private $conn;
    private $table_name = "payments";

    public $id;
    public $konto_z;
    public $nazwa_odbiorcy;
    public $konto_do;
    public $kwota;
    public $tytul;
    public $data;
    public $status;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function read()
    {
        $query = "SELECT id, konto_z, nazwa_odbiorcy, konto_do, kwota, tytul, data, status FROM " . $this->table_name . "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET konto_z=:konto_z, nazwa_odbiorcy=:nazwa_odbiorcy, konto_do=:konto_do, kwota=:kwota, tytul=:tytul, data=:data, status=:status";
        $stmt = $this->conn->prepare($query);

        $this->konto_z = htmlspecialchars(strip_tags($this->konto_z));
        $this->nazwa_odbiorcy = htmlspecialchars(strip_tags($this->nazwa_odbiorcy));
        $this->konto_do = htmlspecialchars(strip_tags($this->konto_do));
        $this->kwota = htmlspecialchars(strip_tags($this->kwota));
        $this->tytul = htmlspecialchars(strip_tags($this->tytul));
        $this->data = htmlspecialchars(strip_tags($this->data));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":konto_z", $this->konto_z);
        $stmt->bindParam(":nazwa_odbiorcy", $this->nazwa_odbiorcy);
        $stmt->bindParam(":konto_do", $this->konto_do);
        $stmt->bindParam(":kwota", $this->kwota);
        $stmt->bindParam(":tytul", $this->tytul);
        $stmt->bindParam(":data", $this->data);
        $stmt->bindParam(":status", $this->status);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET konto_z=:konto_z, nazwa_odbiorcy=:nazwa_odbiorcy, konto_do=:konto_do, kwota=:kwota, tytul=:tytul, data=:data, status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->konto_z = htmlspecialchars(strip_tags($this->konto_z));
        $this->nazwa_odbiorcy = htmlspecialchars(strip_tags($this->nazwa_odbiorcy));
        $this->konto_do = htmlspecialchars(strip_tags($this->konto_do));
        $this->kwota = htmlspecialchars(strip_tags($this->kwota));
        $this->tytul = htmlspecialchars(strip_tags($this->tytul));
        $this->data = htmlspecialchars(strip_tags($this->data));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":konto_z", $this->konto_z);
        $stmt->bindParam(":nazwa_odbiorcy", $this->nazwa_odbiorcy);
        $stmt->bindParam(":konto_do", $this->konto_do);
        $stmt->bindParam(":kwota", $this->kwota);
        $stmt->bindParam(":tytul", $this->tytul);
        $stmt->bindParam(":data", $this->data);
        $stmt->bindParam(":status", $this->status);


        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}
