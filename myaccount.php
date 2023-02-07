<?php
session_start();
if (!(isset($_SESSION['logged']) && $_SESSION['logged'] === true)) {
    // $_SESSION['fullname'] = $row['fname'] + $row['lname'];
    // $_SESSION['addresss'] = $row['address'];
    // $_SESSION['email'] = $row['email'];
    // $_SESSION['phone'] = $row['phone'];
    // $_SESSION['logged'] = true;
    // $_SESSION['role'] = 'user';
    header("location: ./login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomato - My Orders</title>
    <link rel="stylesheet" href="styles/myaccount.css" />
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
</head>

<body>

    <?php include('header.php'); ?>

    <div id="main" style="margin-top: 20px;" class="main">
        <div class="container">
            <div class="side-bar">
                <div class="user-info">
                    <div class="user-img">
                        <img src="user-pic/profile.webp" class="user-img-el" />
                    </div>
                    <div class="user-body">
                        <div class="greeting">
                            <label user-greeting>Hello</label><label>,</label>
                        </div>
                        <div class="user-name">
                            <label user-name>Nishal Barman</label>
                        </div>
                    </div>
                </div>
                <div class="other-details">
                    <div class="profile-title">
                        <a href="#" class="myaccount-a" onclick="toogleMe(this)" account-sidebar>Profile Settings</a>
                    </div>
                    <div class="profile-address">
                        <a href="#" class="myaccount-a" onclick="toogleMe(this)" account-sidebar>Give Feedback</a>
                    </div>
                </div>
            </div>

            <div id="profile-setting" class="info-container">
                <div class="info-container-title">
                    <label info-container-title-el>Profile Settings</label>
                </div>
                <div class="user-data-container">
                    <div class="name">
                        <div class="inputWrapper">
                            <label class="fadeout">&#x2192; First Name <span class="required">*</span> &#x2190;</label>
                            <input name="fname" id="fname" type="text" class="inputs" value="<?php if (isset($_SESSION['fname'])) {
                                echo $_SESSION['fname'];
                            } else {
                                echo '';}?>" />
                        </div>
                        <div class="gap"></div>
                        <div class="inputWrapper">
                            <label class="fadeout">&#x2192; Last Name <span class="required">*</span> &#x2190;</label>
                            <input name="sname" id="sname" type="text" class="inputs" value="<?php if (isset($_SESSION['sname'])) {
                                echo $_SESSION['sname'];
                            } else {
                                echo '';}?>" />
                        </div>
                    </div>
                    <div class="name">
                        <div class="inputWrapper">
                            <label class="phone">&#x2192; Phone Number <span class="required">*</span> &#x2190;</label>
                            <input name="fname" id="phone" type="text" class="inputs" value="<?php if (isset($_SESSION['phone'])) {
                                echo $_SESSION['phone'];
                            } else {
                                echo '';}?>" />
                        </div>

                    </div>

                    <div class="name">
                        <div class="inputWrapper">
                            <label class="phone">&#x2192; Email Address <span class="required">*</span> &#x2190;</label>
                            <input id="email1" name="email" type="emails" class="inputs" disabled email />
                        </div>

                    </div>

                    <div class="name">
                        <div class="inputWrapper">
                            <label class="phone">&#x2192; Gender <span class="required">*</span> &#x2190;</label>
                            <select name="gender" id="gender">
                                <option value="<?php if (isset($_SESSION['gender'])) {
                                echo $_SESSION['gender'];
                            } else {
                                echo '';}?>"><?php if (isset($_SESSION['gender']) && $_SESSION['gender'] !== "") {
                                    echo $_SESSION['gender'];
                                } else {
                                    echo '--- Select ---';}?></option> <span class="required">*</span>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                    </div>

                    <div class="name">
                        <div class="inputWrapper" style="height: 100px;">
                            <label class="phone">&#x2192; Address <span class="required">*</span> &#x2190;</label>
                            <textarea name="address" id="address" type="address" class="inputs" placeholder="Address"><?php if (isset($_SESSION['address'])) {
                                echo $_SESSION['address'];
                            } else {
                                echo '';}?></textarea>
                        </div>

                    </div>

                    <div class="name">
                        <div class="inputWrapper">
                            <label class="phone">&#x2192; Pin Code <span class="required">*</span> &#x2190;</label>
                            <input name="pincode" id="pincode" type="number" class="inputs" value="<?php if (isset($_SESSION['pincode'])) {
                                echo $_SESSION['pincode'];
                            } else {
                                echo '';}?>" />
                        </div>

                    </div>

                    <div class="name">
                        <div class="inputWrapper"
                            style="width: 80%; padding: none; text-align: center; background-color: orange; outline: none; border: none; margin: auto;  margin-top: 20px; margin-bottom: 20px;">
                            <button id="submit" class="submit-btn">Update</button>
                        </div>

                    </div>
                </div>
            </div>

            <div id="feedback-form" class="info-container" style="display: none;">
                <div class="info-container-title">
                    <label info-container-title-el>Feedback</label>
                </div>
                <div class="user-data-container">
                    <div class="name">
                        <div class="inputWrapper">
                            <label class="phone">&#x2192; Email Address <span class="required">*</span> &#x2190;</label>
                            <input id="email2" name="email" type="email" class="inputs" disabled email />
                        </div>
                    </div>

                    <div class="name">
                        <div class="inputWrapper">
                            <label class="phone">&#x2192; Subject / Title <span class="required">*</span>
                                &#x2190;</label>
                            <input id="title" name="title" type="text" class="inputs" title />
                        </div>
                    </div>

                    <div class="name">
                        <div class="inputWrapper" style="height: 100px;">
                            <label class="phone">&#x2192; Feedback <span class="required">*</span> &#x2190;</label>
                            <textarea name="feed" id="feed" type="text" class="inputs" placeholder="Feedback" value=""
                                feedback></textarea>
                        </div>
                    </div>

                    <div class="name">
                        <div class="inputWrapper"
                            style="width: 80%; padding: none; text-align: center; background-color: orange; outline: none; border: none; margin: auto;  margin-top: 20px; margin-bottom: 20px;">
                            <button id="submit-feed" class="submit-btn">Submit Feedback</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script>
    // src="js/myaccount.js"
    let userid =
        "<?php if (isset($_SESSION['logged'])) {
                echo $_SESSION['email'];
            } else {
                echo '';
            } ?>";
    console.log(userid);
    console.log(userid);
    const emails = document.querySelectorAll("[email]");
    emails.forEach((element) => {
        element.value = userid;
    });

    function toogleMe(target) {
        if (target.textContent === "Give Feedback") {
            document.getElementById("profile-setting").style.display = "none";
            document.getElementById("feedback-form").style.display = "block";
        }
        if (target.textContent === "Profile Settings") {
            document.getElementById("profile-setting").style.display = "block";
            document.getElementById("feedback-form").style.display = "none";
        }
    }
    </script>
    <script src="js/sidenav.js"></script>
    <script>
    const submitFeed = document.querySelector("#submit-feed");
    const submit = document.querySelector("#submit");
    submitFeed.addEventListener('click', () => {
        if (document.querySelector("[feedback]").value === '' || document.querySelector("[title]").value ===
            '') {
            alert("All fields are required.");
        } else {
            let formdata = new FormData();
            formdata.append("email", window.localStorage.getItem("userId"));
            formdata.append("title", document.getElementById('title').value);
            formdata.append("feedback", document.getElementById('feed').value);

            let postData = {
                body: formdata,
                method: "post"
            }

            fetch("./api/post-feedback.php", postData).then(res => res.json()).then(data => {
                if (data.success === true) {
                    document.getElementById('feed').value = "";
                    alert("Your feedback has been recorded, thank you.");
                } else {
                    alert("Some error has occured, feedback failed to send.");
                }
            })
        }
    });

    submit.addEventListener('click', () => {
        // if (document.querySelector("[feedback]").value === '' || document.querySelector("[title]").value ===
        //     '') {
        //     alert("All fields are required.");
        // } else {
        let formdata = new FormData();
        formdata.append("fname", document.getElementById('fname').value);
        formdata.append("sname", document.getElementById('sname').value);
        formdata.append("phone", document.getElementById('phone').value);
        formdata.append("email", document.getElementById('email1').value);
        formdata.append("gender", document.getElementById('gender').value);
        formdata.append("address", document.getElementById('address').value);
        formdata.append("pincode", document.getElementById('pincode').value);
        formdata.append("submit", document.getElementById('submit').value);

        let postData = {
            body: formdata,
            method: "post"
        }

        fetch("./api/post-update-profile.php", postData).then(res => res.json()).then(data => {
            if (data.success === true) {
                document.getElementById('feed').value = "";
                alert("Profile Updated Successfuly.");
            } else {
                alert("Some error has occured, profile updatation failed..");
            }
        })
        // }
    });
    </script>
</body>

</html>