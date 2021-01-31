<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../database.php');
include_once('../paymentsdb.php');

$database = new Database();
$pdo = $database->getConnection();
$payments = new payments($pdo);

//posted data
$data = json_decode(file_get_contents("php://input"));
    $payments->id = $data->id;
    $payments->konto_z = $data->konto_z;
    $payments->nazwa_odbiorcy = $data->nazwa_odbiorcy;
    $payments->konto_do = $data->konto_do;
    $payments->kwota = $data->kwota;
    $payments->tytul = $data->tytul;
    $payments->data = $data->data;
    $payments->status = $data->status;

    if ($payments->update()) {
        http_response_code(201);

        echo json_encode([
            "message" => "The payment was updated."
        ]);
    } else {
        http_response_code(503);

        echo json_encode([
            "message" => "Unable to update the payment."
        ]);
    }
