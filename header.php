<style>
a {
    text-decoration: none;
    color: #000;
}

a:hover {
    color: rgb(179, 179, 179);
}

.site-header {
    /* border-bottom: 1px solid #ccc; */
    padding: 0.5em 1em;
    display: flex;
    justify-content: space-between;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px,
        rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
}

.site-identity h1 {
    font-size: 1.5em;
    margin: 0.6em 0;
    display: inline-block;
    padding-left: 10px;
}

.site-navigation ul,
.site-navigation li {
    margin: 0;
    padding: 0;
}

.site-navigation li {
    display: inline-block;
    margin: 1.4em 1em 1em 1em;
}

.main {
    margin-left: 5rem;
    margin-right: 5rem;
}

@media only screen and (max-width: 2906px) {
    .main {
        margin-left: 15rem;
        margin-right: 15rem;
    }
}

@media only screen and (max-width: 2197px) {
    .main {
        margin-left: 8rem;
        margin-right: 8rem;
    }
}

@media only screen and (max-width: 1159px) {
    .main {
        margin-left: 6rem;
        margin-right: 6rem;
    }
}

@media only screen and (max-width: 800px) {
    .main {
        margin-left: 2rem;
        margin-right: 2rem;
    }

    .flip-card {
        height: auto;
        width: auto;
        aspect-ratio: 1 / 1;
        margin-bottom: 150px;
        perspective: 1000px;
        background-color: none;
    }

    /* .flip-card {
        height: auto;
        width: 200px;
        aspect-ratio: 1 / 1;
        margin-bottom: 150px;
        perspective: 1000px;
        background-color: none;
    } */
}

@media only screen and (max-width: 600px) {
    .main {
        margin-left: 1rem;
        margin-right: 1rem;
    }
}
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<header class="site-header">
    <div class="site-identity">
        <h1><a href="index.php">Food Clash</a></h1>
    </div>
    <nav class="site-navigation">
        <ul class="nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="menu.php">Food Menu</a></li>
            <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) { ?>
            <li><a href="orders.php">My Orders</a></li>
            <li><a href="myaccount.php">My Account</a></li>
            <li><a id="loginBtnHead" href="logout.php" onclick="logOut()">LogOut</a></li>
            <?php } else { ?>
            <li><a href="login.php">Login</a></li>
            <?php } ?>

        </ul>
    </nav>
</header>
<!-- <script src="header.js"></script> -->