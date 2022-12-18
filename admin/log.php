<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ./login.php");
    exit;
}

include '../config/db.php';

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $sql = "SELECT * FROM `admin` where `email`='$email' and `password`='$pass'";

    $res = $conn->query($sql);
    $count = $res->num_rows;
    if ($count > 0) {
        while ($row = $res->fetch_assoc()) {
            $name = $row["name"];
        }
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = "admin";
        $_SESSION['username'] = $name;
        header("location: ./index.php");
    }
}

if (isset($_POST['reg'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO `admin`(`email`, `phone`, `name`, `password`) values ('$email','$phone','$name','$pass');";

    if ($conn->query($sql) === true) {
        echo "<script>alert('Registration Successful.');</script>";
    }
}
?>