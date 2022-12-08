<?php
include 'config/db.php';

$conn = mysqli_connect($host, $un, $pass, $db);

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: index.php');
    exit;
}

$username = $_SESSION['username'];

$sql = "select * from students where username = '$username'";

$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($res)) {
    $name = $row['fullname'];
    $phone = $row['phone'];
    $address = $row['address'];
}

if (isset($_POST['submit'])) {
    $title = $_POST['ntitle'];
    $visible = $_POST['visible'];
    $file_name = $_FILES['filename']['name'];
    $file_size = $_FILES['filename']['size'];
    $file_tmp = $_FILES['filename']['tmp_name'];
    $exten = array();
    $errors = array();
    $chars = str_split($file_name);
    $extensions = array("jpeg", "jpg", "png");
    $count = 1;

    foreach ($chars as $single) {
        if ($count === 0) {
            $exten[] = $single;
        }

        if ($single === '.') {
            $count = 0;
        }
    }

    $fileextension = implode("", $exten);

    if (!($fileextension === "jpg" || $fileextension === "png" || $fileextension === "pdf")) {
        $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (isset($file_name) and !empty($file_name)) {
        if (empty($errors) == true) {
            $location = '../notice/';
            $new_file = $location . time() . '_' . $file_name;
            $link = "http://localhost:80/college/" . $new_file;

            if (move_uploaded_file($file_tmp, $new_file)) {
                $sql = "INSERT INTO `notice` (`title`, `link`, `visible`) VALUES ('$title', '$link', '$visible')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Notice uploaded successfully');</script>";
                } else {
                    unlink($new_file);
                    echo "<script>alert('Database error');</script>";
                }
            }
        } else {
            echo "<script>alert('" . implode(' ', $errors) . "');</script>";
        }
    } else {
        $sql = "INSERT INTO `notice` (`title`, `link`, `visible`) VALUES ('$title', 'null', '$visible')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Notice uploaded successfully');</script>";
        } else {
            echo "<script>alert('Database error');</script>";
            // echo mysqli_errno($conn) . ": " . mysqli_error($conn);
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/addnotice.css" />
    <style>
        * {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

        }

        #main {
            text-align: center;
        }

        h3 {
            font-size: 27px;
            text-align: left;
        }

        .col label {
            font-size: 20px;
            font-weight: bold;
            margin-right: 30px;
            width: 150px;
            margin-top: 11px;
            margin-left: 25px;
        }

        .row {
            margin-top: 27px;
            display: inline-block;
            margin-left: 0 auto;
            margin-right: 0 auto;
            justify-content: center;
            width: 85%;
            margin-bottom: 30px;
            border: 2px double #000080;
            border-radius: 10px;
            padding-top: 10px;
            padding-bottom: 30px;
        }

        .col {
            margin-top: 15px;
            display: flex;
            text-align: left;
        }

        input,
        select {
            margin-right: 25px;
            margin-top: 5px;
            margin-top: 5px;
        }

        input[type="text"] {
            height: 36px;
            width: 100%;
            outline: none;
            border: 1px dashed black;
            border-radius: 5px;
            margin-top: 5px;
            padding-left: 8px;
            padding-right: 8px;
            font-size: 18px;
            -moz-appearance: textfield;
        }

        input[id="file-upload"] {
            height: 31px;
            outline: none;
            width: 100%;
            border: 1px dashed black;
            padding-left: 8px;
            padding-top: 9px;
            font-size: 15px;
        }

        select {
            height: 40px;
            width: 100%;
            outline: none;
            border: 1px dashed black;
            border-radius: 5px;
            margin-top: 5px;
            padding-left: 8px;
            padding-right: 8px;
            font-size: 18px;
            -moz-appearance: textfield;
        }

        .file {
            outline: none;
            border: 1px dashed black;
            border-radius: 5px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }


        .material-symbols-outlined:hover {
            color: lightgreen;
        }

        .notification {
            display: block;
        }

        .notice {
            padding-top: 4px;
            margin-left: auto;
            margin-right: auto;
            border: 2px double #000080;
            border-radius: 5px;
            width: 85%;
            height: 27px;
            margin-bottom: 2px;
            text-align: center;
            background-color: #7fa8ff;
        }

        .sec {
            top: 0;
            z-index: 1;
            margin-left: auto;
            margin-right: auto;
            border: 2px double #000080;
            border-radius: 5px;
            width: 84%;

        }

        .notice-content {
            z-index: 1;
            top: 0;
            text-align: left;
            margin-bottom: 10px;
            margin-left: 10px;
        }

        .nT {
            height: auto;
            font-size: 20px;
            text-align: center;
            font-weight: bold;
            margin-top: auto;
            margin-bottom: auto;
            color: white;

        }

        .notice-text {
            font-size: 20px;
            font-weight: bold;
            color: #ff0000;
            display: block;
            margin-bottom: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.4s;

        }

        .notice-text:hover {
            color: #7fa8ff;
        }

        .ntbtn {
            margin-top: 25px;
            width: 60%;
            height: 50px;
            border: none;
            border-radius: 10px;
            background-color: #7fa8ff;
            color: white;
            font-weight: bold;
            font-size: 16px;
            transition: 0.4s;
            cursor: pointer;
        }

        .ntbtn:hover {
            background-color: #3e7cff;
            box-shadow: 5px 5px 10px #7fa8ff;

        }
    </style>
</head>

<body>
    <?php include 'sidenav.html'; ?>
    <div id="main">
        <h3>Add Notice</h3>
        <hr>
        <div class="row">
            <form action="" method="post" enctype="multipart/form-data" name="noticeform" id="noticeform">
                <div class="col">
                    <label>Notice</label>
                    <input type="text" name="ntitle" id="title" class="notice-title" placeholder="Notice Title"
                        required />
                </div>
                <div class="col">
                    <label for="file-upload" class="custom-file-upload">
                        File
                    </label>
                    <input id="file-upload" type="file" name="filename" />
                </div>
                <div class="col">
                    <label>Visible</label>
                    <select name="visible" id="title" class="notice-visible">
                        <option value="std">Student</option>
                        <option value="fac">Faculty</option>
                    </select>
                </div>
                <input class="ntbtn" type="submit" name="submit" value="Add Notification" />
            </form>
        </div>

        <div class="notification">
            <div class="notice">
                <span class="nT">Notifications</span>
            </div>
            <div class="sec">
                <div class="notice-content">
                    <section id="section"></section>
                </div>
            </div>
            <br>
        </div>

    </div>
    <script src="js/sidenav.js"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>