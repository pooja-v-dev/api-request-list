<?php


error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

include_once 'dbConnection.php';

if (!isset($_GET) || empty($_GET['priority']) && empty($_GET['assignee']) && empty($_GET['requeststatus']) && empty($_GET['page']) && empty($_GET['page_size'])) {
    $sql = "SELECT * FROM test.request";
    $result = $conn->query($sql);
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
} else {
    $where = '';
    if ($_GET['priority'] && !empty($_GET['pagesize'])) {
        $priority = $_GET['priority'];
        $where .= "priority=" . "'$priority'";
    }
    if ($_GET['assignee'] && !empty($_GET['assignee'])) {
        $assignee = $_GET['assignee'];
        $where .= " AND assignee=" . "'$assignee'";
    }
    if ($_GET['requeststatus'] && !empty($_GET['requeststatus'])) {
        $requeststatus = $_GET['requeststatus'];
        $where .= "AND requeststatus=" . "'$requeststatus'";
    }
    if ($_GET['page'] && !empty($_GET['page'])) {
        $page = $_GET['page'];
        $rows = explode("to", $page);
        $rowfrom = $rows[0];
        $rowto = $rows[1];
        $where .= "LIMIT=" . $rowto . "AND OFFSET" . $rowfrom;

    }
    if ($_GET['pagesize'] && !empty($_GET['pagesize'])) {
        $pagesize = $_GET['pagesize'];
        $where .= "LIMIT=" . $pagesize;
    }

    $sql = "SELECT * FROM test.request WHERE $where";
    $result = $conn->query($sql);
    if ($result) {

        if ($result->num_rows > 0) {
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
