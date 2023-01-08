<?php
include './../config/db.php';

$email = $_POST['email'];
// $name = $_POST['name'];
$title = $_POST['title'];
$feedback = $_POST['feedback'];

// $sql = "INSERT INTO foodfeedback (`name`, `email`,`title`, `feedback`) VALUES ('$name','$email','$title','$feedback')";
$sql = "INSERT INTO foodfeedback (`email`,`title`, `feedback`) VALUES ('$email','$title','$feedback')";

if (mysqli_query($conn, $sql)) {
    $data = array("success" => true, "message" => "Feedback Submitted Successfuly.");
    print(json_encode($data));
    exit;
} else {
    $data = array("success" => false, "message" => "Feedback Submission Failed.");
    print(json_encode($data));
    exit;
}

?>