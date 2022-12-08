<?php include '../config/db.php';

$sql = 'select * from cards limit 4';

$res = mysqli_query($conn, $sql);
$data = array();
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}

print(json_encode($data));

?>