<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../database.php');
include_once('../usersdb.php');

$database = new Database();
$pdo = $database->getConnection();
$users = new users($pdo);

//posted data
$data = json_decode(file_get_contents("php://input"));
    $users->Nr_konta = $data->Nr_konta;
    $users->Stan_konta = $data->Stan_konta;


    if ($users->update2()) {
        http_response_code(201);

        echo json_encode([
            "message" => "The user was updated."
        ]);
    } else {
        http_response_code(503);

        echo json_encode([
            "message" => "Unable to update the user."
        ]);
    }
