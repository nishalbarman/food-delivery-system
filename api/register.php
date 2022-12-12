<?php
include '../config/db.php';

$phone = $_POST['uid'];
$firstname = $_POST['ufname'];
$lastname = $_POST['ulname'];
$email = $_POST['email'];
$address = $_POST['uaddress'];
$password = $_POST['upass'];

if ($conn->connect_errno) {
    sendJson(true, $conn->connect_error, '');
}

check($phone, $conn);

$sql = "INSERT INTO `users`(`phone`, `fname`, `lname`, `address`, `password`, `email`) VALUES ('$phone','$firstname','$lastname','$address','$password', '$email')";


if (mysqli_query($conn, $sql)) {
    sendJson(true, "Registration Successfull", $phone);
} else {
    sendJson(false, "Registration Failed", '');
}

// if ($res = $conn->query($sql)) {
// }

function sendJson($response, $msg, $uid)
{
    $data = array('success' => $response, 'message' => $msg, 'userid' => $uid);
    print_r(json_encode($data));
}

function check($phone, $conn)
{
    $sql = "select fname from users where phone = '$phone'";
    if ($res = $conn->query($sql)) {
        $count = $res->num_rows;
        // echo $res->num_rows;
        if ($count > 0) {
            // echo "Account exist";
            sendJson(false, "User already exist", '');
            exit();
        }
    }
}

?>