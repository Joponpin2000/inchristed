<?php

require_once("functions/DatabaseClass.php");

$database = new DatabaseClass();

$limit = 3;

if (isset($_GET['page']))
{
  $page = trim($_GET['page']);
}
else
{
  $page = 1;
}
$start_from = ($page-1) * $limit;
$statement = "SELECT * FROM books ORDER BY added_on DESC LIMIT $start_from, $limit";

$books = $database->Read($statement);

?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Inchristed.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar" role="banner">
      <div class="container-fluid">
        <div class="row align-items-center">
          
          <div class="col-4 site-logo">
            <a href="index.php" class="text-black h2 mb-0">
              <img src="images/logo-1.jpg">
            </a>
          </div>

          <div class="col-8 text-right">
            <nav class="site-navigation" role="navigation">
              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">
                <li><a href="index.php">Home</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact Us</a></li>
              </ul>
            </nav>
            <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span class="icon-menu h3"></span></a></div>
          </div>

      </div>
    </header>
    
    
    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('images/banner-15.jpg');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              <h1 class="">Books</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php
    if ($books) 
    {
    ?>
      <h2 class="mt-5">Recent Books</h2>
      <div class="site-section">
        <div class="container">
        <?php
        foreach ( $books as $book )
        {
          ?>
            <div class="row mb-5 bg-light" style="padding: 20px 5px">
              <div class="col-md-5 order-md-1">
                <img class="book-img" src="books/<?php echo $book['image']; ?>" alt="Book Image" class="img-fluid">
              </div>
              <div class="col-md-7 mr-auto order-md-2">
                  <h3 class="my-3"><?php echo $book['title']; ?></h3>
                  <p style="color: black; font-family:Arial, Helvetica, sans-serif">
                  <?php echo $book['details']; ?>
                  </p>
              </div>
            </div>
        <?php
        }
        ?>
        </div>
      </div>
  <?php
    }
    else
    {
  ?>
  
      <div class="text-center">
        <h2 class="my-5">No Books Yet</h2>
        <h5 class="my-5" style="color: red;">Watch out!!!</h5>
      </div>
  <?php
    }
    ?>

    <?php
      include_once('footer.php');
    ?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

 
  </body>
</html>