<?php
// Email Submit
if ( isset($_POST['email']) && isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['message']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
{

  // detect & prevent header injections
  $test = "/(content-type|bcc:|cc:|to:)/i";
  foreach ( $_POST as $key => $val )
  {
    if ( preg_match( $test, $val ) )
    {
        header("location: index.php");
        exit;
    }
  }
    $headers = 'From: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
    'Reply-To: ' . $_POST["email"] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    if(mail( "idowuayanfeoluwa@gmail.com", $_POST['subject'], $_POST['message'], $headers ))
    {
      echo "<script>alert('Mail has been sent!\nThanks for contacting us.')</script>";
    }
    else
    {
      echo "<script>alert('Oops! An error occured.')</script>";
      header("location: ./");
    }
}
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
                <img src="images/logo-1.jpg"></a>
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
    
    
    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('images/banner-14.jpg');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              <h1 class="">Contact Us</h1>
              <p class="lead mb-4 text-white">We'll love to hear from you</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">

            

            <form action="" method="POST" role="form" class="p-5 bg-white">
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="name">Your Name</label>
                  <input class="form-control" name="name" type="text" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input class="form-control" name="email" type="text" required>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="text" name="subject" class="form-control" required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label>
                  <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..." required></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5">
            
            <div class="p-4 mb-3 bg-white">

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a style="color: inherit;" href="tel:0803 4108 859">+234 803 4108 859</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="mailto:felix@inchristed.com" style="color: inherit;">felix@inchristed.com</a></p>

            </div>

          </div>
        </div>
      </div>
    </div>
    
    
    <?php
    include_once("footer.php");
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


</script>
    
  </body>
</html>