<?php

require_once("functions/DatabaseClass.php");

$database = new DatabaseClass();

$sql = "SELECT * FROM topics ORDER BY id DESC LIMIT 0, 6";
$tags = $database->Read($sql);

?>
<div class="site-footer">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-4">
          <h3 class="footer-heading mb-4">About Us
          </h3>
          <p style="color: white; opacity: 0.7;">
            Here at InChristed, our goal is to make you a lifelong testifier of the realities in Chris Jesus.
             We believe that when believers lay hold of their identity in Christ, 
             they will be able to exercise their rights and authority so as to reign as kings on this earth.
          </p>
        </div>
        <div class="col-md-3 ml-auto">
          <h3 class="footer-heading mb-4">Useful Links</h3>
          <ul class="list-unstyled float-left mr-5">
            <li><a href="index.php" style="color: white;">Home</a></li>
            <li><a href="about.php" style="color: white;">About</a></li>
            <li><a href="contact.php" style="color: white;">Contact Us</a></li>  
          </ul>
        </div>
        <div class="col-md-3">
          <h3 class="footer-heading mb-4">Recent Tags</h3>
          <?php
            if ($tags)
            {
              foreach ($tags as $tag)
              {
          ?>
                <a href="category.php?title=<?php echo $tag['slug']?>" class="btn btn-success" style="color: white; margin: 5px; border-radius: 10px;"><?php echo $tag['name']; ?></a>
          <?php
              }
            }
          ?>
        </div>
        <div class="col-md-2">
          <div>
            <h3 class="footer-heading mb-4">Social Links</h3>
            <p>  
              <ul class="list-unstyled float-left">
                <a href="https://twitter.com/FelixAlalade" style="color: white;"><span class="icon-twitter p-2"></span></a>
                <li><a href="https://instagram.com/felixinchristed" style="color: white;"><span class="icon-instagram p-2"></span></a></li>
                <li><a href="https://facebook.com/phelixzehope" style="color: white;"><span class="icon-facebook p-2"></span></a></li>
                <li><a href="tel:0803 4108 859" style="color: white;"><span class="icon-phone p-2"></span></a></li>
              </ul>
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <p style="color: white;">
            Copyright &copy; <a href="index.php" class="lead">Inchristed</a> <script>document.write(new Date().getFullYear());</script> 
            </p>
        </div>
      </div>
    </div>
  </div>
