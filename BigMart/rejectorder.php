<?php
include('dbconnection.php');
session_start();
if(isset($_GET['id']))
  {
    $idd=$_GET['id'];
    
    $sql="update ordertab set status='Reject' where ordno='$idd'";
    $result=$con->query($sql);
    // 
    // $sql="delete from `doctor` where d_id='$idd'";
    
    // header("Location:admin_doctor_main.php");
    ?>
    <script type="text/javascript">
    	// alert("Added to cart1");
    	document.location.href = 'admin_vieworder.php',true;
    </script>

    <?php
  	}
  	// header("Location:view_instruments_usr.php");
  	?>

  