<?php
include '../config/db.php';

$email = $_POST['uname'];
$password = $_POST['upass'];

if ($conn->connect_errno) {
    sendJson(true, $conn->connect_error, '');
}

$sql = "select * from users where email='$email' and password='$password'";
$res = $conn->query($sql);

if ($res) {
    $count = $res->num_rows;
    if ($count > 0) {
        if (isset($_SESSION)) {
            $_SESSION = array();
            session_destroy();
        }
        session_start();
        while ($row = mysqli_fetch_assoc($res)) {
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['sname'] = $row['lname'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['logged'] = true;
            $_SESSION['role'] = 'user';
            $_SESSION['pincode'] = $row['pincode'];
        }
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