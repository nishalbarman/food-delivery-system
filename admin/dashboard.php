<?php
include '../config/db.php';
$conn = mysqli_connect($host, $un, $pass, $db);
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: index.php');
    exit;
}

$username = $_SESSION['username'];

$sql = "select * from admin where username = '$username'";

$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($res)) {
    $name = $row['username'];
    $roll = $row['roll'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/dashboard.css" />
    <title>Admin Portal</title>
</head>

<body>
    <?php include('sidenav.html'); ?>
    <div id="main">
        <div class="content">

            <div class="details">
                <div class="notice">
                    <span class="nT">Details</span>
                </div>
                <div class="sec">
                    <div class="notice-content">
                        <div class="flex">
                            <span id="name" class="name">
                                <span style="color: green">User:</span>
                                <?php echo $name; ?>,
                            </span>
                            <span id="roll" class="roll"> <span style="color: green"> Roll:
                                </span>
                                <?php echo $roll; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <br>
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
        <!-- <script src="js/dashboard.js"></script> -->
        <script>
            const noticeSec = document.getElementById('section');

            fetch('http://localhost/college/api/getNotice.php').then(res => res.json()).then(function (data) {
                console.log(data);
                data.forEach(element => {

                    const div_card = document.createElement('div');
                    div_card.setAttribute('class', 'notice-content');

                    const noticeText = document.createElement('a');
                    noticeText.setAttribute('class', 'notice-text');
                    noticeText.setAttribute('id', 'notic');
                    noticeText.innerHTML = '🔥 ' + `${element.title}`;
                    noticeText.href = `${element.link}`;

                    div_card.appendChild(noticeText);
                    noticeSec.appendChild(div_card);

                    noticeSec.appendChild(noticeText);

                });

            });
        </script>
</body>

</html>