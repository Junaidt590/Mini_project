<?php
include('dbconnection.php');
session_start();
if(isset($_GET['id']))
  {
    $idd=$_GET['id'];
    $qty=$_GET['qty'];
    $price=$_GET['price'];
    $uid=$_SESSION['uid'];
    if($_GET['stock']==0)
    {?>
      <script type="text/javascript">
        alert("No stocks");
        document.location.href = 'view_instruments_usr.php',true;
      </script>
      <?php
    }
    else
    {
    $sql="select * from cart where uid='$uid' and item_id='$idd'";
    $result=$con->query($sql);
    $nrows=mysqli_num_rows($result);
    if($nrows>0)
    {
    	$sql="update cart set qty='$qty' ,price='$price' where uid='$uid' and item_id='$idd'";

    }
    else
    {
      $d=date('Y-m-d');
    	$sql="INSERT INTO `cart` VALUES (0,'$uid', '$idd', '$qty','$price','$d')";

    }
    $result=$con->query($sql);
    $sql="update item set stock=stock-$qty where item_id=$idd";
    $result2=$con->query($sql);
    // 
    // $sql="delete from `doctor` where d_id='$idd'";
    
    // header("Location:admin_doctor_main.php");
    ?>
    <script type="text/javascript">
    	alert("Added to cart1");
    	document.location.href = 'view_items_usr.php',true;
    </script>
    <?php
  	}
  }
  	// header("Location:view_instruments_usr.php");
  	?>

  	<!DOCTYPE html>
  	<html>
  	<head>
  		<title></title>
  		<script type="text/javascript">
  			// document.location.href = 'view_instruments_usr.php',true;
  			// Location.href="view_instruments_usr.php";
  		</script>
  	</head>
  	<body>
  	
  	</body>
  	</html>