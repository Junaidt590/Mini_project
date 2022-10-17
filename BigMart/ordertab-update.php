<?php
// Include config file
require_once "config.php";
include('dbconnection.php');
session_start();

// Define variables and initialize with empty values
$instrument_id = "";
$qty = "";
$price = "";
$status = "";
$uid = "";
$Proof = "";
$Date = "";

$instrument_id_err = "";
$qty_err = "";
$price_err = "";
$status_err = "";
$uid_err = "";
$Proof_err = "";
$Date_err = "";




if(isset($_POST["submit"])){
    if(isset($_GET['uid']))
    {
       
    $uid=$_GET['uid'];
    $sql="select * from cart where uid=$uid";
    $sum1=$con->query($sql);
    $Proof = $_FILES["Proof"];
    while($r=mysqli_fetch_assoc($sum1))
    {
    $tsum=$t['price']*$t['qty'];
	
    $instrument_id = $r["instrument_id"];
    $qty = $r["qty"];
    $price = $r["price"];
    $status = "Ordered";
    $uid = $uid;
    
    $Date = date('Y-m-d');
		

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

        $vars = parse_columns('ordertab', $_POST);
        $stmt = $pdo->prepare("INSERT INTO ordertab (instrument_id,qty,price,status,uid,Proof,Date) VALUES (?,?,?,?,?,?,?)");

        if($stmt->execute([ $instrument_id,$qty,$price,$status,$uid,prav_upload($Proof),$Date  ])) {
                $stmt = null;
				
				$stmt = $pdo->prepare("delete from cart where uid=? and instrument_id=?");
				if($stmt->execute([$uid, $instrument_id])) {
                $stmt = null;
				header("location: user_orderstatus.php");
       // $result=$con->query($sql);
				
		}
				
    }	
}		
				
                
            } else{
                echo "Something went wrong. Please try again later.";
            }



if(isset($_GET['id'])){

                
        $instrument_id = trim($_POST["instrument_id"]);
		$qty = trim($_POST["qty"]);
		$price = trim($_POST["price"]);
		$status = trim($_POST["status"]);
		$uid = trim($_POST["uid"]);
		$Proof = $_FILES["Proof"];
		$Date = date('Y-m-d');
		

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

        $vars = parse_columns('ordertab', $_POST);
        $stmt = $pdo->prepare("INSERT INTO ordertab (instrument_id,qty,price,status,uid,Proof,Date) VALUES (?,?,?,?,?,?,?)");

        if($stmt->execute([ $instrument_id,$qty,$price,$status,$uid,prav_upload($Proof),$Date  ])) {
                $stmt = null;
				
				$stmt = $pdo->prepare("delete from cart where uid=? and instrument_id=?");
				if($stmt->execute([$uid, $instrument_id])) {
                $stmt = null;
				header("location: user_orderstatus.php");
       // $result=$con->query($sql);
				
		}
                
            } else{
                echo "Something went wrong. Please try again later.";
            }
            }
        }


//echo "working";
    // Check existence of id parameter before processing further
	

	if(isset($_GET['id']))
    {
	
	$idd=$_GET['id'];
	$instrument_id=$idd;
    // $price=$_GET['price'];
    $uid=$_SESSION['uid'];

    $sql="select * from cart where uid='$uid' and instrument_id='$idd'";
			//echo "prrrrrrrrr".$sql;
    $result=$con->query($sql);
    $nrows=mysqli_num_rows($result);
    if($nrows>0)
    {
        $ordrow=$result->fetch_assoc();
	//	echo "prrrrrrrrr".$ordrow;
        $qty=$ordrow['qty'];
        $price=$ordrow['price'];

     /*   $sql="INSERT INTO `ordertab` (`instrument_id`, `qty`, `price`, `status`,`uid`) VALUES ('$idd', '$qty', '$price', 'Ordered','$uid')";
        $result=$con->query($sql);

    	$sql="delete from cart where uid='$uid' and instrument_id='$idd'";
        $result=$con->query($sql);
		*/
    }
   
    $result=$con->query($sql);
	
}
	



?>
<?php
if(isset($_GET['uid']))
{
    $uid=$_GET['uid'];
    $sql="select sum(price) as price, sum(qty) as qty from cart where uid=$uid";
    $sum=$con->query($sql);
    $t=mysqli_fetch_assoc($sum);
    $tsum=$t['price']*$t['qty'];

    $sql="select * from instrument where instrument_id in (select instrument_id from cart where uid=$uid)";
    $in=$con->query($sql);

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

    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="page-header">
                        <h2>Payment information</h2>
                    </div>
                    <p>Dear <?php
		  
		  echo $_SESSION['fname'];
		  
		 
		 ?>, Please Pay an Amount of Rs <?php echo (isset($_GET['uid']))?$tsum:$qty*$price; ?>. And upload the proof below.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                                <label>Instrument: <?php echo prav_get("instrument_name","instrument","instrument_id",$instrument_id);?></label>
                                <input type="Hidden" placeholder="Instrument" required name="instrument_id" class="form-control" value="<?php echo $instrument_id; ?>">
                                <span class="form-text"><?php echo $instrument_id_err; ?></span>

                                <?php
                                	if(isset($_GET['uid']))
                                    {
                                    
                        while($row=mysqli_fetch_assoc($in))
                        {
                            echo $row['instrument_name']."<br>";
                        }
                    }
?>
                            </div>


						<?php if(!isset($_GET['uid'])){ ?><div class="form-group">
                                <label>Quantity</label>
                                <input type="number" placeholder="Quantity" readonly name="qty" class="form-control" value="<?php echo $qty; ?>">
                                <span class="form-text"><?php echo $qty_err; ?></span>
                            </div>
                        <?php } ?>
						<div class="form-group">
                                <label>Amount</label>
                                <input type="number" placeholder="Price" readonly name="price" class="form-control" value="<?php echo (isset($_GET['uid']))?$tsum:$price; ?>">
                                <span class="form-text"><?php echo $price_err; ?></span>
                            </div>
						<div class="form-group">
                              
                                <input type="hidden" required placeholder="Status" name="status" maxlength="10"class="form-control" value="Ordered">
                                <span class="form-text"><?php echo $status_err; ?></span>
                            </div>
						<div class="form-group">
                            
                                <input type="hidden"  placeholder="User" required name="uid" class="form-control" value="<?php echo $uid; ?>">
                                <span class="form-text"><?php echo $uid_err; ?></span>
                            </div>


                            <div class="form-group">
                             <label>Scan QR Code</label>
                             <img class="i" src="ss.png" height="200" width="200"></img>
                            </div>

						<div class="form-group">
                                <label>Payment Proof</label>
								<!-- <img src="<?php echo $Proof; ?>" width="100">-->
                                <input type="file" accept="image/gif, image/jpeg, image/png" required name="Proof" value="<?php echo $Proof; ?>">
                                <span class="form-text"><?php echo $Proof_err; ?></span>
                            </div>
					    
                    
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <a href="user_orderstatus.php" class="btn btn-secondary">Cancel</a>
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
