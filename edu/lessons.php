<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>

<?php 
        $sql = "SELECT * FROM category WHERE id= '$_GET[view]' AND active = 1";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result); 

?>

<?php
        $sql2 = "SELECT * FROM tbl_users WHERE userID=$pra[teacher_id] and userStatus = 'Y' ";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);

        $row2 = mysqli_num_rows($result2); 
?>









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


             $result = mysqli_query($connect, "INSERT INTO products VALUES (NULL, '$_SESSION[userSession]',  '$pra_get[id]', '$pra_get[teacher_id]', '$time', '$date', 'Free', '', '', '', '', '1', '' )");

?><meta http-equiv="refresh" content="0; URL='https://<?php echo $actual_domain_without_http; ?>/students_cart_activate.php'" /> <?php 
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


            $result = mysqli_query($connect, "INSERT INTO products VALUES (NULL, '$_SESSION[userSession]',  '$_POST[product_id]', '$_POST[teacher_id]', '$time', '$date', 'Free', '', '', '', '', '1', '' )");

?><meta http-equiv="refresh" content="0; URL='https://<?php echo $actual_domain_without_http; ?>/students_cart_activate.php'" /> <?php 
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


            $result = mysqli_query($connect, "INSERT INTO products VALUES (NULL, '$_SESSION[userSession]',  '$_POST[product_id]', '$_POST[teacher_id]', '$time', '$date', 'Free', '', '', '', '', '1', '' )");

?><meta http-equiv="refresh" content="0; URL='https://<?php echo $actual_domain_without_http; ?>/students_cart_activate.php'" /> <?php 
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


            $result = mysqli_query($connect, "INSERT INTO products VALUES (NULL, '$_SESSION[userSession]',  '$item[id]', '$item[teacher_id]', '$time', '$date', 'Proceed', '', '', '', '', '1', '' )");

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
<meta http-equiv="refresh" content="0; URL='https://<?php echo $actual_domain_without_http; ?>/students_cart_activate.php'" />

  <?php  }
?>




<?php 
        $sql = "SELECT * FROM category WHERE id= '$_GET[view]' AND active = 1";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result); 

?>


<!doctype html>
<html class="no-js" lang="zxx">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title><?php echo $pra[name_of_class]; ?> - <?php echo $site_title; ?></title>
   <?php metas(); ?>
   <!-- Go to www.addthis.com/dashboard to customize your tools -->
   <!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-587a4d67086e8205"></script>-->


<style type="text/css">
    .course-features-bottom .btn-common  { height: inherit; line-height: inherit; padding: 10px 20px; }
</style>
</head>

<body>
   <!--[if lte IE 9]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end-->
   
   








<?php

        if($row2 == '' OR $row2 == '0' ) { echo '
               <div class="textblock-area pt-30">
                        <div class="section-title text-center">
                           <h2 >Sorry, We cant find Lecturer</h2>
                        </div>
               <div class="container textblock-inner">

               
             <p>Please contact '.$site_website_name.'</p>



               </div>
            </div>

         ';}
         if($row2 != '' OR $row2 != '0' ) { 

?>

<?php

        if($row == '' OR $row == '0' ) { echo '
               <div class="textblock-area pt-30">
                        <div class="section-title text-center">
                           <h2 >Sorry, We cant find Lesson</h2>
                        </div>
               <div class="container textblock-inner">

               
             <p>Please contact '.$site_website_name.'</p>



               </div>
            </div>

         ';}
         if($row != '' OR $row != '0' ) { 

?>



   <!--page-banner-area start-->
   <div class="page-banner height-200x bg-1">
      <div class="d-table" style=" max-height: 100px; ">
         <div class="page-title vertical-middle text-center">
            <h2 style="line-height: normal;"> <br><?php echo $pra[name_of_class]; ?>
            <br><br><span style="  font-size: initial; height: 110px; display: inline-block; overflow: auto;    width: 100%;"><?php echo $pra[description]; ?> </span></h2>
         </div>
      </div>
   </div>
   <!--page-banner-area end-->
   
   <!--breadcrumb-area start-->
   <div class="breadcrumb-area mt-25">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="site-breadcrumb">
                  <ul class="list-none">
                     <li><a href="index.php">Home</a></li>
                     <li><i class="fa fa-angle-right"></i></li>
                     <li><?php echo $pra[name_of_class]; ?></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--breadcrumb-area end-->
   
   <!--course-details start-->
   <div class="course-details-area mt-80">
      <div class="container">
         <div class="row">
            <div class="col-lg-8">
               <div class="course-details mb-40">
                  <h2><?php echo $pra[name_of_class]; ?></h2>
                  <div class="course-info mt-25 mb-50">
                     <ul class="list-none">
                        <li>
                              <i class="fa fa-calendar-o"></i>
                              <?php echo $pra[lesson_date]; ?>
                           <small><?php echo $pra[lesson_time]; ?></small>
                        </li>
                        <li>
                              <i class="fa fa-calendar-o"></i>
                              <?php echo $pra[date2]; ?>
                           <small><?php echo $pra[time2]; ?></small>
                        </li>
                        
                     </ul>
                  </div>

                  <?php if( $pra[large_flyer] == '') { ?>
                                    <img src="https://afmec.org/images/no-image-available-icon.jpg" class="mb-40" style="border-radius: 10px;" />
                  <?php } ?>
                  <?php if( $pra[large_flyer] != '') { ?>
                                    <img src="<?php echo getImageUrl($pra['large_flyer'], $baseURL, $current_page); ?>" class="mb-40" style="border-radius: 10px;" />
                  <?php } ?>


<?php if($pra[content_of_the_program]) {  ?>
                  <h3>Content of the Program</h3>
                  <p><?php echo $pra[content_of_the_program]; ?></p>
<?php } ?>

<?php if($pra[course_objectives]) {  ?>

                  <h3>Course Objectives</h3>
                  <p><?php echo $pra[course_objectives]; ?></p>
<?php } ?>

<?php if($pra[target_audience_full]) {  ?>
                  
                  <h3>Target Audience</h3>
                  <p><?php echo $pra[target_audience_full]; ?></p>
<?php } ?>

<?php if($pra[additional_information_full]) {  ?>
                  <h3>Additional Information</h3>
                  <p><?php echo $pra[additional_information_full]; ?></p>
<?php } ?>

<?php if($pra[youtube_link]) {  ?>
                  <h3>Video Introduction</h3>
                  <p><iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $pra[youtube_link]; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>
<?php } ?>

<?php if($pra[brochure]) {  ?>
                  <h3>Brouchure</h3>
                  <a href="<?php echo getImageUrl($pra['brochure'], $baseURL, $current_page); ?>" target="_blank" style="background: #f4516c; border: #f4516c; " class="btn-common">Download</a>
<?php } ?>
                 
               </div>
            
               
            </div>
            <div class="col-lg-4">
               <!--course-features-->
               <div class="course-features mt-sm-40 text-center">
                  <ul class="list-none">
                     <li>
                        <span>Course fee</span>
                        <span class="course-price"><?php echo $pra[charge]; ?> <?php echo $pra[currency]; ?></span>
                     </li>
                     <?php if ($pra[partial_payment] == '1' ) { ?>
                     <?php if ($pra[complete_payment] != '' OR $pra[complete_payment] != '0' ) { ?>
                      <li style=" background: #df0000; padding: 10px; border-radius: 5px; ">
                        <span style=" color: white; ">Complete fee</span>
                        <span class="course-price" style="font-size: initial;color: white;"><?php echo $pra[complete_payment]; ?> <?php echo $pra[currency]; ?></span>
                     </li>
                     <?php } ?>
                     <?php } ?>
                     
                     <!--
                     <li>
                        <span><i class="fa fa-folder-open"></i>Program Type</span>
                        <span><?php echo $pra[type_of_programe]; ?></span>
                     </li>
                     <li>
                        <span><i class="fa fa-flag"></i>Target Audience</span>
                        <span><?php echo $pra[target_audience]; ?></span>
                     </li>
                     <li>
                        <span><i class="fa fa-pencil"></i>Batch Size</span>
                        <span><?php echo $pra[no_of_students]; ?></span>
                     </li>-->
                  </ul>
                  <div class="course-features-bottom mt-30">


<?php
        $sql2x = "SELECT * FROM category WHERE active = 1 AND id = '$_GET[view]'  ORDER by lesson_date ASC";
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
                                                                                                                        

        $sql5 = "SELECT * FROM products WHERE lesson_id=$pra[id] AND active = 1 AND status = 'Paid' OR lesson_id=$pra[id] AND active = 1 AND status = 'Free' OR lesson_id=$pra[id] AND active = 1 AND status = 'PostPay'  ORDER by id DESC";
        $result5 = mysqli_query($connect, $sql5);      $num_rows5 = mysqli_num_rows($result5);

      



$user_home = new USER(); 

 if($user_home->is_logged_in()!="" && $_SESSION['type'] == '2' && $pra[teacher_id] == $_SESSION[userSession] ) { echo '<a href="lessons_add_info.php?view='.$pra[id].'" style="background: #f4516c; border: #f4516c; " class="btn-common">EDIT NOW</a>';   }
 if($user_home->is_logged_in()!="" && $_SESSION['type'] == '3'  ) { 
    ?>
    <form method="post" action=""> <!--<?php if($found == '0') {   ?>thank_you.php<?php } ?>-->
        <input type="hidden" name="product_id" value="<?php echo $pra['id']; ?>">
        <input type="hidden" name="teacher_id" value="<?php echo $pra['teacher_id']; ?>">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="actual_timex" value="<?php echo time(); ?>">

<?php
                            
 
        $sql3 = "SELECT * FROM products WHERE lesson_id='$pra[id]' AND active = 1 AND student_id = '$_SESSION[userSession]' ORDER by id DESC";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3); 
        if(mysqli_num_rows($result3) > 0) { 

                if($pra3[status] == 'Proceed') { 
                            echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #a40573;">ගෙවීම් කරන්න</p></a>';  
                }
                if($pra3[status] == 'Paid') { 
                            echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #1dc9b7;">මුදල් ගෙවා  ඇත</p></a>';  
                }
                if($pra3[status] == 'Free') { 
                            echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #f4516c;">Free පන්තිය</p></a>';  
                }
                if($pra3[status] == 'PostPay') { 
                            echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #000;">PostPay</p></a>';  
                }
                if($pra3[status] == 'Institute') { 
                            echo '<a href="students_cart_activate.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #000;">Institute</p></a>';  
                }
       } else { 
                        

                      if($pra[blocked_by_admin] == '0') { 

                        if($num_rows5 < $pra[no_of_students]) {  
                                if($found == '1') {   echo '<a href="thank_you.php"><p class="btn btn--md register_btn btn-common" style="color: white;border: none;background: #a40573;">GO TO CHECKOUT</p></a>';
                                echo '<input class="btn-common" type="submit" name="remove_now" style="min-width: inherit;background: #f4516c;border: #f4516c;font-size: smaller;margin: 0 auto;height: 25px;line-height: inherit;border-radius: 5px;" value="Remove from Cart">'; 
                                  
                                } if($found == '0')  { 

                                  if($pra[charge] == '0') {      echo '<input class="btn-common" type="submit" name="join_free" style="    min-width: 100%;background: #4CAF50; border: none;" value="පන්ති නොමිලේ ඉල්ලුම් කරන්න">';  } else { 
                                                                    echo '<input class="btn-common" type="submit" name="order_now" style="    min-width: 100%;" value="පන්ති ඉල්ලුම් කරන්න">';    }


                                   
                                    } 
                            } else { echo '<span class="btn btn--md register_btn btn-common"  style="background: #f4516c; border: #f4516c;" >Slots are Finished</span>'; }
                        } 

                      if($pra[blocked_by_admin] == '1') {  echo '<span class="btn btn--md register_btn btn-common"  style="background: #f4516c; border: #f4516c;" >BLOCKED BY ADMIN</span>'; }
                 }                  
                           
?>   
    </form>
<?php
}  

if(!$user_home->is_logged_in() ) {   
    if($pra[charge] == '0') {     

        echo '<a href="login.php?view='.$pra[id].'" style="background: #4CAF50; border: none;" class="btn-common">පන්ති නොමිලේ ඉල්ලුම් කරන්න</a>';  } else { 
        echo '<a href="login.php?view='.$pra[id].'" style="" class="btn-common">පන්ති ඉල්ලුම් කරන්න</a>';   }


                                    
                                     } 

   ?>
                     <p>Enroll until  <?php echo $pra[date2]; ?></p>
                  </div>
               </div>
               <!--course-author-->
               




               <!--author-bio-->
               <div class="author-bio text-center mt-50">
                  <h3><?php echo $pra2[userName]; ?></h3>
                  <small><?php echo $pra2[grade]; ?></small>

                  <?php if( $pra2[p_picture] == '') { ?>
                  <a href="lecture.php?view=<?php echo $pra2[userID]; ?>"><img src="source_files/logo.png" style="width: 75%;margin: 0 auto;display: block; border-radius: 0px;"></a>
                  <?php } ?>
                  <?php if( $pra2[p_picture] != '') { ?>
                  <a href="lecture.php?view=<?php echo $pra2[userID]; ?>"><img src="<?php echo getImageUrl($pra2['p_picture'], $baseURL, $current_page); ?>" style="max-width: 100%; margin: 0 auto; display: block;"></a>
                  <?php } ?>

                  <p><?php echo $pra2[selected_medium]; ?></p>



                  
               </div>
               
              
            </div>
         </div>
      </div>
   </div>
   <!--course-details end-->
















   <!--course-area start-->
   <div class="course-area mt-70">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               
               <div class="tab-content">
                  <!--single-tab-->
                  <div id="grid-products" class="tab-pane fade in show active">
                     <div class="row">
                     
<?php 
        $sql3 = "SELECT * FROM category WHERE teacher_id= '$pra2[userID]' AND active = 1 ORDER by ID desc LIMIT 6";
        $result3 = mysqli_query($connect, $sql3);
        while( $pra3 = mysqli_fetch_array($result3))  { 
        

?>

<?php
        $sql4 = "SELECT * FROM tbl_users WHERE userID=$pra3[teacher_id]";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);

?>

                        
                        <div class="col-lg-4 col-sm-6">
                           <div class="course-single mb-30">


                              <div class="course-thumb">
                                 <a href="lessons.php?view=<?php echo $pra3[id]; ?>">
                  <?php if( $pra3[cover_page] == '') { ?>
                                    <img src="https://afmec.org/images/no-image-available-icon.jpg" alt="" />
                  <?php } ?>
                  <?php if( $pra3[cover_page] != '') { ?>
                                    <img src="<?php echo getImageUrl($pra3['cover_page'], $baseURL, $current_page); ?>" alt="" />
                  <?php } ?>
                                 </a>
                              </div>
                              <div class="course-info">
                                 <div class="author-info">
                                    <div class="author-name">

                  <?php if( $pra4[p_picture] == '') { ?>
                  <img src="source_files/favicon.png" style="margin: 0 auto;display: block; border-radius: 0px; height: auto;">
                  <?php } ?>
                  <?php if( $pra4[p_picture] != '') { ?>
                  <img src="<?php echo getImageUrl($pra4['p_picture'], $baseURL, $current_page); ?>" style="margin: 0 auto;display: block; max-height: 100px; border-radius: 10px; ">
                  <?php } ?>



                                       <a href="lecture.php?view=<?php echo $pra4[userID]; ?>"><?php echo $pra4[userName]; ?></a>
                                       <small><?php echo $pra4[grade]; ?></small>
                                    </div>
                                    <div class="course-price text-right">
                                       <h5><?php echo $pra3[charge]; ?> <?php echo $pra3[currency]; ?></h5>
                                    </div>
                                 </div>
                                 <div class="course-text mt-10">
                                    <h3><a href="lessons.php?view=<?php echo $pra3[id]; ?>"><?php echo $pra3[name_of_class]; ?></a></h3>
                                    <p><?php echo $pra3[description]; ?></p>
                                 </div>
                              </div>
                              <div class="course-meta">
                                 <a href="lessons.php?view=<?php echo $pra3[id]; ?>"><i class="fa fa-calendar"></i><?php echo $pra3[lesson_date]; ?></a>
                                 <a href="lessons.php?view=<?php echo $pra3[id]; ?>"><i class="fa fa-user"></i><?php echo $pra3[no_of_students]; ?> Students</a>
                              </div>
                           </div>
                        </div>
<?php } ?>



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










   
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>
