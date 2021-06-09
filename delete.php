<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
include_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;
}

if (isset($id)) {

    $sql = "DELETE FROM `test`.`request` WHERE idrequest = '$id'";
    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(
            array('message' => 'Category deleted')
        );
    } else {
        echo ("Error: " . $conn->error);
    }
} else {
    echo json_encode(['error' => 'enter ID value']);
}
