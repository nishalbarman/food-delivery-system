<?php
include '../config/db.php';

$action = "";

$status = $_POST["status"];
$firstname = $_POST["firstname"];
$phone = $_POST["phone"];
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

// Salt should be same Post Request 

if (isset($_POST["additionalCharges"])) {
    $additionalCharges = $_POST["additionalCharges"];
    $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '||||||||||' . $foodid . '||' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
} else {
    $retHashSeq = $salt . '|' . $status . '||||||||||' . $foodid . '||' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
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
    $sql = "INSERT INTO `orders` (`phone`, `fname`, `foodtitle`, `foodsubtitle`, `foodimage`, `address`,`amount`, `transactionid`, `ordertype`, `status`, `location`, `date`) VALUES ('$phone', '$firstname', '$productinfo', '$foodsubtitle', '$foodimage', '$address', '$amount', '$txnid', 'Prepaid', 'Pending', '$address', '$date');";
    $res = mysqli_query($conn, $sql);
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .content {
            max-width: 500px;
            margin: auto;
            padding-left: 6px;
            padding-right: 6px;
            padding-top: 1px;

        }

        #clock {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #7CE46F;
            margin: auto;
        }

        #seconds {
            display: block;
            width: 100%;
            margin: auto;
            padding-top: 18px;
            text-align: center;
            font-size: 40px;
            color: white;
        }

        button {
            background-color: #4CAF50;
            /* Green */
            border: 1px;
            border-radius: 3px;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
        }

        p,
        h4 {
            color: green;
        }

        button:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }
    </style>
</head>

<body>
    <div class="content">

        <center>
            <h2 style="color: #3FB8D9;text-decoration: underline dotted #3FB8D9;">Order Successful</h2>
            <p><span style='color:red; font-weight: bold; font-size: 15px'>Copy and save the transaction id for
                    future reference.</span></p>
        </center>
        <h4>We have received a payment of Rs.
            <?php echo $amount; ?>
        </h4>
        <p><span style="color: #FF9A00;">Your Transaction ID for this transaction is </span></p>
        <p><span style='color:#2235DA;font-size: 20px; font-weight:bold'>
                <?php echo $txnid; ?>
            </span></p>

        <br>
        <center>
            <!-- <label style="color:green;font-weight: bold; font-size: 20px;">...</label> -->
            <button onclick="redirect()" id="button" class="button">My
                Orders</button>
        </center>
    </div>
    <script>
        function redirect() {
            console.log("Clicked Btn");
            window.location = 'http://localhost/food/orders.html';
        }
    </script>
</body>

</html>