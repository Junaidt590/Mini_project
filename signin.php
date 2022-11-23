<?php
// Include config file
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
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Fullname = trim($_POST["Fullname"]);
		$Username = trim($_POST["Username"]);
		$Address = trim($_POST["Address"]);
		$Email = trim($_POST["Email"]);
		$Phone = trim($_POST["Phone"]);
		$Pass1 = trim($_POST["pass1"]);
		$Pass2 = trim($_POST["pass2"]);

    // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  /*
  if (empty($Fullname)) { array_push($errors, "Fullname is required"); }
  if (empty($Username)) { array_push($errors, "Username is required"); }
  if (empty($Email)) { array_push($errors, "Email is required"); }
  if (empty($Pass1)) { array_push($errors, "Password is required"); }
  if ($Pass1 != $Pass2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM registration WHERE Username='$Username' OR Email='$Email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['Username'] === $Username) {
      array_push($errors, "Username already exists");
    }

    if ($user['Email'] === $Email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$Pass2 = ($Pass1);
    echo "$Pass";
  	$query = "INSERT INTO registration (Fullname ,Username, Address, Email, Phone) 
  			  VALUES('$Fullname', '$Username', '$Address', '$Email', '$Phone')";
    //$query1 ="INSERT INTO login (Username, pwd, type) VALUES('$Username', '$Pass2', 'User')";
  	mysqli_query($db, $query);
  	$_SESSION['Username'] = $Username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }**/

    
	if($Pass1==$Pass2)
	{
		

        $dsn = "mysql:host=$db_server;dbname=$db_name;charset=utf8mb4";
        $options = [
         PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //make the default fetch be an associative array
        ]; 
        
        try {
          $pdo = new PDO($dsn, $db_user, $db_password, $options);
        } catch (Exception $e) {
          error_log($e->getMessage());
          exit('Something weird happened'); //something a user can understand
        }

        $vars = parse_columns('registration', $_POST);
        $stmt = $pdo->prepare("INSERT INTO registration (Fullname,Username,Address,Email,Phone) VALUES (?,?,?,?,?)");

        if($stmt->execute([ $Fullname,$Username,$Address,$Email,$Phone  ])) {
               
			$stmt = $pdo->prepare("INSERT INTO login (username,pwd,type) VALUES (?,?,?)");
$type="user";
        if($stmt->execute([ $Username,$Pass1,$type  ]))
			
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

}
	else{
		
		?>
<script>alert("Passwords are different!!")</script>
<?php
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>register</title>

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

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
   <!-- <div class="block text-center">-->
          <a class="logo" href="index.html">
            <!--<img src="images/logo.png" alt="">-->
          </a>
          <h2 class="text-center">Create Your Account</h2>
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" name="Fullname" maxlength="15"class="form-control" value="<?php echo $Fullname; ?>" required>
                                <span class="form-text"><?php echo $Fullname_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Username</label>
                                <input type="text" name="Username" maxlength="15"class="form-control" value="<?php echo $Username; ?>"required>
                                <span class="form-text"><?php echo $Username_err; ?></span>
                            </div>
								  <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass1"  pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Must contain Minimum eight characters, at least one letter and one number"  maxlength="12"class="form-control"required>
                               
                            </div>
								  <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="pass2" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Must contain Minimum eight characters, at least one letter and one number" maxlength="12"class="form-control"required>
                                
                            </div>
						<div class="form-group">
                                <label>Address</label>
                               
							<textarea name="Address" class="form-control"></textarea>
                            </div>
						<div class="form-group">
                                <label>Email</label>
                                <input type="email" name="Email" maxlength="30"class="form-control" value="<?php echo $Email; ?>"required>
                                <span class="form-text"><?php echo $Email_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Phone</label>
                                <input type="tel" name="Phone" maxlength="10" pattern="\d{10}"title="Please use numbers"class="form-control" value="<?php echo $Phone; ?>"required>
                                <span class="form-text"><?php echo $Phone_err; ?></span>
                            </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                 
                    </form>
          <p class="mt-20">Already hava an account ?<a href="login.php"> Login</a></p>
          <!--<p><a href="#"> Forgot your password?</a></p>-->
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