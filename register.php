<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Food Clash - Register</title>
    <link rel="stylesheet" href="styles/reg.css" />
</head>

<body>

    <div class="formWrapper" id="formWrapper">
        <!-- <form action="api/login.php" method="post" enctype="application/x-www-form-urlencoded" id="login_form"> -->
        <form id="loginForm">
            <div class="name-flex">
                <div class="inputWrapper" style="margin-right: 50px;">
                    <label>First Name :
                        <span style="color: red; vertical-align: middle">*</span>
                    </label><br />
                    <input id="ufname" type="text" name="ufname" autocomplete="false" required />
                </div>

                <div class="inputWrapper">
                    <label>Last Name :
                        <span style="color: red; vertical-align: middle">*</span>
                    </label><br />
                    <input id="ulname" type="text" name="ulname" autocomplete="false" required />
                </div>
            </div>
            <div class="inputWrapper">
                <label>Phone No. (Without +91) :
                    <span style="color: red; vertical-align: middle">*</span>
                </label><br />
                <input id="uid" type="number" name="uid" autocomplete="false" required />
            </div>

            <div class="inputWrapper">
                <label>Email Address :
                    <span style="color: red; vertical-align: middle">*</span>
                </label><br />
                <input id="email" type="email" name="email" autocomplete="false" required />
            </div>

            <div class="inputWrapper">
                <label>Address :
                    <span style="color: red; vertical-align: middle">*</span>
                </label><br />
                <textarea id="uaddress" type="text" name="uaddress" autocomplete="false" required></textarea>
            </div>

            <div class="inputWrapper">
                <label>Password :
                    <span style="color: red; vertical-align: middle">*</span>
                </label><br />
                <input id="pass" type="password" name="upass" autocomplete="false" required />
            </div>
            <br>

        </form>
        <div class="loginWrapper">
            <!-- <center> -->
            <!-- <input type="submit" class="submit" value="Login" name="submit" /> -->
            <button id="loginBtn" class="submit">Register</button>
            <!-- </center> -->
        </div>
        <div class="regWrapper" style="text-align: center">
            <a class="register" href="login.html">Login!</a>
        </div>
    </div>
    <div class="formWrapper" id="otpForm" style="display: none;">

        <form id="loginForm">
            <div class="inputWrapper">
                <lable id="errorTxt" style="color: red; font-weight: bold; display: none;">Invalid OTP</lable>
                <br>
                <label>OTP :
                    <span style="color: red; vertical-align: middle">*</span>
                </label><br />
                <input id="otp" type="number" name="otp" autocomplete="false" required />
            </div>
        </form>
        <div class="loginWrapper">
            <!-- <center> -->
            <!-- <input type="submit" class="submit" value="Login" name="submit" /> -->
            <button id="otpBtn" class="submit">Verify</button>
            <!-- </center> -->
        </div>

    </div>
    <!-- </div> -->
    <script src="js/register.js"></script>
</body>

</html>