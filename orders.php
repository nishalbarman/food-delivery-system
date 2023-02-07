<?php session_start();
if (!(isset($_SESSION['logged']) && $_SESSION['logged'] === true)) {
    // $_SESSION['fullname'] = $row['fname'] + $row['lname'];
// $_SESSION['addresss'] = $row['address'];
// $_SESSION['email'] = $row['email'];
// $_SESSION['phone'] = $row['phone'];
// $_SESSION['logged'] = true;
// $_SESSION['role'] = 'user';
    header("location: ./login.php");
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomato - My Orders</title>
    <link rel="stylesheet" href="styles/orders.css" />
    <!-- <link rel="stylesheet" href="styles/sidenav.css" /> -->
    <link rel="stylesheet" href="styles/header.css" />
    <link rel="stylesheet" href="styles/head.css" />
    <script>
    let loggedin =
        "<?php if (isset($_SESSION['logged'])) {
                echo $_SESSION['logged'];
            } else {
                echo '';
            } ?>";
    console.log(loggedin);
    if (loggedin === "") {
        alert("You are not logged in, kindly log in or sign up to view order section.");
        window.location = "./index.html";
    }

    function logOut() {
        window.localStorage.setItem("authToken", '');
        window.localStorage.setItem("userId", '');
    }

    function setButton() {
        let loggedin = window.localStorage.getItem("authToken");
        if (!(loggedin !== "" && loggedin === "success")) {
            document.getElementById('loginBtnHead').textContent = "LogIn";
            document.getElementById('loginBtnHead').href = "./log.html";
            document.getElementById('loginBtnHead').setAttribute('onclick', '');
        } else {
            document.querySelectorAll('[hide-me]').forEach(element => {
                element.style.display = "block";
            });
        }

    }
    </script>
</head>

<body>

    <?php include('header.php'); ?>

    <div id="main" class="main">
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
    <script>
    //  src="js/orders.js"
    // let userid = window.localStorage.getItem("userId");
    let userid =
        "<?php if (isset($_SESSION['logged'])) { echo $_SESSION['email']; } else { echo '';} ?>";
    console.log(userid);

    const orderTemplate = document.querySelector("[data-order-template]");
    const orderCards = document.querySelector("[order-cards]");

    let options = {
        method: "POST",
        headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: "email=" + userid,
    };

    fetch("http://localhost/food/api/orders.php", options)
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if (data.length === 0) {
                const order = orderTemplate.content.cloneNode(true).children[0];
                const orderDate = order.querySelector("[order-date]");
                const orderPrice = order.querySelector("[order-price]");
                const orderUsername = order.querySelector("[order-name]");
                const orderSname = order.querySelector("[order-sname]");
                const orderAddress = order.querySelector("[order-address]");
                const orderStatus = order.querySelector("[order-status]");
                const orderImage = order.querySelector("[order-image]");
                const orderTitle = order.querySelector("[order-title]");
                const orderSubtitle = order.querySelector("[order-subtitle]");
                const orderButton = order.querySelector("[order-button]");
                const orderHeader = order.querySelector("[order-header]");

                orderDate.style.display = "none";
                orderPrice.style.display = "none";
                orderUsername.style.display = "none";
                orderSname.style.display = "none";
                orderAddress.style.display = "none";
                orderStatus.style.display = "none";
                orderImage.style.display = "none";
                orderTitle.textContent = "No orders found";
                orderSubtitle.style.display = "none";
                orderButton.style.display = "none";
                orderHeader.style.display = "none";

                orderCards.appendChild(order);
                return;
            }

            users = data.map((user) => {
                const order = orderTemplate.content.cloneNode(true).children[0];
                const orderDate = order.querySelector("[order-date]");
                const orderPrice = order.querySelector("[order-price]");
                const orderUsername = order.querySelector("[order-name]");
                const orderSname = order.querySelector("[order-sname]");
                const orderAddress = order.querySelector("[order-address]");
                const orderStatus = order.querySelector("[order-status]");
                const orderImage = order.querySelector("[order-image]");
                const orderTitle = order.querySelector("[order-title]");
                const orderSubtitle = order.querySelector("[order-subtitle]");
                const orderButton = order.querySelector("[order-button]");

                orderDate.textContent = user.date;
                orderPrice.textContent = user.amount;
                orderUsername.textContent = user.fname;
                orderSname.textContent = user.fname;
                orderAddress.textContent = user.address;
                orderStatus.textContent = user.status;
                orderImage.src = "http://localhost/food/food-images/" + user.foodimage;
                orderTitle.textContent = user.foodtitle;
                orderSubtitle.textContent = user.foodsubtitle;
                orderButton.setAttribute("onclick", "openDetails(" + user.id + ")");

                orderCards.appendChild(order);
                return {
                    title: user.foodtitle,
                    subtitle: user.foodsubtitle,
                    amount: user.amount,
                    element: order,
                };
            });
        });

    function openDetails(id) {
        window.location = "http://localhost/food/details.php?id=" + id;
    }
    </script>
    <script src="js/sidenav.js"></script>
</body>

</html>