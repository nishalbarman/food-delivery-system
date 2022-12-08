<?php include 'config/db.php';

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {

} else {
    header('location: dashboard.php');
}

if (isset($_POST['submit'])) {
    $username = $_POST['uname'];
    $password = $_POST['upass'];

    // $username = stripcslashes($username);
    // $password = stripcslashes($password);
    // $username = mysqli_real_escape_string($conn, $username);
    // $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM `admin` where username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // if ($result === false) {
    // } else {

    // }

    $count = mysqli_num_rows($result);
    if ($count === 1) {
        echo "<script>alert('Login Successful');</script>";
        session_unset();
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        header('location: dashboard.php');
    } else {
        echo "<script>alert('Login Failed! User name or passwordd invalid');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nishal Barman" />
    <title>College Portal System -- Nishal Barman</title>
    <link rel="stylesheet" href="styles/index.css" />
</head>

<body>
    <!-- <?php include 'sidenav.html'; ?> -->
    <div class="container">
        <div class="header">
            <h2>College Portal System Login</h2>
        </div>

        <div class="error_text">
            <span id="error" style="color: red; font-weight: bold">User name or password invalid</span>
        </div>

        <div class="formWrapper">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" id="login_form">
                <div class="unameWrapper">
                    <label>User Name : <span style="color: red; vertical-align: middle;">*</span></label><br />
                    <input type="text" id="uname" name="uname" required />
                </div>

                <div class="passWrapper">
                    <label>Password : <span style="color: red; vertical-align: middle;">*</span></label><br>
                    <input type="password" id="upass" name="upass" required />
                </div>

                <div class="forgotWrapper">
                    <a class="forgot" href="#">Forgot Password?</a>
                </div>

                <div class="loginWrapper">
                    <center>
                        <input type="submit" class="submit" value="Login" name="submit" />
                    </center>
                </div>

            </form>
            <div class="regWrapper" style="text-align: center;">
                <a class="register" href="register.php">Register!</a>
            </div>
        </div>
    </div>
    </div>
</body>

</html>