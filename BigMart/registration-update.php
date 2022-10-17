<?php
session_start();
//echo $_SESSION['uid'];
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$Fullname = "";
$Username = "";
$Address = "";
$Email = "";
$Phone = "";

$Fullname_err = "";
$Username_err = "";
$Address_err = "";
$Email_err = "";
$Phone_err = "";


// Processing form data when form is submitted
if(isset($_POST["uid"])){
    // Get hidden input value
    $uid =$_SESSION['uid'];

    $Fullname = trim($_POST["Fullname"]);
		$Username = trim($_POST["Username"]);
		$Address = trim($_POST["Address"]);
		$Email = trim($_POST["Email"]);
		$Phone = trim($_POST["Phone"]);
	//echo $Fullname;
		

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

    $vars = parse_columns('registration', $_POST);
    $stmt = $pdo->prepare("UPDATE registration SET Fullname=?,Username=?,Address=?,Email=?,Phone=? WHERE uid=?");

    if(!$stmt->execute([ $Fullname,$Username,$Address,$Email,$Phone,$uid  ])) {
        echo "Something went wrong. Please try again later.";
      //  header("location: error.php");
    } else {
        $stmt = null;
        header("location: usermain.php");
    }
} else {
   
	
        $uid =  trim($_SESSION["uid"]);

        // Prepare a select statement
        $sql = "SELECT * FROM registration WHERE uid = '$uid'";
	
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_id = $uid;
//echo $sql;
                        // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value

                    $Fullname = $row["Fullname"];
					$Username = $row["Username"];
					$Address = $row["Address"];
					$Email = $row["Email"];
					$Phone = $row["Phone"];
					

                } 

            } 
        }

        // Close statement
        mysqli_stmt_close($stmt);

     
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
  <title>profile edit</title>

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
<?php include 'user_menu.php' ?>
<!--<section class="signin-page account">-->
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.html">
           <!--- <img src="music.ico" alt="">-->
          </a>
          <h2 class="text-center">UPDATE PROFILE</h2>
                              <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" name="Fullname" maxlength="15"class="form-control" value="<?php echo $Fullname; ?>">
                                <span class="form-text"><?php echo $Fullname_err; ?></span>
                            </div>
						<!--<div class="form-group">
                                <label>Username</label>
                                <input type="text" name="Username" maxlength="15"class="form-control" value="<?php echo $Username; ?>">
                                <span class="form-text"><?php echo $Username_err; ?></span>
                            </div>-->
						<div class="form-group">
                                <label>Address</label>
                                <input type="text" name="Address" maxlength="10"class="form-control" value="<?php echo $Address; ?>">
                                <span class="form-text"><?php echo $Address_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Email</label>
                                <input type="text" name="Email" maxlength="30"class="form-control" value="<?php echo $Email; ?>">
                                <span class="form-text"><?php echo $Email_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Phone</label>
                                <input type="tel" name="Phone" maxlength="10"class="form-control" value="<?php echo $Phone; ?>">
                                <span class="form-text"><?php echo $Phone_err; ?></span>
                            </div>

                        <input type="hidden" name="uid" value="<?php echo $uid; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        
                    </form>
         <!-- <p class="mt-20">Already hava an account ?<a href="login.php"> Login</a></p>
          <p><a href="#"> Forgot your password?</a></p>-->
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