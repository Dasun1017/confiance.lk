<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>

<?php

if(!$user_home->is_logged_in())
{
     $user_home->redirect('login.php');
}


if($user_home->is_logged_in()!="")
{
    if($_SESSION['type'] == '1' OR $_SESSION['type'] == '2' ) { $user_login->redirect('login.php'); }
}

?>  


<?php
            $sql3 = "SELECT * FROM category WHERE id='$_GET[view]' ORDER by id DESC";
            $result3 = mysqli_query($connect, $sql3);
            $pra3 = mysqli_fetch_array($result3);

?>
    
<?php
        $sql2x = "SELECT * FROM products WHERE lesson_id='$_GET[view]' AND student_id='$_SESSION[userSession]' AND active = 1 ORDER by id DESC";
        $result2x = mysqli_query($connect, $sql2x);
        $pra2x = mysqli_fetch_array($result2x);
        $row2x = mysqli_num_rows($result2x); 

?>      
    <?php if($row2x != '' AND $row2x != '0') { ?>
    <?php if($pra2x[status] == 'Paid' OR $pra2x[status] == 'Free' OR $pra2x[status] == 'PostPay' OR $pra2x[status] == 'Institute') { ?>




<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
   <title>Learning Meterials - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">

    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage" style="background:black">
        <div class="hero-content content_above" style="padding: 10px 0 50px 0;">
                            <div class="content-wrapper">



































                    



   <!--course-area start-->
   <div class="course-area mt-20">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               
               <div class="tab-content">
                  <!--single-tab-->
                  <div id="grid-products" class="tab-pane fade in show active">
                     <div class="row">
   
<?php if(1 == 2) { 
        $sql2x = "SELECT * FROM products WHERE student_id='$_SESSION[userSession]' AND lesson_id ='$_GET[view]' AND active = 1 ORDER by id DESC";
        $result2x = mysqli_query($connect, $sql2x);
        while($pra3x = mysqli_fetch_array($result2x)) { 

?>      

    <?php
            $sql3 = "SELECT * FROM category WHERE id='$pra3x[lesson_id]' AND active = 1 ORDER by id DESC";
            $result3 = mysqli_query($connect, $sql3);
            $pra3 = mysqli_fetch_array($result3);

    ?>   
<?php
        $sql4 = "SELECT * FROM tbl_users WHERE userID=$pra3[teacher_id]";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);

?>



                        <div class="col-lg-12 mb-30">
                           <div class="course-single list-view">
                              <div class="course-thumb">
                                 <!--<a href="lessons.php?view=<?php echo $pra3[id]; ?>">-->

                  <?php if( $pra3[cover_page] == '') { ?>
                                    <img src="https://afmec.org/images/no-image-available-icon.jpg" class="mb-40" />
                  <?php } ?>
                  <?php if( $pra3[cover_page] != '') { ?>
                                    <img src="<?php echo getImageUrl($pra3['cover_page'], $baseURL, $current_page); ?>" class="mb-40" />
                  <?php } ?>

                                 <!--</a>-->
                              </div>
                              <div class="course-info">
                                 <div class="course-text mt-10">
                                    <div class="table-view">
                                       <div class="table-cell pr-10">
                                          <h3><!--<a href="lessons.php?view=<?php echo $pra3[id]; ?>">--><?php echo $pra3[name_of_class]; ?><!--<</a>--></h3>
                                       </div>
                                       <div class="table-cell">
                                          <div class="course-price text-right" style="float: right; display: contents; ">
                                             <h5><?php echo $pra3[charge]; ?> <?php echo $pra3[currency]; ?></h5>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="course-meta" style="display: none">
                                       <!--<a href="lessons.php?view=<?php echo $pra3[id]; ?>">--><i class="fa fa-calendar"></i><?php echo $pra3[lesson_date]; ?><!--</a>-->
                                       <!--<a href="lessons.php?view=<?php echo $pra3[id]; ?>">--><i class="fa fa-user"></i><?php echo $pra3[no_of_students]; ?> Students<!--</a>-->
                                    </div>


                                    <p><?php echo $pra3[description]; ?> </p>
                                 </div>
                                 <div class="author-info" style="display: none">
                                    <div class="author-name">
                                       
                                       
                  <?php if( $pra4[p_picture] == '') { ?>
                  <img src="source_files/logo.png" style="margin: 0 auto;display: block;border-radius: 0px;height: auto;">
                  <?php } ?>
                  <?php if( $pra4[p_picture] != '') { ?>
                  <img src="<?php echo getImageUrl($pra4['p_picture'], $baseURL, $current_page); ?>" style="margin: 0 auto;display: block; max-height: 100px;  ">
                  <?php } ?>

                                       <!--<a href="lecture.php?view=<?php echo $pra4[userID]; ?>">--><?php echo $pra4[userName]; ?><!--</a>-->
                                       <small><?php echo $pra4[grade]; ?></small>
                                    </div>
                                    
                                 </div>

                                 <!-- new code-->

                                 <div class="course-features-bottom mt-0 col-lg-6 mb-0" style=" float: right; padding:5px; ">


<?php 


$sql_attachment = "SELECT * FROM products WHERE id='$pra3x[id]' AND comments != ''";
$result_attachment = mysqli_query($connect, $sql_attachment);
$pra_attachment = mysqli_fetch_array($result_attachment);
$rowcount=mysqli_num_rows($result_attachment);

?>
                                    


                 </div>

                                 <div class="course-features-bottom mt-0 col-lg-6 mb-0" style=" float: right; padding: 0px ">               
                                        <?php if($pra3x[status] == 'Paid' OR $pra3x[status] == 'Free' OR $pra3x[status] == 'PostPay' OR $pra3x[status] == 'Institute') { ?>
                                            <?php if($pra3[student_link] != ''){ ?>
                                            <br><a style="color: white;text-align: center;background: #f4516c;padding: 10px 15px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: auto;display: block;border-radius: 10px; " href="<?php echo $pra3[student_link]; ?>" target="_blank">සජීවි ZOOM පන්තියට සම්බන්ධ වන්න</a>
                                            <?php } ?>
                                            
                                            
                                           
                                           
                                        <?php } ?>


                  </div>
                                 <!-- new code-->

                              </div>
                           </div>
                        </div>


<?php } ?>

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











<style type="text/css">

   @media (max-width: 460px) {  
    .youtube_iframe { width: 250px !important; height: 140px !important; } 
    .vimeo_iframe { width: 250px !important; height: 140px !important; } 
    .full_width_in_mobile { width: 100% !important; }
  }
  .table td, .table th { border:none }

</style>




























                               
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            




                            <div class="row" style="display: none">
                              
                                
                                
                             
<div class="col-lg-6 col-md-6 p-top-20 " style=" color: white; text-align: left;">
<?php if($pra2x[status] == 'Paid' OR $pra2x[status] == 'Free' OR $pra2x[status] == 'PostPay' OR $pra2x[status] == 'Institute') { ?>
                                            <?php if($pra3[student_link] != ''){ ?>
                                            <a style="color: white;text-align: center;background: tomato;padding: 10px 15px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: fit-content;display: block;font-weight: bold;border-radius: 10px; " href="<?php echo $pra3[student_link]; ?>" target="_blank">JOIN WITH LIVE TRAINER <span style="font-size: small; font-weight: 100;">Click Here</span></a>  <br> 
                                            <?php } ?>
               
<?php } ?>   </div>
                                           
                            
                                
<div class="col-lg-6 col-md-6 p-top-20 " style=" color: white; text-align: right;">
                            <a href="students_cart_activate.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " ><strong>මගේ පන්ති</strong></span></a>

</div>



                            </div>

















                <div class="row" >

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: black;box-shadow: none !important;">
                            <table class="table">
                               

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = '1' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr class="full_width_in_mobile" style="width: 100%; float: left;">
                                    
                                    

                                    <td style=" font-size: initial; font-weight: bolder; margin-bottom: 20px; display: block; color: #90daff; "><?php echo $pra_cat[learning_title]; ?>

                                    <br>
                                    <br>


<?php   


$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_SESSION[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];


?>


<?php if(isset($_POST[watch_now])) { if($_POST[learning_id] == $pra_cat[id]) {  if($new_view_count > '0' ) { ?>

          <iframe class="youtube_iframe" src="https://www.youtube.com/embed/<?php echo $pra_cat[learning_description]; ?>?rel=0&autoplay=0&controls=0&&showinfo=0&loop=1" width="100%"  frameborder="0" scrolling="no" seamless webkitallowfullscreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen" data-ready="true" allow="autoplay; fullscreen" allowfullscreen style="border: 1px solid white; overflow: hidden; width: 100%; height: 400px;     border-radius: 10px;"></iframe>



<?php 
$save = mysqli_query($connect, "INSERT INTO watch_now VALUES (NULL, '$_GET[view]',  '$_POST[video_id]', '$_SESSION[userSession]', '1' )");


}  } }  ?>

      

<?php
    if (isset($_POST['watch_now']) ){ 
        
 
$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_SESSION[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];
}

?>


    <p style="text-align: left; color: white; margin-bottom: 0px"><!--ඔබට මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන දෙකක් පමණි. <br>ඔබට තවත් -->මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන <!--වන්නේ --> <span style=" font-size: x-large; background: red; color: white; padding: 0px 20px; border-radius: 5px; line-height: initial; "><?php echo $new_view_count; ?></span></p>

    <?php //if(!isset($_POST[watch_now])) { 
        if($new_view_count > '0' ) {?>
        <form action="" method="post" >
            <input type="submit" value="CLICK HERE TO PLAY" name="watch_now" style="height: 31px;min-height: 20px;background: #1c445e;color: white;border: none;padding: 3px 20px;border-radius: 10px;font-size: initial;margin-bottom: 0px;    cursor: pointer;">
            <input type="hidden" value="<?php echo $pra2x[id];?>" name="product_id" >
            <input type="hidden" value="<?php echo $pra_cat[id];?>" name="video_id" >
            <input type="hidden" value="<?php echo $pra_cat[id];?>" name="learning_id" >
            <input type="hidden" value="<?php echo $pra2x[views_count];?>" name="views_count" >

        </form>
    <?php } else { echo '<p style=" background: black; color: white; padding: 3px; text-align: center; border-radius: 10px; margin-top: 0px; line-height: inherit; ">සමාවන්න, ඔබගේ වීඩියෝ නැරඹීම් වාර ගණන අවසන් විය.</p>'; } 
//}  ?>
        
        
        
        
        
        
                                    </td>
                                   
                                   
                                    <td><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>
                                    <?php } ?></td>



                                </tr>
<?php } ?>




<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = '7' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr class="full_width_in_mobile" style="width: 50%; float: left;">
                                    
                                    

                                    <td style=" font-size: initial; font-weight: bolder; margin-bottom: 20px; display: block; color: #90daff; "><?php echo $pra_cat[learning_title]; ?>

                                    <br>
                                    <br>


<?php   


$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_SESSION[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];


?>


<?php if(isset($_POST[watch_now])) { if($_POST[learning_id] == $pra_cat[id]) {  if($new_view_count > '0' ) { ?>

          <iframe class="vimeo_iframe"  style=" border: none; overflow: hidden; width: 100%; height: 400px;     border-radius: 10px;" src="https://player.vimeo.com/video/<?php echo $pra_cat[learning_description]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;loop=0&amp;autoplay=0"  width="100%" height="300px" frameborder="0" scrolling="no" seamless webkitallowfullscreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen" data-ready="true" allow="autoplay; fullscreen" allowfullscreen ></iframe>

<?php 
$save = mysqli_query($connect, "INSERT INTO watch_now VALUES (NULL, '$_GET[view]',  '$_POST[video_id]', '$_SESSION[userSession]', '1' )");


}  } }  ?>

      

<?php
    if (isset($_POST['watch_now']) ){ 
        
 
$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_SESSION[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];
}

?>


    <p style="text-align: left; color: white; margin-bottom: 0px"><!--ඔබට මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන දෙකක් පමණි. <br>ඔබට තවත් -->මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන <!--වන්නේ --> <span style=" font-size: x-large; background: red; color: white; padding: 0px 20px; border-radius: 5px; line-height: initial; "><?php echo $new_view_count; ?></span></p>

    <?php //if(!isset($_POST[watch_now])) { 
        if($new_view_count > '0' ) {?>
        <form action="student_learning_meterials_video.php?view=<?php echo $_GET[view]; ?>" method="post" target="_blank">
            <input type="submit" value="CLICK HERE TO PLAY" name="watch_now" style="height: 31px;min-height: 20px;background: #1c445e;color: white;border: none;padding: 3px 20px;border-radius: 10px;font-size: initial;margin-bottom: 0px;    cursor: pointer;">
            <input type="hidden" value="<?php echo $pra2x[id];?>" name="product_id" >
            <input type="hidden" value="<?php echo $pra_cat[id];?>" name="video_id" >
            <input type="hidden" value="<?php echo $pra_cat[id];?>" name="learning_id" >
            <input type="hidden" value="<?php echo $pra2x[views_count];?>" name="views_count" >

        </form>
    <?php } else { echo '<p style=" background: black; color: white; padding: 3px; text-align: center; border-radius: 10px; margin-top: 0px; line-height: inherit; ">සමාවන්න, ඔබගේ වීඩියෝ නැරඹීම් වාර ගණන අවසන් විය.</p>'; } 
//}  ?>
        
        
        
        
        
        
                                    </td>
                                   
                                   
                                    <td><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>
                                    <?php } ?></td>



                                </tr>
<?php } ?>












<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = '8' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr class="full_width_in_mobile" style="width: 50%; float: left;">
                                    
                                    

                                    <td style=" font-size: initial; font-weight: bolder; margin-bottom: 20px; display: block; color: #90daff; "><?php echo $pra_cat[learning_title]; ?>

                                    <br>
                                    <br>


<?php   


$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_SESSION[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];


?>


<?php if(isset($_POST[watch_now])) { if($_POST[learning_id] == $pra_cat[id]) {  if($new_view_count > '0' ) { ?>

          <iframe src="<?php echo $pra_cat[learning_description]; ?>" loading="lazy" style="border-radius: 5px; height: 400px; width: 100%;" allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;" allowfullscreen="true"></iframe>

<?php 
$save = mysqli_query($connect, "INSERT INTO watch_now VALUES (NULL, '$_GET[view]',  '$_POST[video_id]', '$_SESSION[userSession]', '1' )");


}  } }  ?>

      

<?php
    if (isset($_POST['watch_now']) ){ 
        
 
$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_SESSION[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];
}

?>


    <p style="text-align: left; color: white; margin-bottom: 0px"><!--ඔබට මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන දෙකක් පමණි. <br>ඔබට තවත් -->මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන <!--වන්නේ --> <span style=" font-size: x-large; background: red; color: white; padding: 0px 20px; border-radius: 5px; line-height: initial; "><?php echo $new_view_count; ?></span></p>

    <?php //if(!isset($_POST[watch_now])) { 
        if($new_view_count > '0' ) {?>
        <form action="student_learning_meterials_video.php?view=<?php echo $_GET[view]; ?>" method="post" target="_blank">
            <input type="submit" value="CLICK HERE TO PLAY" name="watch_now" style="height: 31px;min-height: 20px;background: #1c445e;color: white;border: none;padding: 3px 20px;border-radius: 10px;font-size: initial;margin-bottom: 0px;    cursor: pointer;">
            <input type="hidden" value="<?php echo $pra2x[id];?>" name="product_id" >
            <input type="hidden" value="<?php echo $pra_cat[id];?>" name="video_id" >
            <input type="hidden" value="<?php echo $pra_cat[id];?>" name="learning_id" >
            <input type="hidden" value="<?php echo $pra2x[views_count];?>" name="views_count" >

        </form>
    <?php } else { echo '<p style=" background: black; color: white; padding: 3px; text-align: center; border-radius: 10px; margin-top: 0px; line-height: inherit; ">සමාවන්න, ඔබගේ වීඩියෝ නැරඹීම් වාර ගණන අවසන් විය.</p>'; } 
//}  ?>
        
        
        
        
        
        
                                    </td>
                                   
                                   
                                    <td><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>
                                    <?php } ?></td>



                                </tr>
<?php } ?>









                                </tbody>
                            </table>

                    </div></div>







                            </div>

























































                <div class="row" >

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: black;box-shadow: none !important;    margin-top: 0px;">
                            <table class="table">
                               

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = '2' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr class="full_width_in_mobile" style="width: 50%; float: left;">
                                    
                                    <td style="border: none; width: 100%; display: block; text-align: center;"><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 10px 15px; color: #fff; font-weight: 400; font-size: large; background: #094976; width: 100%;"><?php echo $pra_cat[learning_title]; ?></span></a>
                                    <?php } ?></td>



                                </tr>
<?php } ?>







                                </tbody>
                            </table>

                    </div></div>







                            </div>






























                <div class="row" >

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: black;box-shadow: none !important;    margin-top: 0px;">
                            <table class="table">
                               

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = '6' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr class="full_width_in_mobile" style="width: 50%; float: left;">
                                    
                                    

                                    <td style=" font-size: initial; font-weight: bolder; margin-bottom: 20px; display: block; color: #90daff; border: none">
                                        <a style="color: white;text-align: center;background: #f4516c;padding: 10px 15px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: auto;display: block;border-radius: 10px; " href="<?php echo $pra_cat[learning_description]; ?>" target="_blank"><?php echo $pra_cat[learning_title]; ?></a>
                                        
                                    </td>
                                   
                                    <td style="border: none;"><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>
                                    <?php } ?></td>



                                </tr>
<?php } ?>







                                </tbody>
                            </table>

                    </div></div>







                            </div>







































































                        </div>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->




     
  

    
     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
  
</body>
</html>
<?php } ?>

<?php } ?>