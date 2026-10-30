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
if (isset($_POST['edit'])){


if($_POST[new_status] == '2') { 
    $type ='2';
  } 
  
if($_POST[new_status] == '3') { 
    $type ='3';
  } 


                $sql = "UPDATE tbl_users SET  userName = '$_POST[teacher_name]', grade = '$_POST[teacher_grade]', type = '$type' WHERE userID='$_GET[teacher]'  ";
                mysqli_query($connect, $sql);
                echo "<script>alert('Teacher Details Changed Successfully!')</script>";
}           
?>

<?php 
if (isset($_POST['save'])){

                $sql = "UPDATE tbl_users SET subject='$_POST[subject]', selected_ol_al_grade='$_POST[selected_ol_al_grade]', selected_medium='$_POST[selected_medium]', selected_subject='$_POST[selected_subject]' WHERE userID='$_GET[teacher]'  ";
                mysqli_query($connect, $sql);
                echo "<script>alert('Teacher Grade Changed Successfully!')</script>";
}           
?>

<?php 
if (isset($_GET['delete_payout'])){

                $sql = "UPDATE tutor_payouts SET active='$0' WHERE id='$_GET[delete_payout]' ";
                mysqli_query($connect, $sql);
                echo "<script>alert('Payout Deleted Successfully!')</script>";
}           
?>


<?php
        $sql = "SELECT * FROM tbl_users WHERE userID=$_GET[teacher] ";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>


<?php 
if (isset($_POST['add_payout'])){
  
$time = time();
$date = date('Y-m-d h:s');

    $result = mysqli_query($connect, "INSERT INTO tutor_payouts VALUES (NULL, '$_GET[teacher]', '$_POST[payout_title]', '$_POST[category]',  '$_POST[amount]',  '$_POST[payout_date_time]', '$_POST[description]', '$date', '$time',  'Paid', '1' )");
    
    if($result) { 
                            $msg = "
                                    <div class='alert alert-success'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Success!</strong>  Payout registered Succesfully!
                                    </div>

                                    ";
              } else { 

                        $msg = "
                              <div class='alert alert-danger'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Sorry !</strong>  We cant your Registry!
                              </div>
                              ";
                }

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
    <title>Teachers Settings - <?php echo $site_title; ?></title>

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
                                <div class="container">
                                    <div class="row">
                                   

                                        
                                            <div class="col-md-12 col-lg-9">
                                                <div class="p-top-0 p-bottom-20">
                                                    <h2 style="background: #fff;height: 20px;border-radius: 5px 5px 5px 0;    margin: 0px;"></h2>
                                                    
                                                    
                                                    <a href="admin_teachers_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>TRAINERS/ TUTORS</strong></span></a> 
                                                    
                                                </div>
                                            </div><!-- end .col-md-12 -->




                                        <div class="col-md-12 col-lg-3">
                                                            <div class="hero__content__title">
                                                <?php if( $pra[p_picture] == '') { ?>
                                                <a href="login.php"><img src="source_files/logo.png" style="width: 100%;"></a>
                                                <?php } ?>
                                                <?php if( $pra[p_picture] != '') { ?>
                                                <a href="login.php"><img src="<?php echo getImageUrl($pra['p_picture'], $baseURL, $current_page); ?>" style="border-radius: 150px;max-height: 150px;"></a>
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
                                    <input required="" style="width: 110px;color: transparent;border: none;line-height: 30px;height: 40px;margin-right: 20px" type="file" class="text_field" name="file"><span style="color: white;">Profile Picture</span>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-common" type="submit" name="upload_profile_picture" value="Upload" style="float: right;margin-top: 0px;"
                                </div> 
                                
                                </div>
                                
                                    
</form>                                
                    
                                           
                                        </div><!-- end .col-md-12 -->
                                    </div>
                                </div>
                <div class="container featured-products2  p-top-0 p-bottom-120">
                            






                            




                            <div class="row">
<div class="col-lg-9 col-md-12 p-bottom-0">
    <div class="login--header" style=" border-bottom: none; "> <h3 style=" font-size: initial; color: black; text-align: left; ">List of Trainers/Tutors<h3p> </div>
    
    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: left; "><?php echo $pra[userName]; ?> <br> <?php echo $pra[grade]; ?></p> </div>

</div>

<div class="col-lg-3 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="admin_teachers_add_lesson.php?teacher=<?php echo $_GET[teacher]; ?>" target="_blankx" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>ADD A LESSON</strong></span></a>

</div>
                            </div>








  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

      .form-control, input {border: 1px solid #262626; } 
      
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
        $sql_new_1 = "SELECT * FROM products WHERE status='Paid' AND active = 1 AND teacher_id = '$_GET[teacher]'  ORDER by id DESC";
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
        $sql_new_3 = "SELECT * FROM tutor_payouts WHERE status='Paid' AND active = 1 AND category = 'Payouts' AND teacher_id = '$_GET[teacher]' ORDER by id DESC";
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

        <div class="col-lg-2 col-sm-6"  >
            <div class="statement_info_card">
                <div class="info_wrap">
                    <div class="info">
                            
<?php
        $sql_new_3_x = "SELECT * FROM tutor_payouts WHERE status='Paid' AND active = 1 AND category = 'VAS' AND teacher_id = '$_GET[teacher]' ORDER by id DESC";
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
                        <span class="icon-briefcase_x icon mcolorbg4 transparent-bg danger" style="background: black; color: white; display: none"><?php  $to_be_paid =  $total_fees-$total_expences-$vas; $percentage = $to_be_paid/$total_fees; echo round($percentage*100); ?>%</span>
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     
   <script>
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   </script>           
                <div class="row">
                    <?php echo $msg; ?>

                    <div class="col-lg-12 col-sm-12">
                        <form action="" method="post" onsubmit="return confirm('Are you sure?')">
                            
    <div class="upload_modules" style="box-shadow: 0 6px 3px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.09) !important;">
        <div class="modules__title">
            <h4>Add Payouts</h4>
        </div><!-- ends: .module_title -->

        <div class="modules__content">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="form-group">
                        <input type="text" name="payout_title" class="text_field" placeholder="Title" required="">
                    </div>
                </div><!-- ends: .col-md-6 -->
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <div class="select-wrap select-wrap2">
                            <select name="category" id="category" class="text_field" required>
                                <option value="Payouts">Payouts</option>
                                <option value="VAS">VAS</option>
                            </select>
                            <span class="lnr icon-arrow-down"></span>
                        </div>
                    </div>
                </div><!-- end: .col-md-6 -->

                <div class="col-lg-3 col-sm-12">
                    <div class="form-group">
                        <input type="text" onkeypress="return isNumberKey(event)"  required="" name="amount" class="text_field" placeholder="Amount" value="">
                    </div>
                </div><!-- ends: .col-md-6 -->

                <div class="col-lg-3 col-sm-12">
                    <div class="form-group">
                        <input type="text"  required="" name="payout_date_time" class="text_field" placeholder="Date & Time" value="<?php echo date('Y-m-d h:s:A') ?>">
                    </div>
                </div><!-- ends: .col-md-6 -->


                <div class="col-lg-10 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="description" class="text_field" placeholder="Description">
                    </div>
                </div><!-- ends: .col-md-12 -->


                <div class="col-lg-2 col-sm-12">
                    <div class="form-group">
                        <input type="submit" name="add_payout" class="btn btn-lg btn-danger" value="Save" >
                    </div>
                </div><!-- ends: .col-md-12 -->


            </div>
        </div><!-- ends: .modules__content -->
  

    </div><!-- ends: .upload_modules -->

                        </form>
                    </div><!-- ends: .col-md-8 -->
                </div><!-- ends: .row -->
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
    
    
    
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
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>


<?php
        $sql_new_payouts = "SELECT * FROM tutor_payouts WHERE status='Paid'  AND teacher_id = '$_GET[teacher]' ORDER by id DESC";
        $result_new_payouts = mysqli_query($connect, $sql_new_payouts);
        while($pra_new_payouts = mysqli_fetch_array($result_new_payouts)) {  

        
?>     


                    <tr>
                        <td>#<?php echo $pra_new_payouts[id]; ?></td>
                        <td><?php echo $pra_new_payouts[payout_date_time]; ?></td>
                        <td><?php echo $pra_new_payouts[payout_title]; ?></td>
                        <td class="bold">Rs <?php echo $pra_new_payouts[amount]; ?></td>
                        <td class="bold"><?php echo $pra_new_payouts[category]; ?>    </td>
                        <td class="bold type"><?php if( $pra_new_payouts[active] == '1') { echo '<span class="proceed" style="">Active</span>' ;} if( $pra_new_payouts[active] == '0') { echo '<span class="proceed" style=" background: red; ">Deleted</span>' ;}  ?>    </td>
                        <td class="bold"><a onclick="return confirm('Are you sure you want to DELETE?');" href="admin_teachers_settings.php?teacher=<?php echo $_GET[teacher]; ?>&&delete_payout=<?php echo $pra_new_payouts[id]; ?>">&#10060;</a></td>
                    </tr>

<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

                    </div>
                </div>-->
    
    
    
    
    
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
    
    

                <div class="row" style="margin-top:50px">
                    <div class="col-md-12">
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                 
                                
                                
                                
<form action="" method = "post" style="margin-top:0px" onsubmit="return confirm('Are you sure?')">
                                <div class="row">
    
                                <div class="col-lg-5 col-md-12">
                                <input  type="text" value="<?php echo $pra[userName]; ?>" class="text_field" placeholder="Enter Teacher Name" name="teacher_name" required="" >
                                </div> 
                                <div class="col-lg-3 col-md-12">
                                <input  type="text" value="<?php echo $pra[grade]; ?>" class="text_field" placeholder="Enter Grade" name="teacher_grade" required="" >
                                </div> 
                                <div class="col-lg-3 col-md-12">
                                    <select class="text_field" name="new_status" style=" width: 100%; border-radius:2px; padding:0 15px; " required=""> 
                                        
                                        <option value="2" <?php if($pra[type] == '2') { echo " selected ";} ?> >Trainer / Tutor / Institute</option>

                                        <option value="3" <?php if($pra[type] == '3') { echo " selected ";} ?>>Learner / Student</option>
                                        
                                    </select>
                                </div> 
                                
    
                                <div class="col-lg-1 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-primary" type="submit" name="edit" value="Edit" style="background: #f4516c">
                                </div> 
                                
                                </div>
                                
                                    
</form>                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                        </div>


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