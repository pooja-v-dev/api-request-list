<?php


error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
// print_r($_POST);

include_once 'dbConnection.php';

if (!empty($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $valid = true;
    $response = array();

    if (empty($_POST["title"])) {
        $response[] = "Title is required";
        $valid = false;
    } else {
        $title = test_input($_POST["title"]);
    }
    if (empty($_POST["category"])) {
        $response[] = "Category is required";
        $valid = false;
    } else {
        $category = test_input($_POST["category"]);
    }
    if (empty($_POST["initiator"])) {

        $response[] = "Initiator is required";
        $valid = false;
    } else {
        $initiator = test_input($_POST["initiator"]);
    }
    if (empty($_POST["initiatoremail"])) {
        $response[] = "Initiator Email is required";
        $valid = false;
    } else {
        $initiatoremail = test_input($_POST["initiatoremail"]);
    }
    if (empty($_POST["assignee"])) {
        $response[] = "Assignee is required";
        $valid = false;
    } else {
        $assignee = test_input($_POST["assignee"]);
    }
    if (empty($_POST["priority"])) {
        $response[] = "Priority is required";
        $valid = false;
    } else {
        $priority = test_input($_POST["priority"]);
    }
    if (empty($_POST["requeststatus"])) {
        $response[] = "Request Status is required";
        $valid = false;
    } else {
        $requeststatus = test_input($_POST["requeststatus"]);
    }
    if (empty($_POST["closed"])) {
        $response[] = "Closed is required";
        $valid = false;
    } else {
        $closed = test_input($_POST["closed"]);
    }
    if ($valid == true) {
        // echo "true";
        $sql = "INSERT INTO test.request(idrequest,title, category, initiator, initiatoremail, assignee, priority, requeststatus, closed) VALUES (NULL,'$title', '$category', '$initiator', '$initiatoremail', '$assignee', '$priority', '$requeststatus', '$closed');";
        // print_r($sql);
       
            $result = $conn->query($sql);
            if ($result) {

            // print_r($result);
            // include('test.php');
            // print_r($result);
            // echo "<h2>From submitted successfully!!!</h2>";
            $response = ["success" => "form submitted successfully"];
        } else {
            echo ("Error description: " . $conn->error);
        }
        // header("Location: /request_list/requestList.php");
        echo json_encode($response);
        exit;
    } else {
        // include('createNewRequest.php');
        $response_status = ["error" => $response];
        echo json_encode($response_status);
    }
    unset($_POST);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
