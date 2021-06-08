<?php


error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
// print_r($_POST);

include_once 'dbConnection.php';

if (!isset($_GET) || empty($_GET['id'])) {
    $valid = true;
    $response = ["Please enter the Request ID"];
    echo json_encode($response);
} else {

    $requestId = $_GET['id'];
    $sql = "SELECT * FROM test.request WHERE idrequest=$requestId";
    $result = $conn->query($sql);
    // print_r($result);
    if ($result) {

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $response = ["success" => $row];
                echo json_encode($response);
            }
        } else {
            echo "0 results";
        }
    } else {
        echo ("Error description: " . $conn->error);
    }
}
