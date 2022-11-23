<?php //Post Params 
 include('dbconnection.php');
if(isset($_GET['prod_id']))
{
	$prod_id=$_GET['prod_id'];
	 $query = "DELETE FROM item WHERE item_id = '$prod_id'"; 
	 
	echo $query;
 $result = $con->query($query); 

 if( $result )
 {
 	//echo 'Success';
	 ?>
	 <script>
		 alert("Deleted the record");
	 window.location="view_items.php";
	 </script>
<?php
 }
 else
 {
 	echo 'Query Failed';
 }
}

?>