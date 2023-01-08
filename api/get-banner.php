<?php
include './../config/db.php';

$sql = 'select * from foodbanner ';

$res = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($res);

$data = array();
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}
// $data['tota_records'] = $num_rows;

print(json_encode($data));

?>