<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//includes
include_once('../database.php');
include_once('../usersdb.php');

$database = new Database();
$pdo = $database->getConnection();
$users = new users($pdo);

$stmt = $users->read();
$num = $stmt->rowCount();
if ($num>0) {
    $products_arr = [];
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $users_item = [
            "id" => $id,
            "imie" => $imie,
            "nazwisko" => $nazwisko,
            "email" => $email,
            "PESEL" => $PESEL,
            "Nr_konta" => $Nr_konta,
            "Stan_konta" => $Stan_konta,
        ];

        array_push($products_arr["records"], $users_item);
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
        array("message" => "No users found.")
    );
}
