<?php include '../config/db.php';

$sql = 'select * from fooditems';

$res = mysqli_query($conn, $sql);
$data = array();
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}

// $data = array_reverse($data);

print(json_encode($data));

?>