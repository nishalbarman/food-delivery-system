<?php
include '../config/db.php';

$phone = $_POST['uid'];
$firstname = $_POST['ufname'];
$lastname = $_POST['ulname'];
$address = $_POST['uaddress'];
$password = $_POST['upass'];

if ($conn->connect_errno) {
    sendJson(true, $conn->connect_error, '');
    // error("Database Error, Please try again latter.");
}

check($phone, $conn);

$sql = "INSERT INTO `users`(`phone`, `fname`, `lname`, `address`, `password`) VALUES ('$phone','$firstname','$lastname','$address','$password')";


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
// INSERT INTO `users` (`id`, `phone`, `fname`, `lname`, `address`, `password`) VALUES ('1', '9101114906', 'Nishal', 'Barman', 'Vill./P.O. - Balikaria, Nalbari, Assam, 781341', '@NishalBoss21');


?>