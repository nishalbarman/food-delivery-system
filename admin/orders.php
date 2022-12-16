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
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomato - My Orders</title>
    <link rel="stylesheet" href="adminstyles/orders.css" />
    <link rel="stylesheet" href="styles/sidenav.css" />
    <link rel="stylesheet" href="styles/header.css" />
    <style>
        .hide {
            display: none;
        }
    </style>
</head>

<body>

    <div id="main">
        <div id="dish-items">
            <h1>My Orders</h1>
            <div id="order-list" order-cards></div>
        </div>
        <template data-order-template>
            <div class="order-item" template>

                <div class="order-top-header" order-header>

                    <div class="col">
                        <div class="row">
                            <label>Order Placed</label>
                        </div>
                        <div class="row">
                            <label order-date></label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <label>Total Price</label>
                        </div>
                        <div class="row">
                            <label order-price></label><label> Rupees</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <label>Ship To</label>
                        </div>
                        <div class="row">
                            <label class="drop-user-name" order-name></label><label>&#8595;</label>
                            <div class="drop-down-content">
                                <div class="user-address">
                                    <div class="name">
                                        <label class="user-name" order-sname></label>
                                    </div>
                                    <div class="address">
                                        <label order-address></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-body">
                    <div class="status-text">
                        <label>Status: </label><label order-status></label>
                    </div>
                    <div class="order-body-content">
                        <div class="order-image-container">
                            <img class="order-image-el" src="" order-image />
                        </div>
                        <div class="order-texts">
                            <div class="order-title">
                                <label order-title></label>
                            </div>
                            <div class="order-subtitle">
                                <label order-subtitle></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-bottom">
                    <button id="order-details" class="order-details" order-button>Details</button>
                </div>

            </div>
        </template>
    </div>
    <script src="js/orders.js"></script>
    <script src="js/sidenav.js"></script>
    <script>

        window.smoothScroll = function (target) {
            var scrollContainer = target;
            do { //find scroll container
                scrollContainer = scrollContainer.parentNode;
                if (!scrollContainer) return;
                scrollContainer.scrollTop += 1;
            } while (scrollContainer.scrollTop == 0);

            var targetY = 0;
            do { //find the top of target relatively to the container
                if (target == scrollContainer) break;
                targetY += target.offsetTop;
            } while (target = target.offsetParent);

            scroll = function (c, a, b, i) {
                i++; if (i > 30) return;
                c.scrollTop = a + (b - a) / 30 * i;
                setTimeout(function () { scroll(c, a, b, i); }, 20);
            }
            // start scrolling
            scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
        }
    </script>
</body>

</html>