<?php 
    include 'functions/main.functions.php';  
    require_once 'class.user.php';
    $user_login = new USER();
?>

<?php

if($user_login->is_logged_in()!="")
{
    if($_SESSION['type'] == '1') { $user_login->redirect('admin_teachers_list.php'); }
    if($_SESSION['type'] == '2') { $user_login->redirect('teachers_add_lesson.php'); }
    if(isset($_GET[view])) { 
      if($_SESSION['type'] == '3') { $user_login->redirect('lessons.php?add&view='.$_GET[view].''); }
    }if(!isset($_GET[view])) { 
      if($_SESSION['type'] == '3') { $user_login->redirect('select_your_teacher.php'); } //select_your_teacher
    }
}

if(isset($_POST['sign_in']))
{
    $email = trim($_POST['username']);
    $sql = "SELECT * FROM tbl_users WHERE userEmail='$email'";
    $result = mysqli_query($connect, $sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows != '' OR $num_rows != '0') { 
   
                    $email = trim($_POST['username']);
                    $upass = trim($_POST['password']);
                    
                    if($user_login->login($email,$upass))
                    {
                        if($_SESSION['type'] == '1') { $user_login->redirect('admin_teachers_list.php'); }
                        if($_SESSION['type'] == '2') { $user_login->redirect('teachers_add_lesson.php'); }
                        if(isset($_GET[view])) { 
                          if($_SESSION['type'] == '3') { $user_login->redirect('lessons.php?add&view='.$_GET[view].''); }
                        }if(!isset($_GET[view])) { 
                          if($_SESSION['type'] == '3') { $user_login->redirect('select_your_teacher.php'); } //select_your_teacher
                        }
                    }
    } else { 

    $show_create = '1';

    if (!is_numeric($_POST[username])) { $show_create = '0'; } 

    }
} 


?>

<?php 
if(isset($_POST['register_now']))
{
  
      
      
      
    $uname = mysqli_real_escape_string($connect, $_POST['name']);
    $uname2 = mysqli_real_escape_string($connect, $_POST['last']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $upass = mysqli_real_escape_string($connect, $_POST['password']);
    $mobile = mysqli_real_escape_string($connect, $_POST['mobile']);
    
    $whatsapp_or_viber = mysqli_real_escape_string($connect, $_POST['whatsapp_or_viber']);
    $subject = mysqli_real_escape_string($connect, $_POST['subject']);
    $grade = mysqli_real_escape_string($connect, $_POST['grade']);
    $location = mysqli_real_escape_string($connect, $_POST['location']);
    $postal_code = mysqli_real_escape_string($connect, $_POST['postal_code']);
    $school = mysqli_real_escape_string($connect, $_POST['school']);
    $batch = mysqli_real_escape_string($connect, $_POST['batch']);



    $telegram = mysqli_real_escape_string($connect, $_POST['telegram']);
    $real_email = mysqli_real_escape_string($connect, $_POST['real_email']);
    $institute_name = mysqli_real_escape_string($connect, $_POST['institute_name']);
    $std_city = mysqli_real_escape_string($connect, $_POST['std_city']);
    $index = mysqli_real_escape_string($connect, $_POST['index']);




if($_POST[grade] == 'Tutor' OR $_POST[grade] == 'Trainer' ) { 
    $type ='2'; 
    $userStatus ='N';
  } 

if($_POST[grade] == 'Student') { 
    $type ='3';
    $userStatus ='Y';
  } 
  
if($_POST[grade] == 'Learner') { 
    $type ='3';
    $userStatus ='Y';
  } 
  
if($_POST[grade] == 'Institute') { 
    $type ='2';
    $userStatus ='N';
  } 
  
    
    $code = md5(uniqid(rand()));
    
    $sql = "SELECT * FROM tbl_users WHERE userEmail='$email' AND institute_id != '' OR institute_id='$_POST[institute_id]'  AND institute_id != ''      ";
    $result = mysqli_query($connect, $sql);
    $pra = mysqli_fetch_array($result);
    
    if(mysqli_num_rows($result) > 0)
    { 
        $msg = "
              <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Sorry !</strong>  Mobile Number or Institute ID is already exists , Please Try another one
              </div>
              ";
    }
    else
    {

            
        $password = md5($upass);



    if($_POST[original_code] == $_POST[code]) { 

        $time = time();
        $date = date('Y-m-d h:i:sa');

                $result = mysqli_query($connect, "INSERT INTO tbl_users VALUES (NULL, '$uname', '$uname2', '$email', '$password', '$userStatus', '$code', '$mobile', '$whatsapp_or_viber', '$_POST[selected_ol_al_grade]', '$_POST[selected_medium]', '$_POST[selected_subject]', '$subject', '$grade', '$location', '$postal_code', '$school', '', '$type', '', '$_POST[institute_id]', 'N'   ,'' , '$telegram', '$real_email', '$institute_name', '$std_city', '$time', '$date' , '', '' ,'$index')");
    } else { 

             $user_login->redirect('login.php?code');

             
    }



        
        //mysqli_query($connect, $sql2);

        if($result) 
        { 




if($_POST[grade] == 'Tutor' OR $_POST[grade] == 'Trainer' OR $_POST[grade] == 'Institute' ) { 


               
                       
    $sql_new = "SELECT * FROM tbl_users WHERE userName='$uname' AND userEmail ='$email' AND mobile = '$mobile' AND grade = '$grade' ";
    $result_new = mysqli_query($connect, $sql_new);
    $pra_new = mysqli_fetch_array($result_new);



                $to = $_POST['email'] . ', ' . $site_info_mail_address;
                $subject = 'Account Acivation - '.$site_website_name.' ('.$pra_new[userID].') ';
                $message = '  
                            
Hi '.$_POST['name'].', <br><br>
<strong>Welcome to '.$site_website_name.' and thank you for registering yourself with us.</strong><br><br>
You are just one step behind to activate the account!><br><br>
Use the link below to activate your account to access our Programs and courses.><br><br>
Please note you may not be able to login to your account until you have activated the account.><br><br>
Click below tab to activate Your Account><br>

<strong><a href="https://'.$actual_domain_without_http.'/activate.php?code='.$pra_new[tokenCode].'">Activate Your Account</strong><br><br>
Enjoy learning with '.$site_website_name.'.<br><br>
If you need any assistance, please use our web chat or email to '.$site_info_mail_address.'.<br><br><br><br>
This is an automated email generated by '.$site_website_name.' Admin to verify the authenticity of the e-mail user.

                            ';
                $from = $site_info_mail_address;
                $headers = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
                $headers .= "From:" . $from;
                mail($to,$subject,$message,$headers);

            
    
    
    
    
    
            $msg .= "
                    <div class='alert alert-success' style=' font-size: initial; ;'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Success!</strong>  You account is Created Successfull! <br>  Thank you for Registering with us, Please check your Email and Activate your Account. <br> <br>";

                        $sql = "SELECT * FROM tbl_users WHERE userEmail='$_POST[email] AND '1' = '2'";
                        $result = mysqli_query($connect, $sql);
                        $pra = mysqli_fetch_array($result);
                        $num_rows = mysqli_num_rows($result);

                                        if ($num_rows != '0' OR $num_rows != ''  ) {   } 
                                            //$msg .=' <p style=" font-size: initial;  ">When your payment is verified by the "'.$site_website_name.'" Your account will be activated. </p> '; 
                                       ?>

<?php 
                    $msg .=' </div>';






} 


if($_POST[grade] == 'Learner'  ) { 





               
                       
    $sql_new = "SELECT * FROM tbl_users WHERE userName='$uname' AND userEmail ='$email' AND mobile = '$mobile' AND grade = '$grade' ";
    $result_new = mysqli_query($connect, $sql_new);
    $pra_new = mysqli_fetch_array($result_new);



            $to = $_POST['email'];
            $subject = 'New Registration - '.$site_website_name.' ('.$pra_new[userID].') ';
            $message = ' 
                            
Hi '.$_POST['name'].', <br><br>
<strong>Welcome to '.$site_website_name.' and thank you for registering yourself with us.</strong><br><br>
You are just one step behind to activate the account!<br><br>

Enjoy learning with '.$site_website_name.'.<br><br>
If you need any assistance, please use our web chat or email to '.$site_info_mail_address.'.<br><br><br><br>
This is an automated email generated by '.$site_website_name.' Admin to verify the authenticity of the e-mail user.

                            ';
            $from = $site_info_mail_address;
            $headers = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
            $headers .= "From:" . $from;
            mail($to,$subject,$message,$headers);

          
  
  
  
  
  
            $msg = "
                    <div class='alert alert-success'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Success!</strong>  Thank you for Registering with us<br> <br>Please check your Email and Activate your Account. 
                    </div>

                    ";



} 








if($_POST[grade] == 'Student'  ) { 





               
//textit        
          $to = "$email";
          $date_time = date("Y/m/d - h:i:sa");
          $text = urlencode("$_POST[name], You have registered successfully in $actual_domain_without_http -NLC- Mobile : $email -NLC- Password : $_POST[password] ");
          $output4 = preg_replace('!\s+!', ' ', $text);
          $baseurl ="http://www.textit.biz/sendmsg";
          //$url = "$baseurl/?id=XXX&pw=XXX&to=$to&text=$output4&eco=Y";
          //$ret = file($url);     $res= explode(":",$ret[0]);                                                        
       
//textit 
  



                       
    $sql_new = "SELECT * FROM tbl_users WHERE userName='$uname' AND userEmail ='$email' AND mobile = '$mobile' AND grade = '$grade' ";
    $result_new = mysqli_query($connect, $sql_new);
    $pra_new = mysqli_fetch_array($result_new);



            $to = $_POST['email'];
            $subject = 'New Registration - '.$site_website_name.' ('.$pra_new[userID].') ';
            $message = ' 
                            
Hi '.$_POST['name'].', <br><br>
<strong>Welcome to '.$site_website_name.' and thank you for registering yourself with us.</strong><br><br>
You are just one step behind to activate the account!<br><br>

Enjoy learning with '.$site_website_name.'.<br><br>
If you need any assistance, please use our web chat or email to '.$site_info_mail_address.'.<br><br><br><br>
This is an automated email generated by '.$site_website_name.' Admin to verify the authenticity of the e-mail user.

                            ';
            $from = $site_info_mail_address;
            $headers = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
            $headers .= "From:" . $from;
            mail($to,$subject,$message,$headers);

          
  
  
  
  
  
            $msg = "
                    <div class='alert alert-success'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Success!</strong>  Thank you for Registering with us<br> <br>You can Login Now
                    </div>

                    ";



    $email = trim($_POST['email']);
    $upass = trim($_POST['password']);
    
    if($user_login->login($email,$upass))
    {
        if($_SESSION['type'] == '1') { $user_login->redirect('admin_teachers_list.php'); }
        if($_SESSION['type'] == '2') { $user_login->redirect('teachers_add_lesson.php'); }
        if(isset($_GET[view])) { 
          if($_SESSION['type'] == '3') { $user_login->redirect('lessons.php?add&view='.$_GET[view].''); }
        }if(!isset($_GET[view])) { 
          if($_SESSION['type'] == '3') { $user_login->redirect('index.php?success'); } //select_your_teacher
        }
    }


    

} 









        }
        else
        {
            echo "sorry , Query could no execute...";
        }       
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
    <title>Login to <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>

    <style type="text/css">
            .col-md-6_new { flex: 25% !important; } 
            @media only screen and (max-width: 445px){  
                .p-top-0 { margin-top: 0px !Important }  
                .logo_img  {     margin-top: 0px !important; height: 335px; margin-left: 30px; object-fit: cover; }  }
                .col-md-6_new { flex: 25%; max-width: 20%; padding: 10px; margin-top: 10px; }
                .hide_in_tab { width: 10%; }

            }  
            
             
            @media only screen and (max-width: 995px){  
                .col-md-6_new { flex: 25%; max-width: 20%; padding: 10px; margin-top: 10px; }
                .hide_in_tab { display: none; }
                .logo_img { margin-top: 20px !important; }

            }  
    </style>
</head>
<body class="preload" style="">
    
   

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    
    
    <section class="hero-area4 bgimage" style="background:  <?php echo $common_body_color; ?>;">
       
        <div class="hero-content content_above" style="padding: 50px 0 50px 0;/**/x">
                            <div class="content-wrapper">
                               
                         
                <div class="container featured-products2  p-top-10 p-bottom-120 " style="<?php if($show_create == '1') { echo 'display: none'; } ?>">
                            
                <div class="row">
                            






                            
<?php
if(isset($_GET[code])) { 
    echo " <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Sorry !</strong>  Your Code is not matching, Please try again
              </div>
              ";
}

?>








<div class="col-lg-8 mt-sm-0"  >
        
<div style="">
<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = 'landing' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>  
    <img src="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" style="/* background: white; */padding: 0px;box-shadow: 0px 0px #dddddd;border-radius: 12px;width: 100%;margin-top: 0px;display: block;" class="logo_img">

<?php } ?>
    
    
</div>
</div>


                            <div class="col-lg-4 col-md-12 p-top-0" style="margin-top:20px; display:none; <?php if($show_create != '1') { echo 'display: block'; } ?> ">
                    
                        
                    
                    
                        
                    

                    

                    <form action="" method="post" autocomplete="off">
                        <div class="cardify signup_form" style="background: #8e040e; border-radius: 10px; padding: 20px 20px 10px 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 );     border: 2px solid #fff; ">
                            <!-- end .login_header -->


<?php 
        if(isset($_GET['inactive']))
        {       
            ?>
            <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong>  When your Email is verified, Your account will be activated. <br><br>Please check your Email & Activate your Account.
            </div>
            <?php
        }
        ?>
        <?php
        if(isset($_GET['error']))
        {
            ?>
            <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Wrong Details!</strong> 
            </div>
            <?php
        }
        ?>




















<?php    if (isset($_GET['done']) ){
echo ' <div class="alert alert-success" style="font-size: initial; ">

                    <p style=" font-size: x-large;color: white;background: green;border: none;padding-top: 20px;font-weight: bold;border-radius: 0 0 5px 5px; ">  <span style=" font-size: large; font-weight: 100; ">Thank You '.$_SESSION['userName'].', </span> <br><br>
      We Received your Payment<br><br></p>      </div>'; 

    $sql_paid = "UPDATE tbl_users SET userStatus='Y' WHERE userID='$_GET[order_id]'";
    mysqli_query($connect, $sql_paid);       }    ?>

<?php    if (isset($_GET['cancel']) ){
echo '<p style=" font-size: large; color: white; "> Sorry '.$_SESSION['userName'].',  <br><br>
                        We could not Receive your Payment<br><br></p>';   }  ?>






   <script>
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   </script>







<?php 
        if(isset($_GET['inactive_x']))
        {       
        $sql = "SELECT * FROM tbl_users WHERE userEmail='$_GET[e]'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);
        $num_rows = mysqli_num_rows($result);

            ?>


          
        <?php if($pra[selected_package] == '')             {  $com =  '5000';  } ?>


            <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry <?php echo $pra['userName']; ?>!</strong> This Account is not Activated,  <br> <br>
                        <?php if ($num_rows != '0' OR $num_rows != ''  ) {  } echo '<p style=" font-size: initial;  ">When your Email is verified, Your account will be activated. <br><br>Please check your Email.</p> '; 
                       ?>
            </div>
            <?php
        }
        ?>
        <?php
        if(isset($_GET['error_x']))
        {
            ?>
            <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Wrong Details!</strong> 
            </div>
            <?php
        }
        ?>







<div class="section-title">
                
                    <p style="margin-top: 0px;color: red;line-height: initial;text-align: center; <?php if($show_create == '0') { echo 'display: none'; } ?>"> 



                  <img src="source_files/new_confiance_big - Copy.jpeg" style="margin: 0 auto;display: block;border-radius: 0px;height: auto;width: 55%; margin-bottom: 5px;">
                  
                  
                    <!--<span style=" background: #f2f2f2; display: block; color: black; padding: 10px; ">ඔබ දැනටමත් ලියාපදිංචි වී ඇත්නම් දුරකතන අංකය හා මුරපදය පහත යොමු කරන්න</span>

                    <br>නැත්නම් ඔබගේ දුරකතන අංකය සහ මුරපදයක් ඇතුලු කර ගිණුමක් විවෘත කළ හැකිය.</p>-->

                    <p style="margin-top: 0px;color: red;line-height: initial;text-align: center;  display:none; <?php if($show_create == '0') { echo 'display: block'; } ?>"> 

                    <span style=" background: red;display: block;color: white;padding: 10px;font-size: inherit;">Please enter a Mobile Number</p>


                 
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


        <p style=" text-align: center; font-size: small;color: white; ">ඔබගේ දුරකතන අංකය යොමු කර ඉදිරියට යන්න මත click කරන්න</p>

                            <div class="login--form">
                                <div class="form-group" style="margin-bottom: 5px;">
                                    
                                    <input type="text" class="text_field" placeholder="Mobile Number" name="username" required="" maxlength="10"  minlength="10"  onkeypress="return isNumberKey(event)">
                                </div>

                                
                              <div class="row">
                      
                      
                      <div class="col-lg-12 mt-25">
                         <input class="btn btn--md register_btn btn-common" type="submit" name="sign_in" value="ඉදිරියට යන්න" style="width: 100%; height: 40px; background-color: red" >
                      </div>


                    </div>
                    
                    
                               
                                
                                
                      














</div>
</div>
<div class="cardify signup_form" style="background: #8e040e; border-radius: 10px; padding: 20px 20px 10px 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 );    margin-top: 25px;     border: 2px solid #fff; ">
                            <!-- end .login_header -->












                    <div class="col-md-12 col-lg-12 mt-25">
                        <div class="copyright-text mt-25">
                            <p  style="color: white">
                                    <strong><?php echo $site_info_mail_address; ?> |  <?php echo $site_mobile; ?></strong> 
                            </p>
                            <!--<p><a href="/terms-and-condition.php" style="color: #a2a5b9;">Terms &amp; Condition</a></p>-->
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12" style="text-align: right;">
                    
                        <div class="copyright-text row">
                                 
                                  <div class="col-lg-2 col-md-6_new">
                                     <div class="product-single latest-single" style="background: none;margin: 0px;padding: 0px;     border: none;">
                                      <div class="product-excerpt" style="background: none;border: none;padding: 1px;">
                                        <h5 style="text-align: center;line-height: unset;margin: 3px 0 3px 0;"><a href="https://www.facebook.com/shimoglobal" style="color: white;" target="_blank"><img src="img/facebook.jpeg" style="width: 100%; border-radius: 10px;"></a></h5>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-2 col-md-6_new">
                                     <div class="product-single latest-single" style="background: none;margin: 0px;padding: 0px;     border: none;">
                                      <div class="product-excerpt" style="background: none;border: none;padding: 1px;">
                                        <h5 style="text-align: center;line-height: unset;margin: 3px 0 3px 0;"><a href="https://www.youtube.com/@ShimoGlobalpvt" style="color: white;" target="_blank"><img src="img/youtube.jpeg" style="width: 100%; border-radius: 10px;"></a></h5>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-lg-2 col-md-6_new">
                                     <div class="product-single latest-single" style="background: none;margin: 0px;padding: 0px;     border: none;">
                                      <div class="product-excerpt" style="background: none;border: none;padding: 1px;">
                                        <h5 style="text-align: center;line-height: unset;margin: 3px 0 3px 0;"><a href="https://www.instagram.com/shimo_lk/" style="color: white;" target="_blank"><img src="img/insta.jpeg" style="width: 100%; border-radius: 15px;"></a></h5>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-lg-2 col-md-6_new">
                                     <div class="product-single latest-single" style="background: none;margin: 0px;padding: 0px;     border: none;">
                                      <div class="product-excerpt" style="background: none;border: none;padding: 1px;">
                                        <h5 style="text-align: center;line-height: unset;margin: 3px 0 3px 0;"><a href="https://wa.me/94778783728" style="color: white;" target="_blank"><img src="img/whatsapp.jpeg" style="width: 100%; border-radius: 10px;"></a></h5>
                                      </div>
                                    </div>
                                  </div>
                                  
                                   <div class="col-lg-2 col-md-6_new">
                                     <div class="product-single latest-single" style="background: none;margin: 0px;padding: 0px;     border: none;">
                                      <div class="product-excerpt" style="background: none;border: none;padding: 1px;">
                                        <h5 style="text-align: center;line-height: unset;margin: 3px 0 3px 0;"><a href="https://www.tiktok.com/@shimoglobal" style="color: white;" target="_blank"><img src="img/saru1001.jpeg" style="width: 100%; border-radius: 10px;"></a></h5>
                                      </div>
                                    </div>
                                  </div>
                                        
                        </div>
                    </div>
                    
              








              








              








              









                      

                                
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    </form><!-- Ends: .product-single -->


                 

                                </div>





































<!-- 
<div class="row" style="margin-top:50px">
    <div class="col-lg-12 mt-sm-0">
        <img src="source_files/long_banner.jpg" style="width:100%;border-radius:10px">
    </div>
</div>
-->


                        </div>
                        
                             <div class=""  style="display:block;width: 30%;margin: 0px auto; <?php if($show_create != '1') { echo 'display: none'; } ?> ">



         <?php echo $msg; ?>




<?php    if (isset($_GET['done']) ){
echo ' <div class="alert alert-success" style="font-size: initial; ">

                    <p style=" font-size: x-large;color: white;background: green;border: none;padding-top: 20px;font-weight: bold;border-radius: 0 0 5px 5px; ">  <span style=" font-size: large; font-weight: 100; ">Thank You '.$_SESSION['userName'].', </span> <br><br>
      We Received your Payment<br><br></p>      </div>'; 

    $sql_paid = "UPDATE tbl_users SET userStatus='Y' WHERE userID='$_GET[order_id]'";
    mysqli_query($connect, $sql_paid);       }    ?>

<?php    if (isset($_GET['cancel']) ){
echo '<p style=" font-size: large; color: white; "> Sorry '.$_SESSION['userName'].',  <br><br>
                        We could not Receive your Payment<br><br></p>';   }  ?>






   <script>
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   </script>







<?php 
        if(isset($_GET['inactive_x']))
        {       
        $sql = "SELECT * FROM tbl_users WHERE userEmail='$_GET[e]'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);
        $num_rows = mysqli_num_rows($result);

            ?>


          
        <?php if($pra[selected_package] == '')             {  $com =  '5000';  } ?>


            <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry <?php echo $pra['userName']; ?>!</strong> This Account is not Activated,  <br> <br>
                        <?php if ($num_rows != '0' OR $num_rows != ''  ) {  } echo '<p style=" font-size: initial;  ">When your Email is verified, Your account will be activated. <br><br>Please check your Email.</p> '; 
                       ?>
            </div>
            <?php
        }
        ?>
        <?php
        if(isset($_GET['error_x']))
        {
            ?>
            <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Wrong Details!</strong> 
            </div>
            <?php
        }
        ?>


<style type="text/css">
    .mt-25 { margin-top: 10px !important; }

</style>




          <div class="input-form register-form mt-60">
            <form id="contactForm" data-toggle="validator" method="POST" action="" autocomplete="off">
              <div class="cardify signup_form row" style="background: #f2f2f2; border-radius: 10px; padding: 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 ); ">

          <!--<div class="section-title style-3">
            <h3>Select Category!</h3>
          </div>
                  
                  <br><br>-->
                  
                  
                <div class="col-sm-12 mt-25" style="display: none">
                   <input type="text" class="text_field" placeholder="Mobile Address" name="email" required="" maxlength="10"  minlength="10"  onkeypress="return isNumberKey(event)"  value="<?php echo $_POST[username]; ?>" >
                </div>


                       <span style="background: #f2f2f2;display: block;color: black;padding: 10px;text-align: center;line-height: normal;padding: 10px;border-radius: 10px;margin-top: 10px; width: 100%; margin: 0 auto;">මතක සිටින කැමති මුර පදයක් ඇතුලත් කරන්න</span>



                <div class="col-sm-12 mb-25" >
                  <input type="password" class="text_field" placeholder="Password" name="password" required="" value="" style="background: black;text-align: center;border-radius: 10px;">
                </div>



                <div class="col-sm-12 mt-25" >
                  <input type="text" class="text_field" placeholder="නම (Name)" name="name"  required="" >
                </div>
                <div class="col-sm-12 mt-25" >
                  <input type="text" class="text_field" placeholder="වාසගම (Surname) " name="last"  required="" >
                </div>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<style id="compiled-css" type="text/css">  .none { display:none; }</style>




<!--
                <div class="col-sm-12" align="center" style="background: red;color: white;border-radius: 5px;padding: 2px;margin: 20px 0 0 0;"> ඔබ <?php echo $site_website_name; ?> ආයතනයේ ශිෂ්‍ය / ශිෂ්‍යාවක්ද? </div>

                <div class="col-sm-6 mt-10" align="center">ඔව්
                  <input type="radio"  value="yes" data-id="bank" name="yes_or_not"  >
                </div>
                <div class="col-sm-6 mt-10" align="center">නැත
                  <input type="radio"  value="no" data-id="school" name="yes_or_not"  >
                </div>



                <div class="col-sm-12 none" id="school">
                    <p style="margin-top: 20px;     margin-bottom: 10px; color: red;line-height: initial;text-align: center;">  ආයතනයේ ID අංකය යොමු කරන්න</p>
                  <input type="text" class="text_field" placeholder="MyTeachersStudent ID" name="institute_id"  >
                </div>
 
<div id="bank" class="none"></div>


<script type="text/javascript">

  $(':radio').change(function (event) {
      var id = $(this).data('id');
      $('#' + id).addClass('none').siblings().removeClass('none');
  });
</script>


-->


                <div class="col-sm-12">
                  
                </div>
                
                

               

                <div class="col-sm-12 mt-25" >
                  <input type="text" class="text_field" placeholder="Nic number ( ඔබේ/ භාරකරුගේ )" name="postal_code"  >
                </div>

                
                <div class="col-sm-12 mt-25">
  <label style="text-align: center; display: block; margin-bottom: 5px;">Auto Generated Index Number</label>
  <input type="text" class="text_field" placeholder="Index Number" name="index" readonly style="background-color: #f5f5f5;">
</div>

<div class="col-sm-12 mt-25" >
                  <input type="text" class="text_field" placeholder="දැනට සිටින පාසල (School)" name="school"  >
                </div>


                <div class="col-sm-12 mt-25">
                  <input type="text" class="text_field" placeholder="WhatsApp භාවිතා කරන අංකය" name="mobile" maxlength="20"  minlength="10"  onkeypress="return isNumberKey(event)" required="">
                </div>
                

                
                <div class="col-sm-12 mt-25" style="display: none">
                    <select name="telegram">
                        <option value="">Select Medium</option>
                     
                        <option>Sinhala Medium</option>
                        <option>Tamil Medium</option>
                        <option>English Medium</option>
                    </select>
                </div>

                
                <div class="col-sm-12 mt-25"  style="display: none">
                    <select name="batch">
                        <option value="">ශ්‍රේණිය (Grade)</option>
                        <?php echo $site_grades; ?>
                    </select>
                </div>

                
                <div class="col-sm-12 mt-25" style="display: none">
                    <label style="text-align: center;color: white;line-height: normal;background: #545252;padding: 2px;border-radius: 6px; width: 100%">Important for Recieving Tutes <br> නිබන්ධන ලබාගැනීම සදහා වැදගත් වේ</label>
                    <select name="institute_name" required="">
                        <option>Online Classes</option>
                        <option>Physical Classes</option>
                    </select>
                </div>


               



                <div class="col-sm-6 mt-25" style="display:none">
                  <input type="text" class="text_field" placeholder="Telegram No" name="telegramX" maxlength="20"  minlength="10"  onkeypress="return isNumberKey(event)" >
                </div>




                <div class="col-sm-12 mt-25"  style="display:none">
                  <input type="email" class="text_field" placeholder="Email Address" name="real_email"  >
                </div>

     <div class="col-sm-12 mt-25"  style="display:">
                  <input type="text" class="text_field" placeholder=" ඉගෙනුම ලබන වසර" name="real_email"  >
                </div>





                <div class="col-sm-12 mt-25">
                  <select name="std_city" required="">
                                        <option value="">ඔබ පදිංචි දිස්ත්‍රික්කය (District)</option>
                                        <option>Ampara</option>
                                        <option>Anuradhapura</option>
                                        <option>Badulla</option>
                                        <option>Batticaloa</option>
                                        <option>Colombo</option>
                                        <option>Galle</option>
                                        <option>Gampaha</option>
                                        <option>Hambantota</option>
                                        <option>Jaffna</option>
                                        <option>Kalutara</option>
                                        <option>Kandy</option>
                                        <option>Kegalle</option>
                                        <option>Kilinochchi</option>
                                        <option>Kurunegala</option>
                                        <option>Mannar</option>
                                        <option>Matale</option>
                                        <option>Matara</option>
                                        <option>Monaragala</option>
                                        <option>Mullaitivu</option>
                                        <option>Nuwara Eliya</option>
                                        <option>Polonnaruwa</option>
                                        <option>Puttalam</option>
                                        <option>Ratnapura</option>
                                        <option>Trincomalee</option>
                                        <option>Vavuniya</option>
                                    </select>
                </div>


                <div class="col-sm-12 mt-25" >
                  <input type="text" class="text_field" placeholder="ලිපිනය (Address)" name="location"  >
                </div>

<script>
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

      // Add the new index number generator function
      const generateIndexNumber = () => {
        const name = document.querySelector('input[name="name"]').value.trim();
        const surname = document.querySelector('input[name="last"]').value.trim();
        const nicNumber = document.querySelector('input[name="postal_code"]').value.trim();
        const indexInput = document.querySelector('input[name="index"]');
        
        if (name && surname && nicNumber) {
          // Extract first letters of name and surname
          const nameInitial = name.charAt(0).toUpperCase();
          const surnameInitial = surname.charAt(0).toUpperCase();
          
          // Extract first 4 digits of NIC (birth year)
          const birthYear = nicNumber.slice(0, 4);
          
          // Get current year last 2 digits
          const year = new Date().getFullYear().toString().slice(-2);
          
          // Generate random 3 digit number
          const randomNum = Math.floor(Math.random() * 900 + 100);
          
          // Combine all parts to create index number without slashes
          // Format: YYNINNNNRRR (Year + Initials + BirthYear + Random)
          const indexNumber = `${year}${nameInitial}${surnameInitial}${birthYear}${randomNum}`;
          
          // Set the generated index number
          indexInput.value = indexNumber;
        }
      };

      // Add event listeners
      document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('input[name="name"]').addEventListener('change', generateIndexNumber);
        document.querySelector('input[name="last"]').addEventListener('change', generateIndexNumber);
        document.querySelector('input[name="postal_code"]').addEventListener('change', generateIndexNumber);
      });
</script>


<?php

$number_of_charactro = strlen($_POST[username]);
if($number_of_charactro > '8') { 

         if($show_create == '1') { 
            //textit        
                      $to = $_POST[username];
                      $random = (rand(1000,9999));
                      $date_time = date("Y/m/d - h:i:sa");
                      $text = urlencode("OTP Code - $actual_domain_without_http<br><br><br>Code :  $random <br><br><br>$date_time");
                      $output4 = preg_replace('!\s+!', ' ', $text);
                      $baseurl ="https://www.textit.biz/sendmsg";
                      $url = "$baseurl/?id=$site_textit_username&pw=$site_textit_password&to=$to&text=$output4";
                      $ret = file($url);     $res= explode(":",$ret[0]);                                                        
                   
            //textit 
         }
}
?>
                <input type="hidden" name="original_code" value="<?php echo $random; ?>">
                
                <div class="col-sm-12 mt-25">
                    <label style=" text-align: center; color: white; line-height: normal; background: #5fb0d0; padding: 10px; border-radius: 10px; ">ඔබ යොමු කල දුරකථනයට Message එකක් ලෙස පැමිණි Verification Code එක පහත යොමු කරන්න</label>
                  <input type="text" class="text_field" placeholder="Verification Code" name="code" required=""  >
                </div>

                <div class="col-sm-12 mt-25" style="display: none">
                  <!--<label>Select Category*</label>-->
                   <select name="grade" style=" width: 100%; height:40px; border:1px solid #ebebeb; border-radius:2px; padding:0 15px; " required=""> 
                    <option>Student</option>
                    <option>Tutor</option>
                  </select>
                </div>
                


                <div class="col-lg-12 mt-30">
                  <input class="btn-common" type="submit" name="register_now" value="ගිණුමක් විවෘත කරන්න">
                </div>
              </div>
            </form>

            <!--<button class="btn-common" style="width: auto;font-weight: normal;font-size: 14px;float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#login">Login</button> -->

            <!--<span style="font-size: initial;float: right;margin-right: 10px;margin-top: 10px;">or</span>-->


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