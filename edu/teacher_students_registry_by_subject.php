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

<?php 
if (isset($_POST['change_orders_status'])){

        $sqlx = "SELECT * FROM products WHERE id='$_POST[order_id]'";
        $resultx = mysqli_query($connect, $sqlx);
        $prax = mysqli_fetch_array($resultx);
            if($prax[teacher_id] ==  $_SESSION[userSession]) { 
                //$sql = "UPDATE products SET status='$_POST[change_orders_status]' WHERE id='$_POST[order_id]'";
                //mysqli_query($connect, $sql);
                //echo "<script>alert('Lesson Status Changed Successfully!')</script>";
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
                            






                            









<?php

        $sql4 = "SELECT * FROM category WHERE id=$_GET[lesson]";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);

?>
                            <div class="row">
                              



<div class="col-lg-12 col-md-12 p-bottom-0">

<br>

    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: left; "><?php echo $pra[userName]; ?> - <?php echo $pra[grade]; ?> <br>

        <span style=" font-weight: bold; "><?php echo $pra4[name_of_class]; ?> (<?php echo $pra4[lesson_date]; ?> - <?php echo $pra4[lesson_time]; ?>)</span>
        <br>
        <span style=" font-weight: bold; "><?php echo $pra4[charge]; ?> <?php echo $pra4[currency]; ?></span>

    </p> </div>

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
                                    <th></th>
                                    <th></th>
                                    <th>Student Name & ID</th>
                                    <th>Contact</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Requested</th>
                                    <!--<td></td>-->
                                </tr>
                                </thead>

                                <tbody>

<?php   $num=1;
        $sql2 = "SELECT * FROM products WHERE teacher_id='$_SESSION[userSession]' AND active = 1 AND lesson_id = '$_GET[lesson]' ORDER by student_id ASC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {             

        $sql3 = "SELECT * FROM tbl_users WHERE userID=$pra2[student_id]";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);

?>     

                                <tr>
                                    <td><?php echo $num; ?></td>
                                    <td><?php if($pra2[comments] != '') { ?><a href="<?php echo getImageUrl($pra2['comments'], $baseURL, $current_page); ?>" target="_blankx"><img src="<?php echo getImageUrl($pra2['comments'], $baseURL, $current_page); ?>" style="max-height: 70px;max-width: 115px;border: 2px solid white;border-radius: 5px;"></a><?php } ?></td>
                                    <td><?php echo $pra3[userName]; ?> (<?php echo $pra3[userID]; ?>)   <?php if($pra3[institute_id_verified] == 'Y') { echo '<br> <span style="background:#1dc9b7; color: white;     padding: 2px 10px;">';echo $pra3[institute_id]; echo '</span>'; } ?>
                                    <?php if($pra2[reference] != '') { ?><br>(<span style="color:red"><?php echo $pra2[reference]; ?></span>)<?php } ?></td>
                                    <td><?php echo $pra3[userEmail]; ?><br><?php echo $pra3[mobile]; ?> </td>
                                    <td class="type"><?php if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == 'Online' OR $pra2[status] == 'Proceed' && $pra2[paid_marked_by] == 'Online' ) { echo '<span class="proceed" style=" background: red; ">Online</span>'; } if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == '' ) { echo 'Deposit'; }?></td>
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

                                    <!--<td class="action">
                                        <form action="" method="post">
                                            <input type="hidden" name="order_id" value="<?php echo $pra2[id]; ?>">
                                            <select name="change_orders_status" required=""  onchange="this.form.submit()" style=" background: #1dc9b7; color: white; height: 30px; width: fit-content; font-weight: bold; ">
                                                <option>Edit</option>
                                                <option value="Proceed">Requested</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Free">Free</option>
                                                <option value="PostPay">PostPay</option>
                                            </select>
                                        </form>
                                    </td>-->
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