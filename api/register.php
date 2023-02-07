<?php
include './../config/db.php';

$phone = $_POST['phone'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$password = $_POST['password'];
$pincode = $_POST['pincode'];

if ($conn->connect_errno) {
    sendJson(true, $conn->connect_error, '');
}

check($email, $conn);

$sql = "INSERT INTO `users`(`phone`, `fname`, `address`, `password`, `email`, `pincode`) VALUES ('$phone','$name','$address','$password', '$email', '$pincode')";


if (mysqli_query($conn, $sql)) {
    sendJson(true, "Registration Successful", $email);
} else {
    sendJson(false, "Registration Failed", '');
}

function sendJson($response, $msg, $email)
{
    $data = array('success' => $response, 'message' => $msg, 'email' => $email);
    print_r(json_encode($data));
}

function check($email, $conn)
{
    $sql = "select fname from users where email = '$email'";
    if ($res = $conn->query($sql)) {
        $count = $res->num_rows;
        if ($count > 0) {
            sendJson(false, "User already exist", '');
            exit;
        }
    }
}

?>