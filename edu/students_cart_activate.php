<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>










<span style="display: none">

<?php 
 
if($user_home->is_logged_in()!="")
{       
    if($_SESSION['type'] == '3') { 


            function new_getLink($api_key, $api_secret, $first_name, $last_name, $email, $meeting_id, $auto_approve)
            {   
                $url = 'https://aws-zoom-security2.zoomlock.lk/public/api/add-registrant';

                $fields =  array(
                    "api_key" => $api_key,
                    "api_secret" => $api_secret,
                    "first_name" => $last_name,
                    "last_name" => $first_name,
                    "email" => $email,
                    "meeting_id" => $meeting_id,
                    "auto_approve" => $auto_approve
                );

                $payload = $fields;

                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch,CURLOPT_POST, true);
                curl_setopt($ch,CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);

                //echo "here3"; var_dump($response); //die();
                curl_close($ch);
                
                return $response;
            }


        $sql_user = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]'";
        $result_user = mysqli_query($connect, $sql_user);
        $pra_user = mysqli_fetch_array($result_user);


        $sql_new_x = "SELECT id, student_id, active, paid_date, lesson_id FROM products WHERE student_id = '$_SESSION[userSession]' AND active = '1' AND paid_date = '' ";
        $result_new_x = mysqli_query($connect, $sql_new_x);
        while($pra_new_x = mysqli_fetch_array($result_new_x)) { 





        


        echo $sql_category_x = "SELECT id, course_objectives FROM category WHERE id='$pra_new_x[lesson_id]' AND course_objectives != ''";
        $result_category_x = mysqli_query($connect, $sql_category_x);
        $pra_category_x = mysqli_fetch_array($result_category_x);
        $num_check_x2 = mysqli_num_rows($result_category_x);
        if($num_check_x2 != '' OR $num_check_x2 != '0') { 

        echo $sql_category_x = "SELECT id, zoom_meeting_id, zoom_api_key, zoom_api_secret FROM category WHERE zoom_meeting_id='$pra_category_x[course_objectives]' ";
        $result_category_x = mysqli_query($connect, $sql_category_x);
        $pra_category_x = mysqli_fetch_array($result_category_x);
        $num_check_x = mysqli_num_rows($result_category_x);
        if($num_check_x != '' OR $num_check_x != '0') { 


            //$email_x = $pra_user[userEmail].'@gmail.com';
            $email_x = $pra_user[selected_subject];

            $result_x = new_getLink (
                "$pra_category_x[zoom_api_key]", 
                "$pra_category_x[zoom_api_secret]", 
                "$pra_user[userName]", 
                "$pra_user[userID]", 
                "$email_x", 
                "$pra_category_x[zoom_meeting_id]",
                'true'
            );

            $data_x = json_decode($result_x);

            $join_url_x = $data_x->join_url;
            echo $sql_paid_date_x = "UPDATE products SET paid_date='$join_url_x' WHERE id='$pra_new_x[id]' ";
            $results_paid_date_x = mysqli_query($connect, $sql_paid_date_x);

        }

        }







        $sql_category = "SELECT id, zoom_meeting_id, zoom_api_key, zoom_api_secret FROM category WHERE id='$pra_new_x[lesson_id]' AND zoom_meeting_id != ''";
        $result_category = mysqli_query($connect, $sql_category);
        $pra_category = mysqli_fetch_array($result_category);
        $num_check = mysqli_num_rows($result_category);
        if($num_check != '' OR $num_check != '0') { 


            //$email = $pra_user[userEmail].'@gmail.com';
            $email = $pra_user[selected_subject];

            $result = new_getLink (
                "$pra_category[zoom_api_key]", 
                "$pra_category[zoom_api_secret]", 
                "$pra_user[userName]", 
                "$pra_user[userID]", 
                "$email", 
                "$pra_category[zoom_meeting_id]",
                'true'
            );

            $data = json_decode($result);

            $join_url = $data->join_url;
            echo $sql_paid_date = "UPDATE products SET paid_date='$join_url' WHERE id='$pra_new_x[id]' ";
            $results_paid_date = mysqli_query($connect, $sql_paid_date);

        }
           
    }

}
}

?>


</span>















<?php

if(!$user_home->is_logged_in())
{
     $user_home->redirect('login.php');
}


if($user_home->is_logged_in()!="")
{
    if($_SESSION['type'] == '1' OR $_SESSION['type'] == '2' ) { $user_login->redirect('login.php'); }
}

?>          
<?php
        $sql = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>      


<?php
        $sql = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>      

<?php


            if (isset($_POST['reference_submit'])){
                    $date = date('Y-m-d h:i:sa');
                    $sql = "UPDATE products SET reference='$_POST[reference]', posted_date = '$date' WHERE id=$_POST[product_id]";
                    $results = mysqli_query($connect, $sql);
                    echo "<script>alert('Payment Reference Updated Succesfully!')</script>";
            }
                    

            if (isset($_POST['receipt_submit'])){

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
                    $date = date('Y-m-d h:i:sa');

                    $sql = "UPDATE products SET comments='$fname', posted_date = '$date'  WHERE id=$_POST[product_id]";
                    $results = mysqli_query($connect, $sql);
                    echo "<script>alert('Payment Receipt Uploaded Succesfully!')</script>";

                  }

                }
                else {

                  echo "<script>Invalid file type</script>";

                }

            }


if (isset($_POST['receipt_submit_x'])){
if(($_FILES['file']['tmp_name'])){
require_once 'functions/image_class/ThumbLib.inc.php';
            $file = $_FILES['file']['tmp_name'];
                $options = array('jpegQuality' => 85);
                $image_name = time().'.'."jpg";
                
                //Large image
                $thumb = PhpThumbFactory::create($file, $options);
                $thumb->resize(1200, 465);
                $thumb->save('functions/uploads/_large/'.$image_name);
                
                //thumb image
                $thumb = PhpThumbFactory::create($file, $options);
                $thumb->resize(1200, 465 );
                $thumb->save('functions/uploads/'.$image_name);
$sql = "UPDATE products SET comments='$image_name' WHERE id=$_POST[product_id]";
$results = mysqli_query($connect, $sql);
echo "<script>alert('Payment Receipt Uploaded Succesfully!')</script>";
}}


?>

<!doctype HTML>
<html lang="en" style="background:white">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
       <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title><?php echo $pra[userName]; ?>'s Profile - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">
    <style>

        .course-single.list-view .course-text p { display: block !important }
            
        .course-price h5 { font-size: 22px; color: #094976 !important; }
            
        @-webkit-keyframes magentaPulse {
          from { background-image: linear-gradient(to right,#69DEB4 0,#1EC481 100%);  }
          50% { background-image: linear-gradient(to right,#1EC481 0,#69DEB4 100%); }
          to { background-image: linear-gradient(to right,#69DEB4 0,#1EC481 100%);  }
        }
        .small_button{
            -webkit-animation-name: magentaPulse;
            -webkit-animation-duration: 2s;
            -webkit-animation-iteration-count: infinite;
        }
    </style>

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload" style="background:white">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    

    



    
    
    <section class="hero-area4 bgimage">
        <div class="hero-content content_above" style="padding: 10px 0 50px 0;     background: white;">
                            <div class="content-wrapper">
                                <div class="container">
                                    <div class="row">
                                   

                                        
                                            <div class="col-md-12 col-lg-12">
                                                <div class="p-top-0 p-bottom-20">
 <a href="select_your_teacher.php" class="btn btn--md register_btn btn-primary" style="float:right; background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; "> <strong> වෙනත් පන්ති </strong> පෙන්වන්න </a>
                                                                                                        </div>
                                            </div><!-- end .col-md-12 -->




                                        <!-- end .col-md-12 -->
                                    </div>
                                </div>
              

















































                    



   <!--course-area start-->
   <div class="course-area mt-20" style=" background: white; margin-top: 0px; ">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               
               <div class="tab-content">
                  <!--single-tab-->
                  <div id="grid-products" class="tab-pane fade in show active">
                     <div class="row">
<?php  $current_date = date('Y-m-d'); ?> 
<?php  $after_one_year = date('Y-m-d', strtotime($current_date . ' +10 year'));  ?>
<?php  $before_one_year = date('Y-m-d', strtotime($current_date . ' -10 year')); ?>         


<?php
        $sql2x = "SELECT * FROM products WHERE student_id='$_SESSION[userSession]' AND active = 1 ORDER by id DESC";
        $result2x = mysqli_query($connect, $sql2x);
        while($pra3x = mysqli_fetch_array($result2x)) { 

?>      

    <?php
            $sql3 = "SELECT * FROM category WHERE id='$pra3x[lesson_id]' AND active = 1 ORDER by id DESC";
            $result3 = mysqli_query($connect, $sql3);
            $pra3 = mysqli_fetch_array($result3);

    ?>   
    
          


<?php
        $sql4 = "SELECT * FROM tbl_users WHERE userID=$pra3[teacher_id]";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);

?>



                        <div class="col-lg-12 mb-30">
                           <div class="course-single list-view">
                              
                              <div class="course-info" style=" width: 100%; border: 1px solid white !important; border-radius: 10px; background: #6c757d; ">
                                 <div class="course-text mt-10" style="padding-bottom: 0px">
                                    <div class="table-view">
                                       <div class="table-cell pr-10">
                                          <h3 style="    color: #fff;"><!--<a href="lessons.php?view=<?php echo $pra3[id]; ?>">--><?php echo $pra3[name_of_class]; ?><!--<</a>--></h3>
                                       </div>
                                       <div class="table-cell">
                                          <div class="course-price text-right" style="float: right; display: contents; ">
                                             <h5><?php echo $pra3[charge]; ?> <?php echo $pra3[currency]; ?></h5>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="course-meta" style="display: none">
                                       <!--<a href="lessons.php?view=<?php echo $pra3[id]; ?>">--><i class="fa fa-calendar"></i><?php echo $pra3[lesson_date]; ?><!--</a>-->
                                       <!--<a href="lessons.php?view=<?php echo $pra3[id]; ?>">--><i class="fa fa-user"></i><?php echo $pra3[no_of_students]; ?> Students<!--</a>-->
                                    </div>


                                    <p style="    color: #fff;"><?php echo $pra3[description]; ?> </p>
                                 </div>
                                 <div class="author-info" style="display: none">
                                    <div class="author-name">
                                       
                                       
                  <?php if( $pra4[p_picture] == '') { ?>
                  <img src="source_files/logo.png" style="margin: 0 auto;display: block;border-radius: 0px;height: auto;">
                  <?php } ?>
                  <?php if( $pra4[p_picture] != '') { ?>
                  <img src="<?php echo getImageUrl($pra4['p_picture'], $baseURL, $current_page); ?>" style="margin: 0 auto;display: block; max-height: 100px;  ">
                  <?php } ?>

                                       <!--<a href="lecture.php?view=<?php echo $pra4[userID]; ?>">--><?php echo $pra4[userName]; ?><!--</a>-->
                                       <small><?php echo $pra4[grade]; ?></small>
                                    </div>
                                    
                                 </div>

                                 <!-- new code-->

                                 <div class="course-features-bottom mt-0 col-lg-6 mb-0" style=" float: right; padding:5px; ">


<?php 


$sql_attachment = "SELECT * FROM products WHERE id='$pra3x[id]' AND comments != ''";
$result_attachment = mysqli_query($connect, $sql_attachment);
$pra_attachment = mysqli_fetch_array($result_attachment);
$rowcount=mysqli_num_rows($result_attachment);

?>
                                    

                                   
<?php    if($pra3x[status] == 'Proceed' OR $pra3x[status] == 'PostPay' ) {  ?>

<?php if($rowcount != '' OR $rowcount != '0') { ?><a href="<?php echo getImageUrl($pra_attachment['comments'], $baseURL, $current_page); ?>" target="_blankx"><img src="<?php echo getImageUrl($pra_attachment['comments'], $baseURL, $current_page); ?>" style="max-height: 70px;max-width: 275px;border: 2px solid white;border-radius: 5px;"></a><?php } ?>


       <form action="" method="post" id="form" enctype="multipart/form-data" onsubmit="return confirm('නම සහ මාසය රිසිට්පතෙහි සදහන් කරන්න')"  style=" display: block;clear: both;padding-top: 0px;float: right;text-align: right;border: 1px solid white;border-radius: 10px;background: white;padding: 0 10px; ">
              <input name="product_id" type="hidden" value="<?php echo $pra3x[id]; ?>">
              <span style="display: inline-table;color: black;display: 10px;margin-top: 12px;text-align: center;line-height: initial; display: none">ඔබට නිබන්ධන ලබාගැනීමේදී ලබාදුන් පන්ති කාඩ්පත Choose File මගින් තෝරා Upload කරන්න 
හෝ
පහත ගිණුමට මුදල් තැන්පත් කර රිසිට් පත Choose File මගින් තෝරා Upload කරන්න</span>
              
              <input name="file" type="file" required="" style=" width: 110px; float: left; height: 28px; color: transparent; border: none; ">
              <input name="receipt_submit" type="submit" value="Upload Slip" style=" height: 28px; ">
               
              
        </form>
<?php  } ?>

                 </div>

                                 <div class="course-features-bottom mt-0 col-lg-6 mb-0" style=" float: right; padding: 0px ">                   

<?php if($pra3x[status] == 'Proceed' OR $pra3x[status] == 'PostPay' ) { ?>  
<!--<a href="thank_you.php?student_paying_to=<?php echo $pra3x[id]; ?>" target="_blankx" class="small_button btn btn--md register_btn btn-primary" style="background: #fff3ba;border: none;padding: 0 10px;font-weight: bold;font-size: initial;margin-top:20px;">Pay now to Enrol</a>-->

<?php

$hash = $site_payhere_merchant_id;
$hash .= $pra3x[posted_time];
$hash .= number_format($pra3[charge], 2, '.', '');
$hash .= 'LKR';
$hash .= strtoupper(md5($site_payhere_hash));
$hash = strtoupper(md5($hash));

?>
<?php echo '<form action="https://www.payhere.lk/pay/checkout" method="post" style="'.$site_payhere.'">
     <input type="hidden" name="merchant_id" value="'.$site_payhere_merchant_id.'">    <!-- Replace your Merchant ID --> 
     <input type="hidden" name="return_url" value="https://'.$actual_domain_without_http.'/thank_you.php?done">
     <input type="hidden" name="cancel_url" value="https://'.$actual_domain_without_http.'/thank_you.php?cancel">
     <input type="hidden" name="notify_url" value="https://'.$actual_domain_without_http.'/thank_you2.php?cancel">  
     
     <input type="hidden" name="order_id" value="'.$pra3x[posted_time].'" required="">
     <input type="hidden" name="items" value="'.$actual_domain_without_http.'" required="" >
  
     <input type="hidden" name="first_name" value="'.$pra[userName].'" required="" >
     <input type="hidden" name="last_name" value="'.$actual_domain_without_http.'" required="">
     <input type="hidden" name="email" value="'.$pra[userEmail].'" required="">
     <input type="hidden" name="phone" value="'.$pra[mobile].'" required="" >
     <input type="hidden" name="address" value="'.$pra[school].'"  required="" >
     <input type="hidden" name="city" value="'.$pra[batch].'" required="" >
     <input type="hidden" name="currency" value="LKR" >
     
     <input type="hidden" name="hash" value="'.$hash.'">
     <input type="hidden" name="amount" value="'.$pra3[charge].'" required="">
     <input type="hidden" name="country" value="Sri Lanka"> 

     <!--<input type="text" class="text_field" placeholder="" name="paying_amount" readonly="" style="margin-bottom: 20px;font-size: xx-large;font-weight: bold;width: 200px;color: black;text-align: center;" value="'.$pra3[charge].'">-->
     <input class="small_button btn btn--md register_btn btn-primary" style="background: #fff3ba;border: none;padding: 0 10px;font-weight: bold;font-size: initial;margin-top:0px; line-height: normal;padding: 10px;text-overflow: ellipsis;white-space: break-spaces;overflow: initial;height: min-content;" type="submit" name="submit_pay_online" value="PAY ONLINE NOW">

</form>'; ?>

<?php } ?>

   


               
 <?php if($pra3[teacher_link] != '' ){ ?>
                                            <a style="background: white;padding: 10px  18px;margin-top: 4px;border-radius: 50px;margin-bottom: 20px;display: inherit;width: fit-content;" target="_blank" href="<?php echo $pra3[teacher_link]; ?>" > <img src="img/whatsapp2.jpeg" style="width: 100px;margin-top: -5px;"> </a>
<?php } ?>
                                        <?php if($pra3x[status] == 'Paid' OR $pra3x[status] == 'Free' OR $pra3x[status] == 'PostPay' OR $pra3x[status] == 'Institute') { ?>
                                            <?php if($pra3[student_link] != ''){ ?>
                                            <br><a style="color: white;text-align: center;background: #f4516c;padding: 10px 15px;margin-bottom: 10px;font-size: larger;text-transform: uppercase;width: fit-content;display: block;border-radius: 50px;" href="<?php echo $pra3[student_link]; ?>" target="_blank">සජීවි ZOOM පන්තියට සම්බන්ධ වන්න</a>
                                            <?php } ?>

 <?php if($pra3x[paid_date] != '' ){ ?>
                                            <a style="color: white;text-align: center;margin: 10px 0;text-transform: uppercase;width: fit-content;display: block;border-radius: 50px;" href="<?php echo $pra3x[paid_date]; ?>" >Join <img src="img/zoom_badge.png" style="width: 100px"> Class</a>
<?php } ?>
                                            
                                             <a style="color: black;text-align: center;background: yellow;padding: 1px 20px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: fit-content;display: block;border-radius: 30px;margin-bottom: 20px;line-height: 30px;" href="student_learning_meterials.php?view=<?php echo $pra3[id]; ?>" target="_blank">Record Videos / PDF </a>
                                           
                                           
                                        <?php } ?>


                  </div>


                                 <!-- new code-->




                              </div>
                           </div>
                        </div>


<?php } ?>


<img class="hide_in_mobile" src="img/pay-min.png" style="width: 50%;border-right: 10px;height: 100%;margin: 0 auto;border-radius: 10px;background: #e1e1e1; margin-bottom: 50px;">
<img class="show_in_mobile" src="img/pay-min.png" style="display:none; width: 100%;border-right: 10px;height: 100%;margin: 0 auto;border-radius: 10px;background: #e1e1e1; margin-bottom: 50px;">



                     </div>
                  </div>
                  <!--single-tab-->
                  
               </div>
               
            </div>
         </div>
      </div>
   </div>
   <!--course-area end-->












































































                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->




     
  


     
  


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>