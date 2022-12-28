<?php
include './../api/config/db.php';

$sql = 'select * from foodcategory ';

$res = mysqli_query($conn, $sql);
$data = array();
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}

print(json_encode($data));


?>