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
    if($_SESSION['type'] == '1' OR $_SESSION['type'] == '3' ) { $user_home->redirect('login.php'); }
}

?>


<?php 
if (isset($_POST['save_about'])){
                $sql = "UPDATE tbl_users SET selected_medium='$_POST[about_me]' WHERE userID=$_SESSION[userSession]";
                mysqli_query($connect, $sql);
                echo "<script>alert('About Me - Saved Successfully!')</script>";
            }
?>

<?php
        $sql = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>

<?php 
if (isset($_GET['delete'])){

        $sqlx = "SELECT * FROM category WHERE id=$_GET[delete]";
        $resultx = mysqli_query($connect, $sqlx);
        $prax = mysqli_fetch_array($resultx);
            if($prax[teacher_id] ==  $_SESSION[userSession]) { 
                $sql = "UPDATE category SET active='0' WHERE id=$_GET[delete]";
                mysqli_query($connect, $sql);
                echo "<script>alert('Lesson Deleted Successfully!')</script>";
}           }
?>



<?php 
if (isset($_POST['teacher_link'])){

                $sql = "UPDATE category SET teacher_link='$_POST[teacher_link]' WHERE id='$_POST[category_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Teacher Link Updated Successfully!')</script>";
}           
?>

<?php 
if (isset($_POST['student_link'])){

                $sql = "UPDATE category SET student_link='$_POST[student_link]' WHERE id='$_POST[category_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Student Link Updated Successfully!')</script>";
}           
?>
<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Lessons of Teacher - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;background-image: url('img/bg2.jpg');background-attachment: fixed;">
                            <div class="content-wrapper">
                                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                                    <div class="row">
                                   

                                        
                                            <div class="col-md-12 col-lg-9">
                                                <div class="p-top-0 p-bottom-20">
                                                   
                                                    
                                                    
                                                    <div style="background: #fff;border: none;width: fit-content;float: left; border-radius: 0 0 5px 5px">
                                                        
                                                        <p class="btn btn--md register_btn btn-primary" style="background: #f4516c;border: #f4516c;line-height: inherit;padding: 10px 20px;text-transform: uppercase;">
                                                        <a href="teachers_add_lesson.php" style="color: #fff">Reserve New Session/Program</a>
                                                        </p>
                                                    </div>



<p style=" clear: both; "></p>
<form action="" method="post" class="row p-top-60">


                                <div class="col-lg-12 col-md-12" style=" font-size: inherit; padding: 0 0 10px 20px; ">About Me</div>

                                <div class="col-lg-6 col-md-12">
                                    <textarea type="text" class="text_field" required="" placeholder="EMPTY" name="about_me" style="min-height: 20px;padding-top: 10px;line-height: 30px;height: 90px;"><?php echo $pra[selected_medium]; ?></textarea>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-common" type="submit" name="save_about" value="Save" style="float: left;margin-top: 0px;" > 
                                
                                </div>
                                    
</form>
                                                </div>


                                            </div><!-- end .col-md-12 -->




                                        <div class="col-md-12 col-lg-3">
                                            <div class="hero__content__title">
                                                <?php if( $pra[p_picture] == '') { ?>
                                                <a href="login.php"><img src="source_files/logo.png" style="width: 75%;margin: 0 auto;display: block;"></a>
                                                <?php } ?>
                                                <?php if( $pra[p_picture] != '') { ?>
                                                <a href="login.php"><img src="<?php echo getImageUrl($pra['p_picture'], $baseURL, $current_page); ?>" style="width: 75%;margin: 0 auto;display: block; max-height: 150px;"></a>
                                                <?php } ?>
                                            </div><!-- end .hero__btn-area-->

<?php


            if (isset($_POST['upload_profile_picture'])){

                $allowedExts = array("jpg", "jpeg", "gif", "png");
                $extension = end(explode(".", $_FILES["file"]["name"]));

                if ($_FILES["file"]["type"] == "image/gif" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/png" && $_FILES["file"]["size"] < 2500000 && in_array($extension, $allowedExts)) {

                  if ($_FILES["file"]["error"] > 0) {

                    echo "<script>alert('";
                        echo "Error: " . $_FILES["file"]["error"] . "<br />";
                    echo ')</script>';

                  }
                  else {

                    //$fname = $_FILES["file"]["name"];
                    $fname = time().'.'."jpg";
                    move_uploaded_file($_FILES["file"]["tmp_name"], "functions/uploads/$fname");

                    
                    $sql = "UPDATE tbl_users SET p_picture='$fname' WHERE userID=$_SESSION[userSession]";
                    $results = mysqli_query($connect, $sql);
                    echo "<script>alert('Profile Picture Uploaded Succesfully!')</script>";

                  }

                }
                else {

                  echo "<script>alert('Invalid file type!')</script>";

                }

            }

?>








<form action="" method = "post" enctype="multipart/form-data" style="margin-top:10px" onsubmit="return confirm('Are you sure?')" class="row">
                                
                                <div class="col-lg-6 col-md-12">
                                    <input required="" style="width: 110px;color: transparent;border: none;line-height: 30px;height: 40px;margin-right: 20px" type="file" class="text_field" name="file">
                                </div>



                                <div class="col-lg-6 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-common" type="submit" name="upload_profile_picture" value="Upload Picture" style="float: right;margin-top: 0px;"
                                </div> 
                                
                                </div>
                                
                                    
</form>                                
                    


                                           
                                        </div><!-- end .col-md-12 -->
                                    </div>
                                </div>
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            






<style>
    .author_info, .card_style1, .card_style2, .cardify, .comment_area, .contact_tile, .content_title, .credit_modules, .featured_event, .google_map .location_address .addres_module, .payment_module, .shortcode_modules, .statement_info_card, .statement_table, .thread_sort_area, .upload_modules, .withdraw_module { background: #fff; -webkit-border-radius: 4px; border-radius: 4px; }
    .statement_info_card .info p { font-size: 28px; } 
</style>

         
                      
                                
                                
                                



<div class="row" style=" margin: 50px -10px 30px -10px; ">
        <div class="col-lg-3 col-sm-6">
            <div class="statement_info_card">
                <div class="info_wrap">
                    <span>
                        <span class="icon-handbag_x icon primarybg transparent-bg primary" style="background: black; color: white;">100%</span>
                    </span>
                    <div class="info">

<?php
        $sql_new_1 = "SELECT * FROM products WHERE status='Paid' AND active = 1 AND teacher_id = '$_SESSION[userSession]'  ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        while($pra_new_1 = mysqli_fetch_array($result_new_1)) {  

        $sql_new_2 = "SELECT * FROM category WHERE id='$pra_new_1[lesson_id]' ORDER by id DESC";
        $result_new_2 = mysqli_query($connect, $sql_new_2);
        $pra_new_2 = mysqli_fetch_array($result_new_2);  

           $total_fees += $pra_new_2[charge];
           
          if($pra[grade] == 'Tutor') { 
            if($pra_new_2[virutual_or_full] == 'Virual Training Only - Payment Gateway Free')       {  $com =  '0.15';  } 
            if($pra_new_2[virutual_or_full] == 'Full Package')                                      {  $com =  '0.25';  }

            $total_expences += $pra_new_2[charge]*$com;
          }

          if($pra[grade] == 'Trainer') { 
            if($pra_new_2[virutual_or_full] == 'Virual Training Only - Payment Gateway Free')       {  $com =  '0.25';  } 
            if($pra_new_2[virutual_or_full] == 'Full Package')                                      {  $com =  '0.35';  }

            $total_expences += $pra_new_2[charge]*$com;
          }

          if($pra[grade] == 'Tutor') { 
            if($pra_new_2[virutual_or_full] == 'Virual Training Only - Payment Gateway Free')       {  $com =  '0.15';  } 
            if($pra_new_2[virutual_or_full] == 'Full Package')                                      {  $com =  '0.25';  }

            $total_expences += $pra_new_2[charge]*$com;
          }




        }
        
?>      
                        <p class="primary">Rs <?php if($total_fees == '') { echo '0'; } else { echo $total_fees; }  ?></p>
                        <span>Total Fees</span>
                    </div>
                </div><!-- end .info_wrap -->
            </div><!-- end .statement_info_card -->
        </div><!-- end .col-lg-3 -->

        <div class="col-lg-2 col-sm-6">
            <div class="statement_info_card">
                <div class="info_wrap">
                    <span>
        
                        <span class="icon-basket_x-loaded icon secondarybg transparent-bg secondary" style="width: 50px; line-height: 50px; background: black; color: white;"><?php echo $com2; ?></span>
                    </span>
                    <div class="info">


<?php     
     //$total_expences = $total_fees*$com;
        
?>      
                        <p class="secondary"><?php if($total_expences == '') { echo '0'; } else { echo $total_expences; }  ?></p>
                        <span>Website Charges</span>
                    </div>
                </div>
                <!-- end .info_wrap -->
            </div>
            <!-- end .statement_info_card -->
        </div>
        <!-- end .col-lg-3 -->

        <div class="col-lg-2 col-sm-6">
            <div class="statement_info_card">
                <div class="info_wrap">
                    <div class="info">
                            
<?php
        $sql_new_3 = "SELECT * FROM tutor_payouts WHERE status='Paid' AND active = 1 AND category = 'Payouts' AND teacher_id = '$_SESSION[userSession]' ORDER by id DESC";
        $result_new_3 = mysqli_query($connect, $sql_new_3);
        while($pra_new_3 = mysqli_fetch_array($result_new_3)) {  

           $tutor_payouts += $pra_new_3[amount];

        }
        
?>       


                        <p class="info" style="color: violet;">Rs <?php if($tutor_payouts == '') { echo '0'; } else { echo $tutor_payouts; }  ?></p>
                        <span>Payouts</span>
                    </div>
                </div><!-- end .info_wrap -->
            </div><!-- end .statement_info_card -->
        </div><!-- end .col-lg-3 -->

        <div class="col-lg-2 col-sm-6" >
            <div class="statement_info_card">
                <div class="info_wrap">
                    <div class="info">
                            
<?php
        $sql_new_3_x = "SELECT * FROM tutor_payouts WHERE status='Paid' AND active = 1 AND category = 'VAS' AND teacher_id = '$_SESSION[userSession]' ORDER by id DESC";
        $result_new_3_x = mysqli_query($connect, $sql_new_3_x);
        while($pra_new_3_x = mysqli_fetch_array($result_new_3_x)) {  

           $vas += $pra_new_3_x[amount];

        }
        
?>       


                        <p class="info">Rs <?php if($vas == '') { echo '0'; } else { echo $vas; }  ?></p>
                        <span>VAS</span>
                    </div>
                </div><!-- end .info_wrap -->
            </div><!-- end .statement_info_card -->
        </div><!-- end .col-lg-3 -->

        <div class="col-lg-3 col-sm-12">
            <div class="statement_info_card">
                <div class="info_wrap">
                    <span>
                        <span class="icon-briefcase_x icon mcolorbg4 transparent-bg danger" style="background: black; color: white;"><?php  $to_be_paid =  $total_fees-$total_expences-$vas; $percentage = $to_be_paid/$total_fees; echo round($percentage*100); ?>%</span>
                    </span>
                    <div class="info">
                        <p class="danger">Rs <?php echo $total_balance =  $total_fees-$total_expences-$tutor_payouts-$vas; ?></p>
                        <span>Available Balance</span>
                    </div>
                </div><!-- end .info_wrap -->
            </div><!-- end .statement_info_card -->
        </div><!-- end .col-lg-3 -->


<!--
        <div class="col-lg-12 col-sm-12"> <div class="statement_info_card" style=" "> <div class="" style=" padding: 10px; text-align: center; "> <div class="info" style=" "> <span style="font-family: inherit;">Class Fee x (#Online Payments + #Other Paid ) x (100%-percentage value )</span> </div> </div>  </div>  </div>
-->



    </div>
    
    
    
    
    
    
    













                
                
                
    
    
    
 <!--
                <div class="row dashboard_purchase">
                    <div class="col-md-12 dashboard_contents">
                        
    <div class="modules__content bg-white">
        <div class="table_module">
            <div class="table_header">
                <h3>Payment History</h3>
            </div>
            <div class="table-responsive">
                <table class="table withdraw__table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date & Time</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Details</th>
                    </tr>
                    </thead>

                    <tbody>


<?php
        $sql_new_payouts = "SELECT * FROM tutor_payouts WHERE status='Paid' AND active = 1 AND teacher_id = '$_SESSION[userSession]' ORDER by id DESC";
        $result_new_payouts = mysqli_query($connect, $sql_new_payouts);
        while($pra_new_payouts = mysqli_fetch_array($result_new_payouts)) {  

        
?>     


                    <tr>
                        <td>#<?php echo $pra_new_payouts[id]; ?></td>
                        <td><?php echo $pra_new_payouts[payout_date_time]; ?></td>
                        <td><?php echo $pra_new_payouts[payout_title]; ?></td>
                        <td class="bold">Rs <?php echo $pra_new_payouts[amount]; ?></td>
                        <td class="bold"><?php echo $pra_new_payouts[category]; ?>    </td>
                    </tr>

<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

                    </div>
                </div> -->
    
    
    
    
    
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                




                <div class="row">


<div class="col-lg-6 col-md-12 p-bottom-0">


    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: left; "><?php echo $pra[userName]; ?> - <?php echo $pra[grade]; ?></p> </div>

</div>


<div class="col-lg-6 col-md-12 p-top-20 " style=" color: white; text-align: right;">

                            <a href="teacher_students_registry.php" class="btn btn--md register_btn btn-primary" style="background: #1dc9b7; border: none" >ALL REGISTRATIONS</a>
<?php
      if(isset($_GET[archive])) { 
         echo '<a href="teachers_active.php" class="btn btn--md register_btn btn-primary" style="background: #1dc9b7; border: none" >LIVE SESSIONS / PROGRAMS</a>';
      } 
      if(!isset($_GET[archive])) { 
         echo '<a href="teachers_active.php?archive" class="btn btn--md register_btn btn-primary" style="background: #1dc9b7; border: none" >ARCHIVE SESSIONS / PROGRAMS</a>';
      } 

?>
                            

                            
</div>




                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white;border-radius: 10px;box-shadow: 0 6px 3px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.09) !important;margin: 50px 0 0 0;">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Session/ Program</th>
                                    <th style="display: none">Type & Audience</th>
                                    <th>Charges</th>
                                    <th style="width: 200px; max-width:200px; display: none">Virtual/Full</th>
                                    <th>Teacher Link</th>
                                    <th>Student Link</th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 50px 0px; ">Requested</th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 50px 0px; ">E.Paid</th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 50px 0px; ">D.Acc</th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 50px 0px; ">Free</th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 50px 0px; ">Slots</th>
                                </tr>
                                </thead>

                                <tbody>

     

<?php 
if (isset($_POST['file_submit'])){
if(($_FILES['file']['tmp_name'])){
    
    $temp = explode(".", $_FILES["file"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    move_uploaded_file($_FILES["file"]["tmp_name"], "functions/uploads/" . $newfilename);

    $sql = "UPDATE category SET pdf='$newfilename' WHERE id=$_POST[cat_id]";
    $results = mysqli_query($connect, $sql);
    echo "<script>alert('File Uploaded Succesfully!')</script>";
}}

?>
                    
                    <?php  $current_date = date('Y-m-d'); ?> 
                    <?php  $after_one_year = date('Y-m-d', strtotime($current_date . ' +10 year'));  ?>
                    <?php  $before_one_year = date('Y-m-d', strtotime($current_date . ' -10 year')); ?>
<?php 
      if(isset($_GET[archive])) { 
         $sql2 = "SELECT * FROM category WHERE 
         teacher_id=$_SESSION[userSession] AND date2 between '$before_one_year' AND '$current_date' AND active = 0 OR
         teacher_id=$_SESSION[userSession] AND date2 between '$before_one_year' AND '$current_date' AND active = 1 OR
         teacher_id=$_SESSION[userSession] AND date2 between '$before_one_year' AND '$current_date' AND active = 2 
         ORDER by lesson_date DESC";
      } 
      if(!isset($_GET[archive])) { 
         $sql2 = "SELECT * FROM category WHERE 
         teacher_id=$_SESSION[userSession] AND date2 between '$current_date' AND '$after_one_year' AND active = 0 OR
         teacher_id=$_SESSION[userSession] AND date2 between '$current_date' AND '$after_one_year' AND active = 1 OR
         teacher_id=$_SESSION[userSession] AND date2 between '$current_date' AND '$after_one_year' AND active = 2 
         ORDER by lesson_date ASC";
      } 


        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) { 

?>                                                              
<?php
        $sql3 = "SELECT * FROM products WHERE lesson_id=$pra2[id] AND active = 1 AND status = 'Proceed' AND paid_marked_by = '' ORDER by id DESC";
        $result3 = mysqli_query($connect, $sql3);      $num_rows3 = mysqli_num_rows($result3);

?>                                                                 
<?php
        $sql3_x = "SELECT * FROM products WHERE lesson_id=$pra2[id] AND active = 1 AND status = 'Paid' AND paid_marked_by = 'Online' ORDER by id DESC";
        $result3_x = mysqli_query($connect, $sql3_x);      $num_rows3_x = mysqli_num_rows($result3_x);

?>                                                                                                  
<?php
        $sql4 = "SELECT * FROM products WHERE lesson_id=$pra2[id] AND active = 1 AND status = 'Paid' AND paid_marked_by = '' ORDER by id DESC";
        $result4 = mysqli_query($connect, $sql4);      $num_rows4 = mysqli_num_rows($result4);

?>                                                                                                
<?php
        $sql5 = "SELECT * FROM products WHERE lesson_id=$pra2[id] AND active = 1 AND status = 'Paid' OR lesson_id=$pra2[id] AND active = 1 AND status = 'Free' OR lesson_id=$pra2[id] AND active = 1 AND status = 'PostPay'  ORDER by id DESC";
        $result5 = mysqli_query($connect, $sql5);      $num_rows5 = mysqli_num_rows($result5);

?>           

                                                                                               
<?php
        $sql7 = "SELECT * FROM products WHERE lesson_id=$pra2[id] AND active = 1 AND status = 'Free' ORDER by id DESC";
        $result7 = mysqli_query($connect, $sql7);      $num_rows7 = mysqli_num_rows($result7);

?>     
                                                                                               
<?php
        $sql8 = "SELECT * FROM products WHERE lesson_id=$pra2[id] AND active = 1 AND status = 'PostPay' ORDER by id DESC";
        $result8 = mysqli_query($connect, $sql8);      $num_rows8 = mysqli_num_rows($result8);

?>     

                                           
                                <tr>
                                    <?php if( $pra2[active] == '2') {  ?>
                                    <td class="type" align="center"> <span class="proceed">PENDING</span>  <br><span style=" color: #343e51; font-size: smaller; line-height: initial; margin-top: 10px; "><?php echo $pra2[lesson_date]; ?> (<?php echo $pra2[lesson_time]; ?>)
                                        <br> <?php echo $pra2[date2]; ?> (<?php echo $pra2[time2]; ?>)</span>
                                        
                                        <?php if($pra2[teacher_link] != ''){ ?>
                                            <br><a style="color: white;text-align: center;background: #f4516c;padding: 10px 15px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: auto;display: block;border-radius: 10px; " href="<?php echo $pra2[teacher_link]; ?>" target="_blank">Join The Stream </a>
                                            <?php } ?>
                                            
                                            </td>
                                    <?php } ?>
                                    <?php if( $pra2[active] == '1') {  ?>
                                    <td class="type" align="center"> <span class="paid" >APPROVED</span>  <br><span style=" color: #343e51; font-size: smaller; line-height: initial; margin-top: 10px; "><?php echo $pra2[lesson_date]; ?> (<?php echo $pra2[lesson_time]; ?>)
                                        <br> <?php echo $pra2[date2]; ?> (<?php echo $pra2[time2]; ?>)</span>
                                        
                                        <?php if($pra2[teacher_link] != ''){ ?>
                                            <br><a style="color: white;text-align: center;background: #f4516c;padding: 10px 15px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: auto;display: block;border-radius: 10px; " href="<?php echo $pra2[teacher_link]; ?>" target="_blank">Join The Stream </a>
                                            <?php } ?>
                                             <br><a style="color: white;text-align: center;background: #FF9800;padding: 5px 10px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: auto;display: block;border-radius: 10px; " href="learning_meterials.php?view=<?php echo $pra2[id]; ?>" target="_blank">Click & View Lessons / පන්ති වලට මෙතනින් පිවිසෙන්න </a>
                                           
                                            </td>
                                    <?php } ?>
                                    <?php if( $pra2[active] == '0') {  ?>
                                    <td class="type" align="center"> <span class="finished">DECLINED</span>  <br><span style=" color: #343e51; font-size: smaller; line-height: initial; margin-top: 10px; "><?php echo $pra2[lesson_date]; ?> (<?php echo $pra2[lesson_time]; ?>)
                                        <br> <?php echo $pra2[date2]; ?> (<?php echo $pra2[time2]; ?>)</span>
                                        
                                        <?php if($pra2[teacher_link] != ''){ ?>
                                            <br><a style="color: white;text-align: center;background: #f4516c;padding: 10px 15px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: auto;display: block;border-radius: 10px; " href="<?php echo $pra2[teacher_link]; ?>" target="_blank">Join The Stream </a>
                                            <?php } ?>
                                            
                                            </td>
                                    <?php } ?>


                                    <td style="    width: 200px; max-width:200px;"><?php echo $pra2[name_of_class]; ?> <strong>(<?php echo $pra2[description]; ?>)</strong>

                                    <?php if( $pra2[active] == '1') {  ?><a style=" font-weight: bold; color: #094976; display: flex; margin-bottom: 9px;" href="lessons.php?view=<?php echo $pra2[id]; ?>" ><span class="paid" style=" line-height: 24px; float: right; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a><?php } ?>

                                    <a style="margin-bottom: 9px;font-weight: bold;color: #094976;display: flex;" href="lessons_add_info.php?view=<?php echo $pra2[id]; ?>" ><span class="paid" style=" line-height: 24px; float: right; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">ADD MORE DETAILS</span></a>
<?php if( $pra2[active] == '1') {  ?><a style=" font-weight: bold;color: #094976;display: initial;width: inherit;margin: 0px;padding: 0px; " href="teacher_students_registry_by_subject.php?lesson=<?php echo $pra2[id]; ?>" ><span class="postpay" style="line-height: 24px;/* float: right; */border-radius: 3px;display: inline-block;padding: 0 15px;color: #fff;font-weight: 400;font-size: 12px;background: #094976; ">STUDENTS</span></a><?php } ?>



                                    </td>
                                    <td style="display: none"><?php echo $pra2[type_of_programe]; ?><br>(<?php echo $pra2[target_audience]; ?> - <?php echo $pra2[no_of_students]; ?>)</td>
                                    
                                    <td><?php echo $pra2[charge]; ?><br>(<?php echo $pra2[currency]; ?>)</td>
                                    <td style="width: 200px; max-width:200px; display: none"><?php echo $pra2[virutual_or_full]; ?></td>


                                   
                                    
                                    <td class="action">
                                        <form style="padding: 0;" action="" method="post" onsubmit="return confirm('Are you sure you want to Save?);">
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="text" name="teacher_link" value="<?php echo $pra2[teacher_link]; ?>"  style="    width: 150px;">
                                        </form>
                                    </td>

                                    <td class="action">
                                        <form style="padding: 0;" action="" method="post" onsubmit="return confirm('Are you sure you want to Save?');">
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="text" name="student_link" value="<?php echo $pra2[student_link]; ?>"  style="    width: 150px;">
                                        </form>
                                    </td>
                                    
                                    


                                    <td><?php echo $num_rows3; ?></td>
                                    <td><?php echo $num_rows3_x; ?></td>
                                    <td><?php echo $num_rows4; ?></td>
                                    <td><?php echo $num_rows7; ?></td>
                                    <td><?php echo $pra2[no_of_students]-$num_rows5; ?></td>
                                            
                                    


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