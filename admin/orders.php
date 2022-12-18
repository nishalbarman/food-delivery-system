<?php
include 'header.html';
include '../config/db.php';

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ./login.php");
    exit;
} else {
    if ($_SESSION['role'] !== 'admin') {
        header("location: ./login.php");
        exit;
    }
}

$sql = "SELECT * FROM `orders`";
$result = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomato - My Orders</title>
    <link rel="stylesheet" href="./adminstyles/orders.css" />
    <link rel="stylesheet" href="./adminstyles/sidenav.css" />
    <!-- <link rel="stylesheet" href="styles/header.css" /> -->
    <style>
        .hide {
            display: none;
        }
    </style>
</head>

<body>

    <div id="main">
        <div id="dish-items">
            <h1>All Orders</h1>
            <div id="order-list" order-cards>

                <?php

                foreach ($orders as $file): ?>

                <div class="order-item" template>

                    <div class="order-top-header" order-header>

                        <div class="col">
                            <div class="row">
                                <label>Order Placed</label>
                            </div>
                            <div class="row">
                                <label order-date>
                                    <?php echo $file['date']; ?>
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <label>Total Price</label>
                            </div>
                            <div class="row">
                                <label order-price></label>
                                <?php echo $file['amount']; ?><label> Rupees</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <label>Ship To</label>
                            </div>
                            <div class="row">
                                <label class="drop-user-name" order-name></label>
                                <?php echo $file['fname']; ?><label>&#8595;</label>
                                <div class="drop-down-content">
                                    <div class="user-address">
                                        <div class="name">
                                            <label class="user-name" order-sname>
                                                <?php echo $file['fname']; ?>
                                            </label>
                                        </div>
                                        <div class="address">
                                            <label order-address>
                                                <?php echo $file['address']; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-body">
                        <div class="status-text">
                            <label>Status: </label><label order-status>
                                <?php echo $file['status']; ?>
                            </label>
                        </div>
                        <div class="order-body-content">
                            <div class="order-image-container">
                                <img class="order-image-el"
                                    src="<?php echo './../food-images/' . $file['foodimage']; ?>" order-image />
                            </div>
                            <div class="order-texts">
                                <div class="order-title">
                                    <label order-title>
                                        <?php echo $file['foodtitle']; ?>
                                    </label>
                                </div>
                                <div class="order-subtitle">
                                    <label order-subtitle>
                                        <?php echo $file['foodsubtitle']; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-bottom">


                        <button id="order-details" class="view-details"
                            onclick="viewDetails('<?php echo $file['id']; ?>')" order-button onclick>View
                            Details</button>

                    </div>

                </div>

                <?php endforeach; ?>

            </div>
        </div>

    </div>

    <script src="js/sidenav.js"></script>
    <script>
        function viewDetails(id) {
            console.log(id);
            window.location = "./details.php?id=" + id;
        }
    </script>

</body>

</html>