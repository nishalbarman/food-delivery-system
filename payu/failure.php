<?php
include '../config/db.php';

$status = $_POST["status"];
$firstname = $_POST["firstname"];
$amount = $_POST["amount"];
$txnid = $_POST["txnid"];
$serial = $_POST["address1"];
$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$productinfo = $_POST["productinfo"];
$email = $_POST["email"];
$salt = "72toOcfuXCBizlYLEGqvVYeIUnXLOGsY";


date_default_timezone_set("Asia/Calcutta");
$date = 'Not Available (' . $date = date('d/m/Y h:i:s a', time()) . ')';


if (isset($_POST["additionalCharges"])) {
    $additionalCharges = $_POST["additionalCharges"];
    $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {
    $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
}
$hash = hash("sha512", $retHashSeq);

?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/success.css">

</head>

<body>

    <div class="content-t">
        <div class="content">

            <lable class="order-r">Your order has been recieved
            </lable>
            <p></p>
            <img src="../assets/cross.png" style="width: 160px; height: 160px;" />
            <p></p>
            <label class="order-tq">Your purchase failed.
                !</label>
            <p></p>
            <!-- <label class="order-tra">Your transaction id is:&nbsp;
                <?php echo $txnid; ?>
            </label> -->

            <button onclick="redirect()" id="button" class="button">MY ORDERS</button>
        </div>
    </div>
    <script>
        function redirect() {
            console.log("Clicked Btn");
            window.location = 'http://localhost/food/orders.html';
        }
    </script>
</body>

</html>