<?php

require_once("functions/DatabaseClass.php");

$database = new DatabaseClass();

$limit = 6;

if (isset($_GET['page']))
{
  $page = trim($_GET['page']);
}
else
{
  $page = 1;
}
$start_from = ($page-1) * $limit;
$statement = "SELECT c.name as category_name, p.id, p.title, p.slug, p.body, p.image, p.category_id, p.created_at
                FROM posts p LEFT JOIN topics c ON p.category_id = c.id
                ORDER BY p.created_at DESC LIMIT $start_from, $limit";

$posts = $database->Read($statement);

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
              <a href="" class="text-black h2 mb-0">
                <img src="images/logo-1.jpg">
              </a>
            </div>
            <div class="col-8 text-right">
              <nav class="site-navigation" role="navigation">
                <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="about.php">About</a></li>
                  <li><a href="contact.php">Contact Us</a></li>
                </ul>
              </nav>
              <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span class="icon-menu h3"></span></a></div>
            </div>
        </div>
      </header>

    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('images/banner-2.jpg'); background-position: center;">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              <p class="lead mb-4 text-white">When God takes aim, He doesn't miss. God's hand is upon you. Be assured!</p>
              <h1 class="">Inchristed</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!--<div class="banner">
      </div>-->
  <?php
  if ($posts)
  {
  ?>
    <div class="site-section">
      <div class="container">
        <div>
          <div class="row mb-5">
            <div class="col-12">
              <h2>Recent Posts</h2>
            </div>
          </div>
          <div class="row">
            <?php

              foreach ($posts as $post)
              {
            ?>
                    <div class="col-lg-4 mb-4 blog-card">
                      <div class="entry2">
                        <a href="single.php?title=<?php echo $post['slug']?>">
                        <div style="text-align: center; width"><img src="images/<?php echo $post['image']; ?>" alt="Image" class="img-fluid rounded m-i-h"></div>
                        </a>
                        <div class="excerpt">
                          <span class="post-category text-white bg-success mb-3"><?php echo $post['category_name']; ?></span>
                          <h2><a href="single.php?title=<?php echo $post['slug']?>">
                          <?php
                                  $title_limit = 22;
                                  if (strlen($post['title']) <= $title_limit)
                                  {
                                      echo $post['title'];
                                  }
                                  else
                                  {
                                      echo substr_replace($post['title'], "..", $title_limit);
                                  }
                          ?></a></h2>
                          <div class="post-meta align-items-center text-left clearfix">
                              <figure class="author-figure mb-0 mr-3 float-left"><img src="images/portrait.jpg" alt="Author" class="img-fluid"></figure>
                              <span class="d-inline-block mt-1">By <a href="about.php#author"> Felix Alalade</a></span>
                              <span>&nbsp;-&nbsp; <?php echo date("F j, Y ", strtotime($post['created_at'])); ?></span>
                          </div>
                          <p style="max-width: 100%; min-width: 100%;">
                            <div class="entry-content" style="word-break: break-all;">
                              <?php
                                  $body_limit = 70;
                                  if (strlen($post['body']) <= $body_limit)
                                  {
                                      echo $post['body'];
                                  }
                                  else
                                  {
                                      echo substr_replace($post['body'], "..", $body_limit);
                                  }
                              ?>
                            </div>
                          </p>
                          <a class="btn btn-primary" href="single.php?title=<?php echo $post['slug']?>">Read More</a>
                        </div>
                      </div>
                    </div>
          <?php
                    unset($statement);
                }
            ?>
          </div>
        </div>
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination" style="margin-bottom: 50px">
              <?php
                $result_db = "SELECT COUNT(id) FROM posts";
                $row_db = $database->Read($result_db);
                $total_records = $row_db[0]['COUNT(id)'];
                $total_pages = ceil($total_records / $limit);
                $pagLink = "";
                for ($i = 1; $i <= $total_pages; $i++)
                {
                  if ($i == $page)
                  $pagLink .= "<a style='margin-right:20px; background-color: grey; color: black;' href='index.php?page=" . $i . "'>" . $i . "  </a>";
                  else
                  {                            
                      $pagLink .= "<a style='margin-right:20px' href='index.php?page=" . $i . "'>" . $i . "  </a>";
                  }
              }
              echo $pagLink;
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  else
  {
  ?>
  <div class="container">
    <div class="row my-5">
      <div class="col-12">
        <h2>No Posts yet!</h2>
      </div>
    </div>
  </div>
  <?php
  }
  ?>

    <!--
    <div class="site-section bg-lightx">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-5">
            <div class="subscribe-1 ">
              <h2>Subscribe to our newsletter</h2>
              <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nesciunt error illum a explicabo, ipsam nostrum.</p>
              <form action="#" class="d-flex">
                <input type="email" class="form-control" placeholder="Enter your email address" required />
                <input type="submit" class="btn btn-primary" value="Subscribe">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
              -->
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
  </body>
</html>