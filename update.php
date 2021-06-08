<?php

include_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    echo "this is a put request\n";
    parse_str(file_get_contents("php://input"),$post_vars);
    print_r($post_vars);
    echo $post_vars['assignee']." is the fruit\n";
    echo "I want ".$post_vars['priority']." of them\n\n";
}
die();

if ($_POST['dropdownValue']) {
    $selectedVal  = explode('|', $_POST['dropdownValue']);
    // echo "Selected value in php ".$selectedVal[0] + $selectedVal[1];
    // print_r($selectedVal);
    $id = $selectedVal[0];
    $status = $selectedVal[1];

    $sql = "UPDATE `test`.`request` SET requeststatus = $status WHERE idrequest = '$id'";
    $result = $conn->query($sql);
} else {
    die("No selected value");
}
