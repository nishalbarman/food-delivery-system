<?php include '../config/db.php';

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$id = $_GET['id'];
$sql = "DELETE FROM `fooditems` WHERE `id` = $id";
$sql2 = "ALTER TABLE `fooditems` AUTO_INCREMENT = $id";

if (mysqli_query($conn, $sql)) {
    $str = "Item deleted.";
} else {
    $str = "Error deleting item: " . mysqli_error($conn);
}

mysqli_query($conn, $sql2);

$filepath = '../food-images/' . $_GET['image'];

if (file_exists($filepath)) {
    $delete = unlink($filepath);
}

header("location: /food/admin/index.php");

?>