<?php 
    include 'functions/main.functions.php';  
    require_once 'class.user.php';
    $user_login = new USER();
?>

<?php

if(!$user_login->is_logged_in())
{
     $user_login->redirect('login.php');
}




if($user_login->is_logged_in()!="")
{
    if($_SESSION['type'] == '3') { $user_login->redirect('login.php'); }
    if($_SESSION['type'] == '2') { $user_login->redirect('login.php'); }
}

$show_create = '1';


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
    $school = mysqli_real_escape_string($connect, $_POST['school']);
    $batch = mysqli_real_escape_string($connect, $_POST['batch']);


    $type ='2'; 
  
    
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


    //if($_POST[original_code] == $_POST[code]) { 

                $result = mysqli_query($connect, "INSERT INTO tbl_users VALUES (NULL, '$uname', '$uname2', '$email', '$password', 'Y', '$code', '$mobile', '$whatsapp_or_viber', '$_POST[selected_ol_al_grade]', '$_POST[selected_medium]', '$_POST[selected_subject]', '$subject', '$grade', '$location', '$_POST[selected_package]', '$school', '$batch', '$type', '', '$_POST[institute_id]', 'N'   ,'' , '$telegram', '$real_email', '$institute_name', '$std_city', '$time', '$date' , '', '','' )");
    //} else { 

    //         $user_login->redirect('login.php?code');

             
    //}



        
        //mysqli_query($connect, $sql2);

        if($result) 
        { 


        if($_SESSION['type'] == '1') { $user_login->redirect('admin_teachers_list.php'); }

    









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
          <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
   <title>Add Grade - <?php echo $site_title; ?></title>


    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   <!--[if lte IE 9]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end-->
   
   



    
    
    <section class="hero-area4 bgimage">
       
        <div class="hero-content content_above" style="padding: 50px 0 50px 0;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-10 p-bottom-120">
                            






                            
<?php
if(isset($_GET[code])) { 
    echo " <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Sorry !</strong>  Your Code is not matching, Please try again
              </div>
              ";
}

?>










                            <div class="row">
                               
                                 <div class="col-lg-4 mt-sm-0"></div>
                                
                                <div class="col-lg-4 col-md-12 p-top-0" style="display:none; <?php if($show_create != '1') { echo 'display: block'; } ?> ">
                                    
                              <?php echo $msg; ?>
                    
                        
                    
                    
                        
                    

                    

                    <form action="" method="post" autocomplete="off">
                        <div class="cardify signup_form" style="background: white; border-radius: 10px; padding: 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 );    box-shadow: 5px 8px 20px 0px rgb(180 180 180 / 73%);
    padding: 11px;
    border-radius: 20px;
    background: radial-gradient(ellipse at right bottom,rgb(65 80 96 / 51%) 0,#626262 30%,#8387a1 50%,#434a5d 100%);
    ">
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








                        </div><!-- end .cardify -->
                    </form><!-- Ends: .product-single -->


                 

                                </div>

































                                 <!--<div class="col-lg-2 mt-sm-40"></div>-->


                                 <div class="col-lg-4 mt-sm-40"  style="display:block; <?php if($show_create != '1') { echo 'display: none'; } ?> ">



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






          <div class="input-form register-form mt-60">
            <form id="contactForm" data-toggle="validator" method="POST" action="" autocomplete="off">
              <div class="cardify signup_form row" style="background: white; border-radius: 10px; padding: 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 );    box-shadow: 5px 8px 20px 0px rgb(180 180 180 / 73%);
    padding: 11px;
    border-radius: 20px;
    background: radial-gradient(ellipse at right bottom,rgb(65 80 96 / 51%) 0,#626262 30%,#8387a1 50%,#434a5d 100%);
   ">

          <!--<div class="section-title style-3">
            <h3>Select Category!</h3>
          </div>
                  
                  <br><br>-->


                <div class="col-sm-12 mt-25" >
                   <select name="selected_ol_al_grade" style=" width: 100%; height:40px; border:1px solid #ebebeb; border-radius:2px; padding:0 15px; " required="">

                      <?php   $sql_cat = "SELECT * FROM main_group  where active = '1' ORDER by id DESC";
                                $result_cat = mysqli_query($connect, $sql_cat);
                                while($pra_cat = mysqli_fetch_array($result_cat)) { ?>     
                                  <option value="<?php echo $pra_cat[id]; ?>"><?php echo $pra_cat[main_group_name]; ?></option>
                        <?php } ?>
                  </select>
                </div>
                
                <div class="col-sm-12 mt-25" style="display:none">
                   <select name="subject" style=" width: 100%; height:40px; border:1px solid #ebebeb; border-radius:2px; padding:0 15px; " requiredx=""> 
                    <option value="sinhala">සිංහල මාධ්‍ය</option>
                    <option value="english">ඉංග්‍රීසි මාධ්‍ය</option>
                  </select>
                </div>
                


                <div class="col-sm-12 mt-25" >
                  <input type="text" class="text_field" placeholder="Group Name" name="name"  required="" >
                </div>

                <div class="col-sm-12 mt-25" >
                  <input type="text" class="text_field" placeholder="විෂය" name="school"  required="" >
                </div>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<style id="compiled-css" type="text/css">  .none { display:none; }</style>





                <div class="col-sm-12">
                  
                </div>
                
                
                <div class="col-sm-12 mt-25" style="display: none">
                   <input type="text" class="text_field" placeholder="Any Mobile Number" maxlength="10" minlength="10" onkeypress="return isNumberKey(event)"  name="email" required="" value="<?php echo rand(1111111111,999999999); ?>">
                </div>
                <div class="col-sm-12 mt-25" style="display: none">
                  <input type="password" class="text_field" placeholder="Enter your Password" name="password" required="" value="123abc">
                </div>


                <div class="col-sm-12 mt-25" style="display: none">
                  <input type="text" class="text_field" placeholder="WhatsApp" name="mobile" maxlength="20"  minlength="8" value="" >
                </div>


                <div class="col-sm-12 mt-25"  style="display: none">
                  <!--<label>Select Category*</label>-->
                   <select name="grade" style=" width: 100%; height:40px; border:1px solid #ebebeb; border-radius:2px; padding:0 15px; " required=""> 
                    <option>Tutor</option>
                    <option>Student</option>
                  </select>
                </div>
                

                
                

                
                <div class="col-sm-12 mt-25" style="display: none" >

                  <input type="text" class="text_field" placeholder="Grade" name="batch"  >

                </div>


<?php
     if($show_create == '1') { 
        //textit        
                  $to = $_POST[username];
                  $random = (rand(1000,9999));
                  $date_time = date("Y/m/d - h:i:sa");
                  $text = urlencode("OTP Code - ismeducationnetwork.com<br><br><br>Code :  $random <br><br><br>$date_time");
                  $output4 = preg_replace('!\s+!', ' ', $text);
                  $baseurl ="https://www.textit.biz/sendmsg";
                  $url = "$baseurl/?id=x&pw=x&to=$to&text=$output4";
                  //$ret = file($url);     $res= explode(":",$ret[0]);                                                        
               
        //textit 
     }

?>

<!--
                <input type="hidden" name="original_code" value="<?php echo $random; ?>">
                
                <div class="col-sm-12 mt-25">
                    <label style=" text-align: center; color: white; line-height: normal; background: red; padding: 10px; border-radius: 10px; ">ඔබ යොමු කළ දුරකථන අංකයට දැන් යොමුකළ කෙටි පණිවිඩයේ සදහන් අංකය 4 යොමු කරන්න</label>
                  <input type="text" class="text_field" placeholder="Verification Code" name="code" required=""  >
                </div>
-->

                <div class="col-lg-12 mt-30">
                  <input class="btn-common" type="submit" name="register_now" value="Create Now ➢" style="background: #ff9800;display: block;color: white;padding: 10px 20px;font-size: larger;border-radius: 50px;text-align: center;height: 45px;line-height: 20px;width: 100%;border: none;cursor: pointer;">
                </div>
              </div>
            </form>

            <!--<button class="btn-common" style="width: auto;font-weight: normal;font-size: 14px;float: right;" href="javascript:void(0);" data-toggle="modal" data-target="#login">Login</button> -->

            <!--<span style="font-size: initial;float: right;margin-right: 10px;margin-top: 10px;">or</span>-->


          </div>
        </div>



</div>







<!-- start-->
<?php 
    if (isset($_GET['remove'])){
                    $sql = "UPDATE main_group SET active='0' WHERE id='$_GET[remove]'";
                    mysqli_query($connect, $sql);
                    echo "<script>alert('Deleted Successfully!')</script>";
                    echo "<script>console.log('remove function is running');</script>";
    }           
?>

<?php
    if (isset($_POST['save'])){
                $time = time();
                $date = date('Y-m-d h:s');
                $save = mysqli_query($connect, "INSERT INTO main_group VALUES (NULL, '$_POST[main_group_name]', '$date', '$time', '1' )");   
                $msg = "<div class='alert alert-success' style='width:100%'> <button class='close' data-dismiss='alert'>&times;</button> <strong>Update Success!</strong> </div>";
                 echo "<script>console.log('save function is running');</script>";
    } 
?>


<div class="row statement_table table-responsive" >
    
    <button onclick="location.reload();" style="background-color: #b5e598; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 14px; margin:20px;">
    Refresh Page
</button>


    <div class="col-lg-12 col-md-12 p-top-0">

            <form action="" method="post" enctype="multipart/form-data">
                <div class="cardify signup_form" style="background: white; border-radius: 10px; padding: 20px;">
                    <div class="section-title"><h4 style="    margin-top: 0px;     text-align: center;">Main Groups</h4></div>
                    <div class="login--form">
                        <div class="form-group row">
                          <input type="text" class="col-lg-10 col-md-12 text_field" placeholder="Title" name="main_group_name" required="" style="    border-radius: 40px;">
                          <input class="btn btn--md register_btn btn-common col-lg-2 col-md-12 " type="submit" name="save" value="Save Now"></div>
                    </div>
                </div>
            </form>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div style="background: white">
                <table class="table">
                    <tbody>
                        <?php   $sql_cat = "SELECT * FROM main_group  where active = '1' ORDER by id DESC";
                                $result_cat = mysqli_query($connect, $sql_cat);
                                while($pra_cat = mysqli_fetch_array($result_cat)) { ?>     
                                    <tr>
                                        <td><a href="?remove=<?php echo $pra_cat[id]; ?>&view=<?php echo $_GET[view]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>
                                        <td><?php echo $pra_cat[main_group_name]; ?></td>
                                    </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>     
    </div>  

</div>
<!-- finish-->
















                        </div>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->








    
   <!--banner-area end-->
   <!--team-area start-->
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>
