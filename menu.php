<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our food items</title>
    <link rel="stylesheet" href="styles/menu.css" />
    <link rel="stylesheet" href="styles/sidenav.css" />
    <link rel="stylesheet" href="styles/head.css" />
    <link rel="stylesheet" href="./styles/cardflip.css" />
    <script>
    function logOut() {
        window.localStorage.setItem("authToken", '');
        window.localStorage.setItem("userId", '');
    }
    </script>
    <style>
    .hide {
        display: none;
    }
    </style>
</head>

<body>

    <?php include('header.php'); ?>

    <div id="main" class="main">
        <div class="searchBar" style="margin-top: 40px" class="main">
            <form id="search-form" class="search-form">
                <input class="sInput" type="search" placeholder="Search" aria-label="Search" searchInput>
            </form>
        </div>

        <div id="dish-items">
            <h1 id="title-head">Food Menu</h1>
            <p></p>
            <div id="menu-card" menu-cards></div>
        </div>

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
                                    <div class="view-btn-wrapper"><button class="view-btn" data-button-flip></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
        </template>

    </div>
    <script>
    // src="js/menu.js"
    // let loggedin = window.localStorage.getItem("authToken");
    let loggedin = "<?php if (isset($_SESSION['logged'])) {
            echo $_SESSION['logged'];
        } else {
            echo '';
        } ?>";
    console.log(loggedin);
    if (loggedin === "") {
        alert("You are not logged, order can't be placed.");
    }

    let userid = window.localStorage.getItem("userId");

    let cat = window.localStorage.getItem("cat");
    console.log(cat);
    let menuApi;
    if (cat === "") {
        menuApi = "./api/get-menu.php";
    } else {
        document.getElementById("title-head").innerHTML =
            cat + " <span class='show-all' onclick='loadAll()'>( Show all )</span> ";

        menuApi = "./api/get-menu.php?cat=" + cat;
        window.localStorage.setItem("cat", "");
    }

    const menuTemplate = document.querySelector("[data-menu-template]");
    const menuCards = document.querySelector("[menu-cards]");
    const search = document.querySelector("[searchInput]");
    let users = [];

    search.addEventListener("input", (e) => {
        value = e.target.value.toLowerCase();
        console.log(value);

        users.forEach((user) => {
            let t = user.title.toLowerCase();
            let s = user.subtitle.toLowerCase();

            const isVisible = t.includes(value) || s.includes(value);

            isVisible
                ?
                user.element.classList.remove("hide") :
                user.element.classList.add("hide");
        });
    });

    fetch(menuApi)
        .then((res) => res.json())
        .then((data) => {
            users = data.map((user) => {
                const menu = menuTemplate.content.cloneNode(true).children[0];

                const title = menu.querySelector("[data-title]");
                const subtitle = menu.querySelector("[data-subtitle]");
                const cardbg = menu.querySelector("[card-bg]");
                const button = menu.querySelector("[data-button]");
                const buttonFlip = menu.querySelector("[data-button-flip]");
                let image = "./food-images/" + user.image;

                cardbg.style.backgroundImage = "url(" + image + ")";
                title.textContent = user.title;
                subtitle.textContent = user.subtitle;
                button.textContent = user.amount + " INR /-";
                button.setAttribute("onclick", "buyFood(" + user.id + ")");
                buttonFlip.textContent = user.amount + " INR /-";
                buttonFlip.setAttribute("onclick", "buyFood(" + user.id + ")");
                menuCards.appendChild(menu);
                return {
                    title: user.title,
                    subtitle: user.subtitle,
                    image: user.image,
                    element: menu,
                };
            });
        });

    function loadAll() {
        window.localStorage.setItem("cat", "");
        console.log(cat);
        window.location = "./menu.php";
    }

    function buyFood(id) {
        // let loggedin = window.localStorage.getItem("authToken");
        let loggedin = "<?php if (isset($_SESSION['logged'])) {
            echo $_SESSION['logged'];
        } else {
            echo '';
        } ?>";
        console.log(loggedin);
        if (loggedin == "") {
            alert("Need to be logged in to place an order.");
        } else {
            window.location = "./payu/index.php?id=" + id + "&userid=" + userid;
            // window.location =
            //     "http://localhost/food/payu/i/ndex.php?id=" + id + "&userid=" + userid;
        }
    }

    // function buyFood(id) {
    //   if (!(loggedin !== "" && loggedin === "true")) {
    //     window.location = "login.html";
    //   } else {
    //     window.location =
    //       "http://localhost/food/payu/i/ndex.php?id=" + id + "&userid=" + userid;
    //   }
    // }
    </script>
    <script src="js/sidenav.js"></script>
    <!-- <script>
    window.smoothScroll = function(target) {
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

        scroll = function(c, a, b, i) {
            i++;
            if (i > 30) return;
            c.scrollTop = a + (b - a) / 30 * i;
            setTimeout(function() {
                scroll(c, a, b, i);
            }, 20);
        }
        // start scrolling
        scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
    }
    </script> -->
</body>

</html>