<?php
session_start();
$_SESSION = array();
session_destroy();

header("location: ./index.php");

?>


<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout from Dashboard</title>
</head>

<body onload="logOut()">
    <script>
    function logOut() {
        window.localStorage.setItem("authToken", "");
        window.localStorage.setItem("userid", "");
        window.location = "login.php";
    }
    </script>
</body>

</html> -->