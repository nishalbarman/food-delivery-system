<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ./login.php");
    exit;
} else {
    if ($_SESSION['role'] !== 'admin') {
        header("location: ./login.php");
        exit;
    }
}

include './../config/db.php';

$id = $_GET['id'];

$sql = "SELECT * from foodfeedback where id = $id";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $email = $row['email'];
    $title = $row['title'];
    $feedback = $row['feedback'];
}

$sql = "SELECT * from users where email = '$email'";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $phone = $row['phone'];
    $fullname = $row['fname'] . " " . $row['lname'];
}

if (empty($fullname)) {
    $fullname = "User deleted";
}

if (empty($phone)) {
    $phone = "User deleted";
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomato - Food order online</title>
    <link rel="stylesheet" href="./adminstyles/details.css" />
    <link rel="stylesheet" href="./adminstyles/sidenav.css" />
</head>

<body>

    <?php include 'header.html'; ?>

    <div id="main">
        <div id="mid">
            <div class="info">
                <h2>Contact Info</h2>
                <p>
                    Name :
                    <b>
                        <?php echo $fullname; ?>
                    </b></br>
                    Phone :
                    <b>
                        <?php echo $phone; ?>
                    </b></br>
                    Email :
                    <b>
                        <?php echo $email; ?>
                    </b></br>
                    Title :
                    <b>
                        <?php echo $title; ?>
                    </b></br>
                    Feedback :
                    <b>
                        <?php echo $feedback; ?>
                    </b></br>
                </p>
            </div>
        </div>

        <div id="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Title</h2>
                        </td>
                        <td class="item">
                            <h2></h2>
                        </td>
                        <td class="Rate">
                            <h2>Feedback</h2>
                        </td>
                    </tr>

                    <tr class="service">
                        <td class="tableitem">
                            <p class="itemtext">
                                <?php echo $title; ?>
                            </p>
                        </td>
                        <td class="item">
                            <h2></h2>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">
                                <?php echo $feedback; ?>
                            </p>
                        </td>
                    </tr>

                </table>
            </div>
            <!--End Table-->

            <div class="below-btn">
                <div class="buttons">
                    <button id="order-details" class="view-details" order-button onclick="window.print()">Print</button>
                </div>
            </div>

        </div>
    </div>
    <!-- <script>
        function mark(msg) {
            if (msg) {
                fetch("./api/mark.php?id=<?php echo $id; ?>&data=" + msg).then(res => res.json()).then(data => {
                    if (data.success === true) {
                        alert("Status updated");
                        document.getElementById("status").innerHTML = msg;
                    } else {
                        alert("Status update failed.");
                    }
                });
            }
        }
    </script> -->
</body>

</html>