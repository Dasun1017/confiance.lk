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
        $sql = "SELECT * FROM tbl_users WHERE userID=$_SESSION[userSession]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

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
    <title>Teachers Registry - <?php echo $site_title; ?></title>

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
                                   

                                        
                                            <div class="col-md-6 col-lg-6">
                                                <div class="p-top-0 p-bottom-20">
                                                    
                                                  
                                                    <div style="background: #fff;border: none;width: fit-content;float: left; border-radius: 0 0 5px 5px">
                                                        
                                                        <p class="btn btn--md register_btn btn-primary" style="background: #f4516c;border: #f4516c;line-height: inherit;padding: 10px 20px;text-transform: uppercase;">
                                                        <a href="teachers_add_lesson.php" style="color: #fff">Reserve New Session/Program</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="col-md-6 col-lg-6"  align="right">

                                                                     <a href="teachers_active.php" class="btn-common" style="background:#f4516c; border:#f4516c">MY DASHBOARD </a>

                                                                    
                                        </div>



                                    </div>
                                </div>
                <div class="container featured-products2  p-top-0 p-bottom-120">
                            






                            



  <div class="row">
                              



<div class="col-lg-9 col-md-12 p-bottom-0">

<br>

    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: left; "><?php echo $pra[userName]; ?> - <?php echo $pra[grade]; ?></p> </div>

</div>




                            </div>






  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

      .form-control, input {border: 1px solid #262626; } 
  </style>    

    
                        
                      
                    


                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Student Name & ID</th>
                                    <th>Contact</th>
                                    <th>Lessons</th>
                                    <th>Requested</th>
                                    <th>Paid</th>
                                    <th>Free</th>
                                    <th>PostPay</th>
                                    <th>Institute</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   $num=1;
        $sql_x = "SELECT * FROM products WHERE teacher_id='$_SESSION[userSession]' AND active = 1 GROUP by student_id ORDER by student_id ASC";
        $result_x = mysqli_query($connect, $sql_x);
        while($pra_x = mysqli_fetch_array($result_x)) {      

        $sql2 = "SELECT * FROM tbl_users WHERE type = '3' AND userID = $pra_x[student_id] ";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);

        $sql4 = "SELECT * FROM products WHERE teacher_id='$_SESSION[userSession]' AND student_id=$pra2[userID] AND active = 1";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);$num_rows4 = mysqli_num_rows($result4); 

        $sql5 = "SELECT * FROM products WHERE teacher_id='$_SESSION[userSession]' AND student_id=$pra2[userID] AND status = 'Proceed' AND active = 1";
        $result5 = mysqli_query($connect, $sql5);
        $pra5 = mysqli_fetch_array($result5);$num_rows5 = mysqli_num_rows($result5);

        $sql6 = "SELECT * FROM products WHERE teacher_id='$_SESSION[userSession]' AND student_id=$pra2[userID] AND status = 'Paid' AND active = 1";
        $result6 = mysqli_query($connect, $sql6);
        $pra6 = mysqli_fetch_array($result6);$num_rows6 = mysqli_num_rows($result6);  

        $sql7 = "SELECT * FROM products WHERE teacher_id='$_SESSION[userSession]' AND student_id=$pra2[userID] AND status = 'Free' AND active = 1";
        $result7 = mysqli_query($connect, $sql7);
        $pra7 = mysqli_fetch_array($result7);$num_rows7 = mysqli_num_rows($result7);  

        $sql8 = "SELECT * FROM products WHERE teacher_id='$_SESSION[userSession]' AND student_id=$pra2[userID] AND status = 'PostPay' AND active = 1";
        $result8 = mysqli_query($connect, $sql8);
        $pra8 = mysqli_fetch_array($result8);$num_rows8 = mysqli_num_rows($result8);  

        $sql9 = "SELECT * FROM products WHERE teacher_id='$_SESSION[userSession]' AND student_id=$pra2[userID] AND status = 'Institute' AND active = 1";
        $result9 = mysqli_query($connect, $sql9);
        $pra9 = mysqli_fetch_array($result9);$num_rows9 = mysqli_num_rows($result9);  

?>     

                                <tr>
                                    <td><?php echo $num; ?></td>
                                    <td><?php echo $pra2[userName]; ?> (<?php echo $pra2[userID]; ?>) <?php if($pra2[institute_id_verified] == 'Y') { echo '<br> <span style="background:#1dc9b7; color: white;     padding: 2px 10px;">';echo $pra2[institute_id]; echo '</span>'; } ?></td>
                                    <td><?php echo $pra3[userEmail]; ?><br><?php echo $pra3[mobile]; ?> </td>

                                    <td><?php echo $num_rows4; ?></td>
                                    <td><?php echo $num_rows5; ?></td>
                                    <td><?php echo $num_rows6; ?></td>
                                    <td><?php echo $num_rows7; ?></td>
                                    <td><?php echo $num_rows8; ?></td>
                                    <td><?php echo $num_rows9; ?></td>
                                    


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