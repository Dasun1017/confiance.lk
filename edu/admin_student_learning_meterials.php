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
    if($_SESSION['type'] == '2' OR $_SESSION['type'] == '3' ) { $user_login->redirect('login.php'); }
}

?>

                     
<?php

    if (isset($_GET['clear']) ){ 
        
        $sql_video2_insert = "UPDATE watch_now SET active='0' WHERE video_id='$_GET[clear]' AND student_id = '$_GET[userSession]'";
        mysqli_query($connect, $sql_video2_insert);

    }
?>

<?php
            $sql3 = "SELECT * FROM category WHERE id='$_GET[view]' ORDER by id DESC";
            $result3 = mysqli_query($connect, $sql3);
            $pra3 = mysqli_fetch_array($result3);

?>

    

<?php
        $sql2x = "SELECT * FROM products WHERE lesson_id='$_GET[view]' AND student_id='$_GET[userSession]' AND active = 1 ORDER by id DESC";
        $result2x = mysqli_query($connect, $sql2x);
        $pra2x = mysqli_fetch_array($result2x);
        $row2x = mysqli_num_rows($result2x); 

?>      
    <?php if($row2x != '' AND $row2x != '0') { ?>
    <?php if($pra2x[status] == 'Paid' OR $pra2x[status] == 'Free' OR $pra2x[status] == 'PostPay') { ?>




<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Video Count - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            






                            











                            <div class="row">
                              
                                
                                
                             
<div class="col-lg-6 col-md-6 p-top-20 " style=" color: white; text-align: left;">
<?php if($pra2x[status] == 'Paid' OR $pra2x[status] == 'Free' OR $pra2x[status] == 'PostPay') { ?>
                                            <?php if($pra3[student_link] != ''){ ?>
                                            <a style="color: white;text-align: center;background: tomato;padding: 10px 15px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: fit-content;display: block;font-weight: bold;border-radius: 10px; " href="<?php echo $pra3[student_link]; ?>" target="_blank">JOIN WITH LIVE TRAINER <span style="font-size: small; font-weight: 100;">Click Here</span></a>  <br> 
                                            <?php } ?>
               
<?php } ?>   </div>
                                           
                            
                                
<div class="col-lg-6 col-md-6 p-top-20 " style=" color: white; text-align: right;">
                            <a href="students_cart_activate.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>MY PAGE</strong></span></a>

</div>



                            </div>






























                <div class="row">
                    <h3 style=" background: #1dc9b7; border: none; color: white; margin: 0 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">YouTube Videos</h3>

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = '1' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr>
                                    
                                    
                                    <td><?php echo $pra_cat[lesson_date]; ?></td>

                                    <td><?php echo $pra_cat[learning_title]; ?></td>
       

                                    <td>


<?php   


$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_GET[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];


?>


<?php if(isset($_POST[watch_now])) { if($_POST[learning_id] == $pra_cat[id]) {  if($new_view_count > '0' ) { ?>

          <iframe style=" border: none; overflow: hidden;" src="https://player.vimeo.com/video/<?php echo $pra_cat[learning_description]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;loop=0&amp;autoplay=0"  width="100%" height="300px" frameborder="0" scrolling="no" seamless webkitallowfullscreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen" data-ready="true" allow="autoplay; fullscreen" allowfullscreen ></iframe>

<?php 
$save = mysqli_query($connect, "INSERT INTO watch_now VALUES (NULL, '$_GET[view]',  '$_POST[video_id]', '$_GET[userSession]', '1' )");


}  } }  ?>

      

<?php
    if (isset($_POST['watch_now']) ){ 
        
 
$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_GET[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];
}

?>


    <p style="text-align: center; color: black; margin-bottom: 0px"><!--ඔබට මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන දෙකක් පමණි. <br>ඔබට තවත් -->මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන <!--වන්නේ --> <span style=" font-size: x-large; background: red; color: white; padding: 0px 20px; border-radius: 5px; line-height: initial; "><?php echo $new_view_count; ?></span> <a href="admin_student_learning_meterials.php?userSession=<?php echo $_GET[userSession]; ?>&&view=<?php echo $_GET[view]; ?>&clear=<?php echo $pra_cat[id]; ?>" style="width: 100px;text-align: center;font-size: larger;color: red;border: 0px solid black;font-weight: bold;text-align: center;">CLEAR</a> </p>

     



    <?php //if(!isset($_POST[watch_now])) { 
        if($new_view_count > '0' ) {?>
       
    <?php } else { //echo '<p style=" background: black; color: white; padding: 3px; text-align: center; border-radius: 10px; margin-top: 0px; line-height: inherit; ">සමාවන්න, ඔබගේ වීඩියෝ නැරඹීම් වාර ගණන අවසන් විය.</p>'; 
} 
//}  ?>
        
        
        
        
        
        
                                    </td>
                                   
                             



                                </tr>
<?php } ?>


                                </tbody>
                            </table>

                    </div></div>







                            </div>













































                <div class="row">
                    <h3 style=" background: #1dc9b7; border: none; color: white; margin: 0 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Video Sessions</h3>

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = '7' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr>
                                    
                                    
                                    <td><?php echo $pra_cat[lesson_date]; ?></td>

                                    <td><?php echo $pra_cat[learning_title]; ?></td>
       

                                    <td>


<?php   


$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_GET[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];


?>


<?php if(isset($_POST[watch_now])) { if($_POST[learning_id] == $pra_cat[id]) {  if($new_view_count > '0' ) { ?>

          <iframe style=" border: none; overflow: hidden;" src="https://player.vimeo.com/video/<?php echo $pra_cat[learning_description]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;loop=0&amp;autoplay=0"  width="100%" height="300px" frameborder="0" scrolling="no" seamless webkitallowfullscreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen" data-ready="true" allow="autoplay; fullscreen" allowfullscreen ></iframe>

<?php 
$save = mysqli_query($connect, "INSERT INTO watch_now VALUES (NULL, '$_GET[view]',  '$_POST[video_id]', '$_GET[userSession]', '1' )");


}  } }  ?>

      

<?php
    if (isset($_POST['watch_now']) ){ 
        
 
$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_GET[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];
}

?>


    <p style="text-align: center; color: black; margin-bottom: 0px"><!--ඔබට මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන දෙකක් පමණි. <br>ඔබට තවත් -->මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන <!--වන්නේ --> <span style=" font-size: x-large; background: red; color: white; padding: 0px 20px; border-radius: 5px; line-height: initial; "><?php echo $new_view_count; ?></span> <a href="admin_student_learning_meterials.php?userSession=<?php echo $_GET[userSession]; ?>&&view=<?php echo $_GET[view]; ?>&clear=<?php echo $pra_cat[id]; ?>" style="width: 100px;text-align: center;font-size: larger;color: red;border: 0px solid black;font-weight: bold;text-align: center;">CLEAR</a> </p>

     



    <?php //if(!isset($_POST[watch_now])) { 
        if($new_view_count > '0' ) {?>
       
    <?php } else { //echo '<p style=" background: black; color: white; padding: 3px; text-align: center; border-radius: 10px; margin-top: 0px; line-height: inherit; ">සමාවන්න, ඔබගේ වීඩියෝ නැරඹීම් වාර ගණන අවසන් විය.</p>'; 
} 
//}  ?>
        
        
        
        
        
        
                                    </td>
                                   
                             



                                </tr>
<?php } ?>


                                </tbody>
                            </table>

                    </div></div>







                            </div>














































                <div class="row">
                    <h3 style=" background: #1dc9b7; border: none; color: white; margin: 0 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Media Delivery</h3>

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = '8' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr>
                                    
                                    
                                    <td><?php echo $pra_cat[lesson_date]; ?></td>

                                    <td><?php echo $pra_cat[learning_title]; ?></td>
       

                                    <td>


<?php   


$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_GET[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];


?>


<?php if(isset($_POST[watch_now])) { if($_POST[learning_id] == $pra_cat[id]) {  if($new_view_count > '0' ) { ?>

          <iframe src="<?php echo $pra_cat[learning_description]; ?>" loading="lazy" style="border-radius: 5px; height: 400px; width: 700px;" allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;" allowfullscreen="true"></iframe>

<?php 
$save = mysqli_query($connect, "INSERT INTO watch_now VALUES (NULL, '$_GET[view]',  '$_POST[video_id]', '$_GET[userSession]', '1' )");


}  } }  ?>

      

<?php
    if (isset($_POST['watch_now']) ){ 
        
 
$sql_cat_x = "SELECT count(*) as total from watch_now where student_id = '$_GET[userSession]' AND video_id = '$pra_cat[id]' AND active = 1   ";
        $result_x = mysqli_query($connect, $sql_cat_x);
$data=mysqli_fetch_array($result_x);
$new_view_count = 2-$data['total'];
}

?>


    <p style="text-align: center; color: black; margin-bottom: 0px"><!--ඔබට මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන දෙකක් පමණි. <br>ඔබට තවත් -->මෙම වීඩියෝව නැරඹිය හැකි වාර ගණන <!--වන්නේ --> <span style=" font-size: x-large; background: red; color: white; padding: 0px 20px; border-radius: 5px; line-height: initial; "><?php echo $new_view_count; ?></span> <a href="admin_student_learning_meterials.php?userSession=<?php echo $_GET[userSession]; ?>&&view=<?php echo $_GET[view]; ?>&clear=<?php echo $pra_cat[id]; ?>" style="width: 100px;text-align: center;font-size: larger;color: red;border: 0px solid black;font-weight: bold;text-align: center;">CLEAR</a> </p>

     



    <?php //if(!isset($_POST[watch_now])) { 
        if($new_view_count > '0' ) {?>
       
    <?php } else { //echo '<p style=" background: black; color: white; padding: 3px; text-align: center; border-radius: 10px; margin-top: 0px; line-height: inherit; ">සමාවන්න, ඔබගේ වීඩියෝ නැරඹීම් වාර ගණන අවසන් විය.</p>'; 
} 
//}  ?>
        
        
        
        
        
        
                                    </td>
                                   
                             



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