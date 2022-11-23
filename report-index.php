<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>report</title>
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
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="float-center">Report</h2>
                      
                       <!-- <a href="ordertab-index.php" class="btn btn-info float-right mr-2">Reset View</a>
                        <a href="index.php" class="btn btn-secondary float-right mr-2">Back</a>-->
                    </div>

                  
                        <form action="report.php" method="get">
						From
                        <div class="col">
                          <input type="date" class="form-control" placeholder="From Date" name="from" required>
                        </div>
						To
                        <div class="col">
                          <input type="date" class="form-control" placeholder="To Date" name="to" required>
                        </div>
						<br><br>
						     <div class="col">
                            <input type="submit" name="submit" value="Get Report">
                        </div>
              
                        </form>
                    <br>

                  
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>
</html>