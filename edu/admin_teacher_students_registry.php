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
        $sql = "SELECT * FROM tbl_users WHERE userID=$_GET[teacher]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>

<?php 
if (isset($_POST['change_orders_status'])){

        $sqlx = "SELECT * FROM products WHERE id='$_POST[order_id]'";
        $resultx = mysqli_query($connect, $sqlx);
        $prax = mysqli_fetch_array($resultx);
            if($prax[teacher_id] ==  $_GET[teacher]) { 
                $sql = "UPDATE products SET status='$_POST[change_orders_status]' WHERE id='$_POST[order_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Lesson Status Changed Successfully!')</script>";
}           }
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
    <title>Student Registry - <?php echo $site_title; ?></title>

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
                                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                                    <div class="row">
                                   

                                        
                                            <div class="col-md-12 col-lg-12">
                                                <div class="p-top-0 p-bottom-20">
                                                    
                                                    
                                                    <a href="admin_teachers_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>TRAINERS/ TUTORS</strong></span></a>
                                                </div>
                                            </div><!-- end .col-md-12 -->




                                        <!-- end .col-md-12 -->
                                    </div>
                                </div>
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            






                            











                            <div class="row">
                              



<div class="col-lg-6 col-md-12 p-bottom-0">


    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: left; "><?php echo $pra[userName]; ?> - <?php echo $pra[grade]; ?> <br><strong>All Registration</strong></p> </div>

</div>


<div class="col-lg-6 col-md-12 p-top-20 " style=" color: white; text-align: right;">

                            <a href="admin_teachers_active.php?teacher=<?php echo $_GET[teacher]; ?>" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > TRAINER/TUTOR DASHBOARD</a>

                            <a target="_blankx" href="admin_teacher_students_registry_contact_only.php?teacher=<?php echo $_GET[teacher]; ?>&&contact=numbers" class="btn btn--md register_btn btn-primary" style=" background: white;line-height: inherit;padding: 5px 10px;color: black;margin-right: 5px;margin-top: 5px;" >Export Numbers</a>
                            <a target="_blankx" href="admin_teacher_students_registry_contact_only.php?teacher=<?php echo $_GET[teacher]; ?>&&contact=emails" class="btn btn--md register_btn btn-primary" style=" background: white;line-height: inherit;padding: 5px 10px;color: black;margin-right: 5px;margin-top: 5px;" >Export Emails</a>
                            <a target="_blankx" href="admin_teacher_students_registry_by_subject_contact_only.php?teacher=15&&lesson=14&&contact=details" class="btn btn--md register_btn btn-primary" style=" background: white;line-height: inherit;padding: 5px 10px;color: black;margin-right: 5px;margin-top: 5px;" >Export Name, ID, Email</a>

                            
</div>


                            </div>


  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }
      .postpay { background: black; font-weight: bold;  }


      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
  </style>    


                    


                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Lesson</th>
                                    <th>Charge</th>
                                    <th>Status</th>
                                    <th>Requested</th>
                                    <td></td>
                                </tr>
                                </thead>

                                <tbody>

<?php
        $sql2 = "SELECT * FROM products WHERE teacher_id='$_GET[teacher]' AND active = 1 ORDER by id DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {             
            
                //$sql_delete = "UPDATE products SET active='0'  WHERE teacher_id='$_GET[teacher]' AND active = 1 ORDER by id DESC";
                //mysqli_query($connect, $sql_delete);

        $sql3 = "SELECT * FROM tbl_users WHERE userID=$pra2[student_id]";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);

        $sql4 = "SELECT * FROM category WHERE id=$pra2[lesson_id]";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);

?>     

                                <tr>
                                    <td><?php echo $pra3[userID]; ?></td>
                                    <td><?php if($pra2[comments] != '') { ?><a href="<?php echo getImageUrl($pra2['comments'], $baseURL, $current_page); ?>" target="_blankx"><img src="<?php echo getImageUrl($pra2['comments'], $baseURL, $current_page); ?>" style="max-height: 70px;max-width: 105px;border: 2px solid white;border-radius: 5px;"></a><?php } ?></td>
                                    <td><?php echo $pra3[userName]; ?> <?php if($pra3[institute_id_verified] == 'Y') { echo '<br> <span style="background:#1dc9b7; color: white;     padding: 2px 10px;">';echo $pra3[institute_id]; echo '</span>'; } ?> <br></td>
                                    <td><?php echo $pra3[mobile]; ?></td>
                                    <td class="detail"><?php echo $pra4[name_of_class]; ?><br> (<?php echo $pra4[lesson_date]; ?> - <?php echo $pra4[lesson_time]; ?>)</td>
                                    <td><?php echo $pra4[charge]; ?>LKR </td>
                                    <?php 
                                        if($pra2[status] == 'Proceed') { 
                                                    echo '<td class="type"> <span class="proceed">Requested</span> </td>';  
                                        }
                                        if($pra2[status] == 'Paid') { 
                                                    echo '<td class="type"> <span class="paid">Paid</span> </td>';  
                                        }
                                        if($pra2[status] == 'Free') { 
                                                    echo '<td class="type"> <span class="finished">Free</span> </td>';  
                                        }
                                        if($pra2[status] == 'PostPay') { 
                                                    echo '<td class="type"> <span class="postpay">PostPay</span> </td>';  
                                        }
                                        if($pra2[status] == 'Institute') { 
                                                    echo '<td class="type"> <span class="postpay">Institute</span> </td>';  
                                        }

                                    ?>
                                    <td><?php echo $pra2[posted_date]; ?></td>

                                    <td class="action">
                                        <form action="" method="post">
                                            <input type="hidden" name="order_id" value="<?php echo $pra2[id]; ?>">
                                            <select name="change_orders_status" required=""  onchange="this.form.submit()" style=" background: #1dc9b7; color: white; height: 30px; width: fit-content; font-weight: bold; ">
                                                <option>Edit</option>
                                                <option value="Proceed">Requested</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Free">Free</option>
                                                <option value="PostPay">PostPay</option>
                                                <option value="Institute">Institute</option>
                                            </select>
                                        </form>
                                    </td>
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




     
  


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>