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
        $sql = "SELECT * FROM tbl_users WHERE userID=$_GET[student]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>      


<?php if(isset($_GET[status])) { 

                
        $time = time();
        $time = $_GET[student]._.$time;
        $date = date('Y-m-d h:i:sa');


         $sql_check = "SELECT * FROM products WHERE lesson_id='$_GET[category_id]'  AND teacher_id='$_GET[teacher_id]'  AND student_id='$_GET[student]' AND active='1'  ";
        $result_check = mysqli_query($connect, $sql_check);
        $pra_check = mysqli_fetch_array($result_check);
        $num_check = mysqli_num_rows($result_check);

        if($num_check == '' OR $num_check == '0' )  { 


             $result = mysqli_query($connect, "INSERT INTO products VALUES (NULL, '$_GET[student]',  '$_GET[category_id]', '$_GET[teacher_id]', '$time', '$date', '$_GET[status]', '', '', '', '', '1', '', '' )");
 } 

} ?>


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
            
?>            


<?php 
if (isset($_POST['change_orders_status'])){



    if($_POST['change_orders_status'] == 'D') { 
    
                
                $sql2 = "UPDATE products SET active='0' WHERE id='$_POST[order_id]'";
                mysqli_query($connect, $sql2);
                
                echo "<script>alert('Lesson for this Student Deleted Successfully!')</script>";
                
    }
    if($_POST['change_orders_status'] != 'D') { 
    
    
        $sqlx = "SELECT * FROM products WHERE id='$_POST[order_id]'";
        $resultx = mysqli_query($connect, $sqlx);
        $prax = mysqli_fetch_array($resultx);
                //$sql = "UPDATE products SET status='$_POST[change_orders_status]' WHERE id='$_POST[order_id]'";
                //mysqli_query($connect, $sql);
                //echo "<script>alert('Lesson Status Changed Successfully!')</script>";



                if($prax[status] != 'Paid') { 
                        $date = date('Y-m-d h:i:sa');
                                
                if($_POST[change_orders_status] == 'Institute') { 
                                $sql = "UPDATE products SET status='Paid', paid_marked_by='Institute', posted_date='$date', paid_marked_user = '$_SESSION[userSession]'  WHERE id='$_POST[order_id]'";
                                                                }
                if($_POST[change_orders_status] != 'Institute') { 
                                $sql = "UPDATE products SET status='$_POST[change_orders_status]', paid_marked_by = '', posted_date='$date', paid_marked_user = '$_SESSION[userSession]' WHERE id='$_POST[order_id]'";
                                                                }
                                mysqli_query($connect, $sql);
                                echo "<script>alert('Lesson Status Changed Successfully!')</script>";
                }   





                if($prax[status] == 'Paid') { 
                        $date = date('Y-m-d h:i:sa');
                                
                if($_POST[change_orders_status] == 'Institute') { 
                                $sql = "UPDATE products SET status='Paid', paid_marked_by='Institute', posted_date='$date', paid_marked_user = '$_SESSION[userSession]'  WHERE id='$_POST[order_id]'";
                                                                }
                if($_POST[change_orders_status] != 'Institute') { 
                                $sql = "UPDATE products SET status='$_POST[change_orders_status]', paid_marked_by = '', posted_date='$date', paid_marked_user = '$_SESSION[userSession]' WHERE id='$_POST[order_id]'";
                                                                }
                                mysqli_query($connect, $sql);
                                echo "<script>alert('Lesson Status Changed Successfully!')</script>";


                    
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
    <title><?php echo $pra[userName]; ?>'s Profile - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
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
                                                     <a href="admin_students_list.php" class="btn btn--md register_btn btn-primary" style=" float: right;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>LEARNERS/ STUDENTS</strong></span></a>
                                                    
                                                     <a href="admin_my_profile.php?student=<?php echo $_GET[student]; ?>" target="_blank" class="btn btn--md register_btn btn-primary" style=" float: right;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; margin-right: 10px" >EDIT PROFILE</a>
                                                    
                                                </div>
                                            </div><!-- end .col-md-12 -->




                                        <!-- end .col-md-12 -->
                                    </div>
                                </div>
                <div class="container featured-products2  p-top-0 p-bottom-120">
                            






                            











                            <div class="row">
                              



<div class="col-lg-9 col-md-12 p-bottom-0">


    <div class="login--header" style=" border-bottom: none; "> <p style="     margin: 0px;font-size: initial; color: black; text-align: left; "><?php echo $pra[userName]; ?> - <?php echo $pra[grade]; ?></p> </div>

</div>




<div class="col-lg-3 col-md-12 p-top-20 " style=" color: white; text-align: right;">
</div>

                    


<?php if(!isset($_GET[status])) { ?><!--start-->


<form action="" method="get" style=" float: right;border: 0px; clear: both;    margin: 0 10px;">
                                            <select name="teacher_id" required="" onchange="this.form.submit()" style="     margin: 0 10px;background: black;color: white;height: 40px;display: block;line-height: 24px;border: 0px;border-radius: 3px;display: inline-block;padding: 5px 15px;color: #fff;font-weight: 400;font-size: larger;">
<?php if(isset($_GET[teacher_id])) { ?>
                                              <option value="">Change Teacher</option>
<?php } else { ?>
                                              <option value="">Select Teacher</option>
<?php } ?>
<?php 
        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  
?>
    <option value="<?php echo $pra2[userID]; ?>" <?php if(isset($_GET[teacher_id])) { if($_GET[teacher_id] == $pra2[userID]) { echo ' selected ';}  } ?> ><?php echo $pra2[userName]; ?></option>
<?php } ?>

                                            </select>
                                            <input name="student" value="<?php echo $_GET[student];?>" type="hidden">
</form>






<?php if(isset($_GET[teacher_id])) { ?>

<form action="" method="get" style=" float: right;border: 0px; clear: both;    margin: 0 10px;">
                                            <select name="category_id" required="" onchange="this.form.submit()" style="     margin: 0 10px;background: #595858;color: white;height: 40px;display: block;line-height: 24px;border: 0px;border-radius: 3px;display: inline-block;padding: 5px 15px;color: #fff;font-weight: 400;font-size: larger;">

                                              <option value="">Select Class</option>

<?php 
         $sql2x = "SELECT * FROM category WHERE teacher_id=$_GET[teacher_id] AND active = 1  ORDER by lesson_date ASC";
        $result2x = mysqli_query($connect, $sql2x);
        while($pra2x = mysqli_fetch_array($result2x)) { 

?>   
    <option value="<?php echo $pra2x[id]; ?>" <?php if(isset($_GET[category_id])) { if($_GET[category_id] == $pra2x[id]) { echo ' selected ';}  } ?>  ><?php echo $pra2x[name_of_class]; ?></option>
<?php } ?>

                                            </select>
                                            <input name="student" value="<?php echo $_GET[student];?>" type="hidden">
                                            <input name="teacher_id" value="<?php echo $_GET[teacher_id];?>" type="hidden">
</form>
<?php } ?>





<?php if(isset($_GET[category_id])) { ?>

<form action="" method="get" style=" float: right;border: 0px; clear: both;    margin: 0 10px;">
                                            <select name="status" required="" onchange="this.form.submit()" style="     margin: 0 10px;background: #999999;color: white;height: 40px;display: block;line-height: 24px;border: 0px;border-radius: 3px;display: inline-block;padding: 5px 15px;color: #fff;font-weight: 400;font-size: larger;">
                                                <option value="">Add Option</option>
                                                <option value="Proceed">Requested</option>                                                 <option value="Paid">Paid</option>                                                 <option value="Free">Free</option>         
                                                <option value="PostPay">PostPay</option> 
                                                <option value="Institute">Institute</option>
                                            </select>
                                            <input name="student" value="<?php echo $_GET[student];?>" type="hidden">
                                            <input name="teacher_id" value="<?php echo $_GET[teacher_id];?>" type="hidden">
                                            <input name="category_id" value="<?php echo $_GET[category_id];?>" type="hidden">
                                        </form>


<?php } ?>
          

<?php } ?><!--finish-->




<?php if(isset($_GET[status])) { ?>

<a href="admin_students_active.php?student=<?php echo $_GET[student]; ?>" class="btn btn--md register_btn btn-primary" style=" float: right;background: #094784;border: #f4516c;line-height: inherit;padding: 10px 20px;font-size: initial;margin: 10px;">ADD A <strong>NEW CLASS</strong></a>

<?php } ?>


                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table" style="font-size: inherit;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Trainer/Tutor</th>
                                    <th>Session/ Program</th>
                                    <th>Charges</th>
                                    <th>Duration</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>

                              





                    

       
<?php
        $sql2x = "SELECT * FROM products WHERE student_id='$_GET[student]' AND active = 1 ORDER by id DESC";
        $result2x = mysqli_query($connect, $sql2x);
        while($pra2x = mysqli_fetch_array($result2x)) { 

?>      

    <?php
            $sql3 = "SELECT * FROM category WHERE id='$pra2x[lesson_id]' ORDER by id DESC";
            $result3 = mysqli_query($connect, $sql3);
            $pra3 = mysqli_fetch_array($result3);

    ?>   
<?php
        $sql2_teacher = "SELECT * FROM tbl_users WHERE userID='$pra2x[teacher_id]' AND type = '2' ";
        $result2_teacher = mysqli_query($connect, $sql2_teacher);
        $pra2_teacher = mysqli_fetch_array($result2_teacher);

?>

<?php
        $sql2 = "SELECT * FROM tbl_users WHERE userID='$pra2x[student_id]' AND type = '3' ";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);

?>


                                <tr>
                                    <td><?php if($pra2x[comments] != '') { ?><a target="_blank" href="<?php echo getImageUrl($pra2x['comments'], $baseURL, $current_page); ?>" target="_blankx" style=" background: black; color: white; padding: 5px 10px; border-radius: 5px; "><!--<img src="<?php echo getImageUrl($pra2['comments'], $baseURL, $current_page); ?>" style="max-height: 70px;max-width: 275px;border: 2px solid white;border-radius: 5px;">-->Receipt</a><?php } ?>
                                    
                                    
<form action="" method="post" id="form" enctype="multipart/form-data" onsubmit="return confirm('නම සහ මාසය රිසිට්පතෙහි සදහන් කරන්න')"  style=" display: block;clear: both;padding-top: 0px;float: right;text-align: right;border: 1px solid white;border-radius: 10px;background: white;padding: 0 10px; ">
              <input name="product_id" type="hidden" value="<?php echo $pra2x[id]; ?>">
            
              <input name="file" type="file" required="" style=" width: 110px; float: left; height: 28px; color: transparent; border: none; ">
              <input name="receipt_submit" type="submit" value="Upload Slip" style=" height: 28px; ">
               
              
        </form>
        
        
        
        </td>
                                    
                                    <td><?php echo $pra2_teacher[userName]; ?> <strong>(ID : <?php echo $pra2_teacher[userID]; ?>)</strong><br><?php echo $pra2_teacher[grade]; ?></td>
                                    
                                    <td><?php echo $pra3[name_of_class]; ?> (<?php echo $pra3[description]; ?>)

                                        <br><br>
                                      <a href="admin_student_learning_meterials.php?userSession=<?php echo $_GET[student]; ?>&view=<?php echo $pra3[id]; ?>" target="_blank" style="width: 100px;text-align: center;font-size: xx-large;color: red;border: 0px solid black;font-weight: bold;text-align: center;">VIEW COUNTS</a>

                                  </td>
                                    <td><?php echo $pra3[charge]; ?><br>(<?php echo $pra3[currency]; ?>)</td>
                                    <td><?php echo $pra3[lesson_date]; ?> (<?php echo $pra3[lesson_time]; ?>)
                                        <br> <?php echo $pra3[date2]; ?> (<?php echo $pra3[time2]; ?>)</td>
                                    <td class="type" align="center"> 


<?php 
                if($pra2x[status] == 'Proceed') { 
                            echo '<span class="proceed">Requested</span>';  
                }
                if($pra2x[status] == 'Paid') { 
                            echo '<span class="paid">Paid</span>';  
                }
                if($pra2x[status] == 'Free') { 
                            echo '<span class="finished">Free</span>';  
                }
?>               

<?php if($pra2x[status] == 'Paid' && $pra2x[paid_marked_by] == 'Online' OR $pra2x[status] == 'Proceed' && $pra2x[paid_marked_by] == 'Online' ) { echo '<span class="proceed" style=" background: red; ">Online</span>'; } if($pra2x[status] == 'Paid' && $pra2x[paid_marked_by] == '' ) { echo 'Deposit'; } if($pra2x[status] == 'Paid' && $pra2x[paid_marked_by] == 'Institute' ) { echo 'Institute'; }?>


                  </td>

                                  <td>

                                        <form action="" method="post" style=" float: right;border: 0px; clear: both;">
                                            <input type="hidden" name="order_id" value="<?php echo $pra2x[id]; ?>">
                                            <select name="change_orders_status" required=""  onchange="this.form.submit()" style=" background: black;color: white;padding: 0 15px;display: block;line-height: 24px;border: 0px;height: 24px;border-radius: 3px;display: inline-block;padding: 0 15px;color: #fff;font-weight: 400;font-size: 12px;">
                                                <option>Edit</option>
                                                <?php if($pra2x[status] != 'Paid') { ?><option value="Proceed">Requested</option> <?php } ?>
                                                <?php if($pra2x[status] != 'Paid') { ?><option value="Paid">Paid</option> <?php } ?>
                                                <option value="Free">Free</option>  
                                                <option value="PostPay">PostPay</option> 
                                                <option value="Institute">Institute</option>
                                                <option value="D">Delete</option>
                                            </select>
                                        </form>
                                 </td>       

                                </tr>



    <?php } ?>



  </tbody>
                            </table>

                    </div></div>





























                    


                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Date</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   
        $sql2x = "SELECT * FROM students_attendance WHERE active = '1' AND student_rfid = '$pra2[student_rfid]' ORDER by id DESC";
        $result2x = mysqli_query($connect, $sql2x);
        while($pra2x = mysqli_fetch_array($result2x)) {  


?>     

                                <tr>
                                   <td></td>

                                    <td style="    "><?php echo $pra2x[actual_date]; ?></td>

                                </tr>
<?php } ?>

                                </tbody>
                            </table>

                    </div></div>







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