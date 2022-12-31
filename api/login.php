<?php
include '../config/db.php';

$email = $_POST['uname'];
$password = $_POST['upass'];

if ($conn->connect_errno) {
    sendJson(true, $conn->connect_error, '');
}

$sql = "select * from users where email='$email' and password='$password'";

if ($res = $conn->query($sql)) {
    $count = $res->num_rows;

    if ($count > 0) {

        sendJson(true, "Login Successful", $email);
    } else {
        sendJson(false, "Login Failed", '');
    }
}

function sendJson($response, $msg, $email)
{
    $data = array('success' => $response, 'message' => $msg, 'email' => $email);
    print_r(json_encode($data));
}

?>