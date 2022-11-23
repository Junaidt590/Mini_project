<?php
// Include config file
require_once "config.php";
session_start();
$uid=$_SESSION['uid'];


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
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $User = trim($_POST["User"]);
		$Instrument = trim($_POST["Instrument"]);
		$Feedback = trim($_POST["Feedback"]);
		$Reply = trim($_POST["Reply"]);
		
      echo "values: ".$Instrument;
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
          exit('Something weird happened'); //something a user can understand
        }

        $vars = parse_columns('feedback', $_POST);
        $stmt = $pdo->prepare("INSERT INTO feedback (User,item_id,Feedback,Reply) VALUES (?,?,?,?)");

        if($stmt->execute([ $User,$Instrument,$Feedback,$Reply  ])) {
                $stmt = null;
                header("location: feedback-index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
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
<div class="logo text-center">
<p><font color="black" face="WildWest" size="+4">BIG MART</font></p>
</div>

 <?php include 'user_menu.php' ?>
 <!--<section class="signin-page account">-->
   <div class="container">
     <div class="row">
       <div class="col-md-6 col-md-offset-3">
         <div class="block text-center">
           <a class="logo" href="index.html">
            <!--- <img src="music.ico" alt="">-->
           </a>
 		  
    <section class="pt-5">
    <div class="d-flex p-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="page-header">
                        <h2>Feedback</h2>
                    </div>
  
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >

                        <div class="form-group">
                              
                                <input type="hidden" placeholder="User" required name="User" class="form-control" value="<?php echo $uid; ?>">
                                <span class="form-text"><?php echo $User_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Product</label>
                                    <select class="form-control" id="Instrument" name="Instrument">
                                    <?php
                                        $sql = "SELECT *,item_id FROM item WHERE  item_id IN (SELECT item_id FROM ordertab WHERE uid=$uid)";
                                        echo $sql;
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        
                                            $value = $row["item_name"];
                                            if ($row["item_id"] == $Instrument){
                                            echo '<option value="' . "$row[item_id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[item_id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $Instrument_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Feedback</label>
								
                                 <textarea name="Feedback" class="form-control"  required></textarea>
                                <span class="form-text"><?php echo $Feedback_err; ?></span>
                                
                            </div>
						<div class="form-group">
                             
								
                                 <input type="hidden" name="Reply" class="form-control" placeholder="Reply" >
								 <?php echo $Reply; ?>
								
                                <span class="form-text"><?php echo $Reply_err; ?></span>
                                
                            </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="feedback-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
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
     
 
 
   
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>