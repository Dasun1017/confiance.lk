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
    



<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Lessons of Teacher - <?php echo $site_title; ?></title>

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
                            






                            










<?php

        $sql4 = "SELECT * FROM category WHERE id=$_GET[lesson]";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);

?>
                            <div class="row">
                              



<div class="col-lg-6 col-md-12 p-bottom-0">

<br>
    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: left; "><?php echo $pra[userName]; ?> - <?php echo $pra[grade]; ?> <br>

        <span style=" font-weight: bold; "><?php echo $pra4[name_of_class]; ?> (<?php echo $pra4[lesson_date]; ?> - <?php echo $pra4[lesson_time]; ?>)</span>
        <br>
        <span style=" font-weight: bold; "><?php echo $pra4[charge]; ?> LKR</span>

    </p> </div>

</div>


<div class="col-lg-6 col-md-12 p-top-20 " style=" color: white; text-align: right;">

                            <a href="admin_teachers_active.php?teacher=<?php echo $_GET[teacher]; ?>" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > TRAINER/TUTOR DASHBOARD</a>
                            
</div>


                            </div>


  <style type="text/css">
@media print
  {   
      .hideprintedlink { display: none }
      .header-area { display: none }
      footer { display: none }
  }
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }
      .postpay { background: black; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
  </style>    


                      
                    















<?php 
        $CodeWallTutorialArray = ["Proceed", "Free", "PostPay", "Paid"];
        $arrayLength = count($CodeWallTutorialArray);
        
        $i = 0;
        while ($i < $arrayLength)
        {
            //echo $CodeWallTutorialArray[$i] ."<br />";

?>

                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Grade</th>
                                    <th class="hideprintedlink">Contact</th>
                                    <!--<th>School</th>-->
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Requested</th>
                                </tr>
                                </thead>

                                <tbody>

<?php
        $sql2 = "SELECT * FROM products WHERE teacher_id='$_GET[teacher]' AND active = 1 AND lesson_id = '$_GET[lesson]' AND status = '$CodeWallTutorialArray[$i]' ORDER by id DESC ";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {             

        $sql3 = "SELECT * FROM tbl_users WHERE userID=$pra2[student_id]";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);
        

        

?>     

                                <tr>
                                    
                                    
                                    <td><?php echo $pra3[userName]; ?></td>
                                    <td><?php echo $pra3[batch]; ?></td>
                                    <td class="hideprintedlink"><?php echo $pra3[userEmail]; ?><br><?php echo $pra3[mobile]; ?></td>
                                    <!--<td><?php echo $pra3[school]; ?> </td>-->
                                    <td class="type"><?php if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == 'Online' OR $pra2[status] == 'Proceed' && $pra2[paid_marked_by] == 'Online' ) { echo '<span class="proceed" style=" background: red; ">Online</span>'; } if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == '' ) { echo 'Deposit'; } if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == 'Institute' ) { echo 'Institute'; }?></td>
                                    <?php  
                                        if($pra2[status] == 'Proceed') { 
                                                    echo '<td class="type"> <span class="proceed">Requested</span> </td>';  
                                        }
                                        if($pra2[status] == 'Paid') { 
                                                if($pra2[paid_marked_by] == 'Online') {  $online += 1; $real_paid = 'Online'; }
                                                if($pra2[paid_marked_by] == 'Institute') { $institute += 1;  $real_paid = 'Institute'; }
                                                if($pra2[paid_marked_by] == '') { $bank += 1;  $real_paid = 'Paid'; }
                                                    echo '<td class="type"> <span class="paid">'.$real_paid.'</span> </td>';  
                                        }
                                        if($pra2[status] == 'Free') {  $free += 1; 
                                                    echo '<td class="type"> <span class="finished">Free</span> </td>';  
                                        }
                                        if($pra2[status] == 'PostPay') {  $postpay += 1; 
                                                    echo '<td class="type"> <span class="postpay">PostPay</span> </td>';  
                                        }

                                    ?>
                                    
                                    
                                    
                                    
                                    
                                    <td><?php echo $pra2[posted_date]; ?></td>

                                </tr>


<?php } ?>
                                </tbody>
                            </table>

                    </div></div>



                </div>


<?php 
            $i++;
  } 
?>


















<div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Free</th>
                                    <th>Institute</th>
                                    <th>Direct Bank</th>
                                    <th>Online</th>
                                    <th>PostPay</th>
                                    <th class="hideprintedlink"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="type"><span class="postpay"><?php echo $free*$pra4[charge]; ?></span></td>
                                    <td class="type"><span class="paid"><?php echo $institute*$pra4[charge]; ?></span></td>
                                    <td class="type"><span class="finished"><?php echo $bank*$pra4[charge]; ?></span></td>
                                    <td class="type"><span class="proceed"><?php echo $online*$pra4[charge]; ?></span></td>
                                    <td class="type"><span class="proceed" style="background: blue"><?php echo $postpay*$pra4[charge]; ?></span></td>
                                    <td class="type hideprintedlink" style="max-width: 100px;"><a onclick="window.print();return false;"><span class="postpay" style="cursor:pointer;  background: darkblue; font-size: inherit; padding: 10px 20px; ">Generate PDF</span></a></td>    
                                </tr>

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