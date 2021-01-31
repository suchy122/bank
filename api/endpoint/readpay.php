<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//includes
include_once('../database.php');
include_once('../paymentsdb.php');

$database = new Database();
$pdo = $database->getConnection();
$payments = new payments($pdo);

$stmt = $payments->read();
$num = $stmt->rowCount();
if ($num>0) {
    $products_arr = [];
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $payments_item = [
            "id" => $id,
            "konto_z" => $konto_z,
            "nazwa_odbiorcy" => $nazwa_odbiorcy,
            "konto_do" => $konto_do,
            "kwota" => $kwota,
            "tytul" => $tytul,
            "data" => $data,
            "status" => $status,
        ];

        array_push($products_arr["records"], $payments_item);
    }

    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($products_arr);
} else {
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No payments found.")
    );
}
