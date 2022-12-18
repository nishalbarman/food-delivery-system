<?php

include './../../config/db.php';

$data = $_GET["data"];
$id = $_GET["id"];

$sql = "UPDATE `orders` SET `status`='$data' WHERE id='$id'";

if ($conn->query($sql)) {
    $data = array("success" => true);
    print_r(json_encode($data));
} else {
    $data = array("success" => false);
    print_r(json_encode($data));
}

?>