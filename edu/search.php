<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>

<?php $search = $_GET[search];
        $sql = "SELECT * FROM category WHERE 
        category= '$_GET[category]' AND program = '$_GET[program]' AND name_of_class LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND description LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND content_of_the_program LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND course_objectives LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND target_audience_full LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND additional_information_full LIKE '%$search%' AND active = 1

        ";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result); 

?>


<!doctype html>
<html class="no-js" lang="zxx">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Search Resutls for <?php echo $_GET[search]; ?> - <?php echo $site_title; ?></title>
   <?php metas(); ?>
   <!-- Go to www.addthis.com/dashboard to customize your tools -->
   <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-587a4d67086e8205"></script>

</head>

<body>
   <!--[if lte IE 9]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end-->
   
   










<?php

        if($row == '' OR $row == '0' ) { echo '
               <div class="textblock-area pt-30">
                        <div class="section-title text-center">
                           <h2 >Sorry, We cant find Lesson</h2>
                        </div>
               <div class="container textblock-inner">

               
             <p>Please contact '.$site_website_name.'</p>



               </div>
            </div>

         ';}
         if($row != '' OR $row != '0' ) { 

?>



   <!--page-banner-area start-->
   <div class="page-banner height-200 bg-1">
      <div class="d-table">
         <div class="page-title vertical-middle text-center">
            <h2><span style="    font-size: initial;">Search Results for</span>
            <br>
            
                     <span style="font-size: large;"><?php echo $_GET[category]; ?> ></span> 
                     <span style="font-size: large;"><?php echo $_GET[program]; ?> > </span>
                     <?php echo $_GET[search]; ?> 
                     </h2>
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
                     <li><?php echo $_GET[category]; ?></li>
                     <li><i class="fa fa-angle-right"></i></li>
                     <li><?php echo $_GET[program]; ?></li>
                     <li><i class="fa fa-angle-right"></i></li>
                     <li><?php echo $_GET[search]; ?></li>
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
                     
<?php 
        $sql3 = "SELECT * FROM category WHERE 
        category= '$_GET[category]' AND program = '$_GET[program]' AND name_of_class LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND description LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND content_of_the_program LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND course_objectives LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND target_audience_full LIKE '%$search%' AND active = 1
        
        OR 

        category= '$_GET[category]' AND program = '$_GET[program]' AND additional_information_full LIKE '%$search%' AND active = 1
        
        ";
        $result3 = mysqli_query($connect, $sql3);
        while( $pra3 = mysqli_fetch_array($result3))  { 
        

?>

<?php
        $sql4 = "SELECT * FROM tbl_users WHERE userID=$pra3[teacher_id] AND type = '2'  and userStatus = 'Y' ";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);
        $row2 = mysqli_num_rows($result4); 
       if($row2 != '' OR $row2 != '0' ) { 
?>

                        
                        <div class="col-lg-4 col-sm-6">
                           <div class="course-single mb-30">


                              <div class="course-thumb">
                                 <a href="lessons.php?view=<?php echo $pra3[id]; ?>">
                  <?php if( $pra3[cover_page] == '') { ?>
                                    <img src="https://afmec.org/images/no-image-available-icon.jpg" alt="" />
                  <?php } ?>
                  <?php if( $pra3[cover_page] != '') { ?>
                                    <img src="<?php echo getImageUrl($pra3['cover_page'], $baseURL, $current_page); ?>" alt="" />
                  <?php } ?>
                                 </a>
                              </div>
                              <div class="course-info">
                                 <div class="author-info">
                                    <div class="author-name">

                  <?php if( $pra4[p_picture] == '') { ?>
                  <img src="source_files/favicon.png" style="margin: 0 auto;display: block; border-radius: 0px; height: auto;">
                  <?php } ?>
                  <?php if( $pra4[p_picture] != '') { ?>
                  <img src="<?php echo getImageUrl($pra4['p_picture'], $baseURL, $current_page); ?>" style="margin: 0 auto;display: block; max-height: 100px; border-radius: 10px; ">
                  <?php } ?>



                                       <a href="lecture.php?view=<?php echo $pra4[userID]; ?>"><?php echo $pra4[userName]; ?></a>
                                       <small><?php echo $pra4[grade]; ?></small>
                                    </div>
                                    <div class="course-price text-right">
                                       <h5><?php echo $pra3[charge]; ?> <?php echo $pra3[currency]; ?></h5>
                                    </div>
                                 </div>
                                 <div class="course-text mt-10">
                                    <h3><a href="lessons.php?view=<?php echo $pra3[id]; ?>"><?php echo $pra3[name_of_class]; ?></a></h3>
                                    <p><?php echo $pra3[description]; ?></p>
                                 </div>
                              </div>
                              <div class="course-meta">
                                 <a href="lessons.php?view=<?php echo $pra3[id]; ?>"><i class="fa fa-calendar"></i><?php echo $pra3[lesson_date]; ?></a>
                                 <a href="lessons.php?view=<?php echo $pra3[id]; ?>"><i class="fa fa-user"></i><?php echo $pra3[no_of_students]; ?> Students</a>
                              </div>
                           </div>
                        </div>
<?php } } ?>



                     </div>
                  </div>
                  <!--single-tab-->
                  
               </div>
               
            </div>
         </div>
      </div>
   </div>
   <!--course-area end-->








<?php } ?>










   
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>
