<?php
include '../config/db.php';

$userid = $_POST['phone'];

$sql = "select * from orders where phone = '$userid'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
$data = array();

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
$data = array_reverse($data);
print(json_encode($data));