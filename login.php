<?php
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
    // $_SESSION['fullname'] = $row['fname'] + $row['lname'];
    // $_SESSION['addresss'] = $row['address'];
    // $_SESSION['email'] = $row['email'];
    // $_SESSION['phone'] = $row['phone'];
    // $_SESSION['logged'] = true;
    // $_SESSION['role'] = 'user';
    header("location: ./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tomato Food Delivery</title>

    <link rel="stylesheet" href="styles/log.css">

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <script type="text/javascript">
        function generateCaptcha() {
            let alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
                'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
                'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
            let i;

            let a, b, c, d;
            for (i = 0; i < 4; i++) {
                a = alpha[Math.floor(Math.random() * alpha.length)];
                b = alpha[Math.floor(Math.random() * alpha.length)];
                c = alpha[Math.floor(Math.random() * alpha.length)];
                d = alpha[Math.floor(Math.random() * alpha.length)];
            }
            let code = a + ' ' + b + ' ' + ' ' + c + ' ' + d;
            document.getElementById("mainCaptcha").value = code;

            let background = new Array('captcha1', 'captcha2', 'captcha3');
            let back = background[Math.floor(Math.random() * background.length)];
            document.getElementById("mainCaptcha").style.backgroundImage = "url('./assets/" + back + ".jpg')";
        }

        function CheckValidCaptcha() {

        }

        function removeSpaces(string) {
            return string.split(' ').join('');
        }
    </script>
</head>

<body onload="generateCaptcha()">
    <section class="container forms">

        <div class="form login">

            <div class="form-content">
                <h2 class="heading">Login</h2>
                <form id="loginForm">

                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input" id="uid" name="uname" required>
                    </div>

                    <div class=" field input-field">
                        <input type="password" placeholder="Password" class="password" id="pass" name="upass" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class=" field input-field">
                        <input type="text" id="mainCaptcha" readonly="readonly"
                            style="text-align:center; font-size: 20px; color: white;" />
                        <!-- <img style="width: 10px; height: 10px;" src="./assets/refresh.png" /> -->
                    </div>

                    <div class=" field input-field">
                        <!-- <input type="button" id="refresh" value="Refresh" onclick="generateCaptcha();" /> -->
                        <input type="text" placeholder="Captcha" class="input" id="captcha" name="captcha" required>
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
                    </div>

                </form>
                <div class="field button-field">
                    <button id="loginBtn">Login</button>
                </div>

                <div class="form-link">
                    <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                </div>
            </div>


        </div>


        <div class="form signup">

            <div class="form-content">
                <h2 class="heading">Signup</h2>
                <div id="m-reg">
                    <form id="regForm">

                        <div class="field input-field">
                            <input type="text" placeholder="Name" class="input" name="name" required>
                        </div>

                        <div class="field input-field">
                            <input type="number" placeholder="Phone No" class="input" name="phone" required>
                        </div>

                        <div class="field input-field">
                            <input type="email" placeholder="Email" class="input" id="email" name="email" required>
                        </div>

                        <div class="field input-field">
                            <input type="address" placeholder="Address" class="input" name="address" required>
                        </div>

                        <div class="field input-field">
                            <input type="text" placeholder="Pincode" class="input" name="pincode" required>
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Create Password" class="password" name="password"
                                required>
                            <i class='bx bx-hide eye-icon'></i>
                        </div>
                        <div class="field input-field">
                            <input type="password" placeholder="Confirm Password" class="password" required>
                        </div>

                    </form>
                    <div class="field button-field">
                        <button id="regBtn">Send OTP</button>
                    </div>
                </div>
                <div id="reg-otp" style="display: none">
                    <form id="formOtp">

                        <div class="field input-field" id="otpInput">
                            <input type="number" placeholder="OTP Here" class="input" id="otpField" name="otp" required>
                        </div>
                        <div class="form-link">
                            <label id="otp-status" class="forgot-pass">Trying to send OTP</label>
                        </div>
                    </form>
                    <div class="field button-field">
                        <button id="otpBtn">Confirm OTP</button>
                    </div>
                </div>

                <div class="form-link">
                    <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                </div>
            </div>

        </div>
    </section>

    <!-- JavaScript FILE LINK -->
    <script src="js/log.js"></script>

</body>

</html>