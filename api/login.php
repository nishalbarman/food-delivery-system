<?php
include '../config/db.php';

$userid = $_POST['uname'];
$password = $_POST['upass'];

if ($conn->connect_errno) {
    sendJson(true, $conn->connect_error, '');
    // error("Database Error, Please try again latter.");
}

$sql = "select * from users where phone='$userid' and password='$password'";

if ($res = $conn->query($sql)) {
    $count = $res->num_rows;

    if ($count > 0) {

        sendJson(true, "Login Successful", $userid);
    } else {
        sendJson(false, "Login Failed", '');
    }
}

function sendJson($response, $msg, $uid)
{
    $data = array('success' => $response, 'message' => $msg, 'userid' => $uid);
    print_r(json_encode($data));
}

// INSERT INTO `users` (`id`, `phone`, `fname`, `lname`, `address`, `password`) VALUES ('1', '9101114906', 'Nishal', 'Barman', 'Vill./P.O. - Balikaria, Nalbari, Assam, 781341', '@Pasword');


?>