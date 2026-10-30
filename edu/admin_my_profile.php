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

        $sql_paid = "UPDATE tbl_users SET userPass='$new_password' WHERE userID='$_GET[student]' ";
        mysqli_query($connect, $sql_paid);    
    }
?>



<?php    if (isset($_POST['save_now']) ){

    $sql_paid = "UPDATE tbl_users SET userName='$_POST[name]', userName2='$_POST[last]', institute_id='$_POST[institute_id]', mobile='$_POST[mobile]', school='$_POST[school]', location='$_POST[location]',

selected_package='$_POST[selected_package]',
     batch='$_POST[batch]',
     telegram='$_POST[telegram]',
     real_email='$_POST[real_email]',
     institute_name='$_POST[institute_name]',
     std_city='$_POST[std_city]'


     WHERE userID='$_GET[student]'";
    mysqli_query($connect, $sql_paid);       }   

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
    <title>My Profile - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        
        <div class="hero-content content_above" style="padding: 50px 0 50px 0; background: black">
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

                    
                    $sql = "UPDATE tbl_users SET p_picture='$fname' WHERE userID=$_GET[student]";
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
        $sql = "SELECT * FROM tbl_users WHERE userID='$_GET[student]'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);
        $num_rows = mysqli_num_rows($result);

            ?>







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
                   <input style="border: none;" type="email" class="text_field" placeholder="Enter your Email Address" name="email" value="<?php echo $pra[userEmail]; ?>" required="" readonly>
                </div>



                <div class="col-sm-6 mt-25">
                  <input type="text" class="text_field" placeholder="First Name with Intial" name="name" value="<?php echo $pra[userName]; ?>" required >
                </div>
                <div class="col-sm-6 mt-25">
                  <input type="text" class="text_field" placeholder="Last Name" name="last" value="<?php echo $pra[userName2]; ?>" required>
                </div>


                <div class="col-sm-6 mt-25" style="display: none">
                  <label>Admission ID* 
                  <?php if($pra[institute_id_verified] == 'Y') { echo '<span style="background:#1dc9b7; color: white;     padding: 2px 10px;">Verified</span>'; } ?>
                  <?php if($pra[institute_id_verified] == 'N') { echo '<span style="background:#f4516c; color: white;     padding: 2px 10px;">Not Verified</span>'; } ?>
                  </label>
                  <input type="text" class="text_field" placeholder="MyTeachersStudent ID" name="institute_id" value="<?php echo $pra[institute_id]; ?>"  <?php if($pra[institute_id_verified] == 'Y') { echo ' readonly '; } ?>>
                </div>



                
                <div class="col-sm-12 mt-25" >
                  <input type="text" class="text_field" placeholder="Address" name="location"  value="<?php echo $pra[location]; ?>"  >
                </div>

                <div class="col-sm-6 mt-25" >
                  <input type="text" class="text_field" placeholder="Postal Code" name="selected_package"  value="<?php echo $pra[selected_package]; ?>"  >
                </div>



                <div class="col-sm-6 mt-25" >
                  <input type="text" class="text_field" placeholder="School Name" name="school"   value="<?php echo $pra[school]; ?>" >
                </div>

                <div class="col-sm-6 mt-25">
                  <input type="text" class="text_field" placeholder="WhatsApp No" name="mobile" maxlength="20"  minlength="10"  onkeypress="return isNumberKey(event)" value="<?php echo $pra[mobile]; ?>" >
                </div>

                <div class="col-sm-6 mt-25">
                  <input type="text" class="text_field" placeholder="Telegram No" name="telegram" maxlength="20"  minlength="10"  onkeypress="return isNumberKey(event)" value="<?php echo $pra[telegram]; ?>" >
                </div>





                
                <div class="col-sm-12 mt-25">
                    <select name="batch" required="">
                        <option selected><?php echo $pra[batch]; ?></option>
                        <?php echo $site_grades; ?>
                    </select>
                </div>


                
                <div class="col-sm-12 mt-25">
                    <label style="text-align: center;color: white;line-height: normal;background: #545252;padding: 2px;border-radius: 6px; width: 100%">Important for Recieving Tutes <br> නිබන්ධන ලබාගැනීම සදහා වැදගත් වේ</label>
                    <select name="institute_name" required="">
                        
                        <option <?php if($pra[institute_name] == 'Physical Classes') { echo ' selected '; } ?>>Physical Classes</option>
                        <option <?php if($pra[institute_name] == 'Online Classes') { echo ' selected '; } ?>>Online Classes</option>
                    </select>
                </div>


                <div class="col-sm-12 mt-25" >
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
                




                <div class="col-lg-6 mt-30">
                  <input class="btn-common" type="submit" name="save_now" value="Save">
                </div>
              </div>
            </form>

            <!--<button class="btn-common" style="width: auto;font-weight: normal;font-size: 14px;float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#login">Login</button> -->

            <!--<span style="font-size: initial;float: right;margin-right: 10px;margin-top: 10px;">or</span>-->


          </div>
        </div>




                                 <div class="col-lg-1 mt-sm-0"></div>





                                        <div class="col-md-12 col-lg-3" style="background: white; border-radius: 10px; padding: 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 );">
                                            <div class="hero__content__title">
                                                <?php if( $pra[p_picture] == '') { ?>
                                                <a href="login.php"><img src="source_files/logo.png" style="width: 75%;margin: 0 auto;display: block;"></a>
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
                                
                                <input class="btn btn--md register_btn btn-common" type="submit" name="upload_profile_picture" value="Upload Picture" style="float: right;margin-top: 0px;    font-size: 12px;"
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