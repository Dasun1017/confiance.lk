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
    if($_SESSION['type'] == '1' OR $_SESSION['type'] == '2' ) { $user_login->redirect('login.php'); }
}

?>
<?php
        $sql = "SELECT * FROM tbl_users WHERE type='2' AND userID = '$_GET[teacher_id]' AND userStatus = 'Y'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);


        if(mysqli_num_rows($result) > 0) { } else { $user_home->redirect('select_your_teacher.php'); } 

?> 


<?php 

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

                    $sql = "UPDATE products SET comments='$fname' WHERE id=$_POST[product_id]";
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
    //echo '<pre>';
    //var_dump($_SESSION);
    //echo '</pre>';
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
    <title>List of Classes - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
    
    
<style>
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


</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;">
                            <div class="content-wrapper">
                                <div class="container">
                                    <div class="row">
                                   

                                        
                                            <div class="col-md-12 col-lg-12">
                                                <div class="p-top-0 p-bottom-20">
                                                    <h2 style="background: white; margin:0px; height: 20px;border-radius: 5px 5px 5px 0;"></h2>
                                                    
                                                    <div style="background: white;border: none;width: fit-content;float: left; border-radius: 0 0 5px 5px">
                                                        
                                                        <h3 style="text-align: center;line-height: initial;height: 45px;padding: 10px;font-size: initial; ">
                                                        <a href="select_your_teacher.php" style="color: #000">The Tutory</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div><!-- end .col-md-12 -->


                                    </div>
                                </div>
                <div class="container featured-products2  p-top-0 p-bottom-120">
                            






                            











                            <div class="row">
                              



<div class="col-lg-9 col-md-12 p-bottom-80">


    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: white; text-align: left; ">
        <br><br><br>Select the Lesson/s to Proceed the Payments.<br><br><strong><?php echo $pra[userName]; ?> - <?php echo $pra[subject]; ?> </strong> </p> </div>

</div>


<div class="col-lg-3 col-md-12 p-top-20 " style=" color: white; text-align: right;">

                            <a href="select_your_teacher.php" class="btn btn--md register_btn btn-primary" >THE TUTORY</a>

                            <br><br>Batch <strong><?php echo $pra[grade]; ?></strong>
</div>





                               

                    
                    <?php  $current_date = date('Y-m-d'); ?> 
                    <?php  $after_one_year = date('Y-m-d', strtotime($current_date . ' +10 year'));  ?>
                    <?php  $before_one_year = date('Y-m-d', strtotime($current_date . ' -10 year')); ?>
                        
                    
<?php
        $sql2 = "SELECT * FROM category WHERE teacher_id='$_GET[teacher_id]' AND active = 1 AND lesson_date between '$current_date' AND '$after_one_year' ORDER by lesson_date ASC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) { 

        $rows = mysqli_num_rows($result2); 

        $found = '0';
                            if(!empty($_SESSION["cart_item"])) { 
                                foreach($_SESSION["cart_item"] as $item) {  $total_charge += $item["charge"];
                                    if($pra2["id"] == $item['id'] )  {  
                                        $found = '1';       
                                    }  
                                }
                            }


?>                                                                                                                                
<?php
        $sql5 = "SELECT * FROM products WHERE lesson_id=$pra2[id] AND active = 1 AND status = 'Paid' OR lesson_id=$pra2[id] AND active = 1 AND status = 'Free' OR lesson_id=$pra2[id] AND active = 1 AND status = 'PostPay' OR lesson_id=$pra2[id] AND active = 1 AND status = 'Institute'  ORDER by id DESC";
        $result5 = mysqli_query($connect, $sql5);      $num_rows5 = mysqli_num_rows($result5);

?>            
<div class="col-lg-6 col-md-12 p-bottom-100">


<form method="post" action="">
<input type="hidden" name="product_id" value="<?php echo $pra2['id']; ?>">
<input type="hidden" name="action" value="add">
<input type="hidden" name="quantity" value="1">
<input type="hidden" name="actual_timex" value="<?php echo time(); ?>">



                       <h2 style="background: #e8c100;height: 30px;padding: 5px 10px;border-radius: 5px;font-size: unset;"><?php echo $pra2[name_of_class]; ?></h2>
                       <p style="color: aliceblue;"><?php echo $pra2[description]; ?></p>
                        
    <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-lg-6 col-md-12">
                                        <h2 style="background: #e8c100;height: 33px;padding: 5px 10px;border-radius: 5px;font-size: initial;font-weight: bold;">LKR <?php echo $pra2[charge]; ?>/=</h2>
                                    </div><div class="col-lg-6 col-md-12">
<?php
                            
 
        $sql3 = "SELECT * FROM products WHERE lesson_id='$pra2[id]' AND active = 1 AND student_id = '$_SESSION[userSession]' ORDER by id DESC";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3); 
        if(mysqli_num_rows($result3) > 0) { 

                if($pra3[status] == 'Proceed') { 
                            echo '<p class="btn btn--md register_btn btn-primary" style="float: right;line-height: 40px;color: white;height: 45px;border: none;font-weight: bold;background: #a40573;font-size:initial;text-transform:uppercase;">ගෙවීම් කරන්න</p>';  
                }
                if($pra3[status] == 'Paid') { 
                            echo '<p class="btn btn--md register_btn btn-primary" style="float: right;line-height: 40px;color: white;height: 45px;border: none;font-weight: bold;background: #05a427;font-size:initial;text-transform:uppercase;">මුදල් ගෙවා  ඇත</p>';  
                }
                if($pra3[status] == 'Free') { 
                            echo '<p class="btn btn--md register_btn btn-primary" style="float: right;line-height: 40px;color: white;height: 45px;border: none;font-weight: bold;background: #f4516c;font-size:initial;text-transform:uppercase;">Free පන්තිය</p>';  
                }
                if($pra3[status] == 'PostPay') { 
                            echo '<p class="btn btn--md register_btn btn-primary" style="float: right;line-height: 40px;color: white;height: 45px;border: none;font-weight: bold;background: #000;font-size:initial;text-transform:uppercase;">PostPay</p>';  
                }
                if($pra3[status] == 'Institute') { 
                            echo '<p class="btn btn--md register_btn btn-primary" style="float: right;line-height: 40px;color: white;height: 45px;border: none;font-weight: bold;background: #000;font-size:initial;text-transform:uppercase;">Institute</p>';  
                }
        } else { 
                        

                      if($pra2[blocked_by_admin] == '0') { 

                        if($num_rows5 < $pra2[no_of_students]) { 
                                if($found == '1') { echo '<input class="btn btn--md register_btn btn-primary" type="submit" name="remove_now" style="float: right;line-height: 30px;color: white;font-weight: bold;background: crimson;font-size:initial;text-transform:uppercase;" value="Remove Lesson">'; } if($found == '0')  {  
                                echo '<input class="btn btn--md register_btn btn-primary" type="submit" name="order_now" style="float: right;line-height: 30px;color: black;font-weight: bold;background: antiquewhite; font-size:initial; text-transform:uppercase;" value="පන්තියට ඉල්ලුම් කරන්න">'; } 
                            } else { echo '<span class="btn btn--md register_btn btn-primary"  style="float: right;line-height: 30px;color: white;font-weight: bold;background: crimson;font-size:initial;text-transform:uppercase;" >Slots are Finished</span>'; }
                        } 

                      if($pra2[blocked_by_admin] == '1') {  echo '<span class="btn btn--md register_btn btn-primary"  style="float: right;line-height: 30px;color: white;font-weight: bold;background: crimson;font-size:initial;text-transform:uppercase;" >BLOCKED BY ADMIN</span>'; }
                 }                  
                           
?>   
                                    </div>
    </div>



















    <div class="row" style="margin-bottom: 0px;">
                                    <div class="col-lg-7 col-md-12" style="height:140px">
                                        <p style="color: #e8c100;height: 30px;padding: 5px 10px;border-radius: 5px;font-size: unset;">Duraion of the Training (Start) <br><strong style="color: white"><?php echo $pra2[lesson_date]; ?> (<?php echo $pra2[lesson_time]; ?>)</strong>
                                            <br><br>
                                           Duraion of the Training (Finish) <br><strong style="color: white"><?php echo $pra2[lesson_date2]; ?> (<?php echo $pra2[lesson_time2]; ?>)</strong>
                                        <?php if($pra3[status] == 'Paid' OR $pra3[status] == 'Free' OR $pra3[status] == 'PostPay' OR $pra3[status] == 'Institute') { ?>
                                            <?php if($pra2[student_link] != ''){ ?>
                                            <br><a style=" color: black; font-weight: bold; background: white; padding: 2px 15px; margin-top: 10px; width: fit-content; display: block; border-radius: 2px; " href="<?php echo $pra2[student_link]; ?>" target="_blankx">Join The Stream <br>( ඉගැනීම ආරම්භ කරන්න ) </a></p>
                                            <?php } ?>
                                        <?php } ?>
                                            
                                            
                                    </div><div class="col-lg-5 col-md-12" style="text-align: right;">
                
                                       <span style="color: white">Remaining Slots : <strong><?php echo $pra2[no_of_students]-$num_rows5; ?><?php // echo $num_rows5; echo '/'; echo $pra2[no_of_students]; ?></strong> </span>
                                         
                                        <?php if($pra3[status] == 'Paid' OR $pra3[status] == 'Free' OR $pra3[status] == 'PostPay' OR $pra3[status] == 'Institute') { ?>
                                            <?php if($pra2[pdf] != ''){ ?>
                                            <br><a style="color: white;font-weight: bold;/* background: white; *//* padding: 2px 15px; */margin-top: 10px;width: auto;display: block;border-radius: 2px;float: right;text-align: center;" href="<?php echo getImageUrl($pra2['pdf'], $baseURL, $current_page); ?>" target="_blankx">Tutorial ( නිබන්ධන ) </a></p>
                                            <?php } ?>
                                        <?php } ?>
                                        
                                        <?php if($pra3[status] == 'Paid' OR $pra3[status] == 'Free' OR $pra3[status] == 'PostPay' OR $pra3[status] == 'Institute') { ?>
                                            <?php if($pra2[other_link] != ''){ ?>
                                            <br><a style="float:right; color: white; font-weight: bold; background: red; padding: 2px 15px; margin-top: 10px; width: fit-content; display: block; border-radius: 2px; " href="<?php echo $pra2[other_link]; ?>" target="_blankx">Video on Demand</a></p>
                                            <?php } ?>
                                        <?php } ?>
                                        
                                         <?php if($pra3[status] == 'Paid') { ?>
                                            <?php if($pra3[system_token] != ''){ ?>
                                            <br><p style="float:right;color: white;font-weight: bold;background: #ff0000;padding: 2px 15px;margin-top: 10px;width: fit-content;display: block;border-radius: 2px;">Token : <?php echo $pra3[system_token]; ?></p>
                                            <?php } ?>
                                        <?php } ?>
  


<?php   if($found == '1') { echo '<p style=" font-size: xx-large; margin-top: 20px; ">✅</p>';    }  ?>

                            <!--<br><input style="transform: scale(2.5); margin-top: 10px;" type="checkbox" class="text_field" placeholder="Batch" name="whatsapp_or_viber"><span style="color: white;"> </span>-->
                                    </div>
            
    </div>

</form>












<?php 

$sql_attachment = "SELECT * FROM products WHERE id='$pra3[id]' AND comments != ''";
$result_attachment = mysqli_query($connect, $sql_attachment);
$pra_attachment = mysqli_fetch_array($result_attachment);
$rowcount=mysqli_num_rows($result_attachment);


?>




    <div class="row" style="margin-bottom: 20px;">
        
        



                                    <div class="col-lg-6 col-md-12">
                                        <?php if($rowcount != '' OR $rowcount != '0') { ?><a href="<?php echo getImageUrl($pra_attachment['comments'], $baseURL, $current_page); ?>" target="_blankx"><img src="<?php echo getImageUrl($pra_attachment['comments'], $baseURL, $current_page); ?>" style="max-height: 70px;max-width: 275px;border: 2px solid white;border-radius: 5px;"></a><?php } ?>
                                    </div><div class="col-lg-6 col-md-12">
       


<?php 
                if($pra3[status] == 'Proceed' OR $pra3[status] == 'PostPay' ) { 
                    
?>

       <form action="" method="post" id="form" enctype="multipart/form-data" onsubmit="return confirm('You Wants to Upload the Payment Receipt?')"  style=" display: block; clear: both; padding-top: 20px; float: right; text-align: right; ">
              <input name="product_id" type="hidden" value="<?php echo $pra3[id]; ?>">
              <input name="file" type="file" required="" style=" width: 110px; float: left; height: 28px; color: transparent; border: none; ">
              <input name="receipt_submit" type="submit" value="Upload" style=" height: 28px; ">
              <br><span style=" display: inline-table; color: white; margin-top: 5px; ">Upload Payment Slip</span> 
        </form>
<?php 

                } 
?>                                 




                                        
                                         <?php if($pra3[status] == 'Free') {  
                                                    if($pra2[other_link] != ''){ ?>                   
                                                <?php
                                                        $sql_token = "SELECT * FROM buy_token_free WHERE product_id = '$pra3[id]' AND active = '1' AND token_type = 'Free' ";
                                                        $result_token = mysqli_query($connect, $sql_token);
                                                        $pra_token = mysqli_fetch_array($result_token);
                                                        $row_token = mysqli_num_rows($result_token); 
                                                        
                                                        
                                                        if($row_token != '' OR $row_token != '0' ) { 
                                                            if($pra3[system_token] != ''){ 
                                                                
                                                                if($pra2[other_link] != ''){ echo '<br><a style="float:right; color: white; font-weight: bold; background: red; padding: 2px 15px; margin-top: 10px; width: fit-content; display: block; border-radius: 2px; " href="'.$pra2[other_link].'" target="_blankx">Video on Demand</a></p>'; }
                                                                
                                                                echo ' <br><p style="float:right;color: white;font-weight: bold;background: #ff0000;padding: 2px 15px;margin-top: 10px;width: fit-content;display: block;border-radius: 2px;">Token : '.$pra3[system_token].'</p>'; } else { 
                                                        
                                                        echo ' <br><p style="float:right;color: white;font-weight: bold;background: #ff0000;padding: 2px 15px;margin-top: 10px;width: fit-content;display: block;border-radius: 2px;">Paid, Waiting for Token</p>'; } } else { 
                                            
                                                ?>     
                                            <br><p style="float:right;color: white;font-weight: bold;background: #ff0000;padding: 2px 15px;margin-top: 10px;width: fit-content;display: block;border-radius: 2px;" class="small_button"><a href="buy_token_free.php?student_paying_to=<?php echo $pra3[id]; ?>&&amount=<?php echo $pra2[charge]/2; ?>" target="_blankx" style="color: white; ">BUY TOKEN - LKR <?php echo $pra2[charge]/2; ?></a></p>
                                        <?php } } } ?>
                                        
                                        
                                         <?php if($pra3[status] == 'PostPay') { 
                                                    if($pra2[other_link] != ''){ ?>                   
                                                <?php
                                                        $sql_token = "SELECT * FROM buy_token_free WHERE product_id = '$pra3[id]' AND active = '1' AND token_type = 'PostPay' ";
                                                        $result_token = mysqli_query($connect, $sql_token);
                                                        $pra_token = mysqli_fetch_array($result_token);
                                                        $row_token = mysqli_num_rows($result_token); 
                                                        
                                                        
                                                        if($row_token != '' OR $row_token != '0' ) { 
                                                            if($pra3[system_token] != ''){ 
                                                                
                                                                
                                                                if($pra2[other_link] != ''){ echo '<br><a style="float:right; color: white; font-weight: bold; background: red; padding: 2px 15px; margin-top: 10px; width: fit-content; display: block; border-radius: 2px; " href="'.$pra2[other_link].'" target="_blankx">Video on Demand</a></p>'; }
                                                                
                                                                echo ' <br><p style="float:right;color: white;font-weight: bold;background: #ff0000;padding: 2px 15px;margin-top: 10px;width: fit-content;display: block;border-radius: 2px;">Token : '.$pra3[system_token].'</p>'; } else { 
                                                        
                                                        echo ' <br><p style="float:right;color: white;font-weight: bold;background: #ff0000;padding: 2px 15px;margin-top: 10px;width: fit-content;display: block;border-radius: 2px;">Paid, Waiting for Token</p>'; } } else { 
                                            
                                                ?>     
                                            <br><p style="float:right;color: white;font-weight: bold;background: #ff0000;padding: 2px 15px;margin-top: 10px;width: fit-content;display: block;border-radius: 2px;" class="small_button"><a href="buy_token_postpay.php?student_paying_to=<?php echo $pra3[id]; ?>&&amount=<?php echo $pra2[charge]*1.25; ?>" target="_blankx" style="color: white; ">BUY TOKEN - LKR <?php echo $pra2[charge]*1.25; ?></a></p>
                                        <?php } } } ?>
                                        
                                        
                                        
                                        
<?php if($pra3[status] == 'Proceed' OR $pra3[status] == 'PostPay' ) { ?> 
                                      <a href="thank_you.php?student_paying_to=<?php echo $pra3[id]; ?>" target="_blankx" class="small_button btn btn--md register_btn btn-primary" style="background: #fff3ba;border: none;padding: 0 10px;font-weight: bold;font-size: initial;margin-top:20px;float: right; ">PAY ONLINE NOW</a>
<?php } ?>


                                    </div>
    </div>














</div> 
<?php } ?>









<?php if($total_charge != '') {   ?>
    <div class="col-lg-3 col-md-12"></div>
    <div class="col-lg-6 col-md-12 p-top-20" style="float: right;">
                                        

                        <form action="thank_you.php" method="post">
                            <div class="cardify signup_form" align="center">
                                <!-- end .login_header -->


    <input type="hidden" name="teacher_id" value="<?php echo $_GET['teacher_id']; ?>">
    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: white; ">Total Payment (LKR)</p> </div>


    <input type="text" class="text_field" placeholder="" name="paying_amount" readonly="" style="margin-bottom: 20px;font-size: xx-large;font-weight: bold;color: black;text-align: center;" value="<?php echo $total_charge/$rows; ?>">
    <input onclick="return confirm('You want to order these Lessons?');" class="btn btn--md register_btn btn-primary" style=" background: #2487ed;border: #2487ed;margin-bottom: 10px;padding: 0 10px;font-weight: bold;" type="submit" name="proceed_to_pay" value="BANK DEPOSIT / TRANSFER">
    <input onclick="return confirm('You want to Pay Online for these Lessons?');" class="btn btn--md register_btn btn-primary" style=" background: #178a0a;border: #178a0a;margin-bottom: 10px;padding: 0 10px;font-weight: bold;" type="submit" name="proceed_to_pay_online" value="PAY ONLINE NOW">


                            </div><!-- end .cardify -->
                        </form><!-- Ends: .product-single -->


                     

    </div>
<?php } ?>


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