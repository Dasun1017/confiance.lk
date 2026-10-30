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



?>




<?php 
    if(isset($_POST['change_password']))
    {
        $new_password = mysqli_real_escape_string($connect, $_POST['new_password']);
        $new_password = md5($new_password);

        $sql_paid = "UPDATE tbl_users SET userPass='$new_password' WHERE userID='$_SESSION[userSession]' ";
        mysqli_query($connect, $sql_paid);    
    }
?>



<?php    if (isset($_POST['save_now']) ){

    $sql_paid = "UPDATE tbl_users SET userName='$_POST[name]', userName2='$_POST[last]', institute_id='$_POST[institute_id]', mobile='$_POST[mobile]', school='$_POST[school]', location='$_POST[location]',selected_package='$_POST[selected_package]',
     batch='$_POST[batch]',
     telegram='$_POST[telegram]',
     real_email='$_POST[real_email]',
     institute_name='$_POST[institute_name]',
     std_city='$_POST[std_city]',
     selected_subject='$_POST[selected_subject]',
     	real_email='$_POST[Parent_Name]',
      index_number='$_POST[index_number]',
      telegram='$_POST[pra_con]' WHERE userID='$_SESSION[userSession]'";
    mysqli_query($connect, $sql_paid); 
  

  }   

?>


<?php    if (isset($_POST['save_now2']) ){

        $sql_paid = "UPDATE tbl_users SET  selected_subject = '$_POST[selected_subject]' WHERE userID='$_SESSION[userSession]'";
        mysqli_query($connect, $sql_paid);    
        $user_home->redirect('select_your_teacher.php?group=sinhala');
    
}   

?>



<!doctype HTML>
<html lang="en" style="background: white;">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
       <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>My Profile - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload" >
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    
    
   <style>
        
       
    </style>


    



    
    
    <section class="hero-area4 bgimage" style="background: white;">
        
        <div class="hero-content content_above" style="padding: 50px 0 50px 0;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-10 p-bottom-120">
                            






                            











                            <div class="row">
                               
                                 <div class="col-lg-1 mt-sm-0"></div>
                             
































                                 <div class="col-lg-6 mt-sm-0">





<?php    if (isset($_POST['save_now']) ){
echo ' <div class="alert alert-success" style="font-size: initial; ">

                    <p style=" font-size: initial;margin: 0px;border: none;padding-bottom: 0px;font-weight: 100;border-radius: 0 0 5px 5px;">  <span >Your Profile Updated Successfully! </span>  </div>';     }   

?>






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



<?php


            if (isset($_POST['upload_nic_picture'])){

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

                    
                    $sql = "UPDATE tbl_users SET selected_medium='$fname' WHERE userID=$_SESSION[userSession]";
                    $results = mysqli_query($connect, $sql);
                    echo "<script>alert('Profile Picture Uploaded Succesfully!')</script>";

                  }

                }
                else {

                  echo "<script>alert('Invalid file type!')</script>";

                }

            }

?>




<?php //echo $_SESSION[userEmail];
        $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);
        $num_rows = mysqli_num_rows($result);

            ?>







<?php if(isset($_GET[zoom])) { ?>


          <div class="input-form register-form mb-60">
            <form id="contactForm" data-toggle="validator" method="POST" action="">
              <div class="cardify signup_form row" style="background: white; border-radius: 10px; padding: 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 );    box-shadow: 5px 8px 20px 0px rgb(180 180 180 / 73%);padding: 11px; border-radius: 20px; background: radial-gradient(ellipse at right bottom,rgb(65 80 96 / 51%) 0,#626262 30%,#8387a1 50%,#434a5d 100%);    ">

                <div class="col-sm-12 mt-25">
                    <lable style=" color: white; background-color: #343e51; text-align: center; display: block; font-size: large; margin-bottom: 10px; ">ඔබගේ Zoom ගිණුමට ඇතුලු වන Email ලිපිනය පමණක් පහත යොමු කරන්න.   <br>
නැතහොත් ඔබට Zoom පන්ති සදහා සම්බන්ධ විය නොහැකිය.</lable>
                  <input type="email" class="text_field" placeholder="Zoom Email Address" name="selected_subject" value="<?php echo $pra[selected_subject]; ?>" required >
                </div>


                <div class="col-lg-6 mt-30">
                  <input class="btn-common" type="submit" name="save_now2" value="ඉදිරියට යාම සදහා මෙතන Click කරන්න" style="background: #EE3132;display: block;color: white;padding: 10px 20px;font-size: larger;border-radius: 50px;text-align: center;height: 45px;line-height: 20px;width: fit-content ;border: none;cursor: pointer;">
                </div>
              </div>
            </form>

          </div>
          
<?php } ?>
          
          
<?php if(!isset($_GET[zoom])) { ?>
          <div class="input-form register-form mt-60">
            <form id="contactForm" data-toggle="validator" method="POST" action="">
              <div class="cardify signup_form row" style="background: white; border-radius: 10px; padding: 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 ); ">
<!--
          <div class="section-title style-3" style="    width: 100%;">
            <h3><?php echo $pra[grade]; ?>  Profile</h3>
          </div>
          <br><br>
                  
                <div class="col-sm-12">
                  
                </div>
-->
                
                <div class="col-sm-12 mt-10">
                   <input style="border: none;background: antiquewhite;" type="email" class="text_field" placeholder="Enter your Email Address" name="email" value="<?php echo $pra[userEmail]; ?>" required="" readonly>
                </div>



                <div class="col-sm-6 mt-25">
                  <input type="text" class="text_field" placeholder="නම (Name)" name="name" value="<?php echo $pra[userName]; ?>" required >
                </div>
                <div class="col-sm-6 mt-25">
                  <input type="text" class="text_field" placeholder="වාසගම (Surname)" name="last" value="<?php echo $pra[userName2]; ?>" required>
                </div>


                <div class="col-sm-6 mt-25" style="display: none">
                  <label>Admission ID* 
                  <?php if($pra[institute_id_verified] == 'Y') { echo '<span style="background:#1dc9b7; color: white;     padding: 2px 10px;">Verified</span>'; } ?>
                  <?php if($pra[institute_id_verified] == 'N') { echo '<span style="background:#f4516c; color: white;     padding: 2px 10px;">Not Verified</span>'; } ?>
                  </label>
                  <input type="text" class="text_field" placeholder="MyTeachersStudent ID" name="institute_id" value="<?php echo $pra[institute_id]; ?>"  <?php if($pra[institute_id_verified] == 'Y') { echo ' readonly '; } ?>>
                </div>

                

                <div class="col-sm-6 mt-25" >
                  <input type="text" class="text_field" placeholder="දැනට සිටින පාසල (School)" name="school"   value="<?php echo $pra[school]; ?>" >
                </div>
                <div class="col-sm-6 mt-25">
                  <input type="text" class="text_field" placeholder="WhatsApp භාවිතා කරන අංකය" name="mobile" maxlength="20"  minlength="10"  onkeypress="return isNumberKey(event)" value="<?php echo $pra[mobile]; ?>" >
                </div>



                
                <div class="col-sm-6 mt-25" style="display: none;">
                    <select name="telegram">
                        <option <?php if($pra[telegram] == 'Sinhala Medium') { echo ' selected '; } ?>>Sinhala Medium</option>
                        <option <?php if($pra[telegram] == 'Tamil Medium') { echo ' selected '; } ?>>Tamil Medium</option>
                        <option <?php if($pra[telegram] == 'English Medium') { echo ' selected '; } ?>>English Medium</option>
                    </select>
                </div>

                
                <div class="col-sm-6 mt-25">
                    <select name="batch" required="">
                        <option selected><?php echo $pra[batch]; ?></option>
                        <?php echo $site_grades; ?>
                    </select>
                </div>



                <div class="col-sm-6 mt-25">
                  <input type="text" class="text_field" placeholder="NIC Number" name="selected_package"  value="<?php echo $pra[selected_package]; ?>"  >
                </div>




                <div class="col-sm-6 mt-25" style="display:none">
                  <input type="text" class="text_field" placeholder="Telegram No" name="telegramX" maxlength="20"  minlength="10"  onkeypress="return isNumberKey(event)" value="<?php echo $pra[telegram]; ?>" >
                </div>




                
                <div class="col-sm-12 mt-25" style="display: none">
                    <label style="text-align: center;color: white;line-height: normal;background: #545252;padding: 2px;border-radius: 6px; width: 100%">Important for Recieving Tutes <br> නිබන්ධන ලබාගැනීම සදහා වැදගත් වේ</label>
                    <select name="institute_name">
                        
                        <option <?php if($pra[institute_name] == 'Physical Classes') { echo ' selected '; } ?>>Physical Classes</option>
                        <option <?php if($pra[institute_name] == 'Online Classes') { echo ' selected '; } ?>>Online Classes</option>
                    </select>
                </div>


                <div class="col-sm-6 mt-25" >
                  <select name="std_city" required="">
                                        <option><?php echo $pra[std_city]; ?></option>
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




                <div class="col-sm-6 mt-25" >
                  <input type="text" class="text_field" placeholder="ලිපිනය (Address)" name="location"  value="<?php echo $pra[location]; ?>"  >
                </div>

                <div class="col-sm-6 mt-25" >
                  <input type="text" class="text_field" placeholder="index" name="index_number"  value="<?php echo $pra[index_number]; ?>"  >
                </div>
                
                <!-- <div class="col-sm-6 mt-25" >
                  <input type="text" class="text_field" placeholder="Pranent Name" name="Parent_Name"  value="<?php echo $pra[real_email]; ?>"  >
                </div>

                <div class="col-sm-6 mt-25" >
                  <input type="number" class="text_field" placeholder="Pranent Number" name="pra_con"  value="<?php echo $pra[telegram]; ?>"  >
                </div> -->


                <div class="col-sm-6 mt-25" style="display: none">
                  <label>Select Category*</label>
                   <select name="grade" style=" width: 100%; height:40px; border:1px solid #ebebeb; border-radius:2px; padding:0 15px; " required=""> 
                    <option <?php if($pra[grade] == 'Student') { echo ' selected '; } ?>>Student</option>
                    <option <?php if($pra[grade] == 'Learner') { echo ' selected '; } ?>>Learner</option>
                    <option <?php if($pra[grade] == 'Trainer') { echo ' selected '; } ?>>Trainer</option>
                    <option <?php if($pra[grade] == 'Tutor') { echo ' selected '; } ?>>Tutor</option>
                    <option <?php if($pra[grade] == 'Institute') { echo ' selected '; } ?> value="Institute">Institute/ School</option>
                  </select>
                </div>
                




                <div class="col-sm-12 mt-50">

                     <lable style="background:#dedede;text-align: center;display: block;margin-bottom: 10px;border-radius: 10px;padding: 10px 10px;line-height: initial; color: black;">ඔබගේ Zoom ගිණුමට ඇතුලු වන Email ලිපිනය පමණක් පහත යොමු කරන්න.   <br>
                     නැතහොත් ඔබට Zoom පන්ති සදහා සම්බන්ධ විය නොහැකිය.</lable>


                  <input type="text" class="teblackxt_field" placeholder="Zoom Email Address" name="selected_subject" value="<?php echo $pra[selected_subject]; ?>" >
                </div>






                <div class="col-lg-6 mt-30">
                  <input class="btn-common" type="submit" name="save_now" value="Save">
                </div>
              </div>
            </form>

            <!--<button class="btn-common" style="width: auto;font-weight: normal;font-size: 14px;float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#login">Login</button> -->

            <!--<span style="font-size: initial;float: right;margin-right: 10px;margin-top: 10px;">or</span>-->


          </div>
<?php } ?>
        </div>




                                 <div class="col-lg-1 mt-sm-0"></div>





                     

                                        <div class="col-md-12 col-lg-3" style="background: white; border-radius: 10px; padding: 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 );">
                                            <div class="hero__content__title">
                                                
                                                PROFILE
                                                <?php if( $pra[p_picture] == '') { ?>
                                                <a href="login.php"><img src="source_files/new_confiance_big - Copy.jpeg" style="width: 75%;margin: 0 auto;display: block;"></a>
                                                <?php } ?>
                                                <?php if( $pra[p_picture] != '') { ?>
                                                <a href="login.php"><img src="<?php echo getImageUrl($pra['p_picture'], $baseURL, $current_page); ?>" style="width: 60%;margin: 0 auto;display: block;max-height: 150px;border-radius: 100px;border: 6px solid white;"></a>
                                                <?php } ?>
                                            </div><!-- end .hero__btn-area-->








<form action="" method = "post" enctype="multipart/form-data" style="margin-top:10px" onsubmit="return confirm('Are you sure?')" class="row">
                                
                                <div class="col-lg-6 col-md-12">
                                    <input required="" style="width: 110px;color: transparent;border: none;line-height: 30px;height: 40px;margin-right: 20px" type="file" class="text_field" name="file">
                                </div>



                                <div class="col-lg-6 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-common" type="submit" name="upload_profile_picture" value="Upload Picture" style="float: right;margin-top: 0px;    font-size: 12px;  "
                                </div> 
                                
                                </div>
                                
                                    
</form>         

<br><br><br>
NIC

                                            <div class="hero__content__title">
                                                <?php if( $pra[selected_medium] == '') { ?>
                                                <a href="login.php"><img src="source_files/new_confiance_big - Copy.jpeg" style="width: 75%;margin: 0 auto;display: block;"></a>
                                                <?php } ?>
                                                <?php if( $pra[selected_medium] != '') { ?>
                                                <a href="login.php"><img src="<?php echo getImageUrl($pra['selected_medium'], $baseURL, $current_page); ?>" style="width: 60%;margin: 0 auto;display: block;max-height: 150px;border-radius: 100px;border: 6px solid white;"></a>
                                                <?php } ?>
                                            </div><!-- end .hero__btn-area-->




<form action="" method = "post" enctype="multipart/form-data" style="margin-top:10px" onsubmit="return confirm('Are you sure?')" class="row">
                                
                                <div class="col-lg-6 col-md-12">
                                    <input required="" style="width: 110px;color: transparent;border: none;line-height: 30px;height: 40px;margin-right: 20px" type="file" class="text_field" name="file">
                                </div>



                                <div class="col-lg-6 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-common" type="submit" name="upload_nic_picture" value="Upload NIC" style="float: right;margin-top: 0px;    font-size: 12px;"
                                </div> 
                                
                                </div>
                                
                                    
</form>    
                    


<form action="" method="post" style="margin-top:10px" onsubmit="return confirm('Are you sure?')" class="row">
                                
                                <div class="col-lg-12 col-md-12">
                                    <input required="" style="background: #dedede;color: black;text-align: center;line-height: 30px;height: 40px;margin-top: 20px;font-size: 17px !important;" type="text" class="text_field" name="new_password" placeholder="New Password?">
                                </div>



                                <div class="col-lg-12 col-md-12" align="center">
                                
                                <input class="btn btn--md register_btn btn-common" type="submit" name="change_password" value="Change Password" style="margin-top: 0px;font-size: 12px;margin-top: 10px;">
                                </div>
                                
                                  
                                
</form>                     
                    



                                           
                                        </div><!-- end .col-md-12 -->
















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