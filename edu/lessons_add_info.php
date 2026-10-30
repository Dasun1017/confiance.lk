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
    if($_SESSION['type'] == '1' OR $_SESSION['type'] == '3' ) { $user_login->redirect('login.php'); }
}

?>


<?php
        $sql2 = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);

?>



   
<?php



            if (isset($_GET['remove'])){
                if ($_GET['remove'] == 'brochure'){
                    $sql = "UPDATE category SET brochure=''  WHERE id=$_GET[view]";
                    $results = mysqli_query($connect, $sql);
                }
                if ($_GET['remove'] == 'cover_page'){
                    $sql = "UPDATE category SET cover_page=''  WHERE id=$_GET[view]";
                    $results = mysqli_query($connect, $sql);
                }
                if ($_GET['remove'] == 'large_flyer'){
                    $sql = "UPDATE category SET large_flyer=''  WHERE id=$_GET[view]";
                    $results = mysqli_query($connect, $sql);
                }
            } 


            if (isset($_POST['save'])){

                    $sql = "UPDATE category SET 

                    content_of_the_program='$_POST[content_of_the_program]', 
                    youtube_link='$_POST[youtube_link]', 
                    course_objectives='$_POST[course_objectives]', 
                    target_audience_full='$_POST[target_audience_full]', 
                    additional_information_full='$_POST[additional_information_full]' 
                    
                    WHERE id=$_POST[lesson_id]";
                    $results = mysqli_query($connect, $sql);


 $msg = "
                                    <div class='alert alert-success' style='width:100%'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Your changes has been Updated!</strong>  
                                    </div>";





                if(($_FILES['brochure']['tmp_name'])){
                    
                    $temp = explode(".", $_FILES["brochure"]["name"]);
                    $newfilename = round(microtime(true)) . '.' . end($temp);
                    move_uploaded_file($_FILES["brochure"]["tmp_name"], "functions/uploads/" . $newfilename);

                    $sql = "UPDATE category SET brochure='$newfilename' WHERE id=$_POST[lesson_id]";
                    $results = mysqli_query($connect, $sql);
                }






                $allowedExts = array("jpg", "jpeg", "gif", "png");
                $extension = end(explode(".", $_FILES["file"]["name"]));

                if ($_FILES["cover_page"]["type"] == "image/gif" || $_FILES["cover_page"]["type"] == "image/jpg" || $_FILES["cover_page"]["type"] == "image/jpeg" || $_FILES["cover_page"]["type"] == "image/png" && $_FILES["cover_page"]["size"] < 2500000 && in_array($extension, $allowedExts)) {

                  if ($_FILES["cover_page"]["error"] > 0) {

                    echo "<script>alert('";
                        echo "Error: " . $_FILES["cover_page"]["error"] . "<br />";
                    echo ')</script>';

                  }
                  else {

                    $cover_page = time().'.'."jpg";
                    move_uploaded_file($_FILES["cover_page"]["tmp_name"], "functions/uploads/$cover_page");

                    
                    $sql = "UPDATE category SET cover_page='$cover_page' WHERE id=$_POST[lesson_id]";
                    $results = mysqli_query($connect, $sql);

                  }

                }
                










                $allowedExts = array("jpg", "jpeg", "gif", "png");
                $extension = end(explode(".", $_FILES["file"]["name"]));

                if ($_FILES["large_flyer"]["type"] == "image/gif" || $_FILES["large_flyer"]["type"] == "image/jpg" || $_FILES["large_flyer"]["type"] == "image/jpeg" || $_FILES["large_flyer"]["type"] == "image/png" && $_FILES["large_flyer"]["size"] < 2500000 && in_array($extension, $allowedExts)) {

                  if ($_FILES["large_flyer"]["error"] > 0) {

                    echo "<script>alert('";
                        echo "Error: " . $_FILES["large_flyer"]["error"] . "<br />";
                    echo ')</script>';

                  }
                  else {

                    $large_flyer = time().'.'."jpg";
                    move_uploaded_file($_FILES["large_flyer"]["tmp_name"], "functions/uploads/$large_flyer");

                    
                    $sql = "UPDATE category SET large_flyer='$large_flyer' WHERE id=$_POST[lesson_id]";
                    $results = mysqli_query($connect, $sql);

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
    <title>Add more Details - <?php echo $site_title; ?></title>

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
                                <div class="col-lg-12 col-md-12 p-top-0 p-bottom-50">


                                 <a href="teachers_active.php" class="btn-common" style="background:#f4516c; border:#f4516c; float: left;">BACK </strong></a>

                            </div></div>



<?php 
         $sql2 = "SELECT * FROM category WHERE teacher_id=$_SESSION[userSession] AND id = '$_GET[view]' ORDER by lesson_date DESC";


        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);

?>          





<div class="row">



<div class="col-lg-12 col-md-12 p-bottom-0">
    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: right; ">
    
    <?php echo $pra2[name_of_class]; ?> <strong>(<?php echo $pra2[description]; ?>)</strong>

                                    <?php if( $pra2[active] == '1') {  ?><a style=" font-weight: bold;color: #094976;display: block;float: left;margin-left: 9px;" href="lessons.php?view=<?php echo $pra2[id]; ?>" ><span class="paid" style=" line-height: 24px; float: right; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a><?php } ?>



                                    <span class="btn btn--md register_btn btn-primary" style="background: #1dc9b7; border: none">
                                    <?php if( $pra2[active] == '2') {  ?>PENDING<?php } ?>
                                    <?php if( $pra2[active] == '1') {  ?>APPROVED<?php } ?>
                                    <?php if( $pra2[active] == '0') {  ?>DECLINED<?php } ?>
                                      
                                    </span>
    </p> </div>
</div>




                                  


                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white;border-radius: 10px;box-shadow: 0 6px 3px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.09) !important;margin: 50px 0 50px 0;">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="display: none">Type & Audience</th>
                                    <th>Charges</th>
                                    <th style="width: 200px; max-width:200px;display: none">Virtual/Full</th>
                                    <th></th>
                                    <th>Duration </th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 30px 0px; ">Requested</th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 30px 0px; ">E.Paid</th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 30px 0px; ">D.Acc</th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 30px 0px; ">Free</th>
                                    <th style=" transform: rotate(-90deg); padding: 10px 0 30px 0px; ">Slots</th>
                                </tr>
                                </thead>

                                <tbody>

                                                      
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
                                   


                                   
                                    <td style="display: none"><?php echo $pra2[type_of_programe]; ?><br>(<?php echo $pra2[target_audience]; ?> - <?php echo $pra2[no_of_students]; ?>)</td>
                                    
                                    <td><?php echo $pra2[charge]; ?><br>(<?php echo $pra2[currency]; ?>)</td>
                                    <td style="width: 200px; max-width:200px;display: none"><?php echo $pra2[virutual_or_full]; ?></td>


                                    <td style="    width: 110px; max-width:110px;">

                                    <?php if( $pra2[active] == '1') {  ?><a style=" font-weight: bold;color: #094976;display: initial;width: inherit;margin: 0px;padding: 0px; " href="teacher_students_registry_by_subject.php?lesson=<?php echo $pra2[id]; ?>" ><span class="postpay" style="line-height: 24px;/* float: right; */border-radius: 3px;display: inline-block;padding: 0 15px;color: #fff;font-weight: 400;font-size: 12px;background: #094976; ">STUDENTS</span></a><?php } ?>

                                    </td>

                                    
                                    <td><?php echo $pra2[lesson_date]; ?> (<?php echo $pra2[lesson_time]; ?>)
                                        <br> <?php echo $pra2[date2]; ?> (<?php echo $pra2[time2]; ?>)</td>
                                    
                                    


                                    <td><?php echo $num_rows3; ?></td>
                                    <td><?php echo $num_rows3_x; ?></td>
                                    <td><?php echo $num_rows4; ?></td>
                                    <td><?php echo $num_rows7; ?></td>
                                    <td><?php echo $pra2[no_of_students]-$num_rows5; ?></td>
                                            
                                    


                                </tr>

     


                                </tbody>
                            </table>

                    </div></div>





</div>
















                              <?php echo $msg; ?>

                    <form action="" method="post" enctype="multipart/form-data" style=" <?php if($yes == '1'){  echo'display: none!';} ?> " >


                            <div class="row">



                                <div class="col-lg-6 col-md-12">
                                    
                    
                        
                    
                    
                        
                    

                    

                        <div class="cardify signup_form">
                            <!-- end .login_header -->


<div class="login--header" style=" border-bottom: none; "> 

<div class="section-title style-3" style="text-align: left;">
            <h3>ADD MORE DETAILS</h3><br>
</div> 
</div>




                            <div class="login--form">
                                <div class="form-group">
                                    
                                    <textarea type="text" class="text_field" placeholder="Content of the Program" name="content_of_the_program" style=" min-height: 100px; "><?php echo $pra2[content_of_the_program]; ?></textarea>
                                </div>




                                <div class="form-group">
                                     <div class="row">
                                       
                                        <div class="col-lg-6 col-md-12">
                                            <span style="color: black">Youtube Video Link</span>
                                        </div>
                                         <div class="col-lg-6 col-md-12">
                                            <input type="text" class="text_field"  name="youtube_link" value="<?php echo $pra2[youtube_link]; ?>">          
                                        </div>
                                    </div>
                                    
                                </div>



                                <div class="form-group">
                                     <div class="row">
                                       
                                        <div class="col-lg-6 col-md-12">
                                            <span style="color: black">Brochure (PDF Only) 
                                              <?php if($pra2[brochure] != '') { ?> <br>
                                                <a href="<?php echo getImageUrl($pra2['brochure'], $baseURL, $current_page); ?>" target="_blank" style=" line-height: 24px; /* float: right; */ border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976;">Download</a>

                                                <a href="?view=<?php echo $_GET[view]; ?>&remove=brochure" onclick="return confirm('Are you sure?')" style="color: red;font-weight: bold;float: right;">Remove</a>


                                              <?php } ?>

                                          </span>
                                        </div>
                                         <div class="col-lg-6 col-md-12">
                                            <input type="file" class="text_field"  name="brochure" style=" height: 32px; border: none; line-height: inherit; ">          
                                        </div>
                                    </div>
                                    
                                </div>



                                <div class="form-group">
                                     <div class="row">
                                       
                                        <div class="col-lg-6 col-md-12">
                                            <span style="color: black">Cover Page (Size : 800px X 600px) 
                                              <?php if($pra2[cover_page] != '') { ?> <br>
                                                <a href="<?php echo getImageUrl($pra2['cover_page'], $baseURL, $current_page); ?>" target="_blank" style="line-height: 24px; /* float: right; */ border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976;">Download</a>

                                                <a href="?view=<?php echo $_GET[view]; ?>&remove=cover_page" onclick="return confirm('Are you sure?')" style="color: red;font-weight: bold;float: right;">Remove</a>
                                              <?php } ?>

                                          </span>
                                        </div>
                                         <div class="col-lg-6 col-md-12">
                                            <input type="file" class="text_field"  name="cover_page" style=" height: 32px; border: none; line-height: inherit; ">          
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                     <div class="row">
                                       
                                        <div class="col-lg-6 col-md-12">
                                            <span style="color: black">Large Flyer  
                                              <?php if($pra2[large_flyer] != '') { ?> <br>
                                                <a href="<?php echo getImageUrl($pra2['large_flyer'], $baseURL, $current_page); ?>" target="_blank" style="line-height: 24px; /* float: right; */ border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976;">Download</a>

                                                <a href="?view=<?php echo $_GET[view]; ?>&remove=large_flyer" onclick="return confirm('Are you sure?')" style="color: red;font-weight: bold;float: right;">Remove</a>
                                              <?php } ?>

                                          </span>
                                        </div>
                                         <div class="col-lg-6 col-md-12">
                                            <input type="file" class="text_field" name="large_flyer" style=" height: 32px; border: none; line-height: inherit; ">          
                                        </div>
                                    </div>
                                    
                                </div>


                            </div>


                        </div><!-- end .cardify -->

                                </div>
                                
                               <div class="col-lg-1 col-md-12 p-top-50"></div>
                                    
                    
                            <div class="col-lg-5 col-md-12 p-top-50">

                                <div class="form-group">
                                    
                                    <textarea type="text" class="text_field" placeholder="Course Objectives" name="course_objectives" style=" min-height: 100px; "><?php echo $pra2[course_objectives]; ?></textarea>
                                </div>
                                <div class="form-group">
                                    
                                    <textarea type="text" class="text_field" placeholder="Target Audience (Ex: Junior Executive)" name="target_audience_full" style=" min-height: 100px; "   ><?php echo $pra2[target_audience_full]; ?></textarea>
                                </div>

                                <div class="form-group">
                                    
                                    <textarea type="text" class="text_field" placeholder="Additional Information" name="additional_information_full" style=" min-height: 100px; "  ><?php echo $pra2[additional_information_full]; ?></textarea>
                                </div>

                                <input class="btn-common" type="hidden" name="lesson_id" value="<?php echo $pra2[id]; ?>" >
                                <input class="btn-common" type="submit" name="save" value="SAVE" >

                        <div class="cardify signup_form" align="center">
                            <!-- end .login_header -->


                                



                        </div><!-- end .cardify -->


                 

                                </div>







                            </div>








                    </form><!-- Ends: .product-single -->





                        </div>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->




     
  


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>