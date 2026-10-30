<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>

<?php

if(!$user_home->is_logged_in())
{
     $user_home->redirect('teachers.php');
}


if($user_home->is_logged_in()!="")
{
    if($_SESSION['type'] == '1' OR $_SESSION['type'] == '3' ) { $user_login->redirect('login.php'); }
}

?>


<?php 
if (isset($_POST['request_for_quote'])){
  
$time = time();
$date = date('Y-m-d h:s');

    $result = mysqli_query($connect, "INSERT INTO request_for_quote VALUES (NULL, '$_POST[number_of_empoyees]',  '$_POST[no_of_students]', '$_POST[number_of_trainers]', '$_POST[average]', '$_POST[requirement]', '$_POST[team_or_webinar]', '$_SESSION[userSession]', '$time', '$date', '1' )");
    
     if($result) { 

             $msg2 = "
                                            <div class='alert alert-success' style='width:100%'>
                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                <strong>Success!</strong>  Your Request has been sent to $site_website_name
                                            </div>";

    }


    } 

?>

<?php 
if (isset($_POST['publish_now'])){
  
$time = time();
$date = date('Y-m-d h:s');

if ($_POST[usd_or_lkr] == "USD") { $currency = 'USD'; } 
if ($_POST[usd_or_lkr] == "LKR") { $currency = 'LKR'; } 

if ($_POST[virutual_or_full] == "Virutual") { $virutual_or_full = 'Virual Training Only - Payment Gateway Free'; } 
if ($_POST[virutual_or_full] == "Full") { $virutual_or_full = 'Full Package'; } 



    $result = mysqli_query($connect, "INSERT INTO category VALUES (NULL, '$_POST[name_of_class]',  '$_POST[description]', '$_POST[time]', '$_POST[date]', '$_POST[charge]', '$_POST[no_of_students]', '$_SESSION[userSession]', '$time', '$date', '', '', '', '', '', '', '', '2', '$_POST[type_of_programe]', '$_POST[target_audience]', '$_POST[date2]', '$_POST[time2]', '$_POST[marketing_commencement_date]', '$_POST[additional_information]', '$currency', '$virutual_or_full', '', '', '', '', '', '', '', '', '$_POST[category]', '$_POST[program]', '', ''         ,'', '' )");
    
    if($result) { 



if ($_POST[usd_or_lkr] == "USD") { $currency = 'USD'; $amt_130 = '130 USD'; $per_person = '1 USD'; $tution_via_myteachers = '2'; } 
if ($_POST[usd_or_lkr] == "LKR") { $currency = 'LKR'; $amt_130 = '25000 LKR'; $per_person = '150 LKR'; 


  if ($_POST[virutual_or_full] == "Virutual") { $tution_via_myteachers = '150'; } 
  if ($_POST[virutual_or_full] == "Full") { $tution_via_myteachers = '375';  } 
  

} 



if($_POST[type_of_programe] == 'Public Program via MyTeachers')  { $revenue = 'Your Total Revenue : '.$_POST[no_of_students]*$_POST[charge]. $currency; } 
if($_POST[type_of_programe] == 'Personal Training')  { $revenue = ''; } 
if($_POST[type_of_programe] == 'Tution Class via MyTeachers')  { $revenue = 'Your Total Revenue : '.$_POST[no_of_students]*$_POST[charge]. $currency; } 

if($_POST[type_of_programe] == 'Public Program via MyTeachers')  { $facilitation = 'MyTeachersProduction and Facilitation Fee  : '.($_POST[no_of_students]*$_POST[charge]/2). $currency; } 
if($_POST[type_of_programe] == 'Personal Training')  { $facilitation = "MyTeachersProduction and Facilitation Fee  : $amt_130 <br>If more than 30 Number of Partcipants, $per_perso for per person"; } 

if($_POST[type_of_programe] == 'Tution Class via MyTeachers')  { $facilitation = 'MyTeachersProduction and Facilitation Fee  : '.$_POST[no_of_students]* $tution_via_myteachers. $currency; } 






                $to = $_POST['email'] . ', ' . $site_info_mail_address;
                $subject = 'Session Created for '.$_POST[name_of_class].' ('.$pra_new[userID].') ';
                $message = '  
                            
Dear '.$_SESSION[userName].', <br><br>
Welcome to '.$site_website_name.' and thank you for the enrollment.<br><br>
'.$site_website_name.' has approved your session. Please login to your account and verify the details in the dash board.<br><br>
We are happy with your agreement to the terms and conditions on the services.<br><br>
Enjoy training/teaching with '.$site_website_name.'.<br><br>
If you need help, please use our web chat or emal to '.$site_info_mail_address.'

                            ';
                $from = $site_info_mail_address;
                $headers = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
                $headers .= "From:" . $from;
                mail($to,$subject,$message,$headers);

            




                            $yes = '1';
                            $msg = "
                                    <div class='alert alert-success' style='width:100%'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Success!</strong>  Your Requested Training/Lesson sent to $site_website_name
                                    </div>

                                    <div class='form-group' style='  width: 100%;    margin-top: 60px; border-radius: 10px; padding: 10px 10px 20px 10px; '>
                                     <div class='row'>

                                        <div class='col-lg-12 col-md-12'>
                                            <p style='font-size: larger;color: black;'>$revenue</p>
                                        </div>
                                        
                                        <div class='col-lg-12 col-md-12'>
                                            <p style='font-size: larger;color: black;'>$facilitation</p>
                                        </div>

                                    </div>
                                </div>

                                    <div style='width:100%;background: none;'> <a href='teachers_add_lesson.php' class='btn btn--md register_btn btn-common' style=' '>CREATE A NEW SESSION </a> </div>


                                    ";
              } else { 

                        $msg = "
                              <div class='alert alert-danger'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Sorry !</strong>  We cant accept your Lesson, Please Try another one
                              </div>
                              ";
                }

}
?>


<?php
        $sql2 = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);

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
    <title>Add Lesson Portal of  <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>


   <script>
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   </script>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;background-image: url('img/bg2.jpg'  );background-attachment: fixed;">
                            <div class="content-wrapper">
                                
                <div class="container featured-products2  p-top-10 p-bottom-120">
                            






                            











                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    
                    
                        
                    
                    
                        
                    

                              <?php echo $msg; ?>
                    

                    <form action="" method="post" style=" <?php if($yes == '1'){  echo'display: none';} ?> " >
                        <div class="cardify signup_form">
                            <!-- end .login_header -->


<div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: left; ">Dear <?php echo $_SESSION[userName]; ?>, <br><br></p>

<div class="section-title style-3" style="text-align: left;">
            <h3>Add Your Lesson</h3>
</div> 
</div>




                            <div class="login--form">
                                <div class="form-group">
                                    
                                    <input type="text" class="text_field" placeholder="Title / Subject of the Program" name="name_of_class" required="">
                                </div>


             
 


                                <div class="form-group">
                                     <div class="row">

                                   <div class="col-lg-12 col-md-12" style=" font-size: initial;color: white;margin-bottom: 10px;line-height: unset; ">
                                       <select name="category"  id="category" required="">
                                            <option value="">Select Category</option>
                                            <option value="Grade 1 - 11">Grade 1 - 11</option>
                                            <option value="Advanced Level">Advanced Level</option>
                                            <option value="Professional Courses">Professional Courses</option>
                                            <option value="Paper Corner">Paper Corner</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12" style=" font-size: initial;color: white;margin-bottom: 10px;line-height: unset; display: none ">
                                       <select name="program" id="program">
                                            <option value=''></option>
                                        </select>
                                    </div>
                                  </div>
                                </div>
                                
                                
                                
                                
                                
                                <div class="form-group" style="display: none">
                                     <div class="row">

                                   <div class="col-lg-6 col-md-12" style=" font-size: initial;color: white;margin-bottom: 10px;line-height: unset; ">
                                       <select name="type_of_programe" >
                                            <option value="">Type of the Program </option>
                                            <option>Personal Training </option>   
                                            <option>Tution Classes</option>   
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-12" style=" font-size: initial;color: white;margin-bottom: 10px;line-height: unset; ">
                                       <select name="target_audience" >
                                            <option value="">Target Audience </option>
                                            <option>AL Students</option>   
                                            <option>OL Students</option>   
                                            <option>School Students</option> 
                                            <option>Undergraduate</option> 
                                            <option>Graduate</option> 
                                            <option>Employee</option>   
                                            <option>Others</option>   
                                        </select>
                                    </div>
                                  </div>
                                </div>
                                

                                <div class="form-group">
                                    
                                    <input type="text" class="text_field" placeholder="Description of the Lesson" name="description" required="">
                                </div>


                                <div class="form-group">

                                            <input onkeypress="return isNumberKey(event)" type="number" class="text_field" placeholder="Batch Size - Number of Partcipants" name="no_of_students" required="" >
                               
                                     </div>

                                     
                                     

                                <div class="form-group">
                                     <div class="row">

                                        <div class="col-lg-10 col-md-12">
                                            <input onkeypress="return isNumberKey(event)" type="number" class="text_field" placeholder="Per Person Cost" name="charge" required="" >
                               
                                        </div>
                                         <div class="col-lg-2 col-md-3">
                                            <span style="color: black">LKR</span> <input type="radio" class="text_field" checked="" name="usd_or_lkr" required="" value="LKR" >
                                        </div>
                                         
                
                                    </div>
                                    
                                     </div>

                                     

                                <div class="form-group" style="display: none">
                                     <div class="row">

                                         <div class="col-lg-9 col-md-6">
                                            <span style="color: black">Virual Training Only (Payment Gateway Free)</span> <input type="radio" class="text_field" checked="" name="virutual_or_full" value="Virutual" >
                                        </div>
                                         <div class="col-lg-3 col-md-6">
                                            <span style="color: black">Full Package</span> <input type="radio" class="text_field" name="virutual_or_full"  value="Full" >
                                        </div>
                
                                    </div>
                                    
                                     </div>

                                     
                                     





                                     



                                <div class="form-group">
                                     <div class="row">
                                    
                                    <div class="col-lg-4 col-md-12">
                                            <p style=" color: black; ">Duraion of the Lesson (Start)</p>
                                        </div>

                                         <div class="col-lg-4 col-md-6">
                                            <input type="date" class="text_field" placeholder="Time Slot" name="time" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                         <div class="col-lg-4 col-md-6">
                                            
                                            <input type="time" class="text_field" placeholder="Date" name="date" value="<?php echo date('h:s'); ?>">
                                                                
                                        </div>
                
                                    </div>
                


                                </div>



                                <div class="form-group">
                                     <div class="row">

                                    <div class="col-lg-4 col-md-12">
                                            <p style=" color: black; ">Duraion of the Lesson (Finish)</p>
                                        </div>
                                       
                                        <div class="col-lg-4 col-md-6">
                                            <input type="date" class="text_field" placeholder="Time Slot" name="date2" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                         <div class="col-lg-4 col-md-6">
                                            
                                            <input type="time" class="text_field" placeholder="Date" name="time2" value="<?php echo date('h:s'); ?>">
                                                                
                                        </div>
                
                                    </div>
                                </div>


                                <div class="form-group">
                                     <div class="row">
                                    
                                       
                                        <div class="col-lg-6 col-md-12">
                                            Start Date<br>
                                            <input type="date" class="text_field" placeholder="Marketing Commencement Date" name="marketing_commencement_date" required="" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                         <div class="col-lg-6 col-md-12">
                                            <br>
                                            <input type="text" class="text_field" placeholder="Additional Information" name="additional_information" >
                                                                
                                        </div>

              
                                    </div>
                                    
                                </div>


                    
                              
                                


                                
                                
        

                                <input class="btn-common" type="submit" name="publish_now" value="Confirm Your Program" >

                                
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    </form><!-- Ends: .product-single -->

                                </div>
                                
                               <div class="col-lg-1 col-md-12 p-top-50"></div>
                                    
                    
                            <div class="col-lg-5 col-md-12 p-top-50">
                                    
                    
                        
                    
                    
                        
                              <?php echo $msg2; ?>

                    <form action="" method="post" style=" <?php if($yes == '1'){  echo'display: none';} ?> " >
                        <div class="cardify signup_form" style="display: none">
                            <!-- end .login_header -->


<div class="login--header" style=" border-bottom: none; "> 

<div class="section-title style-3" style="text-align: left;">
            <h3>If you are a Company or Training Institute, request a Quotation</h3>
</div> 
 </div>



                            <div class="login--form">


                                <div class="form-group">
                                     <div class="row">

                                        <div class="col-lg-6 col-md-12">
                                            <input onkeypress="return isNumberKey(event)" type="text" class="text_field" placeholder="Number of Employees" name="number_of_empoyees"  >
                               
                                        </div>
                                         <div class="col-lg-6 col-md-12">
                                            <input onkeypress="return isNumberKey(event)" type="text" class="text_field" placeholder="Number of Students" name="no_of_students"  >
                                                                
                                        </div>
                
                                    </div>
                                    
                                </div>

                                     
                                     

                                <div class="form-group">
                                     <div class="row">

                                        <div class="col-lg-6 col-md-12">
                                            <input onkeypress="return isNumberKey(event)" type="text" class="text_field" placeholder="Number of Trainers" name="number_of_trainers" >
                               
                                        </div>
                                         <div class="col-lg-6 col-md-12">
                                            <input onkeypress="return isNumberKey(event)" type="text" class="text_field" placeholder="Average Online Programs per Month" name="average" required="" >
                                                                
                                        </div>
                
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    
                                    <input type="text" class="text_field" placeholder="Description of Requirement " name="requirement" required="">
                                </div>



                                <div class="form-group">
                                     <div class="row">

                                         <div class="col-lg-6 col-md-6">
                                            <span style="color: black">Team Meeting</span> <input type="radio" class="text_field" checked="" name="team_or_webinar" required="" value="Team Meeting" >
                                        </div>
                                         <div class="col-lg-6 col-md-6">
                                            <span style="color: black">Public Webinar</span> <input type="radio" class="text_field" name="team_or_webinar" required="" value="Public Webina" >
                                        </div>
                
                                    </div>
                                    
                                </div>



                                


                                <input class="btn-common" type="submit" name="request_for_quote" value="Request for a Quotation">

                                
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    </form><!-- Ends: .product-single -->

                    

                    

                        <div class="cardify signup_form" align="center">
                            <!-- end .login_header -->


                                


<div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; margin: 20px 0 0 0;"><br><br><br> When the Payment Verification is done update that here in the <?php echo $site_website_name; ?>. <br> </p> </div>



                            <a href="teachers_active.php" class="btn-common" style="background:#f4516c; border:#f4516c">MY DASHBOARD </a>


                        </div><!-- end .cardify -->


                 

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