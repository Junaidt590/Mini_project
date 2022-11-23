<?php
include('dbconnection.php');
session_start();
if(isset($_GET['id']))
  {
    $idd=$_GET['id'];
    // $price=$_GET['price'];
    $uid=$_SESSION['uid'];

    $sql="select * from cart where uid='$uid' and instrument_id='$idd'";
    $result=$con->query($sql);
    $nrows=mysqli_num_rows($result);
    if($nrows>0)
    {
        $ordrow=$result->fetch_assoc();
        $qty=$ordrow['qty'];
        $price=$ordrow['price'];

        $sql="INSERT INTO `ordertab` (`instrument_id`, `qty`, `price`, `status`,`uid`) VALUES ('$idd', '$qty', '$price', 'Ordered','$uid')";
        $result=$con->query($sql);

    	$sql="delete from cart where uid='$uid' and instrument_id='$idd'";
        $result=$con->query($sql);
    }
   
    $result=$con->query($sql);
    // 
    // $sql="delete from `doctor` where d_id='$idd'";
    
    // header("Location:admin_doctor_main.php");
    ?>
    <script type="text/javascript">
    	alert("Order Placed Successfully");
    	document.location.href = 'user_viewcart.php',true;
    </script>

    <?php
  	}
  	// header("Location:view_instruments_usr.php");
  	?>

  