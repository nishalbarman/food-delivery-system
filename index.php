<?php
session_start();
if (!(isset($_SESSION['logged']) && $_SESSION['logged'] === true)) {
    // $_SESSION['fullname'] = $row['fname'] + $row['lname'];
    // $_SESSION['addresss'] = $row['address'];
    // $_SESSION['email'] = $row['email'];
    // $_SESSION['phone'] = $row['phone'];
    // $_SESSION['logged'] = true;
    // $_SESSION['role'] = 'user';
    // header("location: ./login.php");
    // echo 'not logged';
    // exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomato - Food order online</title>
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./styles/slideshow.css" />
    <link rel="stylesheet" href="./styles/head.css" />
    <link rel="stylesheet" href="./styles/cardflip.css" />
    <script>
        function logOut() {
            window.localStorage.setItem("authToken", '');
            window.localStorage.setItem("userId", '');
        }

    // function setButton() {
    //     let loggedin = window.localStorage.getItem("authToken");
    //     if (!(loggedin !== "" && loggedin === "success")) {
    //         document.getElementById('loginBtnHead').textContent = "LogIn";
    //         document.getElementById('loginBtnHead').href = "./log.html";
    //         document.getElementById('loginBtnHead').setAttribute('onclick', '');
    //     } else {
    //         document.querySelectorAll('[hide-me]').forEach(element => {
    //             element.style.display = "block";
    //         });
    //     }

    // }
    </script>
</head>

<body>

    <?php include('header.php'); ?>

    <div id="main" style="margin-top: 20px;" class="main">
        <div class="slideshow-container" slide-show>
            <template data-banner>
                <div class="mySlides fade">
                    <div class="numbertext" num-data></div>
                    <img src="" style="width:100%;" img-data>
                    <div class="text" caption-data></div>
                </div>
            </template>
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
        </div>
        <br>

        <div style="text-align:center" dots-data></div>

        <template banner-dot>
            <span class="dot"></span>
        </template>

        <div style="height: 10px;"></div>

        <!-- Top Card Foods -->
        <div id="cardss" class="cardWrapper">
            <div class="cardHeaderText" style="margin-bottom: 10px;">
                <h1>Categories</h1>
            </div>
            <div id="category-card" class="category-card" category-cards></div>
        </div>
        <div style="height: 5px;"></div>

        <div id="menuWrapper" class="menu-wrapper">
            <div class="menu-header-text">
                <h1>Explore the Menu</h1>
            </div>
            <div id="menu-card" menu-cards></div>

            <template data-menu-template>
                <div>
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">

                                <div class="cards" card-bg>
                                    <div class="cards-img-wrapper">
                                        <label id="card-title" class="cards-title-center" data-title></label>
                                    </div>
                                    <div class="cards-body">
                                        <div class="view-btn-wrapper"><button class="view-btn" data-button></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-card-back">
                                <div class="cards" style="background-color: #000000; background-image: none;" card-bg>

                                    <div class="cards-img-wrapper" style="padding: 10px;">
                                        <label hidden></label>
                                        <label id="card-subtitle" data-subtitle style="padding: 10px;"></label>
                                    </div>
                                    <div class="cards-body">
                                        <div class="view-btn-wrapper"><button class="view-btn"
                                                data-button-flip></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </template>

            <template data-category-template>
                <div>
                    <div class="cards" card-bg>
                        <div class="cards-img-wrapper">
                            <label id="card-title" class="cards-title-center" data-title></label>
                        </div>
                    </div>
                </div>
            </template>

            <div class="see-more">
                <a href="./menu.php">
                    <h2 style="text-align:center;">See More</h2>
                </a>

            </div>
        </div>
    </div>
    </div>
    <script src="./js/index.js"></script>
    <script src="./js/sidenav.js"></script>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>

</body>

</html>