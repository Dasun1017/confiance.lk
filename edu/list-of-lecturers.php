<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>


<!doctype html>
<html class="no-js" lang="zxx">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>List of Specialist <?php echo $_GET[view]; ?> - <?php echo $site_title; ?></title>
   <style type="text/css">
        .author-bio h3 { font-size: small !important; } 
        .author-bio { padding: 20px !important; } 
        .mt-10 { margin-top: -20px !important; z-index: 99999999; position: inherit; }
   </style>
   <?php metas(); ?>
</head>

<body>
   <!--[if lte IE 9]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end-->
   
   










   <!--page-banner-area start-->
   <div class="page-banner height-200 bg-1">
      <div class="d-table">
         <div class="page-title vertical-middle text-center">
            <h2><span style="    font-size: initial;">List of </span><br>Specialist <?php echo $_GET[view]; ?></h2>
         </div>
      </div>
   </div>
   <!--page-banner-area end-->
   
   <!--breadcrumb-area start-->
   <div class="breadcrumb-area mt-25">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="site-breadcrumb">
                  <ul class="list-none">
                     <li><a href="index.php">Home</a></li>
                     <li><i class="fa fa-angle-right"></i></li>
                     <li>List of Specialist <?php echo $_GET[view]; ?></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--breadcrumb-area end-->
   














   <!--course-area start-->
   <div class="course-area mt-70">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               
               <div class="tab-content">
                  <!--single-tab-->
                  <div id="grid-products" class="tab-pane fade in show active">
                     <div class="row">
       

<?php   if($_GET[view] == 'Tutors') { $grade = 'Tutor'; } 
        if($_GET[view] == 'Trainers') { $grade = 'Trainer'; } 
        if($_GET[view] == 'Institutes') { $grade = 'Institute'; } 
        $sql4 = "SELECT * FROM tbl_users WHERE type= '2' AND grade = '$grade'  and userStatus = 'Y'";
        $result4 = mysqli_query($connect, $sql4);
        while ( $pra4 = mysqli_fetch_array($result4)) { 

?>



                        <div class="col-lg-3 col-sm-6">
                        
                        <div class="author-bio text-center mt-50 textblock-inner" style="height: 250px;">
                           <h3><?php echo $pra4[userName]; ?></h3>
                           <small><?php echo $pra4[grade]; ?></small>

                                       
                  <?php if( $pra4[p_picture] == '') { ?>
                  <img src="source_files/favicon.png" style="margin: 0 auto;display: block; border-radius: 0px; height: auto;">
                  <?php } ?>
                  <?php if( $pra4[p_picture] != '') { ?>
                  <img src="<?php echo getImageUrl($pra4['p_picture'], $baseURL, $current_page); ?>" style="margin: 0 auto;display: block;  ">
                  <?php } ?>

                           
                        </div>
                          <div class="course-features-bottom mt-10"> <a style=" width: fit-content; margin: 0 auto; " href="lecture.php?view=<?php echo $pra4[userID]; ?>" class="btn-common">VIEW TRAININGS</a> </div>
                        </div>



<?php } ?>



                     </div>
                  </div>
                  <!--single-tab-->
                  
               </div>
               
            </div>
         </div>
      </div>
   </div>
   <!--course-area end-->















   
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>
