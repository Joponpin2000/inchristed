<?php
session_start();

// include function file
require_once('../functions/DatabaseClass.php');

$db_connect = new DatabaseClass();

if(!isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] !== true))
{
	header("location:adminlogin.php");
}

if (isset($_GET['type']) && trim($_GET['type']) != '')
{
    $type = trim($_GET['type']);

    if ($type == 'delete')
    {
        $id = trim($_GET['id']);
        
        // Execute a Delete statement
        $sql = "DELETE FROM topics WHERE id = :id";
        $stmt = $db_connect->Remove($sql, ['id' => $id]);

        // Close statement
        unset($stmt);
    }
}

    $limit = 5;

    if (isset($_GET['page']))
    {
    $page = trim($_GET['page']);
    }
    else
    {
    $page = 1;
    }

    $start_from = ($page-1) * $limit;

    $sql = "SELECT * FROM topics ORDER BY id DESC LIMIT $start_from, $limit";
    $result = $db_connect->Read($sql);
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
                    <a href="categories.php" class="active">Categories</a>
                </li>
                <li>
                    <a href="posts.php">Posts</a>
                </li>
                <li>
                    <a href="books.php">Books</a>
                </li>
                <li>
                    <a href="settings.php">Account Settings</a>
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
                <h3>Categories</h3>
                <h5><a href="manage_categories.php" style="text-decoration: underline; color: #7386D5;">Add Category</a></h5>
            </div>
            <div class="table-responsive" style="width: 100%;">
                <table style="width: 100%" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                        if ($result)
                        {
                    ?>
                            <tbody>
                                <?php
                                    foreach ($result as $row)
                                    {
                                ?>
                                        <tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td  style="word-break: break-all;">
                                                <?php
                                                    $sub = substr_replace($row['description'], "...", 30);
                                                     echo $sub; 
                                                ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?php
                                                echo "<span class='sett edit'><a href='manage_categories.php?id=" . $row['id'] .  "'>Edit</a></span>";

                                                echo "&nbsp;<span class='sett delete'><a href='?type=delete&id=" . $row['id'] .  "'>Delete</a><span>";
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                    <?php
                        }
                    ?>
                </table>
            </div>
            
            <?php
                $result_db = "SELECT COUNT(id) FROM topics";
                $row_db = $db_connect->Read($result_db);
                $total_records = $row_db[0]['COUNT(id)'];
                $total_pages = ceil($total_records / $limit);
                $pagLink = "";
                for ($i = 1; $i <= $total_pages; $i++)
                {
                    if ($i == $page)
                    $pagLink .= "<a class='btn view-btn1' style='margin-right:20px;' href='categories.php?page=" . $i . "'>" . $i . "  </a>";
                    else
                    {                            
                        $pagLink .= "<a class='btn btn-primary view-btn1' style='margin-right:20px' href='categories.php?page=" . $i . "'>" . $i . "  </a>";
                    }
                }
                echo $pagLink;
            ?>
        </div>
        
    </div>


    <script src="jquery-1.12.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script src="cus.js"></script>
    <script src="../js/main.js"></script>
    </body>
</html