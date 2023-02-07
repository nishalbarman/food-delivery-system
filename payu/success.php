<?php
include '../config/db.php';

$action = "";

$status = $_POST["status"];
$firstname = $_POST["firstname"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$amount = $_POST["amount"];
$txnid = $_POST["txnid"];
$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$productinfo = $_POST["productinfo"];
$salt = "72toOcfuXCBizlYLEGqvVYeIUnXLOGsY";

$address = $_POST['address1'];
$foodid = $_POST['udf1'];

date_default_timezone_set("Asia/Calcutta");
$date = date('d/m/Y h:i:s a', time());

if (isset($_POST["additionalCharges"])) {
    $additionalCharges = $_POST["additionalCharges"];
    $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '||||||||||' . $foodid . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {
    $retHashSeq = $salt . '|' . $status . '||||||||||' . $foodid . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
}

$hash = hash("sha512", $retHashSeq);
if ($hash != $posted_hash) {
    echo "Invalid Transaction. Please try again";
    exit;
} else {
    $sql = "select `subtitle`, `image` from fooditems where id = '$foodid'";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $foodsubtitle = $row['subtitle'];
        $foodimage = $row['image'];
    }
    $sql = "INSERT INTO `orders` (`phone`, `fname`, `foodtitle`, `foodsubtitle`, `foodimage`, `address`,`amount`, `transactionid`, `ordertype`, `status`, `location`, `date`, `email`) VALUES ('$phone', '$firstname', '$productinfo', '$foodsubtitle', '$foodimage', '$address', '$amount', '$txnid', 'Prepaid', 'Pending', '$address', '$date', '$email');";
    $res = mysqli_query($conn, $sql);
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/success.css">
</head>

<body>
    <div class="content-t">
        <div class="content">

            <lable class="order-r">Your order has been received
            </lable>
            <p></p>
            <img src="../assets/verified.gif" style="width: 90px; height: 90px;" />
            <p></p>
            <label class="order-tq">Thank you for your purchase
                !</label>
            <p></p>
            <label class="order-tra">Your transaction id is:&nbsp;
                <?php echo $txnid; ?>
            </label>

            <br>

            <button onclick="redirect()" id="button" class="button">MY ORDERS</button>
        </div>
    </div>
    <script>
        function redirect() {
            console.log("Clicked Btn");
            window.location = 'http://localhost/food/orders.php';
        }
    </script>
</body>

</html>