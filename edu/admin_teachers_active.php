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
if (isset($_POST['second_zoom_meeting_id'])){

                $sql2 = "UPDATE category SET course_objectives ='$_POST[second_zoom_meeting_id]' WHERE id='$_POST[category_id]'";
                mysqli_query($connect, $sql2);

}           
?>

<?php 
if (isset($_POST['sql_clean_now2'])){

                $sql3 = "UPDATE products SET paid_date ='' WHERE lesson_id='$_POST[category_id]'";
                mysqli_query($connect, $sql3);


                $sql2 = "UPDATE category SET course_objectives ='' WHERE id='$_POST[category_id]'";
                mysqli_query($connect, $sql2);

                echo "<script>alert('Zoom Links Cleared!')</script>";
}           
?>

<?php 
if (isset($_POST['sql_clean_now'])){

                $sql3 = "UPDATE products SET paid_date ='' WHERE lesson_id='$_POST[category_id]'";
                mysqli_query($connect, $sql3);


                $sql2 = "UPDATE category SET zoom_meeting_id ='' WHERE id='$_POST[category_id]'";
                mysqli_query($connect, $sql2);

                echo "<script>alert('Zoom Links Cleared!')</script>";
}           
?>

<span style="display: none">
<?php
    if(isset($_POST[getMeetingId])) { 

        
        $sql3 = "UPDATE products SET paid_date ='' WHERE lesson_id='$_POST[category_id]'";
        mysqli_query($connect, $sql3);

        $sql_cat = "SELECT * FROM zoom_accounts  where active = '1' AND id = '$_POST[email_id]' ";
        $result_cat = mysqli_query($connect, $sql_cat);
        $pra_cat = mysqli_fetch_array($result_cat); 

            function new_meeting($api_key, $api_secret, $userId, $topic, $type, $startTime, $duration, $timeZone, $password,$agenda, $approvalType, $waitingRoom, $showShareButton, $allowMultipleDevices)
            {   
                $url = 'https://aws-zoom-security2.zoomlock.lk/public/api/create-meeting';

                $fields =  array(
                    "api_key" => $api_key,
                    "api_secret" => $api_secret,
                    "user_id" => $userId,  // Account email / User email
                    "topic" => $topic, // Meeting title
                    "type" => $type, // 2 - Scheduled meeting
                    "start_time" => $startTime, // yyyy-MM-dd T HH:mm:ss
                    "duration" => $duration, // minutes
                    "timezone" => $timeZone, // 'Asia/Colombo'
                    "password" => $password, // Any password
                    "agenda" => $agenda, // Meeting description
                    "approval_type" => $approvalType,  // 1 - Manually approve
                    "waiting_room" => 'false',
                    "show_share_button" => $showShareButton, // Show/Hide share buttons on meeting 'true/false'
                    "allow_multiple_devices" => $allowMultipleDevices // Allow/Denied access meeting from multiple devices 'true/false'
                );

                $payload = $fields;

                //var_dump($payload); die();

                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch,CURLOPT_POST, true);
                curl_setopt($ch,CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);

                curl_close($ch);
                //var_dump($response); die();
                return $response;
            }
            $random = rand(00000,99999);

            $result = new_meeting (
                $pra_cat[api_key], 
                $pra_cat[api_secret], 
                $pra_cat[email_address], 
                $_POST[topic], 
                "2", 
                $_POST[start_time],
                $_POST[duration],
                "Asia/Colombo",
                $random,
                $_POST[topic],
                "1",
                "false",
                "false",
                "false"
            );


            $data = json_decode($result);

            $meeting_id = $data->id;
            
            $meeting_data = mysqli_real_escape_string($connect, var_dump($data)); //var_dump($data);

            $sql = "UPDATE category SET zoom_meeting_id='$meeting_id', zoom_meeting_data = '$result', zoom_email_id = '$pra_cat[id]', zoom_email_address = '$pra_cat[email_address]', zoom_api_key = '$pra_cat[api_key]',  zoom_api_secret = '$pra_cat[api_secret]' WHERE id=$_POST[category_id]";
                mysqli_query($connect, $sql);





            $sql_cat2 = "SELECT * FROM category  where active = '1' AND id = '$_POST[category_id]' ";
            $result_cat2 = mysqli_query($connect, $sql_cat2);
            $pra_cat2 = mysqli_fetch_array($result_cat2); 

            echo $sql_teacher = "SELECT * FROM tbl_users WHERE userID=$_GET[teacher] AND type = '2'";
            $result_teacher = mysqli_query($connect, $sql_teacher);
            $pra_teacher = mysqli_fetch_array($result_teacher);


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

            //echo $email = $pra_teacher[userEmail].'@gmail.com';
            echo $email = $site_info_mail_address;

            echo $result2 = new_getLink (
                "$pra_cat2[zoom_api_key]", 
                "$pra_cat2[zoom_api_secret]", 
                "$pra_teacher[userName]", 
                "$pra_teacher[userID]", 
                "$email", 
                "$pra_cat2[zoom_meeting_id]",
                'true'
            );

            $data2 = json_decode($result2);

            $join_url = $data2->join_url;
            echo $sql_paid_date = "UPDATE category SET zoom_url='$join_url' WHERE id='$_POST[category_id]' ";
            $results_paid_date = mysqli_query($connect, $sql_paid_date);

    }
?>
</span>


<?php 
if (isset($_POST['save_about'])){
                $sql = "UPDATE tbl_users SET selected_medium='$_POST[about_me]' WHERE userID=$_GET[teacher]";
                mysqli_query($connect, $sql);
                echo "<script>alert('About Me - Saved Successfully!')</script>";
            }
?>




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

                    
                    $sql = "UPDATE tbl_users SET p_picture='$fname' WHERE userID=$_GET[teacher]";
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
        $sql = "SELECT * FROM tbl_users WHERE userID=$_GET[teacher] AND type = '2'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>
<?php 
if (isset($_POST['change_lesson_status'])){


    if($_POST[change_lesson_status] == '9' ) { 
        
        
                $sql = "UPDATE category SET active='$_POST[change_lesson_status]' WHERE id='$_POST[lesson_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Lesson Deleted Successfully!')</script>";
    } else { 
        
                $sql = "UPDATE category SET active='$_POST[change_lesson_status]' WHERE id='$_POST[lesson_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Lesson Status Changed Successfully!')</script>";
    }
}           
?>


<?php 
if (isset($_POST['date_save'])){

                 $sql = "UPDATE category SET lesson_date='$_POST[lesson_date]', lesson_time='$_POST[lesson_time]', lesson_date2='$_POST[lesson_date2]', lesson_time2='$_POST[lesson_time2]'WHERE id= '$_POST[lesson_id]' ";
                mysqli_query($connect, $sql);
                echo "<script>alert('Date & Time Changed Successfully!')</script>";
}           
?>
<?php 
if (isset($_POST['lesson_save'])){

                 $sql = "UPDATE category SET name_of_class='$_POST[name_of_class]', description='$_POST[description]' WHERE id= '$_POST[lesson_id]' ";
                mysqli_query($connect, $sql);
                echo "<script>alert('Lesson Name & Description Changed Successfully!')</script>";
}           
?>


<?php 
if (isset($_GET['delete'])){

        $sqlx = "SELECT * FROM category WHERE id=$_GET[delete]";
        $resultx = mysqli_query($connect, $sqlx);
        $prax = mysqli_fetch_array($resultx);
            if($prax[teacher_id] ==  $_GET[teacher]) { 
                $sql = "UPDATE category SET active='0' WHERE id=$_GET[delete]";
                mysqli_query($connect, $sql);
                echo "<script>alert('Lesson Deleted Successfully!')</script>";
}           }
?>


<?php 
if (isset($_GET['block'])){
                $sql = "UPDATE category SET blocked_by_admin='1' WHERE id=$_GET[lesson]";
                mysqli_query($connect, $sql);
                echo "<script>alert('Lesson Blocked Successfully!')</script>";
}          
?>

<?php 
if (isset($_GET['unblock'])){
                $sql = "UPDATE category SET blocked_by_admin='0' WHERE id=$_GET[lesson]";
                mysqli_query($connect, $sql);
                echo "<script>alert('Lesson Un-Blocked Successfully!')</script>";
}          
?>



<?php 
if (isset($_POST['teacher_link'])){

                $sql = "UPDATE category SET teacher_link='$_POST[teacher_link]' WHERE id='$_POST[category_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('WhatsApp Link Updated Successfully!')</script>";
}           
?>
<?php 
if (isset($_POST['specific_time_link'])){

                $sql = "UPDATE category SET specific_time_link='$_POST[specific_time_link]' WHERE id='$_POST[category_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('MCQ - Specific Time Link Updated Successfully!')</script>";
}           
?>

<?php 
if (isset($_POST['any_time_link'])){

                $sql = "UPDATE category SET any_time_link='$_POST[any_time_link]' WHERE id='$_POST[category_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('MCQ - Any Time Link Updated Successfully!')</script>";
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
                                                   
                                                    
                                                    
                                                    <a href="admin_teachers_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>TRAINERS/ TUTORS</strong></span></a>



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
                                                <a href="login.php"><img src="source_files/new_confiance_big - Copy.jpeg" style="width: 75%;margin: 0 auto;display: block;"></a>
                                                <?php } ?>
                                                <?php if( $pra[p_picture] != '') { ?>
                                                <a href="login.php"><img src="<?php echo getImageUrl($pra['p_picture'], $baseURL, $current_page); ?>" style="width: 75%;margin: 0 auto;display: block; max-height: 150px;"></a>
                                                <?php } ?>
                                            </div><!-- end .hero__btn-area-->


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


<div class="col-lg-4 col-md-12 p-bottom-0">


    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: left; "><?php echo $pra[userName]; ?> - <?php echo $pra[grade]; ?></p> </div>

</div>


<div class="col-lg-8 col-md-12 p-top-20 " style=" color: white; text-align: right;">


<a href="admin_teachers_add_lesson.php?teacher=<?php echo $_GET[teacher]; ?>"  class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " ><strong>ADD A SESSION/ PROGRAM</strong></span></a>


                            <a href="admin_teacher_students_registry.php?teacher=<?php echo $_GET[teacher]; ?>&&" class="btn btn--md register_btn btn-primary" style="background: #1dc9b7; border: none" >ALL REGISTRATIONS</a>
<?php
      if(isset($_GET[archive])) { 
         echo '<a href="admin_teachers_active.php?teacher='.$_GET[teacher].'&&" class="btn btn--md register_btn btn-primary" style="background: #1dc9b7; border: none" >LIVE SESSIONS / PROGRAMS</a>';
      } 
      if(!isset($_GET[archive])) { 
         echo '<a href="admin_teachers_active.php?teacher='.$_GET[teacher].'&&archive" class="btn btn--md register_btn btn-primary" style="background: #1dc9b7; border: none" >ARCHIVE SESSIONS / PROGRAMS</a>';
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
                                    <th style="text-align: center;">WhatsApp Link</th>
                                    <th style="text-align: center;">Student Link</th>
                                    <th style="  transform: rotate(-90deg); padding: 10px 0 50px 0px; ">Requested</th>
                                    <th style="  transform: rotate(-90deg); padding: 10px 0 50px 0px; ">E.Paid</th>
                                    <th style="  transform: rotate(-90deg); padding: 10px 0 50px 0px; ">D.Acc</th>
                                    <th style="  transform: rotate(-90deg); padding: 10px 0 50px 0px; ">Free</th>
                                    <th style="  transform: rotate(-90deg); padding: 10px 0 50px 0px; ">Slots</th>
                                    
                                    
                                </tr>
                                </thead>

                                <tbody>

    
<?php


            if (isset($_POST['flyer_submit'])){

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

                    
                    $sql = "UPDATE category SET pdf='$fname' WHERE id=$_POST[lesson_id]";
                    $results = mysqli_query($connect, $sql);
                    echo "<script>alert('Flyer Uploaded Succesfully!')</script>";

                  }

                }
                else {

                  echo "<script>alert('Invalid file type!')</script>";

                }

            }

?> 

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
         teacher_id=$_GET[teacher] AND date2 between '$before_one_year' AND '$current_date' AND active = 0 OR
         teacher_id=$_GET[teacher] AND date2 between '$before_one_year' AND '$current_date' AND active = 1 OR
         teacher_id=$_GET[teacher] AND date2 between '$before_one_year' AND '$current_date' AND active = 2 
          ORDER by lesson_date DESC";
      } 
      if(!isset($_GET[archive])) { 
         $sql2 = "SELECT * FROM category WHERE 
         teacher_id=$_GET[teacher] AND date2 between '$current_date' AND '$after_one_year' AND active = 0 OR
         teacher_id=$_GET[teacher] AND date2 between '$current_date' AND '$after_one_year' AND active = 1 OR
         teacher_id=$_GET[teacher] AND date2 between '$current_date' AND '$after_one_year' AND active = 2 
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


                                    <td class="action" style="    line-height: normal;">
                                        <form action="" method="post">
                                            <input type="hidden" name="lesson_id" value="<?php echo $pra2[id]; ?>">
                                            <select name="change_lesson_status" required=""  onchange="this.form.submit()" style=" width: 90px; color: white; height: 30px; font-weight: bold; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px;

                                                <?php if( $pra2[active] == '2') {  ?>background: #ffb822<?php } ?>
                                                <?php if( $pra2[active] == '1') {  ?> background: #1dc9b7<?php } ?>
                                                <?php if( $pra2[active] == '0') {  ?>background: #f4516c<?php } ?>


                                    ">
                                                
                                                <?php if($pra2[active] == '2') { ?><option value="2">PENDING</option><option value="1">APPROVED</option><option value="0">DECLINED</option><option value="9">DELETE</option><?php } ?>
                                                
                                                <?php if($pra2[active] == '1') { ?><option value="1">APPROVED</option><option value="2">PENDING</option><option value="0">DECLINED</option><option value="9">DELETE</option><?php } ?>
                                                
                                                <?php if($pra2[active] == '0') { ?><option value="0">DECLINED</option><option value="1">APPROVED</option><option value="2">PENDING</option><option value="9">DELETE</option><?php } ?>
                                            </select>
                                        </form><br><span style=" color: #343e51; font-size: smaller; line-height: initial; margin-top: 10px; "><?php echo $pra2[lesson_date]; ?> (<?php echo $pra2[lesson_time]; ?>)
                                        <br> <?php echo $pra2[date2]; ?> (<?php echo $pra2[time2]; ?>)</span>
                                        
                                        
                                             <br><a style="color: white;text-align: center;background: #FF9800;padding: 5px 10px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: auto;display: block;border-radius: 10px; " href="admin_learning_meterials.php?view=<?php echo $pra2[id]; ?>" target="_blank">Learning Meterials </a>
                                           
                                    </td>




                                    <td style="    width: 200px; max-width:200px;">
                                        
                                        <?php if($pra2[additional_information] != '') { ?><p style=" background: black; border-radius: 5px; color: white; padding: 5px 10px; "><?php echo $pra2[additional_information]; ?> </p><?php } ?>
                                        
                                        <?php echo $pra2[name_of_class]; ?> <strong>(<?php echo $pra2[description]; ?>) <span style=" background: blueviolet; padding: 0px 10px; border-radius: 5px; color: white; float: right; "><?php echo $pra2[id]; ?></span></strong>


                                       <?php if ($pra2[pdf] != '') { ?>
                                       <a href="<?php echo getImageUrl($pra2['pdf'], $baseURL, $current_page); ?>" ><img src="<?php echo getImageUrl($pra2['pdf'], $baseURL, $current_page); ?>" style="max-height: 70px;max-width: 275px;border: 2px solid white;border-radius: 5px;"></a>
                                        <?php } ?>


                                    <?php if( $pra2[active] == '1') {  ?><!--<br><a style=" font-weight: bold; color: #094976; display: flex; margin-bottom: 9px;" href="lessons.php?view=<?php echo $pra2[id]; ?>" ><span class="paid" style=" line-height: 24px; float: right; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>-->

                                    <a style=" margin-bottom: 9px;font-weight: bold;color: #094976;display: flex;" href="admin_lessons_add_info.php?view=<?php echo $pra2[id]; ?>&teacher=<?php echo $_GET[teacher]; ?>" ><span class="paid" style=" line-height: 24px; float: right; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">EDIT</span></a>

 <?php if( $pra2[active] == '1') {  ?><a style=" font-weight: bold;color: #094976;display: initial;width: inherit;margin: 0px;padding: 0px; " href="admin_teacher_students_registry_by_subject.php?lesson=<?php echo $pra2[id]; ?>&teacher=<?php echo $pra2[teacher_id]; ?>&" ><span class="postpay" style="line-height: 24px;/* float: right; */border-radius: 3px;display: inline-block;padding: 0 15px;color: #fff;font-weight: 400;font-size: 12px;background: #094976; ">STUDENTS</span></a><?php } ?>


 <?php if( $pra2[active] == '1') {  ?><a style=" font-weight: bold;color: #094976;display: initial;width: inherit;margin: 0px;padding: 0px; " href="admin_teacher_students_registry_by_subject_payments.php?lesson=<?php echo $pra2[id]; ?>&teacher=<?php echo $pra2[teacher_id]; ?>&" ><span class="postpay" style="line-height: 24px;/* float: right; */border-radius: 3px;display: inline-block;padding: 0 15px;color: #fff;font-weight: 400;font-size: 12px;background: #094976; ">PAYMENTS</span></a><?php } ?>





                                <?php } ?>

                                    </td>




                                    <td style="display: none"><?php echo $pra2[type_of_programe]; ?><br>(<?php echo $pra2[target_audience]; ?> - <?php echo $pra2[no_of_students]; ?>)</td>
                                    
                                    <td><?php echo $pra2[charge]; ?><br>(<?php echo $pra2[currency]; ?>)</td>
                                    <td style="width: 200px; max-width:200px; display: none"><?php echo $pra2[virutual_or_full]; ?></td>


                                    
                                   


<!--
                                        <form action="" method="post" id="form" enctype="multipart/form-data" style="display: block;clear: both;float: right;text-align: right; margin-top: 20px">
                                                      <input name="lesson_id" type="hidden" value="<?php echo $pra2[id]; ?>">
                                                      <input name="file" type="file" required="" style="width: 100px;float: right;height: 32px;color: transparent;border: none;">
                                                      <input name="flyer_submit" type="submit" value="Upload Flyer" style="height: 28px;/* display: none; */">
                                                      <br> 
                                                </form>
-->


                                    <td class="action" align="center">
                                        <form style="padding: 0 20px;" action="" method="post" onsubmit="return confirm('Are you sure you want to Save?');" align="center">
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="text" name="teacher_link" value="<?php echo $pra2[teacher_link]; ?>" style="    width: 150px;" >
                                        </form><br><br>
                                        
                                        

                                        <form action="" method="post" style="    margin-top: 10px;" >
                                            <input type="text" name="duration" placeholder="Minutes" onkeypress="return isNumberKey(event)" value="" style="width: 100px;text-align: center;font-size: large;font-weight: bold;color: red;"  required>
                                            <input type="text" name="start_time" value="<?php echo date('Y-m-d', strtotime($stop_date . ' +1 day'));?>T<?php echo date("h:i"); ?>:00" style="width: 230px;text-align: center;font-size: large;font-weight: bold;color: red;" required>
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="hidden" name="topic" value="<?php echo $pra[userName]; ?> - <?php echo $pra2[name_of_class]; ?>">
                                            <select name="email_id" style=" background: #1dc9b7;color: white;height: 30px;width: 300px;font-weight: bold; "  required>
                                             
<?php   $sql_cat = "SELECT * FROM zoom_accounts  where active = '1' ORDER by id ASC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 
?>        

<option value="<?php echo $pra_cat[id]; ?>"><?php echo $pra_cat[zoom_name]; echo ' - '; echo $pra_cat[email_address]; ?> </option>
<?php } ?>

                                            </select>

                                            <br><input type="submit" value="Generate Zoom ID" name="getMeetingId" style="background: red;color: white;height: 30px;/* width: 100px; */font-weight: bold;">
                                        </form>




<?php if($pra2[zoom_meeting_id] != ''){ ?>
<!-- special -->
                                        <hr style=" margin: 10px 0 0 0; border-top: 2px solid rgb(0 0 0 / 10%); ">

                                            <input type="text" value="https://<?php echo $actual_domain_without_http; ?>/special.php?random_number=<?php echo $pra2[posted_time];?>&&meeting_id=<?php echo $pra2[zoom_meeting_id]; ?>&cat_id=<?php echo $pra2[id]; ?>" style="border: none;width: 100%;border: none;background: transparent; text-align: center;    font-size: 11px;" readonly>

<!-- special -->
<?php } ?>




                                        <form style="padding: 0 20px; display: none;" action="" method="post" onsubmit="return confirm('Are you sure you want to Save?');">
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="text" name="any_time_link"  placeholder="Any Time Link" value="<?php echo $pra2[any_time_link]; ?>" style="    width: 150px;" >
                                        </form>
                                        
                                        
                                    </td>

                                    <td class="action" align="center">
                                        <form style="padding: 0 5px;" action="" method="post" onsubmit="return confirm('Are you sure you want to Save?');">
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="text" name="student_link" value="<?php echo $pra2[student_link]; ?>"  style="    width: 150px;">
                                        </form><br><br>
                                        
                                        
                                        <?php if($pra2[zoom_meeting_id] != ''){ ?><span class="btn-common ds-md-none mr-0 hide_in_mobile_x my_page"><?php echo $pra2[zoom_meeting_id]; ?></span>


<form style="margin-top: 20px;" action="" method="post" onsubmit="return confirm('Are you Sure to Clear?');">
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="submit" value="Clear Zoom Links" name="sql_clean_now" style="background: #f4516c;color: white;border-radius: 20px;font-weight: bold;padding: 5px 20px;height: 40px;">


</form>
                                        <?php if($pra2[zoom_url] != ''){ ?><a style=" height: 32px; padding: 5px 20px; background: black; line-height: unset; "  href= "<?php echo $pra2[zoom_url]; ?>" target="_blank" class="btn-common ds-md-none mr-0 hide_in_mobile_x my_page">Teacher URL</a>

                                        <?php } ?>
                                        <?php } ?>





<form style="margin-top: 20px;" action="" method="post" >
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="text" value="<?php echo $pra2[course_objectives]; ?>" placeholder="Second Meeting ID" name="second_zoom_meeting_id" style="background: #fabc05;color: white;border-radius: 20px;font-weight: bold;padding: 5px 20px;height: 40px;">


</form>
                                        <?php if($pra2[course_objectives] != ''){ ?>

<form style="margin-top: 20px;" action="" method="post" onsubmit="return confirm('Are you Sure to Clear?');">
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="submit" value="Clear Zoom Links 2" name="sql_clean_now2" style="background: #f4516c;color: white;border-radius: 20px;font-weight: bold;padding: 5px 20px;height: 40px;">


</form>
                                        <?php } ?>


                                        
                                        <form style="padding: 0 20px; display: none;" action="" method="post" onsubmit="return confirm('Are you sure you want to Save?);">
                                            <input type="hidden" name="category_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="text" name="specific_time_link"   placeholder="Specific Time Link" value="<?php echo $pra2[specific_time_link]; ?>" style="    width: 150px;" >
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




     
  
    <script>
        $(document).ready(function(){
            $(document).on("click", ".btncopy", function(){
                var id=$(this).attr("id");
                $("#data"+id).select();
                document.execCommand("copy");
                
                $("#"+id).text("Copied");
            });
        });
    </script>


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>