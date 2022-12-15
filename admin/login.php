<?php
include '../config/db.php';

$error = 0;

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $sql = "SELECT * FROM `admin` where `email`='$email' and `password`='$pass'";

    $res = $conn->query($sql);
    $count = $res->num_rows;
    if ($count > 0) {
        while ($row = $res->fetch_assoc()) {
            $name = $row["name"];
        }
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = "admin";
        $_SESSION['username'] = $name;
        header("location: ./index.php");
    } else {
        $error = 1;
    }
}

if (isset($_POST['reg'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO `admin`(`email`, `phone`, `name`, `password`) values ('$email','$phone','$name','$pass');";

    if ($conn->query($sql) === true) {
        echo "<script>alert('Registration Successful.');</script>";
    } else {
        $error = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tomato Food Delivery</title>

    <link rel="stylesheet" href="./adminstyles/login.css">

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script>
        function showErr() {
            let error = <?php echo $error; ?>;
            if (error === 1) {
                document.getElementById("error").style.display = "block";
            }
        }
    </script>
</head>

<body onload="showErr()">
    <section class="container forms">

        <div class="form login">

            <div class="form-content">
                <h2 class="heading">Login</h2>

                <form action="" method="post" enctype="application/x-www-form-urlencoded">
                    <span id="error"
                        style="display: none; color: red; font-size: 15px; font-weight: bold; font-style: italic;">Incorrect
                        email or
                        password.</span>
                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input" name="email" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" name="pass" placeholder="Password" class="password" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
                    </div>

                    <div class="field button-field">
                        <input type="submit" name="login" value="Login" class="button" />
                    </div>
                </form>

                <div class="form-link">
                    <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                </div>
            </div>


        </div>
        <!-- ./log.php
./log.php -->

        <div class="form signup">

            <div class="form-content">
                <h2 class="heading">Signup</h2>
                <form action="" method="post" enctype="application/x-www-form-urlencoded">

                    <div class="field input-field">
                        <input type="text" placeholder="Name" class="input" name="name" required>
                    </div>

                    <div class="field input-field">
                        <input type="number" placeholder="Phone No" class="input" name="phone" required>
                    </div>

                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input" name="email" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Create Password" class="password" name="pass" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="field input-field">
                        <input type="password" placeholder="Confirm Password" class="password" required>
                    </div>

                    <div class="field button-field">
                        <input type="submit" id="signupBtn" name="reg" value="Signup" class="button" />
                    </div>
                </form>

                <div class="form-link">
                    <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                </div>
            </div>

        </div>
    </section>

    <!-- JavaScript FILE LINK -->
    <script src="./js/login.js"></script>
</body>

</html>