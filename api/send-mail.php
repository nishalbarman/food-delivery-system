<?php
$to = $_GET['email'];
$otp = $_GET['otp'];

$subject = "Authentication Code, Tomato - Food Delivery";
$txt = "Your OTP for Tomato Food Delivery is : " . $otp;
$headers = "From: nischalbarman1@gmail.com";

if (mail($to, $subject, $txt, $headers)) {
    $data = array('success' => true, 'message' => "Email sent successfuly.");
    print_r(json_encode($data));
} else {
    $data = array('success' => false, 'message' => "Email not sent.");
    print_r(json_encode($data));
}

?>