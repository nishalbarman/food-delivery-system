<?php include 'header.html';


session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include '../config/db.php';

if (isset($_POST['submit'])) {
    $image = time() . '_' . $_FILES['myfile']['name'];
    $title = $_POST['title'];

    $destination = '../category-image/' . $image;
    $file = $_FILES['myfile']['tmp_name'];

    $extension = pathinfo($image, PATHINFO_EXTENSION);

    if (!in_array($extension, ['png', 'jpg', 'jpeg', 'webp'])) {
        echo "You file extension must be .png, .jpg, .webp or .jpeg";
    } else {
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO `foodcategory` (`catname`, `items`, `image`) VALUES ('$title', '0', '$image');";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Category Created.');</script>";
            }
        } else {
            echo "<script>alert('Failed to Create.');</script>";
        }
    }
}


$sql = "SELECT * FROM `foodcategory`";
$result = mysqli_query($conn, $sql);
$foodcat = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="adminstyles/addfood.css">
    <title>Add Food Category</title>
</head>

<body>
    <div class="content" id="main">
        <h1 class="my-5"><b>
            </b>Add Food Category</h1>
        <div class="login">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="title">Category name</label>
                <input type="text" id="title" name="title" placeholder="Category">

                <label>Choose Image</label>
                <input class="file_up" type="file" name="myfile"> <br>

                <input type="submit" name="submit" value="Submit" />
            </form>
        </div>
        <br>

        <h3 class="my-6" style="text-align: center;"><b>
            </b>Manage Category</h3>

        <div class="tbl">


            <table class="cattable">
                <thead>
                    <th style="text-align:center; ">Category Name</th>
                    <th style="text-align:center; ">Total Items</th>
                    <th style="text-align:center;">Update</th>
                    <th style="text-align:center;">Delete</th>

                </thead>
                <tbody>
                    <?php
                    foreach ($foodcat as $file): ?>
                    <tr>
                        <td style="text-align:center;width: 25%;">
                            <?php echo ucwords(strtolower(str_replace("_", " ", $file['catname']))); ?>
                        </td>

                        <td style="text-align:center;">
                            <?php echo $file['items']; ?>
                        </td>

                        <td style="text-align:center !important;">
                            <a href="updatecat.php?id=<?php echo $file['id']; ?>"><img
                                    style="width: 24px; height: 24px;" src="assets/update.png" /></a>

                        </td>

                        <td style="text-align:center;"><a class="delete"
                                href="deletecat.php?id=<?php echo $file['id'] ?>"><img
                                    style="width: 25px; height: 25px;" src="assets/remove.png" /></a>
                        </td>

                    </tr>



                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>


    </div>
</body>

</html>