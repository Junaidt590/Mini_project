<?php
// Include config file
require_once "config.php";


// Define variables and initialize with empty values
$User = "";
$Instrument = "";
$Feedback = "";
$Reply = "";

$User_err = "";
$Instrument_err = "";
$Feedback_err = "";
$Reply_err = "";


// Processing form data when form is submitted
if(isset($_POST["Feed_id"]) && !empty($_POST["Feed_id"])){
    // Get hidden input value
    $Feed_id = $_POST["Feed_id"];

    $User = trim($_POST["User"]);
		$Instrument = trim($_POST["Instrument"]);
		$Feedback = trim($_POST["Feedback"]);
		$Reply = trim($_POST["Reply"]);
		

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

    $vars = parse_columns('feedback', $_POST);
    $stmt = $pdo->prepare("UPDATE feedback SET User=?,Instrument=?,Feedback=?,Reply=? WHERE Feed_id=?");

    if(!$stmt->execute([ $User,$Instrument,$Feedback,$Reply,$Feed_id  ])) {
        echo "Something went wrong. Please try again later.";
        header("location: error.php");
    } else {
        $stmt = null;
        //header("location: feedback-read.php?Feed_id=$Feed_id");
		//praveen
		header("location: feedback-index-admin.php");
    }
} else {
    // Check existence of id parameter before processing further
	$_GET["Feed_id"] = trim($_GET["Feed_id"]);
    if(isset($_GET["Feed_id"]) && !empty($_GET["Feed_id"])){
        // Get URL parameter
        $Feed_id =  trim($_GET["Feed_id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM feedback WHERE Feed_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_id = $Feed_id;

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

                    $User = $row["User"];
					$Instrument = $row["Instrument"];
					$Feedback = $row["Feedback"];
					$Reply = $row["Reply"];
					

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
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	
 <style>
 body {
   background-image: url('bg.jpg');
 }
 </style>
 
   <!-- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
 
 
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
<body>

 <?php include 'admin_menu.php' ?>
 <!--<section class="signin-page account">-->
   <div class="container">
     <div class="row">
       <div class="col-md-6 col-md-offset-3">
         <div class="block text-center">
           <a class="logo" href="index.html">
            <!--- <img src="music.ico" alt="">-->
           </a>
 		  
    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    
                        <h2>Give reply to the user</h2>
              
                    <p></p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" >

                        <div class="form-group">
                               
                                <input type="hidden" placeholder="User" required name="User" class="form-control" value="<?php echo $User; ?>">
                                <span class="form-text"><?php echo $User_err; ?></span>
                            </div>
						<div class="form-group">
                  
                                    <input type="hidden" class="form-control" id="Instrument" name="Instrument" value="<?php echo $Instrument;?>">
                                                                    <span class="form-text"><?php echo $Instrument_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Feedback</label>
								
                                 <textarea name="Feedback" class="form-control" placeholder="Feedback" readonly>
								 <?php echo $Feedback; ?>
								 </textarea>
                                <span class="form-text"><?php echo $Feedback_err; ?></span>
                                
                            </div>
						<div class="form-group">
                                <label>Reply</label>
								
                                 <textarea name="Reply" class="form-control"  required>
								 <?php echo $Reply; ?></textarea>
								 
                                <span class="form-text"><?php echo $Reply_err; ?></span>
                                
                            </div>

                        <input type="hidden" name="Feed_id" value="<?php echo $Feed_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="feedback-index-admin.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
	
         </div>
       </div>
     </div>
   </div>
 
 
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
