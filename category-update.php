<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$cat_name = "";
$sub_cat = "";
$image = "";

$cat_name_err = "";
$sub_cat_err = "";
$image_err = "";


// Processing form data when form is submitted
if(isset($_POST["cat_id"]) && !empty($_POST["cat_id"])){
    // Get hidden input value
    $cat_id = $_POST["cat_id"];

    $cat_name = trim($_POST["cat_name"]);
		$sub_cat = trim($_POST["sub_cat"]);
		$image = trim($_POST["image"]);
	
	$prod_img= basename($_FILES["image"]["name"]);

      $ext = pathinfo( $prod_img, PATHINFO_EXTENSION);
	$fnn=date("YmdHis").".".$ext;
	 $target_dir = "uploads/";
      // $target_file = $target_dir . basename($_FILES["file1"]["name"]);
      $target_file = $target_dir.$fnn;
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          // echo "The file ". htmlspecialchars( basename( $_FILES["file1"]["name"])). " has been uploaded.";
          // echo "<script>alert('ok')</script>";
        }
        else
        {
          // echo "<script>alert('error')</script>";
        }
	
	
	
		

    // Prepare an update statement
    $dsn = "mysql:host=$db_server;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
    try {
        $pdo = new PDO($dsn, $db_user, $db_password, $options);
    } catch (Exception $e) {
        error_log($e->getMessage());
        exit('Something weird happened');
    }

    $vars = parse_columns('category', $_POST);
	if(isset($prod_img) && !empty($prod_img)) {
		$stmt = $pdo->prepare("UPDATE category SET cat_name=?,sub_cat=?,image=? WHERE cat_id=?");
		if(!$stmt->execute([ $cat_name,$sub_cat,$target_file,$cat_id  ])) {
			echo "Something went wrong. Please try again later.";
			header("location: error.php");
		} else {
			$stmt = null;
			header("location: view_instru.php");
		}
	} else {
		$stmt =  $pdo->prepare("UPDATE category SET cat_name=?,sub_cat=? WHERE cat_id=?");
		if(!$stmt->execute([ $cat_name,$sub_cat,$cat_id  ])) {
			echo "Something went wrong. Please try again later.";
			header("location: error.php");
		} else {
			$stmt = null;
			header("location: view_instru.php");
		}
	}
	

    if(!$stmt->execute([ $cat_name,$sub_cat,$target_file,$cat_id  ])) {
        echo "Something went wrong. Please try again later.";
        header("location: error.php");
    } else {
        $stmt = null;
        header("location: view_instru.php");
    }
} else {
    // Check existence of id parameter before procesview_instru.php_GET["cat_id"] = trim($_GET["cat_id"]);
    if(isset($_GET["cat_id"]) && !empty($_GET["cat_id"])){
        // Get URL parameter
        $cat_id =  trim($_GET["cat_id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM category WHERE cat_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_id = $cat_id;

            // Bind variables to the prepared statement as parameters
			if (is_int($param_id)) $__vartype = "i";
			elseif (is_string($param_id)) $__vartype = "s";
			elseif (is_numeric($param_id)) $__vartype = "d";
			else $__vartype = "b"; // blob
			mysqli_stmt_bind_param($stmt, $__vartype, $param_id);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value

                    $cat_name = $row["cat_name"];
					$sub_cat = $row["sub_cat"];
					$image = $row["image"];
					

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.<br>".$stmt->error;
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<style>
body {
  background-image: url('bg.jpg');
}
</style>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>update</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Constra HTML Template v1.0">
  
  <!-- Favicon -->
<!--<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />-->  
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
    <!-- Start Top Header Bar -->
<section class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-4">
				<div class="contact-number">
					<i class="tf-ion-ios-telephone"></i>
					<span> 095679 14999</span>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="index.html">
						<!-- replace logo here -->
						<svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1" xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink">
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" font-size="40"
								font-family="AustinBold, Austin" font-weight="bold">
								<g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
									<text id="eMUSIC">
										<!--<tspan x="108.94" y="325">eMUSIC</tspan>-->
									</text>
								</g>
							</g>
						</svg>
					</a>
				</div>
			</div>

			<!-- Main Menu Section -->
<section class="menu">
	<nav class="navbar navigation">
		<!--<div class="container">
			<!--<div class="navbar-header">-->
				<h2 class="menu-title">Main Menu</h2>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div><!-- / .navbar-header -->
			


<!-- Navbar Links -->
              <!-- <div id="navbar" class="navbar-collapse collapse text-center">-->
				<ul class="nav navbar-nav">

					<!-- Home -->
					<li class="dropdown ">
						<a href="adminmain.php"><b>Home</b></a>
					</li><!-- / Home -->


					<!-- Elements -->
					<!--<li class="dropdown dropdown-slide">
						<a href="adminmain.php" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Admin Mainpage<span
								class="tf-ion-ios-arrow-down"></span></a>
						<div class="dropdown-menu">
							<div class="row">

								<!-- Basic -->
								<!--<div class="col-lg-6 col-md-6 mb-sm-3">			<ul>	<li class="dropdown-header">Views</li>
										<li role="separator" class="divider"></li>
										<li><a href="view_instru.php">Category</a></li>
										<li><a href="view_instruments.php">Product</a></li>
										<li><a href="view_dealer.php">Dealer</a></li>
										

									</ul>
								</div>

								<!-- Layout -->

							</div><!-- / .row -->
						</div><!-- / .dropdown-menu -->
					</li><!-- / Elements -->


					<!-- Pages -->
					<!--<li class="dropdown full-width dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Pages <span
								class="tf-ion-ios-arrow-down"></span></a>
						<div class="dropdown-menu">
							<div class="row">

								<!-- Introduction -->
								<div class="col-sm-3 col-xs-12">
									<ul>
									<!--	<li class="dropdown-header">Introduction</li>
										<li role="separator" class="divider"></li>
										<li><a href="contact.html">Contact Us</a></li>
										<li><a href="about.html">About Us</a></li>
										<li><a href="404.html">404 Page</a></li>
										<li><a href="coming-soon.html">Coming Soon</a></li>
										<li><a href="faq.html">FAQ</a></li>
									</ul>
								</div>

								<!-- Contact -->
								<!--<div class="col-sm-3 col-xs-12">
									<ul>
										<li class="dropdown-header">Dashboard</li>
										<li role="separator" class="divider"></li>
										<li><a href="dashboard.html">User Interface</a></li>
										<li><a href="order.html">Orders</a></li>
										<li><a href="address.html">Address</a></li>
										<li><a href="profile-details.html">Profile Details</a></li>
									</ul>
								</div>

								<!-- Utility -->
							<!--	<div class="col-sm-3 col-xs-12">
									<ul>
										<li class="dropdown-header">Utility</li>
										<li role="separator" class="divider"></li>
										<li><a href="login.html">Login Page</a></li>
										<li><a href="signin.html">Signin Page</a></li>
										<li><a href="forget-password.html">Forget Password</a></li>
									</ul>
								</div>

								<!-- Mega Menu -->
								<!--<div class="col-sm-3 col-xs-12">
									<a href="shop.html">
										<img class="img-responsive" src="images/shop/header-img.jpg" alt="menu image" />
									</a>
								</div>
							</div><!-- / .row -->
						</div><!-- / .dropdown-menu -->
					</li><!-- / Pages -->



					<!-- Blog -->
				<!--	<li class="dropdown dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Blog <span
								class="tf-ion-ios-arrow-down"></span></a>
						<ul class="dropdown-menu">
							<li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
							<li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
							<li><a href="blog-full-width.html">Blog Full Width</a></li>
							<li><a href="blog-grid.html">Blog 2 Columns</a></li>
							<li><a href="blog-single.html">Blog Single</a></li>
						</ul>
					</li><!-- / Blog -->

					<!-- Shop -->
					<!--<li class="dropdown dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Elements <span
								class="tf-ion-ios-arrow-down"></span></a>
						<ul class="dropdown-menu">
							<li><a href="typography.html">Typography</a></li>
							<li><a href="buttons.html">Buttons</a></li>
							<li><a href="alerts.html">Alerts</a></li>
						</ul>
					</li><!-- / Blog -->
				</ul><!-- / .nav .navbar-nav -->

			</div>
			<!--/.navbar-collapse -->
		</div><!-- / .container -->
	</nav>
</section>


            
 <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="page-header">
                        <h2>Update category</h2>
                    </div>
                   <!-- <p>Please edit the input values and submit to update the record.</p>-->
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                                <label>Category name</label>
                                <input type="text" name="cat_name" maxlength="15"class="form-control" value="<?php echo $cat_name; ?>"required>
                                <span class="form-text"><?php echo $cat_name_err; ?></span>
                            </div>
						<!--<div class="form-group">
                                <label>Sub category</label>
                                <input type="text" name="sub_cat" maxlength="15"class="form-control" value="<?php echo $sub_cat; ?>">
                                <span class="form-text"><?php echo $sub_cat_err; ?></span>
                            </div>-->
						<div class="form-group">
                                <label>Image</label>

								<?php if(isset($image) && !empty($image))
								echo "<td><img src='".$image."' width='100'></td>";
								?>

                                <input type="file" name="image" class="form-control" required >
							
                                <span class="form-text"><?php echo $image_err; ?></span>
                            </div>

                        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="view_instru.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>


<!-- Main Menu Section -->
<section class="menu">
	<nav class="navbar navigation">
		<div class="container">
			<div class="navbar-header">
				<h2 class="menu-title">Main Menu</h2>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div><!-- / .navbar-header -->

			
<!--
<div class="page-wrapper">
   <div class="checkout shopping">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="block billing-details">
                  <h4 class="widget-title">Add instrument Category</h4>
                  <form class="checkout-form" method="post" action="add_instru.php" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="full_name">Category Name</label>
                        <input type="text" class="form-control" id="full_name" placeholder=""  name="cat_name">
                     </div>
					  
					    <div class="form-group">
                        <label for="Sub Category">Sub Category</label>
                        <input type="text" class="form-control" id="Sub Category" placeholder=""  name="sub_cat">
                     </div>
                     <div class="form-group">
                        <label for="Image">Image</label>
                        <input type="file" name="image1" id="image" />
                     </div>
<div class="form-group">
              <button type="submit" class="btn btn-main text-center" name="submit">Submit</button>
            </div>
					  
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
-->
   <!-- Modal -->
   <div class="modal fade" id="coupon-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-body">
               <form>
                  <div class="form-group">
                     <input class="form-control" type="text" placeholder="Enter Coupon Code">
                  </div>
                  <button type="submit" class="btn btn-main">Apply Coupon</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   
<!--<footer class="footer section text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="social-media">
					<li>
						<a href="https://www.facebook.com/themefisher">
							<i class="tf-ion-social-facebook"></i>
						</a>
					</li>
					<li>
						<a href="https://www.instagram.com/themefisher">
							<i class="tf-ion-social-instagram"></i>
						</a>
					</li>
					<li>
						<a href="https://www.twitter.com/themefisher">
							<i class="tf-ion-social-twitter"></i>
						</a>
					</li>
					<li>
						<a href="https://www.pinterest.com/themefisher/">
							<i class="tf-ion-social-pinterest"></i>
						</a>
					</li>
				</ul>
				<ul class="footer-menu text-uppercase">
					<li>
						<a href="contact.html">CONTACT</a>
					</li>
					<li>
						<a href="shop.html">SHOP</a>
					</li>
					<li>
						<a href="pricing.html">Pricing</a>
					</li>
					<li>
						<a href="contact.html">PRIVACY POLICY</a>
					</li>
				</ul>
				<p class="copyright-text">Copyright &copy;2021, Designed &amp; Developed by <a href="https://themefisher.com/">Themefisher</a></p>
			</div>
		</div>
	</div>
</footer>-->
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