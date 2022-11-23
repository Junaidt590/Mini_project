<?php
include('dbconnection.php');
session_start();
if(isset($_GET['id']))
  {
    $idd=$_GET['id'];
    // $price=$_GET['price'];
    $uid=$_SESSION['uid'];

    $sql="select * from cart where uid='$uid' and item_id='$idd'";
    $result=$con->query($sql);
    $ro=mysqli_fetch_assoc($result);
    $nrows=mysqli_num_rows($result);
    if($nrows>0)
    {
    	$sql="delete from cart where uid='$uid' and item_id='$idd'";
      $sql2="update item set stock=stock+$ro[qty] where item_id=$idd";
    }
    $res=$con->query($sql2);
    $result=$con->query($sql);
    // 
    // $sql="delete from `doctor` where d_id='$idd'";
    
    // header("Location:admin_doctor_main.php");
    ?>
    <script type="text/javascript">
    	alert("Item Removed");
    	document.location.href = 'user_viewcart.php',true;
    </script>

    <?php
  	}
  	// header("Location:view_instruments_usr.php");
  	?>

  