<?php
session_start();

// include function file
require_once('../functions/DatabaseClass.php');

$db_connect = new DatabaseClass();

if(!isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] !== true))
{
	header("location:adminlogin.php");
}

$name = $email = $username = $password = "";
$name_err = $email_err = $username_err = $password_err = "";

if (isset($_GET['id']) && (trim($_GET['id']) != ''))
{
    $id = trim($_GET['id']);
    // Populate data from database
    $sql = "SELECT * FROM users WHERE id = :id ";
    $stmt = $db_connect->Read($sql, ["id" => $id]);

    if ($stmt)
    {
        $name = $stmt[0]['name'];    
        $email = $stmt[0]['email'];    
        $username = $stmt[0]['username'];   
        $password = $stmt[0]['password'];
    }
    else
    {
        header("location: settings.php");
        die();            
    }

    // Close statement
    unset($stmt);
}


if(isset($_POST['submit']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($name))
    {
        $name_err = "Provide a valid name!";
    }
    if (empty($email))
    {
        $email_err = "Provide a valid email!";
    }
    if (empty($username))
    {
        $username_err = "Provide a valid name!";
    }
    if (empty($password))
    {
        $password_err = "Provide a valid name!";
    }

    if (empty($name_err) && empty($email_err) && empty($username_err) && empty($password_err))
    {
        if (isset($_GET['id']) && (trim($_GET['id']) != ''))
        {
            $id = trim($_GET['id']);
            // Execute an update statement
            $sql = "UPDATE users SET name = :name, email = :email, username = :username, password = :password WHERE id = :id ";
            $stmt = $db_connect->Update($sql, ['name' => $name, 'email' => $email, 'username' => $username, 'password' => $password, 'id' => $id]);
            // Close statement
            unset($stmt);
        }
        else
        {            
            // Execute an insert statement
            $sql = "INSERT INTO users (name, email, username, password) VALUES (:name, :email, :username, :password)";
            $stmt = $db_connect->Insert($sql, ['name' => $name, 'email' => $email, 'username' => $username, 'password' => $password]);
            // Close statement
            unset($stmt);
        }
        header("location: settings.php");
        die();
    }     
}

unset($pdo);

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
                <div id="content" style="padding-left: 20px; width: 100%">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button class="btn" type="button" id="sidebarCollapse" style="background: #7386D5;">&#9776;</button>
                        </div>
                    </nav>
                    <div class="container">
                    <div class="title">
                        <h5>Manage Account</h5>
                    </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 cat-block">
                            <div class="form-block">
                            <form method="post" action="manage_account?id=<?php echo $id; ?>">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $name ?>" required/>
                                    <span class="help-block" style="color:red;"><?php echo $name_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $email ?>" required/>
                                    <span class="help-block" style="color:red;"><?php echo $email_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-control-label">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $username ?>" required/>
                                    <span class="help-block" style="color:red;"><?php echo $username_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Password</label>
                                    <input type="password" name="password" class="form-control" value="<?php echo $password ?>" required/>
                                    <span class="help-block" style="color:red;"><?php echo $password_err; ?></span>
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