<?php
require_once("functions/DatabaseClass.php");

if(isset($_GET['title']))
{
  $slug = trim($_GET['title']);
  $database = new DatabaseClass("localhost", "blog", "root", "");

  $sql = "SELECT * FROM topics WHERE slug = :slug";
  $blog = $database->Read($sql, ["slug" => $slug]);

  if ($blog)
  {
    if (isset($_GET['page']))
    {
      $page = trim($_GET['page']);
    }
    else
    {
      $page = 1;
    }
    $limit = 6;
    $start_from = ($page-1) * $limit;

    $query = "SELECT * FROM posts WHERE category_id = :category_id LIMIT $start_from, $limit";
    $posts = $database->Read($query, ["category_id" => $blog[0]['id']]);
    
    $re = "SELECT * FROM posts WHERE category_id = :category_id";
    $fe = $database->Read($re, ["category_id" => $blog[0]['id']]);

  }
  else
  {
      header("location: index.php");
      exit;
  }
}
else
{
    header("location: index.php");
    exit;
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
    

    <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('images/banner-2.jpg'); background-position: center;">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
            <span class="lead mb-4 text-white">Category</span>
            <h1><?php echo $blog[0]['name']; ?></h1>
            <p class="lead mb-4 text-white"><?php echo $blog[0]['description']; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section bg-white">
      <div class="container">
        <div class="row">
            <?php
                foreach ($posts as $post)
                {
            ?>
                    <div class="col-lg-4 mb-4 blog-card">
                        <div class="entry2">
                          <a href="single.php?title=<?php echo $post['slug']?>">
                            <div style="text-align: center;"><img src="images/<?php echo $post['image']; ?>" alt="Image" class="img-fluid rounded m-i-h"></div>
                          </a>
                          <div class="excerpt">
                              <span class="post-category text-white bg-warning mb-3"><?php echo $blog[0]['name']; ?></span>
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
                              <figure class="author-figure mb-0 mr-3 float-left"><img src="images/portrait.jpg" alt="Image" class="img-fluid"></figure>
                              <span class="d-inline-block mt-1">By <a href="about.php#author"> Felix Alalade</a></span>
                              <span>&nbsp;-&nbsp; <?php echo date("F j, Y ", strtotime($post['created_at'])); ?></span>
                          </div>
                          <p>
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
                              <p><a class="btn btn-primary" href="single.php?title=<?php echo $post['slug']?>">Read More</a></p>
                          </div>
                        </div>
                    </div>
            <?php
                }
            ?>
        </div>
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
            <?php
                $total_records = count($fe);
                $total_pages = ceil($total_records / $limit);
                
                $pagLink = "";
                for ($i = 1; $i <= $total_pages; $i++)
                {
                  if ($i == $page)
                  {
                    $pagLink .= "<a style='margin-right:20px; background-color: grey; color: black;' href='category.php?title=" . $slug . "&page=" . $i . "'>" . $i . "  </a>";
                  }
                  else
                  {
                      $pagLink .= "<a style='margin-right:20px' href='category.php?title=" . $slug . "&page=" . $i . "'>" . $i . "  </a>";
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