<?php
session_start();

// include function file
require_once('../functions/DatabaseClass.php');
require_once('../functions/functions.php');


$db_connect = new DatabaseClass();

if(!isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] !== true))
{
	header("location:adminlogin.php");
}

$title = "";
$image = "";
$details = "";

$msg = "";
$image_required = 'required';

if (isset($_GET['id']) && (trim($_GET['id']) != ''))
{
    $image_required = '';
    $id = trim($_GET['id']);

    // Populate data from database
    $sql = "SELECT * FROM books WHERE id = :id ";
    $stmt = $db_connect->Read($sql, ["id" => $id]);

    if ($stmt)
    {
        $title = $stmt[0]['title'];    
        $image = $stmt[0]['image'];    
        $details = $stmt[0]['details'];    
    }
    else
    {
        header("location: books.php");
        die();            
    }

    // Close statement
    unset($stmt);
}


if(isset($_POST['submit']))
{
    $title = trim($_POST['title']);
    $details = trim($_POST['details']);

    if ($_FILES['image']['type'] != '' && $_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg')
    {
        $msg = "Please select only png, jpg and jpeg formats.";
    }

    if ($msg == "")
    {
        if (isset($_GET['id']) && (trim($_GET['id']) != ''))
        {
            $id = trim($_GET['id']);

            if ($_FILES['image']['name'] != '')
            {
                $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "../books/" . $image);

                // Execute an update statement
                $sql = "UPDATE books SET title = :title, details = :details, image = :image WHERE id = :id ";
                $stmt = $db_connect->Update($sql, ['title' => $title, 'details' => $details, 'image' => $image, 'id' => $id]);

                // Close statement
                unset($stmt);
            }
            else
            {
                // Execute an update statement
                $sql = "UPDATE books SET title = :title, details = :details WHERE id = :id ";
                $stmt = $db_connect->Update($sql, ['title' => $title, 'details' => $details, 'id' => $id]);

                // Close statement
                unset($stmt);
            }
        }
        else
        {
            $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "../books/" . $image);
            
            // Execute an insert statement
            $sql = "INSERT INTO books (title, image, details) VALUES (:title, :image, :details)";
            $stmt = $db_connect->Insert($sql, ['title' => $title, 'image' => $image, 'details' => $details]);

            // Close statement
            unset($stmt);
        }
        header("location: books.php");
        die();        
    }
}

unset($pdo);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <title>Inchristed.com</title>

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
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" href="style.css" />
    

        <script src="../ckeditor/ckeditor.js"></script>
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
                            <a href="posts.php" >Posts</a>
                        </li>
                        <li>
                            <a href="books.php" class="active">Books</a>
                        </li>
                        <li>
                            <a href="settings.php">Account Settings</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </nav>
                <div id="content" style="padding-left: 20px; width: 100%">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button class="btn" type="button" id="sidebarCollapse" style="background: #7386D5;">&#9776;</button>
                        </div>
                    </nav>
                    <div class="container">
                    <div class="title">
                        <h5>Add Book</h5>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 cat-block">
                        <div class="form-block">
                        <form method="post" enctype="multipart/form-data">
                            <span class="help-block" style="color:red;"><?php echo $msg; ?></span>
                            <div class="form-group">
                                <label for="title" class="form-control-label">Book Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $title ?>" placeholder="Enter book title" required/>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-control-label">Image</label>
                                <input type="file" name="image" class="form-control" <?php echo $image_required ?>/>
                            </div>
                            <div class="form-group">
                                <label for="details" class="form-control-label">Description</label>
                                <input type="text" name="details" class="form-control" value="<?php echo $details ?>" placeholder="Enter book description" required/>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                        </div>
                    </div>
                </div>
                    

                </div>
            </div>

        <script src="jquery-1.12.4.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>

        <script src="cus.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>