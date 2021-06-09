<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
include_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"));
    // echo $data->id;
    $id = $data->id;
    $status = $data->status;
}

if (isset($id)) {

    $sql = "UPDATE `test`.`request` SET requeststatus = '$status' WHERE idrequest = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        $response = ["success" => "Data updated successfully"];
        echo json_encode($response);
    } else {
        echo ("Error: " . $conn->error);
    }
} else {
    echo json_encode(['error'=>'enter ID value']);
}
