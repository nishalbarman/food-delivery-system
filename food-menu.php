<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our food items</title>
    <link rel="stylesheet" href="styles/menu.css" />
    <link rel="stylesheet" href="styles/sidenav.css" />

    <script>
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
            // document.querySelectorAll('[hide-me]').forEach(element => {
            //     element.style.display = "none";
            // });
        } else {
            document.querySelectorAll('[hide-me]').forEach(element => {
                element.style.display = "block";
            });
        }

    }
    </script>

    <style>
    .hide {
        display: none;
    }
    </style>
</head>

<body>

    <div id="main">



        <div id="dish-items">
            <h1>Our food items</h1>
            <div id="menu-card" menu-cards></div>
        </div>
        <template data-menu-template>
            <div class="menu-item" template>
                <div class="menu-img">
                    <img src="" class="menu-img-el" data-image />
                </div>
                <div class="menu-body">
                    <div class="menu-title-wrapper">
                        <label data-title></label>
                    </div>
                    <div class="menu-sub-wrapper">
                        <label data-subtitle></label>
                    </div>
                    <div class="menu-btn-wrapper">
                        <button class="buy-btn" data-button></button>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <script src="js/menu.js"></script>
    <script src="js/sidenav.js"></script>
</body>

</html>