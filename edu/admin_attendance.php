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
if (isset($_POST['save'])){

        $time = time();
        $time = $_SESSION[userSession]._.$time;
        $date = date('Y-m-d h:i:sa');



        $sql = "SELECT student_rfid, userName, userEmail FROM tbl_users WHERE student_rfid = '$_POST[student_rfid]'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);
        $num_rows = mysqli_num_rows($result);
    
        if($num_rows != '' OR $num_rows != '0') { 
 
                                    $msg = "
                                    <div class='alert alert-success' style='width:100%'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>$pra[userName], Attendance Marked Successfull!</strong>  
                                    </div>";
                                } else { 
 
                                    $msg = "
                                    <div class='alert alert-danger' style='width:100%'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Card Not Assigned!</strong>  
                                    </div>";}


    $save = mysqli_query($connect, "INSERT INTO students_attendance VALUES (NULL, '$_SESSION[userSession]', '$time', '$date', '$_POST[student_rfid]', '1' , '$pra[userName]',  '$pra[userEmail]'  )");
    

    
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
   <title>Attendance - <?php echo $site_title; ?></title>

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
                                <div class="col-lg-4 col-md-12">
                                    </div>
                                
                                <div class="col-lg-4 col-md-12 p-top-0">
                                    
                    
                              <?php echo $msg; ?>
                        
                    
                    
                        
                    

                    

                    <form action="admin_attendance.php" method="post">
                        <div class="cardify signup_form" style="background: white; border-radius: 10px; padding: 20px;">
                            <!-- end .login_header -->





<div class="section-title">
                  <h3>Attendance</h3>
                  <p style="    margin-top: 50px;">Please punch ID Card / Enter Student ID</p>
                </div>





                            <div class="login--form">
                                <div class="form-group">
                                    
                                    <input type="text" class="text_field" placeholder="Student Card?" name="student_rfid" required="">
                                </div>

                              
                              <div class="row">
											
											
											<div class="col-lg-12 mt-30">
												 <input class="btn btn--md register_btn btn-common" type="submit" name="save" value="Mark Attendance Now">
											</div>
										</div>
										
										
                               
                                
                                
											
											

                                
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    </form><!-- Ends: .product-single -->


                 

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