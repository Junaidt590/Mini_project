<?php
      include('dbconnection.php');


      $sql="select * from item";
      

      

      if(isset($_POST["submit"])){

      	
      	$cat=$_POST["cat"];
		//echo $cat;
      	if($cat=="0")
      	{
      		$sql="select * from item";
			  //$sql="select * from item where cat_id='$cat'";
			  //$res1 = $con->query($sql);
			  //echo $res1;
			
      	}
      	else
      	{
      		$sql="select * from item where cat_id='$cat'";	
      	}

      }
      $result = $con->query($sql);

      $sql="select * from category";
      $result1 = $con->query($sql);

	// $sql="select * from cart";
    // $cartItems = $con->query($sql);
	// $cartIds = $cartItems->result_array();
	// $ids = array_map(fn($item) => $item->instrument_id, $cartIds );
	
	  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>view</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6b773fe9e4.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 5px;
        }
        body {
            font-size: 14px;
        }
    </style>
  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>view item user</title>

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

<!-- Start Top Header Bar -->
<section class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-4">
				<div class="contact-number">
					<i class="tf-ion-ios-telephone"></i>
					<span> 09645541446</span>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="index.html">
						<!-- replace logo here -->
						<svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1" xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink">
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" font-size="40"
								font-family="AustinBold, Austin" font-weight="bold">
								<g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
									<text id="eMUSIC">
									<p><font color="black" face="Verdana, Geneva, sans-serif" size="+4">BIGMART</font></p>
										<!--<tspan x="108.94" y="325">eMUSIC</tspan>-->
									</text>
								</g>
							</g>
						</svg>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Cart 
				<ul class="top-menu text-right list-inline">
					<li class="dropdown cart-nav dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
								class="tf-ion-android-cart"></i>Cart</a>
						<div class="dropdown-menu cart-dropdown">
							<!-- Cart Item 
							<div class="media">
								<a class="pull-left" href="#!">
									<img class="media-object" src="images/shop/cart/cart-1.jpg" alt="image" />
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#!">Ladies Bag</a></h4>
									<div class="cart-price">
										<span>1 x</span>
										<span>1250.00</span>
									</div>
									<h5><strong>$1200</strong></h5>
								</div>
								<a href="#!" class="remove"><i class="tf-ion-close"></i></a>
							</div><!-- / Cart Item -->
							<!-- Cart Item 
							<div class="media">
								<a class="pull-left" href="#!">
									<img class="media-object" src="images/shop/cart/cart-2.jpg" alt="image" />
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#!">Ladies Bag</a></h4>
									<div class="cart-price">
										<span>1 x</span>
										<span>1250.00</span>
									</div>
									<h5><strong>$1200</strong></h5>
								</div>
								<a href="#!" class="remove"><i class="tf-ion-close"></i></a>
							</div><!-- / Cart Item 

							<div class="cart-summary">
								<span>Total</span>
								<span class="total-price">$1799.00</span>
							</div>
							<ul class="text-center cart-buttons">
								<li><a href="cart.html" class="btn btn-small">View Cart</a></li>
								<li><a href="checkout.html" class="btn btn-small btn-solid-border">Checkout</a></li>
							</ul>
						</div>

					</li><!-- / Cart -->

					<!-- Search 
					<li class="dropdown search dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
								class="tf-ion-ios-search-strong"></i> Search</a>
						<ul class="dropdown-menu search-dropdown">
							<li>
								<form action="post"><input type="search" class="form-control" placeholder="Search..."></form>
							</li>
						</ul>
					</li><!-- / Search -->

					<!-- Languages 
					<li class="commonSelect">
						<select class="form-control">
							<option>EN</option>
							<option>DE</option>
							<option>FR</option>
							<option>ES</option>
						</select>
					</li><!-- / Languages -->

				</ul><!-- / .nav .navbar-nav .navbar-right -->
			</div>
		</div>
	</div>
</section><!-- End Top Header Bar -->


<!-- Main Menu Section -->
<?php include 'user_menu.php' ?>




	  <?php
	 /*  include('dbconnection.php');
	  $sql="select*from category";
	  	$result = $con->query($sql);
	  
	  if ($result->num_rows > 0) {
  // output data of each row
	
	
  while($row = $result->fetch_assoc()) {
	  $url="edit_instru.php?cat_id=".$row['cat_id'];
	    $url2="delete_instru.php?cat_id=".$row['cat_id'];
   echo "<tr><td>".$row['cat_name']."</td><td>".$row['sub_cat']."</td><td><img src='".$row['image']."' width='200'></td><td><a href='$url'>Update</a></td><td><a href='$url2'>Delete</td></a></tr>";
  }
	
} else {
  echo "0 results";
}
	 */ 
	  ?>
	  <form method="post">
	  	&nbsp;&nbsp;Category :
	  	<select name="cat">
	  		<option value="0">All</option>
	  		<?php
                while($row1 = $result1->fetch_assoc()) {
             ?>
             	<option value="<?php echo $row1['cat_id']?>"><?php echo $row1['cat_name']?></option>
             <?php
             	}
             ?>
	  	</select>
	  	<input type="submit" name="submit">
	  </form>
	    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
			<script>
				var f;
						function inc(i){
							if(parseInt(document.getElementById('i'+i).value)>=document.getElementById('h'+i).value)
							{
								window.alert("Insufficient stocks")
							}
							else
							{
							document.getElementById('i'+i).value=parseInt(document.getElementById('i'+i).value)+1;
							document.getElementById('q'+i).value=parseInt(document.getElementById('q'+i).value)+1;
							}
						}
						function dec(i){
							if(parseInt(document.getElementById('i'+i).value)!=1)
							{
							document.getElementById('i'+i).value=parseInt(document.getElementById('i'+i).value)-1;
							document.getElementById('q'+i).value=parseInt(document.getElementById('q'+i).value)-1;
							}
							else
							{
						
							}


						}
						function getval(k){
							// f=
							var h='i'+k;
							windoe.alert("99999");
							
					}
					</script>



            <?php
            if(isset($_POST['submits']))
			{
				$id=$_POST['submits'];
				$st='p'.$_POST['submits'];
				$price=$_POST[$st];
				$st='st'.$_POST['submits'];
				$stock=$_POST[$st];
				$st='q'.$_POST['submits'];
				$qty=$_POST[$st];

				echo "<script>window.location='addtocart.php?id=$id&price=$price&stock=$stock&qty=$qty';</script>";
		
                   //  echo "<script>window.alert('".$qty.$_POST['submits']."');</script>";
			}
			?>
			<?php

            if(isset($_GET['id']))
			{
			?>
			<script>
			f=document.getElementById('i'".$_GET['id'].").value;
			window.alert(f);
			</script>";
                
<?php

				echo "<script>window.location='addtocart.php?id=$_GET[id]&price=$_GET[price]&stock=$_GET[stock]&qty='+f+'';</script>";
				//exit;
			}?>

<form action="" method="post">
<?php
			
                while($row = $result->fetch_assoc()) {
                	$idd=$row['item_id'];
                	$price=$row['price'];
					$stock=$row['stock'];
            ?>
			<style>
				.product-thumb{
					margin-top: 10px;
				}
				.card{
					padding: 10;
					
					border: 2px;
					margin-right: 10px;
					border-radius: 35px;
					height: 100%;
					margin-top: 10px;
				}
			</style>
			<div class="col mt-6">
				<div class="product-item col-md-2 p-6 card">
			
					<div class="product-thumb">
						<!--<span class="bage">Sale	
						</span>-->
						<img class="Responsive image" src="<?php echo $row['image'] ?>" width="80%" height="70%" alt="product-img"  />
						<div class="preview-meta">
							<ul>
								<!-- <li>
									<span  data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search-strong"></i>
									</span>
								</li>
								<li>
			                        <a href="#!" ><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href="#!"><i class="tf-ion-android-cart"></i></a>
								</li> -->
							</ul>
						
                      	</div>
					</div>
					
					<div class="product-content">
						<h3><a href="#"><?php  echo $row['item_name'] ?></a></h3>
						<p class="price">Price :<span id="s<?php echo $idd; ?>"><?php echo $row['price'] ?></span> Stock:<span id="s<?php echo $idd; ?>"><?php echo $row['stock'] ?></span></p>
                        <p class="Description"><?php echo $row['description'] ?></p>
						<input type="hidden" id='h<?php echo $idd; ?>' value="<?php echo $row['stock'];?>">
                        <div class='row' style="margin-left: 15%;"><span style="background-color:grey;color:white" onclick='inc(<?php echo $idd; ?>)'>&nbsp;&nbsp; + &nbsp;&nbsp;</span>&nbsp;&nbsp;
						<input type="number" name="i<?php echo $idd; ?>" min="1"  onchange='inc(<?php echo $idd; ?>)'  width="20px" style="width:40px" disabled value="1" id="i<?php echo $idd; ?>" >&nbsp;<span style="background-color:grey;color:white" onclick='dec(<?php echo $idd; ?>)'>&nbsp;&nbsp; - &nbsp;&nbsp;</span></div>
                        <input type="hidden" value="1" name="q<?php echo $idd; ?>" value="<?php echo $price; ?>" id="q<?php echo $idd; ?>">
						<input type="hidden" name="p<?php echo $idd; ?>" value="<?php echo $price; ?>">
						<input type="hidden" name="st<?php echo $idd; ?>" value="<?php echo $stock; ?>">
						<br>
						<button type="submit" name="submits" value="<?php echo $idd; ?>">Add To Cart</button>
						<!-- <button onclick="getval(4)">Add To Cart</button> -->
					</div>
				</div>
				
			</div>
            <?php
                }
            ?></div>
            </div>
        </div>
			</form>
    </section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
			  </table>



<!--<footer class="footer section text-center">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="social-media">
					<li>
						<a href="https://www.facebook.com/themefisher">
							<i class="tf-ion-social-facebook"></i>
						</a>
					</li>
					<li>
						<a href="https://www.instagram.com/themefisher">
							<i class="tf-ion-social-instagram"></i>
						</a>
					</li>
					<li>
						<a href="https://www.twitter.com/themefisher">
							<i class="tf-ion-social-twitter"></i>
						</a>
					</li>
					<li>
						<a href="https://www.pinterest.com/themefisher/">
							<i class="tf-ion-social-pinterest"></i>
						</a>
					</li>
				</ul>
				<ul class="footer-menu text-uppercase">
					<li>
						<a href="contact.html">CONTACT</a>
					</li>
					<li>
						<a href="shop.html">SHOP</a>
					</li>
					<li>
						<a href="pricing.html">Pricing</a>
					</li>
					<li>
						<a href="contact.html">PRIVACY POLICY</a>
					</li>
				</ul>
				<p class="copyright-text">Copyright &copy;2021, Designed &amp; Developed by <a href="https://themefisher.com/">Themefisher</a></p>
			</div>
		</div>
	</div>
</footer>-->

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