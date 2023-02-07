<?php

session_start();
include './../config/db.php';

$userid = $_SESSION['email'];

$sql = "select * from orders where email = '$userid'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
// $data = array();
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// if ($count > 0) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $data[] = $row;
//     }
// }
$data = array_reverse($data);
print(json_encode($data));