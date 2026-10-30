
<?php 
    include 'functions/main.functions.php'; 
    $user_login = new USER();
?>

<?php

if($user_login->is_logged_in()!="")
{
    if($_SESSION['type'] == '1') { $user_login->redirect('login.php'); }
    if($_SESSION['type'] == '2') { $user_login->redirect('teachers_add_lesson.php'); }
}


?>

<?php


if(isset($_GET[remove])) { 
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["remove"] == $_SESSION["cart_item"][$k]['id']) {
                                unset($_SESSION["cart_item"][$k]);      
                            }
                    }
                }   
} 





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
                
            break;
            
        }
        }




}





?>

<?php 
$redirect_1 = '0';      $redirect_2 = '0';      $redirect_3 = '0';      $redirect_4 = '0';
if(!isset($_GET["student_paying_to"])) {  $redirect_1 = 'redirect_1'; }
if(!isset($_SESSION["cart_item"])) {  $redirect_2 = 'redirect_2'; }
if(!isset($_GET["done"])) {  $redirect_3 = 'redirect_3'; }
if(!isset($_GET["cancel"])) {  $redirect_4 = 'redirect_4'; }

//echo $redirect_1; echo $redirect_2;
//if(!isset($_SESSION["cart_item"]) OR !isset($_GET["student_paying_to"]) ){ $user_login->redirect('students_cart.php'); }  

if($redirect_1 == 'redirect_1' AND $redirect_2 == 'redirect_2' AND $redirect_3 == 'redirect_3' AND $redirect_4 == 'redirect_4') { $user_login->redirect('students_cart.php'); }  



?>

<?php //if(empty($_SESSION["cart_item"])) {  $user_login->redirect('select_your_teacher.php');  } ?>

<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Thank you for the Order - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>



</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;background-image: url('img/bg2.jpg');/*background-attachment: fixed; */
    background-image: linear-gradient(#f3f3f3, #ffffffd6);
    background-position: inherit">
                            <div class="content-wrapper">
                                <div class="container">
                                    <div class="row">
                                    
<?php  if(!isset($_GET['done']) && !isset($_GET['cancel'])  ) {  ?>
                                        
                                            <div class="col-md-12 col-lg-12">
                                                <div class="p-top-0 p-bottom-20" style="display:none">
                                                    
                                                    
                                                   
                                                        <a href="select_your_teacher.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; ">Add <strong>Another Session</strong></a>
                                                        <a href="select_your_teacher.php" class="btn btn--md register_btn btn-primary" style=" background: #000; border: #f4516c;line-height: inherit;  float:right;   padding: 10px 20px; ">Go <strong>Back</strong></a>
                                                        
                                                       
                                                    </div>
                                                    <div align="center"> <img src="img/PleaseWait.gif"> </div>
                                                     <meta http-equiv="refresh" content="0; URL='https://<?php echo $actual_domain_without_http; ?>/students_cart_activate.php'" /> 

                                                </div>
                                            </div><!-- end .col-md-12 --> 
<?php } ?>                                            


                                    </div>
                                </div>
                <div class="container featured-products2  p-top-10 p-bottom-120" >
                            




<div class="row" >
    <div class="col-lg-2 col-md-12 p-top-20"></div>
    <div class="col-lg-8 col-md-12 p-top-20">

<?php    if (isset($_GET['done']) ){
    
    
echo '<p style="    text-align: center;font-size: large;color: white;padding-top: 20px;border-radius: 10px;background: #1dc9b7;border: #f4516c;"> Thank you '.$_SESSION['userName'].',  <br><br> <span style=" font-size: larger; ">   We Received your Payment</span><br><br> You are successfully enrolled now. <br><br>
Thank  you for the agreement on student / learner terms and conditions. <br><br>
Please check  My Page to check the status of your program enrollment.<br><br> Enjoy learning with '.$site_website_name.'. <br> <br>If you need help, please use our web chat or Email to '.$site_info_mail_address.'<br><br></p>';

      

    $sql_paid = "UPDATE products SET status='Paid', paid_marked_by = 'Online' WHERE posted_time='$_GET[order_id]'";
    //mysqli_query($connect, $sql_paid);  
        unset($_SESSION["cart_item"]);  }      ?>

<?php    if (isset($_GET['cancel']) ){
echo '<p style="    text-align: center;font-size: large;color: white;padding-top: 20px;border-radius: 10px;background: #f4516c;border: #f4516c;"> Sorry '.$_SESSION['userName'].',  <br><br> <span style=" font-size: larger; ">   We could not Receive your Payment</span><br><br>Please check  My Page to check the status of your program enrollment.<br><br> Enjoy learning with '.$site_website_name.'. <br> <br>If you need help, please use our web chat or Email to '.$site_info_mail_address.'<br><br></p>'; }  ?>

    </div>
</div>
                            





<?php   if(!empty($_SESSION["cart_item"])) {  ?>
<div class="row" style="display:none">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>

<?php 
                                foreach($_SESSION["cart_item"] as $item) {  
                                    
?>
<?php 
        $sql_cart = "SELECT * FROM category WHERE id= '$item[id]' AND active = 1";
        $result_cart = mysqli_query($connect, $sql_cart);
        $pra_cart = mysqli_fetch_array($result_cart);
        $row_cart = mysqli_num_rows($result_cart); 




?>

                                <tr>
                                    <td>
                                        <div class="cart-product-thumb">
                                            <a href="lessons.php?view=<?php echo $pra_cart[id]; ?>">
                                                  <?php if( $pra_cart[cover_page] == '') { ?>
                                                                    <img style=" max-width: 150px; margin-left: 10px; border-radius: 10px; " src="https://afmec.org/images/no-image-available-icon.jpg" alt="" />
                                                  <?php } ?>
                                                  <?php if( $pra_cart[cover_page] != '') { ?>
                                                                    <img style=" max-width: 150px; margin-left: 10px; border-radius: 10px; " src="<?php echo getImageUrl($pra_cart['cover_page'], $baseURL, $current_page); ?>" alt="" />
                                                  <?php } ?>
                                            </a>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="cart-product-name">
                                            <h5><a href="lessons.php?view=<?php echo $pra_cart[id]; ?>"><?php echo $pra_cart[name_of_class]; ?></a></h5>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="cart-product-price"><?php echo $pra_cart[charge]; $total_charges += $pra_cart[charge]; ?> <?php echo $pra_cart[currency]; ?></span>
                                    </td>
                                    <td>
                                        <div class="product-remove">
                                            <a href="?remove=<?php echo $pra_cart[id]; ?>">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
<?php }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php } ?>













                            <div class="row" style="display:none">
                         
                                
                                <div class="col-lg-2 col-md-12 p-top-80"></div>
                                <div class="col-lg-8 col-md-12 p-top-80">
                                    
                    
                        
                    
                    
                        
                    

                    
                        <div class="cardify signup_form">
                            <!-- end .login_header -->


<div class="login--header" style=" border-bottom: none; "> 





<p style=" font-size: large; color: black; ">

<?php 

    if (isset($_GET['student_paying_to'])){

        $sql_x_old = "SELECT * FROM products WHERE id='$_GET[student_paying_to]'";
        $result_x_old = mysqli_query($connect, $sql_x_old);
        $pra_x_old = mysqli_fetch_array($result_x_old);
        $time = time();
        //$new_posted_time = $pra_x_old[posted_time]._.$time;
          $new_posted_time = $_GET[student_paying_to]._.$time;
    $sql_paid = "UPDATE products SET posted_time='$new_posted_time' WHERE id='$_GET[student_paying_to]'";
    mysqli_query($connect, $sql_paid);

       $sql_x = "SELECT * FROM products WHERE id='$_GET[student_paying_to]'";
        $result_x = mysqli_query($connect, $sql_x);
        $pra_x = mysqli_fetch_array($result_x);

        $sql = "SELECT * FROM tbl_users WHERE userID='$pra_x[student_id]'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

        $sql2 = "SELECT * FROM category WHERE id='$pra_x[lesson_id]'";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);






if(!isset($_GET['done']) && !isset($_GET['cancel'])  ) { 


        $sql2_mail = "SELECT * FROM category WHERE id='$item[id]'";
        $result2_mail = mysqli_query($connect, $sql2_mail);
        $pra2_mail = mysqli_fetch_array($result2_mail);

        $sql_mail = "SELECT * FROM tbl_users WHERE userID='$pra2_mail[teacher_id]'";
        $result_mail = mysqli_query($connect, $sql_mail);
        $pra_mail = mysqli_fetch_array($result_mail);



     
        $sql_new = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result_new = mysqli_query($connect, $sql_new);
        $pra_new = mysqli_fetch_array($result_new);

                $to = '$pra_new[userEmail]';
                $subject = 'New Lesson Enrolled - '.$site_website_name.' ('.$pra_new[userID].') ';
                $message = '

Dear '.$_SESSION[userName].',  <br><br>
You are successfully enrolled for '.$pra2_mail[name_of_class].' <br><br>
Thank you for the agreement on student / learner terms and conditions.<br><br>
Please check My Page to check the status of your program enrollment.<br><br>

Enjoy learning with '.$site_website_name.'.<br><br>
If you need help, please use our web chat or emal to '.$site_info_mail_address.'
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
Please check My Dash Board by login to your account to check the status of your program. <br><br>

Enjoy teaching with '.$site_website_name.'. <br><br>
If you need help, please use our web chat or emal to '.$site_info_mail_address.' <br><br>
                            ';
                $from2 = $site_info_mail_address;
                $headers2 = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
                $headers2 .= "From:" . $from2;
                mail($to2,$subject2,$message2,$headers2);

            

 } 


                        echo '
<form action="https://www.payhere.lk/pay/checkout" method="post" style="'.$site_payhere.'">
     <input type="hidden" name="merchant_id" value="'.$site_payhere_merchant_id.'">    <!-- Replace your Merchant ID --> 
     <input type="hidden" name="return_url" value="https://'.$actual_domain_without_http.'/thank_you.php?done">
     <input type="hidden" name="cancel_url" value="https://'.$actual_domain_without_http.'/thank_you.php?cancel">
     <input type="hidden" name="notify_url" value="https://'.$actual_domain_without_http.'/thank_you.php?cancel">  
     
     <input type="hidden" name="order_id" value="'.$pra_x[posted_time].'" required="">
     <input type="hidden" name="items" value="'.$site_website_name.'" required="" >
  
     <input type="hidden" name="first_name" value="'.$pra[userName].'" required="" >
     <input type="hidden" name="last_name" value="'.$site_website_name.'" required="">
     <input type="hidden" name="email" value="'.$pra[userEmail].'" required="">
     <input type="hidden" name="phone" value="'.$pra[mobile].'" required="" >
     <input type="hidden" name="address" value="'.$pra[school].'"  required="" >
     <input type="hidden" name="city" value="'.$pra[batch].'" required="" >
     <input type="hidden" name="currency" value="LKR" >
     <input type="hidden" name="amount" value="'.$pra2[charge].'" required="">
     <input type="hidden" name="country" value="Sri Lanka"> 

     <input type="text" class="text_field" placeholder="" name="paying_amount" readonly="" style="margin-bottom: 20px;font-size: xx-large;font-weight: bold;width: 200px;color: black;text-align: center;" value="'.$pra2[charge].'">
     <input class="btn btn--md register_btn btn-primary" style="background: #529e2f;border: #529e2f;margin-bottom: 20px;padding: 0 10px;font-size: initial;font-weight: bold;" type="submit" name="submit_pay_online" value="GO TO ONLINE PAYMENT">

</form>

                        
                        
                ';

            }
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







    //if (isset($_POST['proceed_to_deposit'])){
    echo '<p style="font-size: initial; color: black;">';    echo '
                       
                           
Dear '.$_SESSION[userName].' <br><br>
You are successfully enrolled for '.$pra2_mail[name_of_class].' <br><br>
Thank  you for the agreement on student / learner terms and conditions. <br><br>
Please check  My Page to check the status of your program enrollment.<br><br>

Enjoy learning with '.$site_website_name.'.<br><br>
If you need help, please use our web chat or emal to '.$site_info_mail_address.'

                ';      echo '</p>';
    //}
    

    //if (isset($_POST['order_now'])){


if(!isset($_GET['done']) && !isset($_GET['cancel'])  ) { 

    } 


        echo '
                        

<form action="students_cart_activate.php" method="post" style="   float: left;">
    <input  class="btn btn--md register_btn btn-primary" style="background: #f4516c;border: #f4516c;margin-bottom: 20px;padding: 0 10px;font-size: initial;font-weight: bold;" type="submit" name="proceed_to_deposit" value="BANK DEPOSIT / TRANSFER">
</form>




<form action="https://www.payhere.lk/pay/checkout" method="post" style="'.$site_payhere.'">
     <input type="hidden" name="merchant_id" value="'.$site_payhere_merchant_id.'">    <!-- Replace your Merchant ID --> 
     <input type="hidden" name="return_url" value="https://'.$actual_domain_without_http.'/thank_you.php?done">
     <input type="hidden" name="cancel_url" value="https://'.$actual_domain_without_http.'/thank_you.php?cancel">
     <input type="hidden" name="notify_url" value="https://'.$actual_domain_without_http.'/thank_you.php?cancel">  
     
     <input type="hidden" name="order_id" value="'.$time.'" required="">
     <input type="hidden" name="items" value="'.$site_website_name.'" required="" >
  
     <input type="hidden" name="first_name" value="'.$pra[userName].'" required="" >
     <input type="hidden" name="last_name" value="'.$site_website_name.'" required="">
     <input type="hidden" name="email" value="'.$pra[userEmail].'" required="">
     <input type="hidden" name="phone" value="'.$pra[mobile].'" required="" >
     <input type="hidden" name="address" value="'.$pra[school].'"  required="" >
     <input type="hidden" name="city" value="'.$pra[batch].'" required="" >
     <input type="hidden" name="currency" value="LKR" >
     <input type="hidden" name="amount" value="'.$total_charges.'" required="">
     <input type="hidden" name="country" value="Sri Lanka"> 

     <input type="text" class="text_field" placeholder="" name="paying_amount" readonly="" style="margin-bottom: 20px;font-size: xx-large;font-weight: bold;width: 200px;color: black;text-align: center;" value="'.$total_charges.'">
     <input class="btn btn--md register_btn btn-primary" style="background: #529e2f;border: #529e2f;margin-bottom: 20px;padding: 0 10px;font-size: initial;font-weight: bold;" type="submit" name="submit_pay_online" value="GO TO ONLINE PAYMENT">

</form>

                        
                        
                ';
    //}    
                
        }



    }
?>


</p> </div>


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