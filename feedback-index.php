<?php
session_start();
$uid=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>feedback</title>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="float-left">Feedback Details</h2>
                        <a href="feedback-create.php" class="btn btn-success float-right">Add New Feedback</a>
                       <!-- <a href="feedback-index.php" class="btn btn-info float-right mr-2">Reset View</a>
                        <a href="index.php" class="btn btn-secondary float-right mr-2">Back</a>-->
                    </div>

                    <div class="form-row">
                        <form action="feedback-index.php" method="get">
                       <!-- <div class="col">
                          <input type="text" class="form-control" placeholder="Search this table" name="search">
                        </div>-->
                    </div>
                        </form>
                    <br>

                    <?php
                    // Include config file
                    require_once "config.php";
                    

                    //Get current URL and parameters for correct pagination
                    $protocol = $_SERVER['SERVER_PROTOCOL'];
                    $domain     = $_SERVER['HTTP_HOST'];
                    $script   = $_SERVER['SCRIPT_NAME'];
                    $parameters   = $_SERVER['QUERY_STRING'];
                    $protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')
                                === FALSE ? 'http' : 'https';
                    $currenturl = $protocol . '://' . $domain. $script . '?' . $parameters;

                    //Pagination
                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }

                    //$no_of_records_per_page is set on the index page. Default is 10.
                    $offset = ($pageno-1) * $no_of_records_per_page;

                    $total_pages_sql = "SELECT COUNT(*) FROM feedback";
                    $result = mysqli_query($link,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);

                    //Column sorting on column name
                    $orderBy = array('User', 'item_id', 'Feedback', 'Reply');
                    $order = 'Feed_id';
                    if (isset($_GET['order']) && in_array($_GET['order'], $orderBy)) {
                            $order = $_GET['order'];
                        }

                    //Column sort order
                    $sortBy = array('asc', 'desc'); $sort = 'desc';
                    if (isset($_GET['sort']) && in_array($_GET['sort'], $sortBy)) {
                          if($_GET['sort']=='asc') {
                            $sort='desc';
                            }
                    else {
                        $sort='asc';
                        }
                    }

                    // Attempt select query execution
                    $sql = "SELECT * FROM feedback where User=$uid ORDER BY $order $sort LIMIT $offset, $no_of_records_per_page";
                    $count_pages = "SELECT * FROM feedback";


                    if(!empty($_GET['search'])) {
                        $search = ($_GET['search']);
                        $sql = "SELECT * FROM feedback
                            WHERE CONCAT_WS (User,item_id,Feedback,Reply)
                            LIKE '%$search%'
                            ORDER BY $order $sort
                            LIMIT $offset, $no_of_records_per_page";
                        $count_pages = "SELECT * FROM feedback
                            WHERE CONCAT_WS (User,item_id,Feedback,Reply)
                            LIKE '%$search%'
                            ORDER BY $order $sort";
                    }
                    else {
                        $search = "";
                    }

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            if ($result_count = mysqli_query($link, $count_pages)) {
                               $total_pages = ceil(mysqli_num_rows($result_count) / $no_of_records_per_page);
                           }
                            $number_of_results = mysqli_num_rows($result_count);
                           // echo " " . $number_of_results . " results - Page " . $pageno . " of " . $total_pages;

                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                  //      echo "<th><a href=?search=$search&sort=&order=User&sort=$sort>User</th>";
										echo "<th><a href=?search=$search&sort=&order=Product&sort=$sort>Product</th>";
										echo "<th><a href=?search=$search&sort=&order=Feedback&sort=$sort>Feedback</th>";
										echo "<th><a href=?search=$search&sort=&order=Reply&sort=$sort>Reply</th>";
										
                                      
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                              //      echo "<td>" . $row['User'] . "</td>";
									echo "<td>" . prav_get("item_name","item","item_id",$row['item_id']) . "</td>";echo "<td>" . $row['Feedback'] . "</td>";echo "<td>" . $row['Reply'] . "</td>";
                                      /*  echo "<td>";
										//Praveen thappily test
                                            //echo "<a href='feedback-read.php?Feed_id=". $row['Feed_id'] ."' title='View Record' data-toggle='tooltip'><i class='far fa-eye'></i></a>";
                                            echo "<a href='feedback-update.php?Feed_id=". $row['Feed_id'] ."' title='Update Record' data-toggle='tooltip'><i class='far fa-edit'></i></a>";
                                            echo "<a href='feedback-delete.php?Feed_id=". $row['Feed_id'] ."' title='Delete Record' data-toggle='tooltip'><i class='far fa-trash-alt'></i></a>";
                                        echo "</td>";
										*/
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
?>
                                <ul class="pagination" align-right>
                                <?php
                                    $new_url = preg_replace('/&?pageno=[^&]*/', '', $currenturl);
                                 ?>
                                    <li class="page-item"><a class="page-link" href="<?php echo $new_url .'&pageno=1' ?>">First</a></li>
                                    <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo $new_url ."&pageno=".($pageno - 1); } ?>">Prev</a>
                                    </li>
                                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo $new_url . "&pageno=".($pageno + 1); } ?>">Next</a>
                                    </li>
                                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                        <a class="page-item"><a class="page-link" href="<?php echo $new_url .'&pageno=' . $total_pages; ?>">Last</a>
                                    </li>
                                </ul>
<?php
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
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