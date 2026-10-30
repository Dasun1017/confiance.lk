<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>

<?php

if(!$user_home->is_logged_in())
{
     //$user_home->redirect('login.php');
}

?>


<?php 
  //$_GET[view] = 'Tutors'; 
?>


<!doctype html>
<html class="no-js" lang="zxx" style="background: white;">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <title>List of <?php echo $_GET[view]; ?> - <?php echo $site_title; ?></title>
   <style type="text/css">
        .author-bio h3 { font-size: initial !important; } 
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
   <div class="page-banner height-200 bg-1" style="display: none">
      <div class="d-table">
         <div class="page-title vertical-middle text-center">
            <h2><span style="    font-size: initial;">List of </span><br><?php echo $_GET[view]; ?></h2>
         </div>
      </div>
   </div>
   <!--page-banner-area end-->
   
   <!--breadcrumb-area start-->
   <div class="breadcrumb-area mt-25" style="display: none">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="site-breadcrumb">
                  <ul class="list-none">
                     <li><a href="index.php">Home</a></li>
                     <li><i class="fa fa-angle-right"></i></li>
                     <li>List of <?php echo $_GET[view]; ?></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--breadcrumb-area end-->
   











<?php if($site_lecture_page_drop_down == '') { ?>

   <!--course-area start-->
   <div class="course-area mt-0" style=" padding-bottom: 50px;background: white; padding-top: 30px !important;">
      <div class="container">
         <div class="row">


<!--<div class="col-lg-1 mt-sm-0"></div>-->
<div class="col-lg-6 mt-sm-0">
        
   <div style="margin-top: 55px;">
      <?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = 'landing' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


      ?>  
      <img src="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" style="/* background: white; */padding: 0px;box-shadow: 0px 0px #dddddd;border-radius: 12px;width: 100%;margin-top: 0px;display: block;" class="logo_img">

      <?php } ?>

   </div>
</div>

<!--<div class="col-lg-1 mt-sm-0"></div>-->

            <div class="col-lg-4">
               
               <div class="tab-content">
                  <!--single-tab-->
                  <div id="grid-products" class="tab-pane fade in show active">
                     <div class="row">
       

            <div class="col-lg-12  mt-20" style="margin-top: 55px;/* display: none; */"> <div class="section-title text-center"> <h2 style="color: white;padding: 10px;border-radius: 10px;font-size: unset;">Available Classes</h2> </div> </div>

            

                    <?php   $sql_cat = "SELECT * FROM main_group  where active = '1' ORDER by id DESC";
                                $result_cat = mysqli_query($connect, $sql_cat);
                                while($pra_cat = mysqli_fetch_array($result_cat)) { ?>     

                        <div class="col-lg-12 col-sm-12">
                            <div class="author-bio text-center mt-0" style="height: 70px;padding: 0px;width: 15%;border: 0px;float: left;">
                                        <img src="source_files/logo.png" style="margin: 0 auto;display: block; border-radius: 0px; height: auto;">
                              </div>  
                              <div class="course-features-bottom mt-0" style=" width: 100%; margin-top: 6px !important; "> <a href="select_your_teacher2.php?view=<?php echo $pra_cat[id]; ?>" class="btn-common" style="font-size: x-large; height: 40px; line-height: 40px; background-color: #9f7639 !important;"><?php echo $pra_cat[main_group_name]; ?></a> </div>
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

<?php } else { ?>










   <!--course-area start-->
   <div class="course-area mt-0" style=" padding-bottom: 50px;background: white; padding-top: 30px !important;">
      <div class="container">
         <div class="row">
         
       

<!--<div class="col-lg-1 mt-sm-0"></div>-->
<div class="col-lg-6 mt-sm-0">
        
<div style="margin-top: 55px;">
<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = 'landing' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>  
    <img src="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" style="/* background: white; */padding: 0px;box-shadow: 0px 0px #dddddd;border-radius: 12px;width: 100%;margin-top: 0px;display: block;" class="logo_img">

<?php } ?>
    
    
</div></div>

<!--<div class="col-lg-1 mt-sm-0"></div>-->


  <div class="col-lg-4" style=" background: white; border-radius: 10px; height: fit-content; padding-bottom: 10px;">

            <div class="col-lg-12  mt-20" style="<?php if($site_lecture_page_drop_down_opened == '') { echo 'margin-top: 55px;'; } else { echo 'margin-top: 0px;'; } ?>/* display: none; */"> <div class="section-titlex text-center"> <h2 style="color: white;padding: 10px;border-radius: 10px;font-size: unset;">Available Classes</h2> </div> </div>


<?php 
  $_GET[view] = 'Tutors'; 
?>
<?php   if($_GET[view] == 'Tutors') { $grade = 'Tutor'; } 
        if($_GET[view] == 'Trainers') { $grade = 'Trainer'; } 

        if($_GET[type] == 'videos') { 
          $sql4x = "SELECT * FROM tbl_users WHERE type= '2' AND grade = '$grade'  and userStatus = 'Y' AND batch =  'YES' GROUP by selected_ol_al_grade  ORDER by  CAST(order_by AS UNSIGNED) ASC";
        } else {
          $sql4x = "SELECT * FROM tbl_users WHERE type= '2' AND grade = '$grade'  and userStatus = 'Y' AND batch =  '' GROUP by selected_ol_al_grade  ORDER by  CAST(order_by AS UNSIGNED) ASC";
        }


        $result4x = mysqli_query($connect, $sql4x);
        //while ( $pra4x = mysqli_fetch_array($result4x)) { 


?>

<?php   $sql_cat = "SELECT * FROM main_group  where active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra4x = mysqli_fetch_array($result_cat)) { 
        $i += 1; ?>     



            <div class="col-lg-12  <?php if($site_lecture_page_drop_down_opened == '') { echo 'mt-20'; } else { echo 'mt-30'; } ?> collapsible" style="cursor: pointer;">
                            <div class="author-bio text-center mt-0" style="padding: 0px;width: 50px;border: 0px;float: left;    margin-left: -10px;">
                                        <img src="source_files/new_confiance_big - Copy.jpeg" style="margin: 0 auto;display: block; border-radius: 0px; height: auto;background:black;border:white">
                              </div>  
               <div class="text-center" style="text-transform: uppercase;">
                  <h3 style="font-size: x-large;height: 50px;line-height: 30px;font-size: 16px; font-weight: normal; padding: 10px;border-radius: 40px;border-bottom: 1px solid black; background-color:  <?php echo $drop_down_bg_color; ?>; color: rgb(255, 255, 255);text-align: center;padding-left: 20px;font-family: sans-serif;"><?php echo $pra4x[main_group_name]; ?>
                    <span style="float:right;background: white ;padding: 0px 6px;color: black ;border-radius: 50px;font-weight: 500;line-height: 28px;">⋁</span>
                  </h3>
               </div>
            </div>           


<div class="row" style="<?php if($site_lecture_page_drop_down_opened == '') { echo 'display:none;'; } else { echo 'display:contents;'; } ?> <?php if($i == 1) { //echo " display: contents !important"; 
} ?> ">

<?php   if($_GET[view] == 'Tutors') { $grade = 'Tutor'; } 
        if($_GET[view] == 'Trainers') { $grade = 'Trainer'; } 

        if($_GET[type] == 'videos') { 
          $sql4 = "SELECT * FROM tbl_users WHERE type= '2' AND grade = '$grade'  and userStatus = 'Y' AND selected_ol_al_grade = '$pra4x[id]' AND batch =  'YES' ORDER by  CAST(order_by AS UNSIGNED) ASC"; //ORDER by userID ASC
        } else {
         $sql4 = "SELECT * FROM tbl_users WHERE type= '2' AND grade = '$grade'  and userStatus = 'Y' AND selected_ol_al_grade = '$pra4x[id]' AND batch =  '' ORDER by  CAST(order_by AS UNSIGNED) ASC"; //ORDER by userID ASC
        }

        $result4 = mysqli_query($connect, $sql4);
        while ( $pra4 = mysqli_fetch_array($result4)) { 

?>



                        <div class="col-lg-12 col-sm-6">
                        
                        <div class="author-bio text-left mt-0" style="padding: 5px; border:0px;padding-bottom: 0px;height: 40px;">
                           <a href="lecture.php?view=<?php echo $pra4[userID]; ?>">

                            <h3 style="height: 40px;font-size: 16px !important;font-family: 'Roboto';font-weight: normal;color: #555;">
                              <span class="span"><?php echo $pra4[userName]; ?></span>
                           <!--<small style=" background: #04aeef; color: white; padding: 5px; margin: 5px; border-radius: 10px; font-size: large; "><?php echo $pra4[subject]; ?></small>-->

                                       
                  <?php if( $pra4[p_picture] == '') { ?>
                  <!--<img src="img/logo1.png" style="margin: 0 auto;display: block; border-radius: 0px; height: auto;">-->
                  <?php } ?>
                  <?php if( $pra4[p_picture] != '') { ?>
                  <!--<img src="functions/uploads/<?php echo $pra4[p_picture]; ?>" style="margin: 0 auto;display: block; ">-->
                  <?php } ?>

                           <span style="float: right"> <p class="btn-common" style="    margin: 0px; font-size: medium;height: 27px;line-height: revert;border-radius: 50px;width: fit-content;font-weight: 500;padding: 3px 20px; background:  <?php echo $drop_down_sub_color; ?> !important; color: #fff; box-shadow: 2px 3px 4px 0px rgb(168 168 168 / 76%); ">ඇතුල්වන්න</p> </span>

                           </h3>

                           </a>


                          </div>  
                          
                     
                        </div>




<?php } ?>

</div>

<?php } ?>


</div>

                     </div>
                  </div>
                  <!--single-tab-->
                  
   </div>
   <!--course-area end-->







    <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "contents") {
          content.style.display = "none";
        } else {
          content.style.display = "contents";
        }
      });
    }
    </script>


<?php } ?>









   
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
  
</body>
</html>
