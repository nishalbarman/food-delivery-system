<?php
session_start();
include './../config/db.php';

$fname = $_POST['fname'];
$sname = $_POST['sname'];
$phone = $_POST['phone'];
$email = $_SESSION['email'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$pincode = $_POST['pincode'];

// $sql = "INSERT INTO foodfeedback (`name`, `email`,`title`, `feedback`) VALUES ('$name','$email','$title','$feedback')";
$sql = "UPDATE `users` SET `phone` = '$phone', `fname` = '$fname',`lname`='$sname', `gender`='$gender', `address`='$address',`pincode`='$pincode' WHERE `email`='$email'";

if (mysqli_query($conn, $sql)) {
    $_SESSION['fname'] = $fname;
    $_SESSION['sname'] = $sname;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['gender'] = $gender;
    $_SESSION['address'] = $address;
    $_SESSION['logged'] = true;
    $_SESSION['role'] = 'user';
    $_SESSION['pincode'] = $pincode;

    $data = array("success" => true, "message" => "Profile Updated Successfuly.");
    print(json_encode($data));
    exit;
} else {
    $data = array("success" => false, "message" => "Profile Updatation failed.");
    print(json_encode($data));
    exit;
}

?>