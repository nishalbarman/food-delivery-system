<?php

session_start();

if (!(isset($_SESSION['logged']) && $_SESSION['logged'] === true)) {
    header("location: ./login.php");
    exit;
}

include './config/db.php';

$id = $_GET['id'];

$sql = "SELECT * from orders where id = '$id'";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $phone = $row['phone'];
    $email = $row['email'];
    $address = $row['address'];
    $amount = $row['amount'];
    $txnid = $row['transactionid'];
    $fname = $row['fname'];
    $title = $row['foodtitle'];
    $subtitle = $row['foodsubtitle'];
    $status = $row['status'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Clash - Food order online</title>
    <link rel="stylesheet" href="admin/adminstyles/details.css" />
    <!-- <link rel="stylesheet" href="../adminstyles/sidenav.css" /> -->
</head>

<body>

    <?php include 'header.php'; ?>

    <div id="main" class="main">
        <div id="mid">
            <div class="info">
                <h2>Contact Info</h2>
                <p>
                    Name :
                    <b>
                        <?php echo $fname; ?>
                    </b></br>
                    Address :
                    <b>
                        <?php echo $address; ?>
                    </b></br>
                    Email :
                    <b>
                        <?php echo $email; ?>
                    </b></br>
                    Phone :
                    <b>
                        <?php echo $phone; ?>
                    </b></br>
                    Transaction ID :
                    <b>
                        <?php echo $txnid; ?>
                    </b></br>
                    Status :
                    <b>
                        <span id="status">
                            <?php echo $status; ?>
                        </span>
                    </b></br>
                </p>
            </div>
        </div>

        <div id="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Item</h2>
                        </td>
                        <td class="Hours">
                            <h2>Qty</h2>
                        </td>
                        <td class="Rate">
                            <h2>Sub Total</h2>
                        </td>
                    </tr>

                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">
                                <?php echo $title; ?>
                            </p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">1</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">
                                <?php echo $amount; ?>
                            </p>
                        </td>
                    </tr>


                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate">
                            <h2>Total</h2>
                        </td>
                        <td class="payment">
                            <h2>
                                <?php echo $amount; ?>
                            </h2>
                        </td>
                    </tr>

                </table>
            </div>
            <!--End Table-->

            <div class="below-btn">
                <div class="buttons">

                    <button id="order-details" class="view-details" onclick="window.print()" order-button
                        onclick>Print</button>

                </div>
            </div>

        </div>
    </div>
    <script>
        function mark(msg) {
            if (msg) {
                fetch("./api/mark.php?id=<?php echo $id; ?>&data=" + msg).then(res => res.json()).then(data => {
                    if (data.success === true) {
                        alert("Status updated");
                        document.getElementById("status").innerHTML = msg;
                    } else {
                        alert("Status update failed.");
                    }
                });
            }
        }
    </script>
</body>

</html>