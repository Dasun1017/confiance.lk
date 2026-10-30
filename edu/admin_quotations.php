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


<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Quotations - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        <!---->
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            






                            




                            <div class="row">
<div class="col-lg-2 col-md-12 p-bottom-0">

    <br><br>
    <div class="login--header" style=" border-bottom: none; "> <h3 style=" font-size: initial; color: black; text-align: left; ">List of Quotations<h3p> </div>
</div>

<div class="col-lg-10 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="admin_quotations.php" class="btn btn--md register_btn btn-primary" style=" float: right;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > <strong>QUOTATIONS</strong></span></a>
                            <a href="admin_home_statistics.php" class="btn btn--md register_btn btn-primary" style=" float: right;margin-right:25px;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > <strong>STATISTICS</strong></span></a>

                            <a href="admin_students_list.php" class="btn btn--md register_btn btn-primary" style=" float: right;margin-right:25px;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > <strong>LEARNERS/ STUDENTS</strong></span></a>
                            <a href="timetable.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px;  "> <strong>TIME TABLE</strong></a>
                            <a href="admin_home_page_courses.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px;  "><strong>HOME PAGE COURSES</strong></a>
                            <a href="admin_tutory_medici.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #1dc9b7; border: #f4516c;line-height: inherit;    padding: 10px 20px; " ><strong>MAIN DASHBOARD</strong></span></a>

</div>
                            </div>








  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

      .form-control, input {border: 1px solid #262626; } 
      
      .table thead>tr>th_x { padding: 0px 0 20px 5px }  
      .table tbody>tr>td_x { padding: 10px 0 20px 5px } 
  </style>    

   
                        
                      
                    


                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Trainers/Tutor Name</th>
                                    <th style="width: 200px; max-width:200px;">Empoyees</th>
                                    <th style="width: 200px; max-width:200px;">Students</th>
                                    <th style="width: 200px; max-width:200px;">Trainers</th>
                                    <th style="width: 200px; max-width:200px;">Average</th>
                                    <th style="width: 200px; max-width:200px;">Requirement</th>
                                    <th style="width: 200px; max-width:200px;">Team or Webinar</th>
                                    <th style="width: 200px; max-width:200px;">posted_time</th>
                                    <th style="width: 200px; max-width:200px;">posted_date</th>
                                    <td></td>
                                </tr>
                                </thead>

                                <tbody>

<?php   $num=1;
        $sql2 = "SELECT * FROM request_for_quote WHERE active = '1' ORDER by id DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  

        $sql4 = "SELECT * FROM tbl_users WHERE type = '2' AND userID= '$pra2[teacher_id]' ";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);


?>     

                                <tr>
                                    <td><?php echo $num; ?></td>
                                    <td style="    width: 200px; max-width:200px;"><a href="admin_teachers_active.php?teacher=<?php echo $pra4[userID]; ?>" ><?php echo $pra4[userName]; ?> <strong>(ID : <?php echo $pra4[userID]; ?>)</strong><br><?php echo $pra4[grade]; ?> - <?php echo $pra4[subject]; ?></a></td>

                                    <td style="    "><?php echo $pra2[number_of_empoyees]; ?></td>

                                    <td style="    "><?php echo $pra2[no_of_students]; ?></td>

                                    <td style="    "><?php echo $pra2[number_of_trainers]; ?></td>

                                    <td style="    "><?php echo $pra2[average]; ?></td>

                                    <td style="    "><?php echo $pra2[requirement]; ?></td>

                                    <td style="    "><?php echo $pra2[team_or_webinar]; ?></td>

                                    <td style="    "><?php echo $pra2[posted_time]; ?></td>

                                    <td style="    "><?php echo $pra2[posted_date]; ?></td>

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




     
  


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>