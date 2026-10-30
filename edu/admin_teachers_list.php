<?php 
    include 'functions/main.functions.php';   
    //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
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
        $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]' AND active = '1'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>

<?php 
if (isset($_POST['change_teacher_status'])){

    if($_POST[change_teacher_status] == 'D' ) { 
                $sql = "UPDATE tbl_users SET type='4' WHERE userID='$_POST[teacher_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Teacher Deleted Changed Successfully!')</script>";
                
    } else { 
                $sql = "UPDATE tbl_users SET userStatus='$_POST[change_teacher_status]' WHERE userID='$_POST[teacher_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Teacher Status Changed Successfully!')</script>";
    }
}           
?>



<?php 
if (isset($_POST['change_subject'])){

                $sql = "UPDATE tbl_users SET subject='$_POST[subject]', selected_ol_al_grade = '$_POST[selected_ol_al_grade]', order_by = '$_POST[order_by]',
                school = '$_POST[change_subject]', userName = '$_POST[change_name]'
                WHERE userID='$_POST[teacher_id]'";
                mysqli_query($connect, $sql);
                //echo "<script>alert('Teacher Subject & Grade Changed Successfully!')</script>";
}           
?>


<?php 
if (isset($_POST['change_teacher_password'])){

                $password = md5($_POST['change_teacher_password']);
                $sql = "UPDATE tbl_users SET userPass='$password' WHERE userID='$_POST[teacher_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Teacher Password Changed Successfully!')</script>";
}           
?>
<?php 
if (isset($_POST['change_package_status'])){

                $sql = "UPDATE tbl_users SET selected_package='$_POST[change_package_status]' WHERE userID='$_POST[teacher_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Teacher Package Changed Successfully!')</script>";
}           
?>


<!doctype html>
<html class="no-js" lang="zxx" style="background: white;">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
      <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <title>Teachers Registry - <?php echo $site_title; ?></title>

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
        <!---->
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            



<!--
<form action="" method="get" style=" float: right;border: 0px; clear: both;    margin: 0 10px;">
                                            <select name="selected_class" required="" onchange="this.form.submit()" style="     margin: 0 10px;background: black;color: white;height: 40px;display: block;line-height: 24px;border: 0px;border-radius: 3px;display: inline-block;padding: 5px 15px;color: #fff;font-weight: 400;font-size: larger;">

                                              <option value="">CHANGE GRADE</option>
                                              <option>GRADE 9 TO 10</option>
                                              <option>GRADE 10 TO 11</option>
                                              
                                            </select>
</form>
-->


                            






                            <div class="row">


<div class="col-lg-2 col-md-12 p-bottom-0" >

  <p style=" background: white; color: red; font-size: large; padding: 10px; text-align: left; border-radius: 5px; ">
    SMS Balance : 
        <?php 
          $user = $site_textit_username;
          $password = $site_textit_password;

          $text = urlencode($_REQUEST['text']);
          $baseurl ="https://www.textit.biz/creditchk";
              
                $url = "$baseurl/?id=$user&pw=$password";
                $ret = file($url);
                echo $ret[0]*2;
        ?>
  </p>
</div>




<div class="col-lg-2 col-md-12 p-bottom-0" style="display: none">
    <div class="login--header" style=" border-bottom: none; "> <h3 style=" font-size: initial; color: black; text-align: left; ">List of Trainers/Tutors<h3p> </div>
</div>

<div class="col-lg-10 col-md-12 p-top-20 " style=" color: white; text-align: right;">
    
    
                           <a href="inquiry.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: black; border: #f4516c;line-height: inherit;    padding: 10px 20px; "><strong>පැමිණිලි හා යෝජනා </strong></a>
                            <a href="admin_home_page_ads.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: orange; border: #f4516c;line-height: inherit;    padding: 10px 20px;"><strong>BANNERS</strong></a>

                            <!--<a href="admin_quotations.php" class="btn btn--md register_btn btn-primary" style=" float: right;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > <strong>QUOTATIONS</strong></span></a>-->
                            <<a href="admin_add_gallery.php" class="btn btn--md register_btn btn-primary" style=" float: right;margin-right:25px;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > <strong>Gallery</strong></span></a>

                            <a href="admin_zoom.php" class="btn btn--md register_btn btn-primary" style=" float: right;border-radius: 20px;margin-right: 15px;background: #fff;border: #fff;t;padding: 0px 10px;" > <strong><img src="img/zoom_badge.png" style="width: 100px"></strong></span></a>

                            <a href="admin_add_teacher.php" class="btn btn--md register_btn btn-primary" style="float: right; margin-right: 25px; background: #1dc9b7; border: #1dc9b7; line-height: inherit; padding: 10px 20px;" ><strong>SUBJECT/ GRADE / GROUP</strong></span></a>

                            
                            <!--<a href="admin_students_analyzing.php" class="btn btn--md register_btn btn-primary" style=" float: right;margin-right:25px;line-height: inherit;    padding: 10px 20px; " > <strong>ANALIZE</strong></span></a>-->



                            <a href="admin_students_list.php" class="btn btn--md register_btn btn-primary" style=" float: right;margin-right:25px;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > <strong> STUDENTS</strong></span></a>
                            
                            <!--<a href="http://phpstack-162631-1536254.cloudwaysapps.com/admin" target="_blank" class="btn btn--md register_btn btn-primary" style=" float: right;margin-right:25px;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > <strong> MCQ</strong></span></a>-->
                            
                            <!--<a href="timetable.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px;  "> <strong>TIME TABLE</strong></a>-->
                            <!--<a href="admin_home_page_courses.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px;  "><strong>HOME PAGE COURSES</strong></a>-->
                            <!--<a href="admin_attendance.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px;  "><strong>ATTENDANCE</strong></a>-->

                            <!--<a href="daily_monthly_report.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #673ab7; border: #f4516c;line-height: inherit;    padding: 10px 20px; " ><strong>DAILY COLLECTION</strong></span></a>-->

                            <!--<a href="admin_tutory_medici.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #1dc9b7; border: #f4516c;line-height: inherit;    padding: 10px 20px; " ><strong>DASHBOARD</strong></span></a>-->
                            
                            
                           <a href="admin_new_bank_slips.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #673ab7; border: #f4516c;line-height: inherit;    padding: 10px 20px; "><strong>NEW BANK SLIPS</strong></a>
                           
                           <!--<a href="admin_list_of_tutes.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: slategray; border: #f4516c;line-height: inherit;    padding: 10px 20px; "><strong>LIST OF TUTES</strong></a>-->
                           
                           <!--<a href="admin_list_of_packs.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: black; border: #f4516c;line-height: inherit;    padding: 10px 20px; "><strong>LIST OF PACKS</strong></a>-->
                           
                           

</div>
                            </div>








  <style type="text/css">
  .table thead>tr>th {  padding: 10px; } 
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

      .form-control, input {border: 1px solid #262626; } 
      
      .table thead>tr>th_x { padding: 0px 0 20px 5px }  
      .table tbody>tr>td_x { padding: 10px 0 20px 5px } 
  </style>    

   
                        
                      
                    
<?php if (!isset($_GET['with_analytics'])){ ?>
    <!--<a href="admin_teachers_list.php?with_analytics" class="btn btn--md register_btn btn-primary" style="width: 100%;margin-bottom: 30px;background: black;border: #f4516c;line-height: inherit;padding: 10px 20px;"><strong>SHOW WITH ANALYTICS</strong></a>-->
<?php } ?>


                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Detail</th>
                                    <td></td>
                                </tr>
                                </thead>

                                <tbody>

<?php   $num=1;
        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


if (isset($_GET['with_analytics'])){ 
        $sql3 = "SELECT * FROM products WHERE teacher_id=$pra2[userID] AND status = 'Paid' AND active = '1' AND paid_marked_by = 'ONLINE'";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);$num_rows3 = mysqli_num_rows($result3); 
        
        $sql4 = "SELECT * FROM category WHERE teacher_id=$pra2[userID] AND active = 1";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);$num_rows4 = mysqli_num_rows($result4); 


}
?>     

                                <tr>
       
 <td style="   "><a href="admin_teachers_active.php?teacher=<?php echo $pra2[userID]; ?>" target="_blank" style="margin-bottom: 5px;display: -webkit-box;     line-height: 14px;"><img src="img/images.png" style=" width: 40px; "></a></td>



 <td style="   ">


<!--<div class="collapsible" style=" float: right; display: none">
  <span style="float:right;background: #9e9e9e;padding: 1px 10px;color: white;border-radius: 5px;font-weight: 500; cursor: pointer; ">⋁</span>
</div>-->


                                        <form action="" method="post" onsubmit="return confirm('Are you sure?');" style="display:contents;  ">
                                            <input type="hidden" name="teacher_id" value="<?php echo $pra2[userID]; ?>">


                                            <input type="text" name="change_name" placeholder="Teacher Name" value="<?php echo $pra2[userName]; ?>" style="    height: 30px; margin-bottom: 5px; font-size: 12px; border-radius: 10px;     max-width: 200px;">


                                            <input type="text" name="change_subject" placeholder="Subject" value="<?php echo $pra2[school]; ?>" style="    height: 30px; margin-bottom: 5px; font-size: 12px; border-radius: 10px;     max-width: 100px;">

                                            <input type="text" name="order_by" value="<?php echo $pra2[order_by]; ?>" placeholder="Order ID"  style=" background: #f4f4f4;text-align: left;margin-bottom: 5px;height: 30px;color: red;font-size: 12px;border-radius: 10px;     max-width: 120px; ">
                                            

                            
                                               <select name="selected_ol_al_grade" style=" height: 30px;margin-bottom: 5px;font-size: 12px;border-radius: 10px;max-width: 130px; " required="">
                                                                           
                        
                                              <?php   $sql_cat_group = "SELECT * FROM main_group  where active = '1' ORDER by id DESC";
                                                        $result_cat_group = mysqli_query($connect, $sql_cat_group);
                                                        while($pra_cat_group = mysqli_fetch_array($result_cat_group)) { ?>     
                                                          <option value="<?php echo $pra_cat_group[id]; ?>" <?php if($pra2[selected_ol_al_grade] == $pra_cat_group[id]) { echo ' selected '; } ?> ><?php echo $pra_cat_group[main_group_name]; ?></option>
                                                <?php } ?> 
                                              </select>
                                              

                                            <select name="subject" style=" height: 30px;margin-bottom: 5px;font-size: 12px;border-radius: 10px;max-width: 130px; display: none" required=""> 
                                                <option value="sinhala" <?php if($pra2[subject] == 'sinhala') { echo ' selected '; } ?>>සිංහල මාධ්‍ය</option>
                                                <option value="english" <?php if($pra2[subject] == 'english') { echo ' selected '; } ?>>ඉංග්‍රීසි මාධ්‍ය</option>
                                            </select>

                                            <!--<input type="text" name="selected_ol_al_grade" placeholder="Grade" value="<?php echo $pra2[selected_ol_al_grade]; ?>" placeholder="Subject" required="" style="    height: 30px; margin-bottom: 5px; font-size: 12px; border-radius: 10px;     max-width: 200px;">-->
                                            
                                            <!--<br><input type="text" name="batch"  value="<?php echo $pra2[batch]; ?>" placeholder="Video Class - YES?"  style="    height: 30px; margin-bottom: 0px;     background: yellow; font-size: 12px;     border-radius: 10px;     max-width: 200px;">-->

                                            <input type="submit" name="submit_now" value="Save" style=" height: 28px;margin-left: 10px;background: black;color: white;padding: 0px 20px;border-radius: 5px;text-transform: uppercase;font-size: inherit; ">
                                        </form>


                                    </td>
                                    
                                  
                                    <td class="action">
                                        <form action="" method="post">
                                            <input type="hidden" name="teacher_id" value="<?php echo $pra2[userID]; ?>">
                                            <select name="change_teacher_status" required=""  onchange="this.form.submit()" style=" width: 90px;
                                            
                                            background: #<?php if($pra2[userStatus] == 'Y') { echo '1dc9b7'; } if($pra2[userStatus] == 'N') { echo 'f4516c'; }  ?>; 

                                            color: black; height: 30px; font-weight: bold; ">
                                                
                                                <?php if($pra2[userStatus] == 'Y') { ?><option value="Y">Activated</option><option value="N">De-Activate</option><option value="D">Delete</option><?php } ?>
                                                
                                                <?php if($pra2[userStatus] == 'N') { ?><option value="N">De-Activated</option><option value="Y">Activate</option><option value="D">Delete</option><?php } ?>
                                                
                                            </select>
                                        </form>
                                    </td>


                                </tr>


<?php $num++; } ?>
                                </tbody>
                            </table>

                    </div></div>







                            </div>








                        </div>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->
   <!--page-banner-area end-->
   
   
   <script>
    var coll = document.getElementsByClassName("collapsible");
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
   
   
   
 
























   
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
  
</body>
</html>
