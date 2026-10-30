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

// for GET add option
$db_handle = new DBController();

if(isset($_GET[add])) {
                
        $sql_get = "SELECT * FROM category WHERE id= '$_GET[view]' AND active = 1";
        $result_get = mysqli_query($connect, $sql_get);
        $pra_get = mysqli_fetch_array($result_get);

if($pra_get[charge] == '0') {     

                
        $time = time();
        $time = $_SESSION[userSession]._.$time;
        $date = date('Y-m-d h:i:sa');


         $sql_check = "SELECT * FROM products WHERE lesson_id='$pra_get[id]'  AND teacher_id='$pra_get[teacher_id]'  AND student_id='$_SESSION[userSession]' AND active='1'  ";
        $result_check = mysqli_query($connect, $sql_check);
        $pra_check = mysqli_fetch_array($result_check);
        $num_check = mysqli_num_rows($result_check);

        if($num_check == '' OR $num_check == '0' )  { 


             $result = mysqli_query($connect, "INSERT INTO products VALUES (NULL, '$_SESSION[userSession]',  '$pra_get[id]', '$pra_get[teacher_id]', '$time', '$date', 'Free', '', '', '', '', '1', '', '' )");

?><!--<meta http-equiv="refresh" content="0; URL='https://<?php echo $actual_domain_without_http; ?>/students_cart_activate.php'" />--> <?php 
        }



} else {


                  
            
            $sql1="SELECT * FROM category WHERE id='" . $_GET["view"] . "'";
            $exe1=mysqli_query($connect, $sql1);
            $row1=mysqli_fetch_array($exe1);
            //echo $row1['id'];
            $_POST["quantity"] = '1';
            $_POST["lesson_date"] = $row1[lesson_date];
            $_POST["actual_timex"] = time();
            
                        $itemArray = array($row1["id"]=>array('name_of_class'=>$row1["name_of_class"], 'id'=>$row1["id"], 'description'=>$row1["description"],  'lesson_date'=>$_POST["lesson_date"],  'actual_timex'=>$_POST["actual_timex"],  'lesson_time'=>$row1["lesson_time"], 'charge'=>$row1["charge"],  'no_of_students'=>$row1["no_of_students"], 'count'=>"1", 'teacher_id'=>$row1["teacher_id"])); 
                                 

                        if(!empty($_SESSION["cart_item"])) {
                            if(in_array($row1["id"],$_SESSION["cart_item"])) {
                                foreach($_SESSION["cart_item"] as $k => $v) {
                                        if($row1["id"] == $k) {  echo 'Hi';
                                            $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                                            $_SESSION["cart_item"][$k]["actual_timex"] = $_POST["actual_timex"];
                                        }
                                }           
                            } else {
                                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                            }
                        } else {
                            $_SESSION["cart_item"] = $itemArray;
                        }

            
        }


}

?>











<?php

$db_handle = new DBController();

        //foreach ($_SESSION["cart_item"] as $item) { echo $item['id']; echo '<br>'; } 


        if(!empty($_POST["action"])) {
        switch($_POST["action"]) {
            case "add":
                

if(isset($_POST[remove_now])) { 
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_POST["product_id"] == $_SESSION["cart_item"][$k]['id']) {
                                unset($_SESSION["cart_item"][$k]);      
                            }
                            if(empty($_SESSION["cart_item"])){
                                unset($_SESSION["cart_item"]);
                            }
                    }
                }   
} 

elseif (isset($_POST[join_free])) { 

                
        $time = time();
        $time = $_SESSION[userSession]._.$time;
        $date = date('Y-m-d h:i:sa');


        $sql_check = "SELECT * FROM products WHERE lesson_id='$_POST[product_id]'  AND teacher_id='$_POST[teacher_id]'  AND student_id='$_SESSION[userSession]' AND active='1'  ";
        $result_check = mysqli_query($connect, $sql_check);
        $pra_check = mysqli_fetch_array($result_check);
        $num_check = mysqli_num_rows($result_check);

        if($num_check == '' OR $num_check == '0' )  { 


            $result = mysqli_query($connect, "INSERT INTO products VALUES (NULL, '$_SESSION[userSession]',  '$_POST[product_id]', '$_POST[teacher_id]', '$time', '$date', 'Free', '', '', '', '', '1', '', '' )");

?><!--<meta http-equiv="refresh" content="0; URL='https://<?php echo $actual_domain_without_http; ?>/students_cart_activate.php'" />--> <?php 
        }



} else {




                    if(!empty($_POST["quantity"])) {
                        
                            $found = 'false';
                            if(!empty($_SESSION["cart_item"])) { 
                                foreach($_SESSION["cart_item"] as $item) {
                                if($_POST["product_id"] == $item['id'] ) 
                                    $found = "true";        
                                }           
                            }
                        
                        if($found == 'true') {
                            
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                if($_POST["product_id"] == $_SESSION["cart_item"][$k]['id'])
                                    $new_quantity = $_POST["quantity"]; 
                                    $_SESSION["cart_item"][$k]["quantity"] += $new_quantity;                
                                
                                }
                             } else {
                     
                             
            
            $sql1="SELECT * FROM category WHERE id='" . $_POST["product_id"] . "'";
            $exe1=mysqli_query($connect, $sql1);
            $row1=mysqli_fetch_array($exe1);
            //echo $row1['id'];
            
            
                        $itemArray = array($row1["id"]=>array('name_of_class'=>$row1["name_of_class"], 'id'=>$row1["id"], 'description'=>$row1["description"],  'lesson_date'=>$_POST["lesson_date"],  'actual_timex'=>$_POST["actual_timex"],  'lesson_time'=>$row1["lesson_time"], 'charge'=>$row1["charge"],  'no_of_students'=>$row1["no_of_students"], 'count'=>"1", 'teacher_id'=>$row1["teacher_id"])); 
                                 

                        if(!empty($_SESSION["cart_item"])) {
                            if(in_array($row1["id"],$_SESSION["cart_item"])) {
                                foreach($_SESSION["cart_item"] as $k => $v) {
                                        if($row1["id"] == $k) {  echo 'Hi';
                                            $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                                            $_SESSION["cart_item"][$k]["actual_timex"] = $_POST["actual_timex"];
                                        }
                                }           
                            } else {
                                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                            }
                        } else {
                            $_SESSION["cart_item"] = $itemArray;
                        }
                            
                                                                                                                                                }
                    } 
                
            //break;
            
        }
        }




}





?>




<?php
// for GET add option
$db_handle = new DBController();



        if(!empty($_POST["action"])) {
                

if(isset($_POST[remove_now])) { 
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_POST["product_id"] == $_SESSION["cart_item"][$k]['id']) {
                                unset($_SESSION["cart_item"][$k]);      
                            }
                            if(empty($_SESSION["cart_item"])){
                                unset($_SESSION["cart_item"]);
                            }
                    }
                }   
} 

elseif (isset($_POST[join_free])) { 

                
        $time = time();
        $time = $_SESSION[userSession]._.$time;
        $date = date('Y-m-d h:i:sa');


        $sql_check = "SELECT * FROM products WHERE lesson_id='$_POST[product_id]'  AND teacher_id='$_POST[teacher_id]'  AND student_id='$_SESSION[userSession]' AND active='1'  ";
        $result_check = mysqli_query($connect, $sql_check);
        $pra_check = mysqli_fetch_array($result_check);
        $num_check = mysqli_num_rows($result_check);

        if($num_check == '' OR $num_check == '0' )  { 


            $result = mysqli_query($connect, "INSERT INTO products VALUES (NULL, '$_SESSION[userSession]',  '$_POST[product_id]', '$_POST[teacher_id]', '$time', '$date', 'Free', '', '', '', '', '1', '', '' )");

?><!--<meta http-equiv="refresh" content="0; URL='https://<?php echo $actual_domain_without_http; ?>/students_cart_activate.php'" />--> <?php 
        }



} else {




                    if(!empty($_POST["quantity"])) {
                        
                            $found = 'false';
                            if(!empty($_SESSION["cart_item"])) { 
                                foreach($_SESSION["cart_item"] as $item) {
                                if($_POST["product_id"] == $item['id'] ) 
                                    $found = "true";        
                                }           
                            }
                        
                        if($found == 'true') {
                            
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                if($_POST["product_id"] == $_SESSION["cart_item"][$k]['id'])
                                    $new_quantity = $_POST["quantity"]; 
                                    $_SESSION["cart_item"][$k]["quantity"] += $new_quantity;                
                                
                                }
                             } else {
              
            
            $sql1="SELECT * FROM category WHERE id='" . $_POST["product_id"] . "'";
            $exe1=mysqli_query($connect, $sql1);
            $row1=mysqli_fetch_array($exe1);
            //echo $row1['id'];
            
            
                        $itemArray = array($row1["id"]=>array('name_of_class'=>$row1["name_of_class"], 'id'=>$row1["id"], 'description'=>$row1["description"],  'lesson_date'=>$_POST["lesson_date"],  'actual_timex'=>$_POST["actual_timex"],  'lesson_time'=>$row1["lesson_time"], 'charge'=>$row1["charge"],  'no_of_students'=>$row1["no_of_students"], 'count'=>"1", 'teacher_id'=>$row1["teacher_id"])); 
                                 

                        if(!empty($_SESSION["cart_item"])) {
                            if(in_array($row1["id"],$_SESSION["cart_item"])) {
                                foreach($_SESSION["cart_item"] as $k => $v) {
                                        if($row1["id"] == $k) {  echo 'Hi';
                                            $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                                            $_SESSION["cart_item"][$k]["actual_timex"] = $_POST["actual_timex"];
                                        }
                                }           
                            } else {
                                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                            }
                        } else {
                            $_SESSION["cart_item"] = $itemArray;
                        }
                            
                                                                                                                                                }
                    } 
                
            //break;
            
        }




}

// for GET add option
?>



<?php
    if(!empty($_SESSION["cart_item"])) { 
          

        $sql = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);


        $time = time();
          $time = $_SESSION[userSession]._.$time;
        $date = date('Y-m-d h:i:sa');

foreach($_SESSION["cart_item"] as $item) {

       $sql_check = "SELECT * FROM products WHERE lesson_id='$item[id]'  AND teacher_id='$item[teacher_id]'  AND student_id='$_SESSION[userSession]' AND active='1'  ";
        $result_check = mysqli_query($connect, $sql_check);
        $pra_check = mysqli_fetch_array($result_check);
        $num_check = mysqli_num_rows($result_check);

        if($num_check == '' OR $num_check == '0' )  { 


            $result = mysqli_query($connect, "INSERT INTO products VALUES (NULL, '$_SESSION[userSession]',  '$item[id]', '$item[teacher_id]', '$time', '$date', 'Proceed', '', '', '', '', '1', '', '' )");

        } else { $sql_paid = "UPDATE products SET posted_time='$time' WHERE lesson_id='$item[id]'  AND teacher_id='$item[teacher_id]'  AND student_id='$_SESSION[userSession]' AND active='1'  ";
    mysqli_query($connect, $sql_paid); }
}
        $sql2_mail = "SELECT * FROM category WHERE id='$item[id]'";
        $result2_mail = mysqli_query($connect, $sql2_mail);
        $pra2_mail = mysqli_fetch_array($result2_mail);

        $sql_mail = "SELECT * FROM tbl_users WHERE userID='$pra2_mail[teacher_id]'";
        $result_mail = mysqli_query($connect, $sql_mail);
        $pra_mail = mysqli_fetch_array($result_mail);


        if($result) { 
        //if(1 == 1) { 

            
        $sql_new = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result_new = mysqli_query($connect, $sql_new);
        $pra_new = mysqli_fetch_array($result_new);

                $to = '$pra_new[userEmail]';
                $subject = 'New Lesson Enrolled - '.$site_website_name.' ('.$pra_new[userID].') ';
                $message = '

Dear '.$_SESSION[userName].',  <br><br>
You are successfully enrolled for '.$pra2_mail[name_of_class].' <br><br>
Thank  you for the agreement on student / learner terms and conditions. <br><br>
Please check  My Page to check the status of your program enrollment.<br><br>

Enjoy learning with '.$site_website_name.'.<br><br>
If you need help, please use our web chat or emal to '.$site_info_mail_address.'
                            ';
                $from = $site_info_mail_address;
                $headers = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
                $headers .= "From:" . $from;
                mail($to,$subject,$message,$headers);

            
    


                $to2 = '$pra_mail[userEmail]';
                $subject2 = 'New Lesson Enrolled - '.$site_website_name.' ('.$pra_new[userID].') ';
                $message2 = '

Dear '.$pra_mail[userName].', <br><br>
'.$pra[grade].' - '.$_SESSION[userName].' has enrolled your session. <br><br>
Please check  My Dash Board by login to your account to check the status of your program. <br><br>

Enjoy teaching with '.$site_website_name.'. <br><br>
If you need help, please use our web chat or emal to '.$site_info_mail_address.' <br><br>
                            ';
                $from2 = $site_info_mail_address;
                $headers2 = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
                $headers2 .= "From:" . $from2;
                mail($to2,$subject2,$message2,$headers2);



   
                
        }
?>
<!--<meta http-equiv="refresh" content="0; URL='https://<?php echo $actual_domain_without_http; ?>/students_cart_activate.php'" />-->

  <?php  }
?>







<?php      unset($_SESSION["cart_item"]); ?>

<?php 
        $sql = "SELECT * FROM category WHERE id= '$_GET[view]' AND active = 1";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result); 

?>






<?php
        $sql2 = "SELECT * FROM tbl_users WHERE userID= '$_GET[view]' AND type = '2' and userStatus = 'Y' ";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);
        $row = mysqli_num_rows($result2); 

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

                    $sql = "UPDATE products SET comments='$fname', posted_date = '$date' WHERE id=$_POST[product_id]";
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



<!doctype html>
<html class="no-js" lang="zxx" style="background:black">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title><?php echo $pra2[userName]; ?> - <?php echo $site_title; ?></title>
   <?php metas(); ?>
   <!-- Go to www.addthis.com/dashboard to customize your tools -->
   <!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-587a4d67086e8205"></script>-->
</head>

<body style="background: white">
   <!--[if lte IE 9]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end-->
    
   
<style>
        .course-single.list-view .course-text p { display: block !important }
        
        .course-price h5 { font-size: 22px; color: #90daff; }
            
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
        
        .course-price h5 {
    font-size: 22px;
    color: #edeff1 !important;
}
    </style>



         



<?php

        if($row == '' OR $row == '0' ) { echo '
               <div class="textblock-area pt-30">
                        <div class="section-title text-center">
                           <h2 >Sorry, We cant find Lecturer</h2>
                        </div>
               <div class="container textblock-inner">

               
             <p>Please contact '.$site_website_name.'</p>



               </div>
            </div>

         ';}
         if($row != '' OR $row != '0' ) { 

?>









































<?php  $current_date = date('Y-m-d'); ?> 
<?php  $after_one_year = date('Y-m-d', strtotime($current_date . ' +10 year'));  ?>
<?php  $before_one_year = date('Y-m-d', strtotime($current_date . ' -10 year')); ?>         




   <!--course-area start-->
   <div class="course-area mt-20" style=" padding-bottom: 40px; margin-top: 0; background: white; padding-top: 20px; ">
      <div class="container">

<div class="row">








<!--<div class="col-md-12 col-lg-12">-->
<!--                                                <div class="p-top-0 p-bottom-20">-->
<!-- <a href="javascript:history.go(-1)" class="btn btn--md register_btn btn-primary" style="float:right;line-height: inherit;padding: 0px 20px;background: #343e51;color: white;border: none;border-radius: 50px;font-weight: 100;"> Back ↩</a>-->
<!--                                                                                                        </div>-->
<!--                                            </div>-->







<div class="col-lg-12  mt-20 collapsible2" style="cursor: pointer; padding: 0px; display: none">
               <div class="text-center" style="text-transform: uppercase;">
                  <h3 style=" font-size: initial; padding: 10px; border-radius: 10px; font-weight: 200; border-bottom: 1px solid black; background-image: linear-gradient(45deg, #878787 0%, #cccccc 100%); color: rgb(255, 255, 255); text-align: left; padding-left: 20px; font-family: sans-serif; "><?php echo $pra2[userName]; ?>            <span style="float:right;background: #9e9e9e;padding: 1px 10px;color: white;border-radius: 5px;font-weight: 500;">⋁</span>
                  </h3>
               </div>
</div>

<?php if(!isset($_GET[show])) { ?>
<div class="row" style=" display: contents; ">

<?php 
                $sql3 = "SELECT * FROM category WHERE  teacher_id='$pra2[userID]' AND date2 between '$current_date' AND '$after_one_year' AND active = 1 AND additional_information_full != '1' AND additional_information != '' GROUP by additional_information 
                ORDER BY CAST(additional_information AS UNSIGNED INTEGER)

                  "; //ORDER by additional_information DESC
                 $result3 = mysqli_query($connect, $sql3);
                while( $pra3 = mysqli_fetch_array($result3))  { 
        ?>
                        <div class="col-lg-12 col-sm-6" style="padding: 0px; margin-bottom: 15px">
                        <div class="author-bio text-left mt-0" style="padding: 10px 10px 10px 20px;border:0px;padding-bottom: 0px;height: 50px;border-radius: 10px;background: #2361b0;">
                           <a href="lecture.php?view=<?php echo $_GET[view]; ?>&show=<?php echo $pra3[additional_information]; ?>">

                            <h3 style="height: 40px;font-size: 16px !important;font-family: 'Roboto';font-weight: normal;color: #555;">
                              <span class="span" style="color: white;font-size: x-large;"><?php echo $pra3[additional_information]; ?></span>
                           <span style="float: right"> <p class="btn-common" style="   margin: 0px;font-size: medium;height: 27px;line-height: revert;border-radius: 50px;width: fit-content;font-weight: 500;padding: 3px 20px;color: white !important;margin-top: 3px;">Show</p> </span>

                           </h3>

                           </a>
                          </div>  
                          
                        </div>

        <?php } ?>


</div>
<?php } ?>


<?php if(isset($_GET[show])) { ?>
<div class="row" style=" display: contents; ">

<?php 
                $sql3 = "SELECT * FROM category WHERE  teacher_id='$pra2[userID]' AND date2 between '$current_date' AND '$after_one_year' AND active = 1 AND additional_information_full != '1' AND additional_information = '$_GET[show]' GROUP by additional_information 
                ORDER BY CAST(additional_information AS UNSIGNED INTEGER)

                  "; //ORDER by additional_information DESC
                 $result3 = mysqli_query($connect, $sql3);
                while( $pra3 = mysqli_fetch_array($result3))  { 
        ?>
                        <div class="col-lg-12 col-sm-6" style="padding: 0px; margin-bottom: 15px">
                        <div class="author-bio text-left mt-0" style="padding: 10px 10px 10px 20px;border:0px;padding-bottom: 0px;height: 50px;border-radius: 10px;background: #2361b0;">
                           <a href="lecture.php?view=<?php echo $_GET[view]; ?>&show=<?php echo $pra3[additional_information]; ?>">

                            <h3 style="height: 40px;font-size: 16px !important;font-family: 'Roboto';font-weight: normal;color: #555;">
                              <span class="span" style="color: white;font-size: x-large;"><?php echo $pra3[additional_information]; ?></span>
                           <span style="float: right"> <p class="btn-common" style="   margin: 0px;font-size: medium;height: 27px;line-height: revert;border-radius: 50px;width: fit-content;font-weight: 500;padding: 3px 20px;color: white !important;margin-top: 3px;">Show</p> </span>

                           </h3>

                           </a>
                          </div>  
                          
                        </div>

        <?php } ?>


</div>
<?php } ?>






<script>
    var coll = document.getElementsByClassName("collapsible2");
    var i;

    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "contents") {
          content.style.display = "none";
        } else {
          content.style.display = "contents";
        }
      });
    }
</script>






        




</div>
</div>
</div>

   <!--course-area start-->











































   <!--page-banner-area start-->
   <div class="page-banner height-200x bg-1" style="min-height: 200px;padding-top:  50px; display: none">
      <div class="d-table" style="    height: auto;">
         <div class="page-title vertical-middle text-center">


 <div class="container">
 <div class="row">
            <div class="col-lg-3 col-md-12" style="    height: fit-content;">

                                            <div class="hero__content__title">
                                                <?php if( $pra2[p_picture] == '') { ?><img src="source_files/logo.png" style="    max-height: 75px; margin: 0 auto;display: block;">
                                                <?php } ?>
                                                <?php if( $pra2[p_picture] != '') { ?><img src="<?php echo getImageUrl($pra2['p_picture'], $baseURL, $current_page); ?>" style="    max-height: 75px;margin: 0 auto;display: block; max-height: 150px; border-radius: 100px">
                                                <?php } ?>
                                            </div>
            </div>
            <div class="col-lg-9 col-md-12"  style="    height: fit-content;text-align: left;">
               <h3><?php echo $pra2[userName]; ?><br><p style="    font-size: initial;line-height: initial;"><?php echo $pra2[selected_medium]; ?></p></h3>
            </div>
</div>
</div>
      </div>
   </div>
   </div>
   <!--page-banner-area end-->
   
   <!--breadcrumb-area start-->
   <div class="breadcrumb-area mt-25" style="display: none">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="site-breadcrumb">
                  <ul class="list-none">
                     <li><a href="index.php">Home</a></li>
                     <li><i class="fa fa-angle-right"></i></li>
                     <li><?php echo $pra2[userName]; ?></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--breadcrumb-area end-->
   













<?php if(!isset($_GET[show])) { ?>

<!--course-area start-->
   <div class="course-area mt-20" style=" background: white; margin-top: 20px; ">
      <div class="container">
         <div class="row" style="padding-top: 20px">
            <div class="col-lg-8 col-md-12 rowx">
               
               <div class="tab-content">
                  <!--single-tab-->
                  <div id="grid-products" class="tab-pane fade in show active">
                     <div class="row">
<?php  $current_date = date('Y-m-d'); ?> 
<?php  $after_one_year = date('Y-m-d', strtotime($current_date . ' +10 year'));  ?>
<?php  $before_one_year = date('Y-m-d', strtotime($current_date . ' -10 year')); ?>         


<?php 
        //$sql3 = "SELECT * FROM category WHERE teacher_id= '$pra2[userID]' AND active = 1 ORDER by ID ";
        
        $sql3 = "SELECT * FROM category WHERE  teacher_id='$pra2[userID]' AND date2 between '$current_date' AND '$after_one_year' AND additional_information = '' AND active = 1 ORDER by lesson_date DESC";
        $result3 = mysqli_query($connect, $sql3);
        while( $pra3 = mysqli_fetch_array($result3))  { 
        

?>

<?php
        $sql4 = "SELECT * FROM tbl_users WHERE userID=$pra3[teacher_id]";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);

?>



                        <div class="col-lg-12 mb-30">
                           <div class="course-single list-view">
                      
                              <div class="course-info" style=" width: 100%; border: 1px solid white !important; border-radius: 10px; background: black; ">
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


                                    <p style="color: #fff;"><?php echo $pra3[description]; ?> </p>
                                   
                                    <!-- Shortened note with "More Details" button -->
        <p style="color: #fff;">
            <?php echo substr($pra3[note], 0, 150); ?>... <!-- Limit the text to 150 characters -->
        </p>
        <a href="lecture1.php?view=<?php echo $pra3[id]; ?>" style="color: #fff; text-decoration: none; background-color: #007bff; padding: 5px 10px; border-radius: 5px;">
            More Details
        </a>
                                    <p style="color: #fff;"><?php echo $pra3[target_audience_full]; ?> </p>
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
        $sql2x = "SELECT * FROM category WHERE active = 1 AND id = '$pra3[id]'  ORDER by lesson_date ASC";
        $result2x = mysqli_query($connect, $sql2x);
        while($pra2x = mysqli_fetch_array($result2x)) { 

        $rowsx = mysqli_num_rows($result2x); 

        $found = '0';
                            

                            if(!empty($_SESSION["cart_item"])) { 
                                foreach($_SESSION["cart_item"] as $item) {  $total_charge += $item["charge"];
                                    if($pra2x["id"] == $item['id'] )  {  
                                        $found = '1';       
                                    }  
                                }
                            }
        }


?>


                     <?php
                                                                                                                        

        $sql5 = "SELECT * FROM products WHERE lesson_id=$pra3[id] AND active = 1 AND status = 'Paid' OR lesson_id=$pra3[id] AND active = 1 AND status = 'Free' OR lesson_id=$pra3[id] AND active = 1 AND status = 'PostPay'  ORDER by id DESC";
        $result5 = mysqli_query($connect, $sql5);      $num_rows5 = mysqli_num_rows($result5);

      



$user_home = new USER(); 

 if($user_home->is_logged_in()!="" && $_SESSION['type'] == '2' && $pra3[teacher_id] == $_SESSION[userSession] ) { echo '<a href="lessons_add_info.php?view='.$pra3[id].'" style="background: #f4516c; border: #f4516c; " class="btn-common">EDIT NOW</a>';   }
 if($user_home->is_logged_in()!="" && $_SESSION['type'] == '3'  ) { 
    ?>






















<?php 
 
        $sql3x = "SELECT * FROM products WHERE lesson_id='$pra3[id]' AND active = 1 AND student_id = '$_SESSION[userSession]' ORDER by id DESC";
        $result3x = mysqli_query($connect, $sql3x);
        $pra3x = mysqli_fetch_array($result3x); 


$sql_attachment = "SELECT * FROM products WHERE id='$pra3x[id]' AND comments != ''";
$result_attachment = mysqli_query($connect, $sql_attachment);
$pra_attachment = mysqli_fetch_array($result_attachment);
$rowcount=mysqli_num_rows($result_attachment);

?>
                                    

                                   
 <?php if($pra3[teacher_link] != '' ){ ?>
                                            <a style="background: white;padding: 10px  18px;margin-top: 4px;border-radius: 50px;" href="<?php echo $pra3[teacher_link]; ?>" target="_blank"  > <img src="img/whatsapp2.jpeg" style="width: 100px;margin-top: -5px;"> </a>
<?php } ?>


<?php    if($pra3x[status] == 'Proceed' OR $pra3x[status] == 'PostPay' ) {  ?>

<?php if($rowcount != '' OR $rowcount != '0') { ?><a href="<?php echo getImageUrl($pra_attachment['comments'], $baseURL, $current_page); ?>" target="_blankx"><img src="<?php echo getImageUrl($pra_attachment['comments'], $baseURL, $current_page); ?>" style="max-height: 70px;max-width: 275px;border: 2px solid white;border-radius: 5px;"></a><?php } ?>

<!--<img src="source_files/checking_bank_slip.png" style="width: 100px;margin-top: 0px;">-->


       <form action="" method="post" id="form" enctype="multipart/form-data" onsubmit="return confirm('නම සහ මාසය රිසිට්පතෙහි සදහන් කරන්න')"  style="display: block;clear: both;padding-top: 0px;float: right;text-align: right;border: 1px solid white;border-radius: 10px;background: white;padding: 0 10px; ">
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

<?php
        $sql = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>      

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


<?php echo '<form action="https://www.payhere.lk/pay/checkout" method="post" ">
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
     <!--<input class="small_button btn btn--md register_btn btn-primary" style="background: #fff3ba;border: none;padding: 0 10px;font-weight: bold;font-size: initial;margin-top:0px; line-height: normal;padding: 10px;text-overflow: ellipsis;white-space: break-spaces;overflow: initial;height: min-content;" type="submit" name="submit_pay_online" value="PAY ONLINE NOW">-->

</form>'; ?>

<?php } ?>

   















                                        <?php if($pra3x[status] == 'Paid' OR $pra3x[status] == 'Free' OR $pra3x[status] == 'PostPay' OR $pra3x[status] == 'Institute') { ?>
                                            <?php if($pra3[student_link] != ''){ ?>
                                            <br><a style="color: white;text-align: center;background: #f4516c;padding: 10px 15px;margin-bottom: 10px;font-size: larger;text-transform: uppercase;width: fit-content;display: block;border-radius: 50px;" href="<?php echo $pra3[student_link]; ?>" target="_blank">සජීවි ZOOM පන්තියට සම්බන්ධ වන්න</a>
                                            <?php } ?>

 <?php if($pra3x[paid_date] != '' ){ ?>
                                            <a style="color: white;text-align: center;margin: 10px 0;text-transform: uppercase;width: fit-content;display: block;border-radius: 50px;" href="<?php echo $pra3x[paid_date]; ?>" >Join <img src="img/zoom_badge.png" style="width: 100px"> Class</a>
<?php } ?>
                                            
                                            <a style="color: black;text-align: center;background: white ;padding: 1px 20px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: fit-content;display: block;border-radius: 30px;margin-bottom: 20px;line-height: 30px;" href="student_learning_meterials.php?view=<?php echo $pra3[id]; ?>" target="_blank">Record Videos / PDF </a>
                                           
                                           
                                        <?php } ?>




                                        <form method="post" action=""> <!--<?php if($found == '0') {   ?>thank_you.php<?php } ?>-->
    <input type="hidden" name="product_id" value="<?php echo $pra3['id']; ?>">
    <input type="hidden" name="teacher_id" value="<?php echo $pra3['teacher_id']; ?>">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="quantity" value="1">
    <input type="hidden" name="actual_timex" value="<?php echo time(); ?>">

    <!-- Note Section -->
   
    <?php
    if(mysqli_num_rows($result3x) > 0) { 

        if($pra3x['status'] == 'Proceed') { 
            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #a40573;">ගෙවීම් කරන්න</p></a>';  
        }
        if($pra3x['status'] == 'Paid') { 
            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #1dc9b7;">මුදල් ගෙවා  ඇත</p></a>';  
        }
        if($pra3x['status'] == 'Free') { 
            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #f4516c;">Free පන්තිය</p></a>';  
        }
        if($pra3x['status'] == 'PostPay') { 
            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #000;">PostPay</p></a>';  
        }
        if($pra3x['status'] == 'Institute') { 
            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #000;">PostPay</p></a>';  
        }
    } else { 
        if($pra3['blocked_by_admin'] == '') { 
            if($num_rows5 < $pra3['no_of_students']) {  
                if($found == '1') {   
                    echo '<a href="thank_you.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #a40573;">GO TO CHECKOUT</p></a>';
                    echo '<input class="btn-common" type="submit" name="remove_now" style="min-width: inherit;background: #f4516c;border: #f4516c;font-size: smaller;margin: 0 auto;height: 25px;line-height: inherit;border-radius: 5px;" value="Remove from Cart">'; 
                } 
                if($found == '0') { 
                    if($pra3['charge'] == '0') {      
                        echo '<input class="btn-common" type="submit" name="join_free" style="min-width: 100%;background: #4CAF50; border: none; color:white;font-size: initial;" value="පන්ති නොමිලේ ඉල්ලුම් කරන්න">';  
                    } else { 
                        echo '<input class="btn-common" type="submit" name="order_now" style="background:white !important; color:black !important; " value="පන්ති ඉල්ලුම් කරන්න">';
                        //echo '<center><img src="https://www.payhere.lk/downloads/images/payhere_short_banner.png" alt="PayHere"></center>';    
                    }
                } 
            } else { 
                echo '<span class="btn btn--md register_btn btn-common" style="background: #f4516c; border: #f4516c;">Slots are Finished</span>'; 
            }
        } 
        if($pra3['blocked_by_admin'] == '1') {  
            echo '<span class="btn btn--md register_btn btn-common" style="background: #f4516c; border: #f4516c;">BLOCKED BY ADMIN</span>'; 
        }
    }                  
    ?>   
</form>

<?php
}  

if(!$user_home->is_logged_in() ) {   
    if($pra3[charge] == '0') {     

        echo '<a href="login.php?view='.$pra3[id].'" style="background: #4CAF50; border: none; color:white;font-size: initial;" class="btn-common">පන්ති නොමිලේ ඉල්ලුම් කරන්න</a>';  } else { 
        echo '<a href="login.php?view='.$pra3[id].'" class="btn-common"  style="background:white !important; color:black !important; ">පන්ති ඉල්ලුම් කරන්න</a>'; 
        echo '<center></center>'; 
         }


                                    
                                     } 

   ?>



                  </div>


                                 <!-- new code-->






























                              </div>
                           </div>
                        </div>



                        




<?php } ?>

<!--
<img class="hide_in_mobile" src="source_files/pay-min.png" style="width: 50%;border-right: 10px;height: 100%;margin: 0 auto;border-radius: 10px;background: #e1e1e1; margin-bottom: 50px;">
<img class="show_in_mobile" src="source_files/pay-min.png" style="display:none; width: 100%;border-right: 10px;height: 100%;margin: 0 auto;border-radius: 10px;background: #e1e1e1; margin-bottom: 50px;">
-->


                     </div>
                  </div>
                  <!--single-tab-->
                  
               </div>
               
            </div>
            <div class="col-lg-4">
                <div style="box-shadow: 7px 5px 20px 0px #dadada; border-radius: 10px; padding: 20px 0; height: max-content;">
                
                    <?php $_GET['view'] = 'Tutors'; ?>
                    <?php if ($_GET['view'] == 'Tutors') { $grade = 'Tutor'; } if ($_GET['view'] == 'Trainers') { $grade = 'Trainer'; } ?>
                
                    <!-- Redirect -->
                    <?php
                    $sql_check_main_group = "SELECT * FROM main_group WHERE active = '1' ORDER BY id DESC";
                    $result_check_main_group = mysqli_query($connect, $sql_check_main_group);
                    ?>
                
                    <?php
                    $sql_cat = "SELECT * FROM main_group WHERE active = '1' ORDER BY id ASC";
                    $result_cat = mysqli_query($connect, $sql_cat);
                    while ($pra_cat = mysqli_fetch_array($result_cat)) {
                    ?>
                
                    <?php
                    $sql5 = "SELECT * FROM tbl_users WHERE type = '2' AND grade = '$grade' AND userStatus = 'Y' AND selected_ol_al_grade = '{$pra_cat['id']}' AND batch = '' ORDER BY CAST(order_by AS UNSIGNED) ASC";
                    $result5 = mysqli_query($connect, $sql5);
                    $num_rows5 = mysqli_num_rows($result5);
                    ?>
                
                    <div class="col-lg-12 <?php if($site_lecture_page_drop_down_opened == '') { echo 'mt-20'; } else { echo 'mt-30'; } ?> collapsible" style="cursor: pointer;">
                        <div class="author-bio text-center mt-0" style="padding: 0px;width: 50px;border: 0px;float: left; margin-left: -10px;">
                            <img src="source_files/new_confiance_big - Copy.jpeg" style="margin: 0 auto;display: block; border-radius: 0px; height: auto;">
                        </div>
                        <div class="text-center" style="text-transform: uppercase;">
                            <h3 style="font-size:16px; font-weight: normal; height: 50px;line-height: 30px;padding: 10px;border-radius: 40px;border-bottom: 1px solid black; background-color: <?php echo $drop_down_bg_color; ?>; color: rgb(255, 255, 255);text-align: center;padding-left: 20px;font-family: sans-serif;">
                                <?php echo $pra_cat['main_group_name']; ?>
                                <span style="float:right;background: white;padding: 0px 6px;color: black;border-radius: 50px;font-weight: 500;line-height: 28px;">⋁</span>
                            </h3>
                        </div>
                    </div>
                
                    <div class="row" style="display:none;">
                        <?php
                        while ($pra5 = mysqli_fetch_array($result5)) {
                        ?>
                        <div class="col-lg-12 col-sm-6" style="cursor: pointer;">
                            <div class="author-bio text-left mt-0" style="padding: 5px; border:0px;padding-bottom: 0px;height: 40px;">
                                <a href="lecture.php?view=<?php echo $pra5['userID']; ?>">
                                    <h3 style="height: 40px;font-size: 16px !important;font-family: 'Roboto';font-weight: normal;color: #555;">
                                        <span style="float: left;width: 100%;">
                                            <p class="btn-common" style="margin: 0px;font-size: large;height: auto ;line-height: revert;border-radius: 50px;width:fit-content;font-weight: 400;padding: 3px 20px 7px 10px;color: white;background-color:   <?php echo $drop_down_sub_color; ?> !important;text-align: center;">
                                                <?php echo $pra5['userName']; ?>
                                            </p>
                                        </span>
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
    
       
</div>
    
    
<?php if($cart_for_checkout != '' && $cart_for_checkout != '0' ) { ?>
<div style=" background: #f0f0f0; border-radius: 20px; padding: 0; height: max-content; margin-top: 20px; "> 
    <p style="text-align: center;color: #3e3e3e;border-radius: 20px 20px 0 0;padding: 0px;background: #f5f9ff;width: 100%;border: 0px solid #5e5e5e;font-size: smaller;margin-top: 30px;text-transform: uppercase;margin-bottom: 0px;">MY CART</p>
    <div style="margin: 2px">
        <table class="table" style="font-size: inherit; width: 100%; margin-bottom: 0px;">
            <tbody>
                 
            <?php
                    $sql_total = "SELECT * FROM products WHERE student_id = '$_SESSION[userSession]' AND active = '1' AND status = 'Proceed' AND comments = '' ";
                    $result_total = mysqli_query($connect, $sql_total);     
                    while($pra_total = mysqli_fetch_array($result_total)) { 

                      $sql_total2 = "SELECT * FROM category WHERE  id = '$pra_total[lesson_id]' AND active = 1 ORDER by id DESC"; 
                      $result_total2 = mysqli_query($connect, $sql_total2); 
                      $pra_total2 = mysqli_fetch_array($result_total2);
                      $rowcount_total2=mysqli_num_rows($result_total2);


                      $sql_teacher3 = "SELECT * FROM tbl_users WHERE userID='$pra_total[teacher_id]' AND type = '2' ";
                      $result_teacher3 = mysqli_query($connect, $sql_teacher3);
                      $pra_teacher3 = mysqli_fetch_array($result_teacher3);

                      if($pra_total2[charge] != '') {
          ?>   

          <tr style="background: white; <?php if($rowcount_total2 == '0' || $rowcount_total2 == '') { echo 'display: none'; } ?> ">
              <td><a href="<?php echo $actual_link; ?>&remove_lesson=<?php echo $pra_total[id]; ?>" ><img src="https://cdn-icons-png.flaticon.com/512/4379/4379685.png" style=" width: 20px; margin-right: 10px; "></a></td>
              <td><?php echo $pra_teacher3[userName]; ?></td>
              <td><?php echo $pra_total2[name_of_class]; ?> (<?php echo $pra_total2[description]; ?>)</td>
              <td><?php echo $pra_total2[charge]; $total_for_checkout += $pra_total2[charge]; ?></td>
          </tr>
          
          <?php       }   } ?>

        </tbody>
    </table>
    </div>
    <span style="text-align: center;color: #3e3e3e;border-radius: 0 0 20px 20px;padding: 10px;background: #05224b;width: 100%;color: white;border: 0px solid #5e5e5e;font-size: x-large;font-weight: bold;margin-top: 0px;text-transform: uppercase;margin-bottom: 0px;float: left;display: inline-block;margin-bottom: 20px;">
        <span style="float: left;margin-left: 10px;">Total </span>
        <span style="float: right;margin-right: 10px;"><?php echo $total_for_checkout; ?></span>
    </span>
    
    
</div>
<a href="checkout.php" style="font-weight: bold;background: #5e9ae6;width: 100%;border: none;padding: 10px;font-size: large;border-radius: 50px;margin: 0px;background: white;" class="small_button btn btn--md register_btn btn-primary">PROCEED TO CHECKOUT</a>

<?php } ?>



    <!--special--></div><!--special-->
            
            
            
            
         </div>
      </div>
   </div>
   <!--course-area end-->

<?php } ?>














































<?php if(isset($_GET[show])) { ?>

<!--course-area start-->
   <div class="course-area mt-20" style=" background: white; margin-top: 0px; display: none !important;">
      <div class="container">
          
          
          
          
          
         <div class="row" style="padding-top: 20px">
<?php 
        //$sql3 = "SELECT * FROM category WHERE teacher_id= '$pra2[userID]' AND active = 1 ORDER by ID ";
        
        $sql3 = "SELECT * FROM category WHERE  teacher_id='$pra2[userID]' AND date2 between '$current_date' AND '$after_one_year' AND active = 1 ORDER by lesson_date DESC"; //AND additional_information = '$_GET[show]' 
        $result3 = mysqli_query($connect, $sql3);
        while( $pra3 = mysqli_fetch_array($result3))  { 
        

?>
            <?php if($pra3[content_of_the_program] != '') { ?><div class="col-lg-12">
                <h3 style="color: white; width: 100%; "><?php echo $pra3[content_of_the_program]; ?></h3><br>
            </div><?php } ?>
            
            
            <?php if($pra3[youtube_link] != '') { ?><div class="col-lg-6">
                <iframe width="100%" height="320" src="https://www.youtube.com/embed/<?php echo $pra3[youtube_link]; ?>?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style=" border: 3px solid white;border-radius: 20px; "></iframe>
            </div><?php } ?>


<?php } ?>

        </div>




         <div class="row" style="padding-top: 20px">
            <div class="col-lg-12">
               
               <div class="tab-content">
                  <!--single-tab-->
                  <div id="grid-products" class="tab-pane fade in show active">
                     <div class="row">
<?php  $current_date = date('Y-m-d'); ?> 
<?php  $after_one_year = date('Y-m-d', strtotime($current_date . ' +10 year'));  ?>
<?php  $before_one_year = date('Y-m-d', strtotime($current_date . ' -10 year')); ?>         


<?php 
        //$sql3 = "SELECT * FROM category WHERE teacher_id= '$pra2[userID]' AND active = 1 ORDER by ID ";
        
        $sql3 = "SELECT * FROM category WHERE  teacher_id='$pra2[userID]' AND date2 between '$current_date' AND '$after_one_year' AND active = 1 ORDER by lesson_date DESC"; // AND additional_information = '$_GET[show]'
        $result3 = mysqli_query($connect, $sql3);
        while( $pra3 = mysqli_fetch_array($result3))  { 
        

?>

<?php
        $sql4 = "SELECT * FROM tbl_users WHERE userID=$pra3[teacher_id]";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);

?>

<?php
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 1;

// Database Query
$sql41 = "SELECT * FROM category WHERE id = $category_id";
$result44 = mysqli_query($connect, $sql41);
$pra21 = mysqli_fetch_array($result44);
?>



                        <div class="col-lg-12 mb-10">
                           <div class="course-single list-view">
                            1
                         
                              <div class="course-info" style=" width: 100%; border: 1px solid white !important; border-radius: 10px; background: black; ">
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


                                    <p style="color: #fff;"><?php echo $pra3[description]; ?> </p>

                                    <p style="color: #fff;">
    <?php echo isset($pra21['category_name']) ? $pra21['category_name'] : "No category found"; ?>
</p>
                                 </div>
                                 <div class="author-info" style="display: none">
                                    <div class="author-name">
                                       
                                       
                  <?php if( $pra4[p_picture] == '') { ?>
                  <img src="img/logo.png" style="margin: 0 auto;display: block;border-radius: 0px;height: auto;">
                  <?php } ?>
                  <?php if( $pra4[p_picture] != '') { ?>
                  <img src="<?php echo getImageUrl($pra4['p_picture'], $baseURL, $current_page); ?>" style="margin: 0 auto;display: block; max-height: 100px;  ">
                  <?php } ?>

                                       <!--<a href="lecture.php?view=<?php echo $pra4[userID]; ?>">--><?php echo $pra4[userName]; ?><!--</a>-->
                                       <small><?php echo $pra4[grade]; ?></small>
                                    </div>
                                    
                                 </div>













































<?php
        $sql5 = "SELECT * FROM products WHERE lesson_id=$pra3[id] AND active = 1 AND status = 'Paid' OR lesson_id=$pra3[id] AND active = 1 AND status = 'Free' OR lesson_id=$pra3[id] AND active = 1 AND status = 'PostPay'  ORDER by id DESC";
        $result5 = mysqli_query($connect, $sql5);      $num_rows5 = mysqli_num_rows($result5);
        $pra3x = mysqli_fetch_array($result5);

?>
<?php
        $sql = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>      

<?php if($pra3x[status] == 'Proceed' OR $pra3x[status] == 'PostPay' ) { ?>  
<!--<a href="thank_you.php?student_paying_to=<?php echo $pra3x[id]; ?>" target="_blankx" class="small_button btn btn--md register_btn btn-primary" style="background: #fff3ba;border: none;padding: 0 10px;font-weight: bold;font-size: initial;margin-top:20px;">Pay now to Enrol</a>-->
<!--live-->
<?php if($pra3[partial_payment] != '1' ) { ?>  



<?php echo '<form action="" method="post" > 
     <input type="hidden" name="product_id" value="'.$pra3[id].'" required="">
     <input type="hidden" name="teacher_id" value="'.$pra3['teacher_id'].'">
     <input type="hidden" name="action" value="add_new">
     <input type="hidden" name="quantity" value="1">
     <input type="hidden" name="actual_timex" value="'.time().'">           ';

?>
<?php 
                if(!empty($_SESSION["cart_item_new"])) {
                    foreach($_SESSION["cart_item_new"] as $k => $v) {
                            if($pra3["id"] == $_SESSION["cart_item_new"][$k]['id']) {
                                echo '<input class="btn btn--md register_btn btn-primary" type="submit" name="remove_now" style="background: red;border: none;color: white;font-weight: bold;font-size: initial;margin:0px;line-height: normal;padding: 5px 20px;text-overflow: ellipsis;white-space: break-spaces;overflow: initial;height: min-content;border-radius: 50px;float: right;cursor: pointer;text-transform: uppercase; display: none" value="Remove This">'; 

                                    $found_add_to_cart = '1';

                                    $total_amount += $pra3[charge];




                            } 
                    }
                }
?>
    
    <?php if($found_add_to_cart == '0') { ?>
            <input style="background: #4caf50;border: none;color: white;font-weight: bold;font-size: initial;margin:0px;line-height: normal;padding: 5px 20px;text-overflow: ellipsis;white-space: break-spaces;overflow: initial;height: min-content;border-radius: 50px; width:100%;cursor: pointer;" type="submit" name="add_new_submit" value="PAY ONLINE">
    <?php } ?>


</form>


<?php } ?>

<?php } ?>










































                                 <!-- new code-->

                                 <div class="course-features-bottom mt-0 col-lg-6 mb-0" style=" float: right; padding:5px; ">


<?php
        $sql2x = "SELECT * FROM category WHERE active = 1 AND id = '$pra3[id]'  ORDER by lesson_date ASC";
        $result2x = mysqli_query($connect, $sql2x);
        while($pra2x = mysqli_fetch_array($result2x)) { 

        $rowsx = mysqli_num_rows($result2x); 

        $found = '0';
                            

                            if(!empty($_SESSION["cart_item"])) { 
                                foreach($_SESSION["cart_item"] as $item) {  $total_charge += $item["charge"];
                                    if($pra2x["id"] == $item['id'] )  {  
                                        $found = '1';       
                                    }  
                                }
                            }
        }


?>


                     <?php
                                                                                                                        

        $sql5 = "SELECT * FROM products WHERE lesson_id=$pra3[id] AND active = 1 AND status = 'Paid' OR lesson_id=$pra3[id] AND active = 1 AND status = 'Free' OR lesson_id=$pra3[id] AND active = 1 AND status = 'PostPay'  ORDER by id DESC";
        $result5 = mysqli_query($connect, $sql5);      $num_rows5 = mysqli_num_rows($result5);

      



$user_home = new USER(); 

 if($user_home->is_logged_in()!="" && $_SESSION['type'] == '2' && $pra3[teacher_id] == $_SESSION[userSession] ) { echo '<a href="lessons_add_info.php?view='.$pra3[id].'" style="background: #f4516c; border: #f4516c; " class="btn-common">EDIT NOW</a>';   }
 if($user_home->is_logged_in()!="" && $_SESSION['type'] == '3'  ) { 
    ?>






















<?php 
 
        $sql3x = "SELECT * FROM products WHERE lesson_id='$pra3[id]' AND active = 1 AND student_id = '$_SESSION[userSession]' ORDER by id DESC";
        $result3x = mysqli_query($connect, $sql3x);
        $pra3x = mysqli_fetch_array($result3x); 


$sql_attachment = "SELECT * FROM products WHERE id='$pra3x[id]' AND comments != ''";
$result_attachment = mysqli_query($connect, $sql_attachment);
$pra_attachment = mysqli_fetch_array($result_attachment);
$rowcount=mysqli_num_rows($result_attachment);

?>
                                    

                                   
 <?php if($pra3[teacher_link] != '' ){ ?>
                                            <a style="background: white;padding: 10px  18px;margin-top: 4px;border-radius: 50px;" href="<?php echo $pra3[teacher_link]; ?>" target="_blank"  > <img src="img/whatsapp2.jpeg" style="width: 100px;margin-top: -5px;"> </a>
<?php } ?>


<?php    if($pra3x[status] == 'Proceed' OR $pra3x[status] == 'PostPay' ) {  ?>

<?php if($rowcount != '' OR $rowcount != '0') { ?><a href="<?php echo getImageUrl($pra_attachment['comments'], $baseURL, $current_page); ?>" target="_blankx"><img src="<?php echo getImageUrl($pra_attachment['comments'], $baseURL, $current_page); ?>" style="max-height: 70px;max-width: 275px;border: 2px solid white;border-radius: 5px;"></a><?php } ?>




<?php if($rowcount != '' OR $rowcount != '0') { ?>
<span style="color: black;border: 2px solid white;display: block;padding: 10px;text-align: center;border-radius: 15px;margin: 20px 0;background: white;">
	We are committed to providing the most effective and reliable service that you have decided to join our class.<br>

	Your slip is being checked. As soon as possible ; We are working to connect you to the class.<br>

	If not contacted within 12 hours, call the following phone numbers<br>

	0777 898 626 / 011 282 9099
</span>
<?php } ?>


       <form action="" method="post" id="form" enctype="multipart/form-data" onsubmit="return confirm('Mention the name and month on the receipt')"  style="display: block;clear: both;padding-top: 0px;float: right;text-align: right;border: 1px solid white;border-radius: 10px;background: white;padding: 0 10px; ">
              <input name="product_id" type="hidden" value="<?php echo $pra3x[id]; ?>">
              <span style="display: inline-table;color: black;display: 10px;margin-top: 12px;text-align: center;line-height: initial; display: none">Upload the class card given to you by Choose File 
or a
Deposit money into the following account and upload the receipt by choosing File</span>
              
              <input name="file" type="file" required="" style=" width: 110px; float: left; height: 28px; color: transparent; border: none; ">
              <input name="receipt_submit" type="submit" value="Upload Slip" style=" height: 28px; ">
               
              
        </form>
<?php  } ?>

                 </div>

                                 <div class="course-features-bottom mt-0 col-lg-6 mb-0" style=" float: right; padding: 0px ">                   

<?php
        $sql = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>      


<?php if($pra3x[status] == 'Proceed' OR $pra3x[status] == 'PostPay' ) { ?>  
<!--<a href="thank_you.php?student_paying_to=<?php echo $pra3x[id]; ?>" target="_blankx" class="small_button btn btn--md register_btn btn-primary" style="background: #fff3ba;border: none;padding: 0 10px;font-weight: bold;font-size: initial;margin-top:20px;">Pay now to Enrol</a>-->


<?php

$hash = '231399';
$hash .= $pra3x[posted_time];
$hash .= number_format($pra3[charge], 2, '.', '');
$hash .= 'LKR';
$hash .= strtoupper(md5('MTY3NzcxODE0MzM2OTc5NTA4ODM2NzM2MDI0MzIzODUxNTQzNTQw'));
$hash = strtoupper(md5($hash));

?>


<?php echo '<form action="https://www.payhere.lk/pay/checkout" method="post">
     <input type="hidden" name="merchant_id" value="231399">    <!-- Replace your Merchant ID --> 
     <input type="hidden" name="return_url" value="https://PlatinumAcademyLMS.com/thank_you.php?done">
     <input type="hidden" name="cancel_url" value="https://PlatinumAcademyLMS.com/thank_you.php?cancel">
     <input type="hidden" name="notify_url" value="https://PlatinumAcademyLMS.com/thank_you2.php?cancel">  
     
     <input type="hidden" name="order_id" value="'.$pra3x[posted_time].'" required="">
     <input type="hidden" name="items" value="PlatinumAcademyLMS.com" required="" >
  
     <input type="hidden" name="first_name" value="'.$pra[userName].'" required="" >
     <input type="hidden" name="last_name" value="PlatinumAcademyLMS.com" required="">
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

   















                                        <?php if($pra3x[status] == 'Paid' OR $pra3x[status] == 'Free' OR $pra3x[status] == 'PostPay' OR $pra3x[status] == 'Institute') { ?>
                                            <?php if($pra3[student_link] != ''){ ?>
                                            <br><a style="color: white;text-align: center;background: #f4516c;padding: 10px 15px;margin-bottom: 10px;font-size: larger;text-transform: uppercase;width: fit-content;display: block;border-radius: 50px;" href="<?php echo $pra3[student_link]; ?>" target="_blank">Join the live ZOOM class</a>
                                            <?php } ?>

 <?php if($pra3x[paid_date] != '' ){ ?>
                                            <a style="color: white;text-align: center;margin: 10px 0;text-transform: uppercase;width: fit-content;display: block;border-radius: 50px;" href="<?php echo $pra3x[paid_date]; ?>" >Join <img src="img/zoom_badge.png" style="width: 100px"> Class</a>
<?php } ?>
                                            
                                            <a style="color: black;text-align: center;background: white ;padding: 1px 20px;margin-top: 0px;font-size: larger;text-transform: uppercase;width: fit-content;display: block;border-radius: 30px;margin-bottom: 20px;line-height: 30px;" href="student_learning_meterials.php?view=<?php echo $pra3[id]; ?>" target="_blank">Record Videos / PDF </a>
                                           
                                           
                                        <?php } ?>




    <form method="post" action=""> <!--<?php if($found == '0') {   ?>thank_you.php<?php } ?>-->
        <input type="hidden" name="product_id" value="<?php echo $pra3['id']; ?>">
        <input type="hidden" name="teacher_id" value="<?php echo $pra3['teacher_id']; ?>">
        <input type="hidden" name="action" value="add_new">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="actual_timex" value="<?php echo time(); ?>">

<?php
        if(mysqli_num_rows($result3x) > 0) { 

                if($pra3x[status] == 'Proceed') { 
                            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #a40573;">Pay Now</p></a>';  
                }
                if($pra3x[status] == 'Paid') { 
                            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #1dc9b7;">Paid</p></a>';  
                }
                if($pra3x[status] == 'Free') { 
                            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #f4516c;">Free Lessson</p></a>';  
                }
                if($pra3x[status] == 'PostPay') { 
                            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #000;">PostPay</p></a>';  
                }
                if($pra3x[status] == 'Institute') { 
                            //echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #000;">PostPay</p></a>';  
                }
       } else { 
                        

                      if($pra3[blocked_by_admin] == '0') { 

                        if($num_rows5 < $pra3[no_of_students]) {  
                                if($found == '1') {   echo '<a href="thank_you.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #a40573;">GO TO CHECKOUT</p></a>';
                                echo '<input class="btn-common" type="submit" name="remove_now" style="min-width: inherit;background: #f4516c;border: #f4516c;font-size: smaller;margin: 0 auto;height: 25px;line-height: inherit;border-radius: 5px;" value="Remove from Cart">'; 
                                  
                                } if($found == '0')  { 

                                  if($pra3[charge] == '0') {      echo '<input class="btn-common" type="submit" name="join_free" style="    min-width: 100%;background: #4CAF50; border: none; color:white;font-size: initial;" value="Request Free">';  } else { 
                                                                    echo '<input class="btn-common" type="submit" name="order_now" style="" value="Apply Now">';
        //echo '<center><img src="https://www.payhere.lk/downloads/images/payhere_short_banner.png" alt="PayHere"></center>';    
         }


                                   
                                    } 
                            } else { echo '<span class="btn btn--md register_btn btn-common"  style="background: #f4516c; border: #f4516c;" >Slots are Finished</span>'; }
                        } 

                      if($pra3[blocked_by_admin] == '1') {  echo '<span class="btn btn--md register_btn btn-common"  style="background: #f4516c; border: #f4516c;" >BLOCKED BY ADMIN</span>'; }
                 }                  
                           
?>   
    </form>
<?php
}  

if(!$user_home->is_logged_in() ) {   
    if($pra3[charge] == '0') {     

        echo '<a href="login.php?view='.$pra3[id].'" style="background: #4CAF50; border: none; color:white;font-size: initial;" class="btn-common">Request Free</a>';  } else { 
        echo '<a href="login.php?view='.$pra3[id].'" style="" class="btn-common">Apply Now</a>'; 
        //echo '<center><img src="https://www.payhere.lk/downloads/images/payhere_short_banner.png" alt="PayHere"></center>'; 
         }


                                    
                                     } 

   ?>



                  </div>


                                 <!-- new code-->






























                              </div>
                           </div>
                        </div>



                        




<?php } ?>


<div style="background: #e1e1e1;margin: 10px;border-radius: 20px;" align="center">
<img class="hide_in_mobile" src="img/pay-min.png" style="width: 50%;border-right: 10px;/* height: 100%; */margin: 0 auto;border-radius: 10px;background: #e1e1e1;margin-bottom: 10px;">
<img class="show_in_mobile" src="img/pay-min.png" style="display:none; width: 100%;border-right: 10px;height: 100%;margin: 0 auto;border-radius: 10px;background: #e1e1e1; margin-bottom: 50px;">
</div>

                     </div>
                  </div>
                  <!--single-tab-->
                  
               </div>
               
            </div>
         </div>
      </div>
   </div>
   <!--course-area end-->

<?php } ?>
















































<?php } ?>










<?php

                                    
                        $new_posted_time = time();
                        $random_number = (rand(10,100));
                        $_SESSION[new_posted_time] = $new_posted_time = $_SESSION[userSession]._.$new_posted_time._.$random_number;


?>
<?php 
                if(!empty($_SESSION["cart_item_new"])) {   
                    foreach($_SESSION["cart_item_new"] as $item) {  

                        if($item[id] != '') {    

if(!isset($_GET[show])) {

        $sql3 = "SELECT * FROM category WHERE  teacher_id='$pra2[userID]' AND date2 between '$current_date' AND '$after_one_year' AND additional_information = '' AND active = 1 GROUP by id ORDER by lesson_date DESC";
        $result3 = mysqli_query($connect, $sql3);
        while( $pra3 = mysqli_fetch_array($result3))  { 
                     $update_sql_posted_time = "UPDATE products SET 
                                    posted_time='$new_posted_time' WHERE student_id='$_SESSION[userSession]' AND active = '1' AND status = 'Proceed' AND lesson_id = '$pra3[id]' 
                                    ";

        }

}
if(isset($_GET[show])) {
        $sql3 = "SELECT * FROM category WHERE  teacher_id='$pra2[userID]' AND date2 between '$current_date' AND '$after_one_year' AND additional_information = '$_GET[show]' AND active = 1 GROUP by id ORDER by lesson_date DESC";
        $result3 = mysqli_query($connect, $sql3);
        while( $pra3 = mysqli_fetch_array($result3))  { 
                     $update_sql_posted_time = "UPDATE products SET 
                                    posted_time='$new_posted_time' WHERE student_id='$_SESSION[userSession]' AND active = '1' AND status = 'Proceed' AND lesson_id = '$pra3[id]' 
                                    ";

        }

}


                                    



                                    $results_update_sql_posted_time = mysqli_query($connect, $update_sql_posted_time);
                                    //echo '<br>';
                        }

                    }
                }

?>



    <div style="height: 100px"></div>
<?php

$hash = '216178';
$hash .= $_SESSION[new_posted_time];
$hash .= number_format($total_amount, 2, '.', '');
$hash .= 'LKR';
$hash .= strtoupper(md5('MzUxNzMxNjYyNzI0NzgxOTc5MDgxOTk5ODQzMzA1MTk0NDY3MzM2Nw=='));
$hash = strtoupper(md5($hash));

?>

<?php if($total_amount != '') { ?>
    <?php echo '<form action="https://www.payhere.lk/pay/checkout" method="post" >
         <input type="hidden" name="merchant_id" value="216178"> 
         <input type="hidden" name="return_url" value="https://Samatha.lk/thank_you_new.php?done">
         <input type="hidden" name="cancel_url" value="https://Samatha.lk/thank_you_new.php?cancel">
         <input type="hidden" name="notify_url" value="https://Samatha.lk/thank_you2.php?cancel">  
         
         <input type="hidden" name="order_id" value="'.$_SESSION[new_posted_time].'" required="">
         <input type="hidden" name="items" value="Samatha.lk" required="" >
      
         <input type="hidden" name="first_name" value="'.$pra[userName].'" required="" >
         <input type="hidden" name="last_name" value="Samatha.lk" required="">
         <input type="hidden" name="email" value="'.$pra[userEmail].'" required="">
         <input type="hidden" name="phone" value="'.$pra[mobile].'" required="" >
         <input type="hidden" name="address" value="'.$pra[location].'"  required="" >
         <input type="hidden" name="city" value="'.$pra[batch].'" required="" >
         <input type="hidden" name="currency" value="LKR" >
         
         <input type="hidden" name="hash" value="'.$hash.'">
         <input type="hidden" name="amount" value="'.$total_amount.'" required="">
         <input type="hidden" name="country" value="Sri Lanka"> 

         <input class="small_button btn btn--md register_btn btn-primary" style="background: #fff3ba;border: none;width: 100%;font-weight: bold;font-size: x-large;margin:0px;line-height: normal;padding: 10px 20px;text-overflow: ellipsis;white-space: break-spaces;overflow: initial;height: min-content;border-radius: 25px 25px 0 0;bottom: 0;position: fixed;z-index: 999999; display: none" type="submit" name="submit_pay_online" value="PAY '.$total_amount.' NOW - ONLINE">

    </form>'; ?>
<?php } ?>







<style> .collapsible + .row { display: none; } </style>




    <script>
        function setupCollapsible(collapsibleClass, contentClass) {
            var coll = document.getElementsByClassName(collapsibleClass);

            for (var i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    console.log(collapsibleClass + " clicked");

                    // Close all other collapsibles at the same level
                    for (var j = 0; j < coll.length; j++) {
                        if (coll[j] !== this) {
                            coll[j].classList.remove("active");
                            coll[j].nextElementSibling.style.display = "none";
                            console.log("Closed " + collapsibleClass + " index: " + j);
                        }
                    }

                    // Toggle the clicked collapsible
                    this.classList.toggle("active");
                    var content = this.nextElementSibling;
                    if (content.style.display === "contents") {
                        content.style.display = "none";
                        console.log("Closing clicked " + collapsibleClass);
                    } else {
                        content.style.display = "contents";
                        console.log("Opening clicked " + collapsibleClass);
                    }
                });
            }
        }

        // Setup main collapsibles
        setupCollapsible("collapsible", "row");

        // Setup nested collapsibles
        setupCollapsible("nested-collapsible", "nested-content");
    </script>




   
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   <!-- modernizr js -->
   <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
   <!-- jquery-3.3.1 version -->
   <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
   <!-- jquery-migrate-3.0.0.min.js version -->
   <script src="assets/js/vendor/jquery-migrate-3.0.0.min.js"></script>
   <!-- bootstra.min js -->
   <script src="assets/js/bootstrap.min.js"></script>
   <!-- jquery-ui.min js -->
   <script src="assets/js/jquery-ui.min.js"></script>
   <!-- mmenu js -->
   <script src="assets/js/jquery.mmenu.js"></script>
   <!---venobox-js-->
   <script src="assets/js/venobox.min.js"></script>
   <!---slick-js-->
   <script src="assets/js/slick.min.js"></script>
   <!---counterup-js-->
   <script src="assets/js/jquery.counterup.min.js"></script>
   <!---waypoints-js-->
   <script src="assets/js/waypoints.js"></script>
   <!-- jquery.countdown js -->
   <script src="assets/js/jquery.countdown.min.js"></script>
   <!---isotop-js-->
   <script src="assets/js/isotope.pkgd.min.js"></script>
   <!---letteranimation-js-->
   <script src="assets/js/letteranimation.min.js"></script>
   <!-- plugins js -->
   <script src="assets/js/plugins.js"></script>
   <!-- main js -->
   <script src="assets/js/main.js"></script>
   
   <!-- Modal -->
   <?php modal(); ?>
  
</body>
</html>
