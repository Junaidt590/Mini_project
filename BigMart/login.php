<?php
session_start();
  include('dbconnection.php');
  if(isset($_POST['login']))
  {
  //  echo "hello";
    $uname=$_POST['username'];
    $pass=$_POST['password'];
    $sql="select * from login where username='$uname' and pwd='$pass'";
    $result=$con->query($sql);
    $nrows=mysqli_num_rows($result);
    if($nrows>0)
    {

      $user=mysqli_fetch_assoc($result);
		$_SESSION['uid']=$user['uid'];
    $_SESSION['fname']=$user['username'];
      if($user['type']=="admin")
      {
        
        
        $_SESSION['stat']="Active";
       header("Location:adminmain.php");
      }
		else
		{
			
			header("Location:usermain.php");
		}
		echo $_SESSION['uid'];
		
    }
    else
    {

      ?>
      <script>alert("Incorrect username or password");</script>
      
      <?php
    }

  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!--<style>
body {
  background-image: url('signup1.jpg');
}
</style>-->

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>login</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Constra HTML Template v1.0">
  
  <!-- Favicon -->
 <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />-->
  
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  
  <!-- Animate css -->
  <link rel="stylesheet" href="plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick/slick-theme.css">
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body id="body">

<!--<section class="signin-page account">-->
 <!-- <div class="container">-->
    <!--<div class="row">-->
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.html">
            <!--<img src="images/logo.png" alt="">-->
          </a>
          <h1 class="text-center">LOGIN</h1>
          <form class="text-left clearfix" method="post">
            <div class="form-group">
              <input type="text" class="form-control"  placeholder="Username" name="username" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-main text-center" name="login">Login</button>
            </div>
            
          </form>
          <p class="mt-20">New in this site ?<a href="signin.php">Register</a></p>
          <a href="index.php"> Back to Home</a>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- 
    Essential Scripts
    =====================================-->
    
    <!-- Main jQuery -->
    <script src="plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.1 -->
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap Touchpin -->
    <script src="plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Instagram Feed Js -->
    <script src="plugins/instafeed/instafeed.min.js"></script>
    <!-- Video Lightbox Plugin -->
    <script src="plugins/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
    <!-- Count Down Js -->
    <script src="plugins/syo-timer/build/jquery.syotimer.min.js"></script>

    <!-- slick Carousel -->
    <script src="plugins/slick/slick.min.js"></script>
    <script src="plugins/slick/slick-animation.min.js"></script>

    <!-- Google Mapl -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script type="text/javascript" src="plugins/google-map/gmap.js"></script>

    <!-- Main Js File -->
    <script src="js/script.js"></script>
    


  </body>
  </html>