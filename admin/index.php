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

$sql = "SELECT * FROM `fooditems`";
$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="adminstyles/index.css" />

    <title>Tomato Food Delivery</title>
</head>

<body>
    <div class="content" id="main">

        <h1 class="my-5">Hi <b>
                <?php echo ucwords(strtolower(str_replace("_", " ", htmlspecialchars($_SESSION["username"])))); ?>

            </b>, Welcome back !</h1>
        <div style="overflow-x:auto;">
            <div id="order-list" order-cards>

                <?php

                foreach ($files as $file): ?>
                <div class="order-item">

                    <div class="order-top-header">
                        <div class="col">
                            <div class="row">
                                <label>ID</label>
                            </div>
                            <div class="row">
                                <label order-price></label><label>
                                    <?php echo $file['id']; ?>
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <label>Total Price</label>
                            </div>
                            <div class="row">
                                <label order-price></label><label>
                                    <?php echo $file['amount']; ?> INR /-
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="order-body">
                        <div class="status-text">
                            <label>Status: </label><label order-status></label>
                        </div>
                        <div class="order-body-content">
                            <div class="order-image-container">
                                <img class="order-image-el" src="<?php echo "../food-images/" . $file['image']; ?>"
                                    order-image />
                            </div>
                            <div class="order-texts">
                                <div class="order-title">
                                    <label order-title>
                                        <?php echo $file['title']; ?>
                                    </label>
                                </div>
                                <div class="order-subtitle">
                                    <label order-subtitle>
                                        <?php echo $file['subtitle']; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-bottom">
                        <div class="col">
                            <div class="row">
                                <label>Update</label>
                            </div>
                            <div class="row" style="text-align: center; margin-top: 4px;">
                                <a href="updatefood.php?id=<?php echo $file['id'] ?>"><img
                                        style="width: 27px; height: 27px;" src="assets/update.png" /></a>
                            </div>
                        </div>

                        <div class="col">
                            <div class="row">
                                <label>Remove</label>
                            </div>
                            <div class="row" style="text-align: center; margin-top: 4px;">
                                <a class="delete"
                                    href="delete.php?id=<?php echo $file['id'] . "&image=" . $file['image']; ?>"><img
                                        style="width: 25px; height: 25px;" src="assets/remove.png" /></a>
                            </div>
                        </div>


                    </div>

                </div>



                <?php endforeach; ?>

            </div>
        </div>
    </div>

</body>

</html>