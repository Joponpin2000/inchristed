<?php
session_start();

// include function file
require_once('../functions/DatabaseClass.php');

$db_connect = new DatabaseClass();

if(!isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] !== true))
{
	header("location:adminlogin.php");
}


$sql = "SELECT * FROM users WHERE id = :id";
$result = $db_connect->Read($sql, ['id' => $_SESSION['id']]);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
        <title>Inchristed.com</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">

        <link rel="stylesheet" href="../fonts/icomoon/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/magnific-popup.css">
        <link rel="stylesheet" href="../css/jquery-ui.css">
        <link rel="stylesheet" href="../css/owl.carousel.min.css">
        <link rel="stylesheet" href="../css/owl.theme.default.min.css">
        <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
        <link rel="stylesheet" href="../css/aos.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="style.css">

  </head>
  <body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 style="color: white">Admin Panel</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="./">Dashboard</a>
                </li>
                <li>
                    <a href="categories.php">Categories</a>
                </li>
                <li>
                    <a href="posts.php">Posts</a>
                </li>
                <li>
                    <a href="settings.php" class="active">Account Settings</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>
        <div id="content" style="padding-left: 20px; width: 100vw">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button class="btn" type="button" id="sidebarCollapse" style="background: #7386D5;">&#9776;</button>
                </div>
            </nav>
            <div class="title">
                <h3>Account Settings</h3>
            </div>
            <?php
                if ($result)
                {
            ?>
                    <div class="table" style="width: 100%;">
                        <table style="width: 100%">
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                                <?php
                                    foreach ($result as $row)
                                    {
                                ?>
                                        <tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td style="text-align: center;">
                                                <?php
                                                echo "<span class='sett edit'><a href='manage_account.php?id=" . $row['id'] .  "'>Edit</a></span>";
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                        </table>
                    </div>
            <?php 
                }
                else
                {
                    header('location: adminlogin.php');
                }
            ?>


    <script src="jquery-1.12.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script src="cus.js"></script>
    <script src="../js/main.js"></script>
    </body>
</html