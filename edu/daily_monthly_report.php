<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>

<?php

if(!$user_home->is_logged_in())
{
     $user_home->redirect('/index.php');
}


if($user_home->is_logged_in()!="")
{
    if($_SESSION['type'] == '2' OR $_SESSION['type'] == '3' ) { $user_login->redirect('index.php'); }
}

?>
<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="LearnBS.lk - Suranga Senadeera">
    <meta name="keywords" content="LearnBS.lk, LearnBS, LearnBS.lk - Suranga Senadeera">
    <title>Daily Collection - LearnBS.lk - Suranga Senadeera<</title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>


<style>


.proceed {     background: #2196F3 !important; }

@media print {
.hideprintedlink { display:none;  }

.content_above { padding: : 0px !important }
}




    ::placeholder { color: black; }
    @media only screen and (max-width: 480px) {
    .col-md-6_new {     flex: 0 0 50%; max-width: 50%; padding:6px 10px !important }  
    .hide_in_mobile {     display:none; } 
    .bg_image_holder {  height: 100% !important; top: 80px; } 
    .no_margin_in_mobile { padding: 0px }
    .no_border_radius_in_mobile { border-radius: 0px !important }
    } 
.bg_image_holder {  height: 100% !important;     position: fixed;     background-size: cover;} 
</style>


<!--<script src="//code.tidio.co/otopslftp1pmo1f9ozufwtskcojb30ju.js"></script>-->
</head>
<body class="preload">
    
    
    


    

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    






    
    
    <section class="hero-area4 bgimage">
        <!---->
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;">
                            <div class="content-wrapper">
                               
           
                <div class="container featured-products2  p-top-0 p-bottom-10" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            






                            




                            <div class="row " >
<div class="col-lg-5 col-md-12 p-bottom-0">
    <div class="login--header" style=" border-bottom: none; ">

    <?php if(isset($_GET[date_search])) { ?> <h3 style=" font-size: initial; color: white; text-align: left; ">Reports of "<strong><?php echo $_GET['selected_date']; ?></strong>"</h3><?php }?>


    <form class="row hideprintedlink" style="padding: 10px 0px 0 0;width: 100%" action="" method="get">
        <div class="col-lg-4 col-md-6">
            <input type="date" name="selected_date" value="<?php if(isset($_GET[date_search])) { echo $_GET[selected_date]; } else {  echo date('Y-m-d');  } ?>">
        </div>
        <div class="col-lg-6 col-md-6">
            <input value="Filter Now" name="date_search" type="submit" style=" background: green; border: none; color: white; ">
        </div>
    </form>

 </div>

</div>




<?php if($_GET[show] == 'online') { ?>
<div class="col-lg-4 col-md-12 p-bottom-0">
    <a href="daily_monthly_report.php?selected_date=<?php echo $_GET[selected_date]; ?>&show=all" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;background: #ffb91b;font-size: inherit;padding: 10px 20px;color: black;"> SHOW ALL PAYMENTS</span></a>

    <a href="daily_monthly_report_group.php" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;background: #ffb91b;font-size: inherit;padding: 10px 20px;color: black;"> GROUP BY EMPLOYEES</span></a>
</div>
<?php } ?>

<?php if($_GET[show] == 'cash') { ?>
<div class="col-lg-4 col-md-12 p-bottom-0">
    <a href="daily_monthly_report.php?selected_date=<?php echo $_GET[selected_date]; ?>&show=all" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;background: #ffb91b;font-size: inherit;padding: 10px 20px;color: black;"> SHOW ALL PAYMENTS</span></a>

    <a href="daily_monthly_report_group.php" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;background: #ffb91b;font-size: inherit;padding: 10px 20px;color: black;"> GROUP BY EMPLOYEES</span></a>
</div>
<?php } ?>

<?php if($_GET[show] == 'all' OR $_GET[show] == '') { ?>

    <?php if(isset($_GET[selected_date])) { ?>

        <div class="col-lg-4 col-md-12 p-bottom-0">
            <a href="daily_monthly_report.php?selected_date=<?php echo $_GET[selected_date]; ?>&show=cash" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;  background: red; font-size: inherit; padding: 10px 20px; color: white; "> SHOW ONLY CASH</span></a>

            <a href="daily_monthly_report.php?selected_date=<?php echo $_GET[selected_date]; ?>&show=online" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;  background: red; font-size: inherit; padding: 10px 20px; color: white; "> SHOW ONLY ONLINE</span></a>
            <a href="daily_monthly_report_group.php" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;background: #ffb91b;font-size: inherit;padding: 10px 20px;color: black;"> GROUP BY EMPLOYEES</span></a>
        </div>

    <?php } ?>
    
    <?php if(isset($_GET[selected_month])) { ?>

        <div class="col-lg-4 col-md-12 p-bottom-0">
            <a href="daily_monthly_report.php?selected_month=<?php echo $_GET[selected_month]; ?>&show=cash" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;  background: red; font-size: inherit; padding: 10px 20px; color: white; "> SHOW ONLY CASH</span></a>

            <a href="daily_monthly_report.php?selected_month=<?php echo $_GET[selected_month]; ?>&show=online" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;  background: red; font-size: inherit; padding: 10px 20px; color: white; "> SHOW ONLY ONLINE</span></a>
            <a href="daily_monthly_report_group.php" style=" margin-top: 20px; display: flex; width: 100%; "><span class="postpay" style="cursor:pointer;background: #ffb91b;font-size: inherit;padding: 10px 20px;color: black;"> GROUP BY EMPLOYEES</span></a>
        </div>

    <?php } ?>
    
<?php } ?>



<div class="col-lg-3 col-md-12 p-bottom-0">
    <div class="login--header" style=" border-bottom: none; ">

    <?php if(isset($_GET[month_search])) { ?> <h3 style=" font-size: initial; color: white; text-align: left; "><!--Reports of "<strong><?php echo $_GET['selected_month']; ?></strong>" <br> -->from <?php echo $start_new = date('Y-m-01',strtotime($_GET[selected_month])); ?> to <?php echo date('Y-m-d',strtotime($start_new . "+1 months")); ?> <br><br> on <?php echo date('Y-m-d'); ?> </h3><?php }?>


    <form class="row hideprintedlink" style="padding: 10px 0px 0 0;width: 100%" action="" method="get">
        <div class="col-lg-9 col-md-9">
            <input type="month" name="selected_month" value="<?php echo date('Y-m');  ?>">
        </div>
        <div class="col-lg-3 col-md-3">
            <input value="Filter Now" name="month_search" type="submit" style=" background: green; border: none; color: white; ">
        </div>
    </form>

 </div>

</div>



                            </div>








  <style type="text/css">
    .table thead>tr>th { padding: 30px 0 30px 10px; } 
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }
      .postpay { background: black; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

      .form-control, input {border: 1px solid #262626; } 
      
      
@media print {
.paid { color: black !important; background: none;} 
.finished { color: black !important; background: none;} 
.proceed { color: black !important; background: none !important;} 

}
  </style>    


<div class="col-lg-12 col-md-12 p-bottom-50 p-top-20" align="center" style="display: flex;"></div>         
                        
                     













<?php if($_GET[show] == 'all' OR $_GET[show] == '') { ?> <!-- show all-->                     
                    
 <?php if(isset($_GET[selected_date])) { ?>

                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Cash Balance</th>
                                    <th>Direct Bank</th>
                                    <th>Online</th>
                                    <th>Total</th>
                                    <th class="hideprintedlink"></th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $tomorrow = date('Y-m-d',strtotime($_GET[selected_date] . "+1 days"));

        $sql = "SELECT * FROM products WHERE status = 'Paid' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow'  ";
        $result = mysqli_query($connect, $sql);
        while($pra = mysqli_fetch_array($result)) {  

        $sql_new_1 = "SELECT * FROM category WHERE id='$pra[lesson_id]' ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        $pra_new_1 = mysqli_fetch_array($result_new_1);  
           $total += $pra_new_1[charge];
        } 


        
        $sql2 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = 'Institute' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow'  ";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  

        $sql_new_2 = "SELECT * FROM category WHERE id='$pra2[lesson_id]' ORDER by id DESC";
        $result_new_2 = mysqli_query($connect, $sql_new_2);
        $pra_new_2 = mysqli_fetch_array($result_new_2);  
           $institute += $pra_new_2[charge];
        }

        
        $sql3 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = '' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow'  ";
        $result3 = mysqli_query($connect, $sql3);
        while($pra3 = mysqli_fetch_array($result3)) {  

        $sql_new_3 = "SELECT * FROM category WHERE id='$pra3[lesson_id]' ORDER by id DESC";
        $result_new_3 = mysqli_query($connect, $sql_new_3);
        $pra_new_3 = mysqli_fetch_array($result_new_3);  
           $bank += $pra_new_3[charge];
        }

        
        $sql4 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = 'Online' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow'  ";
        $result4 = mysqli_query($connect, $sql4);
        while($pra4 = mysqli_fetch_array($result4)) {  

        $sql_new_4 = "SELECT * FROM category WHERE id='$pra4[lesson_id]' ORDER by id DESC";
        $result_new_4 = mysqli_query($connect, $sql_new_4);
        $pra_new_4 = mysqli_fetch_array($result_new_4);  
           $online += $pra_new_4[charge];
        } 

?>
                                <tr>
                                    <td><?php echo $_GET[selected_date]; ?></td>
                                    <td class="type"><span class="paid"><?php echo $institute; ?></span></td>
                                    <td class="type"><span class="finished"><?php echo $bank; ?></span></td>
                                    <td class="type"><span class="proceed"><?php echo $online; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $total; ?></span></td>    
                                    <td class="type hideprintedlink" style="max-width: 100px;"><a onclick="window.print();return false;"><span class="postpay" style="cursor:pointer;  background: darkblue; font-size: inherit; padding: 10px 20px; ">Generate PDF</span></a></td>    
                                </tr>
<?php //} ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>
















               
                    
 <?php if(isset($_GET[selected_date])) { ?>
 <?php  $total_amount = ''; ?>   

                <div class="row">
                    <div class="col-md-12">
                        <h3 style="color: white; text-align: center; padding: 20px 0;">Balance Sheet</h3>
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Total Amount</th>
                                    <th>%</th>
                                    <th>To Institute</th>
                                    <th>To Teacher</th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $tomorrow = date('Y-m-d',strtotime($_GET[selected_date] . "+1 days"));

        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


        $total = '';

        $sqlx = "SELECT * FROM products WHERE teacher_id = '$pra2[userID]' AND  status = 'Paid' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow'  ";
        $resultx = mysqli_query($connect, $sqlx);
        while($prax = mysqli_fetch_array($resultx)) {  

        $sql_new_1 = "SELECT * FROM category WHERE id='$prax[lesson_id]' ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        $pra_new_1 = mysqli_fetch_array($result_new_1);  
            $total += $pra_new_1[charge]; 
        } 



?>
            
        <?php $com = $pra2[selected_package]; ?>
                                <tr style="<?php if($total=='' OR $total=='0') { echo 'display:none'; } ?>" >
                                    <td><a href="daily_monthly_report_full.php?<?php if(isset($_GET[selected_date])) { echo '&selected_date='; echo $_GET[selected_date];  } ?><?php if(isset($_GET[selected_month])) { echo '&selected_month='; echo $_GET[selected_month];  } ?><?php if(isset($_GET[show])) { echo '&show='; echo $_GET[show];  } ?>&teacher_id=<?php echo $pra2[userID]; ?>" target="_blank"><?php echo $pra2[userName]; ?></a></td>
                                    <td class="type"><span class="paid"><?php echo $total; ?></span></td>
                                    <td class="type"><span class="finished"><?php echo $pra2[selected_package]; echo ' ('.$com.') '; ?></span></td>
                                    <td class="type"><span class="proceed"><?php echo $to_institute = $total*$com; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $total-$to_institute; ?></span></td>    
                                </tr>
<?php } ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>
























































           
 <?php if(isset($_GET[selected_month])) { ?>

                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Cash Balance</th>
                                    <th>Direct Bank</th>
                                    <th>Online</th>
                                    <th>Total</th>
                                    <th class="hideprintedlink"></th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $start = date('Y-m-01',strtotime($_GET[selected_month])); 
        $end_date = date('Y-m-d',strtotime($start . "+1 months"));

        $sql = "SELECT * FROM products WHERE status = 'Paid' AND active = '1' AND posted_date between '$start' AND '$end_date'  ";
        $result = mysqli_query($connect, $sql);
        while($pra = mysqli_fetch_array($result)) {  

        $sql_new_1 = "SELECT * FROM category WHERE id='$pra[lesson_id]' ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        $pra_new_1 = mysqli_fetch_array($result_new_1);  
           $total += $pra_new_1[charge];
        } 


        
        $sql2 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = 'Institute' AND active = '1' AND posted_date between '$start' AND '$end_date'  ";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  

        $sql_new_2 = "SELECT * FROM category WHERE id='$pra2[lesson_id]' ORDER by id DESC";
        $result_new_2 = mysqli_query($connect, $sql_new_2);
        $pra_new_2 = mysqli_fetch_array($result_new_2);  
           $institute += $pra_new_2[charge];
        }

        
        $sql3 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = '' AND active = '1' AND posted_date between '$start' AND '$end_date'  ";
        $result3 = mysqli_query($connect, $sql3);
        while($pra3 = mysqli_fetch_array($result3)) {  

        $sql_new_3 = "SELECT * FROM category WHERE id='$pra3[lesson_id]' ORDER by id DESC";
        $result_new_3 = mysqli_query($connect, $sql_new_3);
        $pra_new_3 = mysqli_fetch_array($result_new_3);  
           $bank += $pra_new_3[charge];
        }

        
        $sql4 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = 'Online' AND active = '1' AND posted_date between '$start' AND '$end_date'  ";
        $result4 = mysqli_query($connect, $sql4);
        while($pra4 = mysqli_fetch_array($result4)) {  

        $sql_new_4 = "SELECT * FROM category WHERE id='$pra4[lesson_id]' ORDER by id DESC";
        $result_new_4 = mysqli_query($connect, $sql_new_4);
        $pra_new_4 = mysqli_fetch_array($result_new_4);  
           $online += $pra_new_4[charge];
        } 

?>
                                <tr>
                                    <td><?php echo $_GET[selected_month]; ?></td>
                                    <td class="type"><span class="paid"><?php echo $institute; ?></span></td>
                                    <td class="type"><span class="finished"><?php echo $bank; ?></span></td>
                                    <td class="type"><span class="proceed"><?php echo $online; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $total; ?></span></td>  
                                    <td class="type hideprintedlink" style="max-width: 100px;"><a onclick="window.print();return false;"><span class="postpay" style="cursor:pointer;  background: darkblue; font-size: inherit; padding: 10px 20px; ">Generate PDF</span></a></td>    
                                </tr>
<?php //} ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>
















               
                    
 <?php if(isset($_GET[selected_month])) { ?>
 <?php  $total_amount = ''; ?>   

                <div class="row">
                    <div class="col-md-12">
                        <h3 style="color: white; text-align: center; padding: 20px 0;">Balance Sheet</h3>
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Total Amount</th>
                                    <th>%</th>
                                    <th>To Institute</th>
                                    <th>To Teacher</th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $start = date('Y-m-01',strtotime($_GET[selected_month])); 
        $end_date = date('Y-m-d',strtotime($start . "+1 months"));

        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


        $total = '';

        $sqlx = "SELECT * FROM products WHERE teacher_id = '$pra2[userID]' AND  status = 'Paid' AND active = '1' AND posted_date between '$start' AND '$end_date'  ";
        $resultx = mysqli_query($connect, $sqlx);
        while($prax = mysqli_fetch_array($resultx)) {  

        $sql_new_1 = "SELECT * FROM category WHERE id='$prax[lesson_id]' ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        $pra_new_1 = mysqli_fetch_array($result_new_1);  
            $total += $pra_new_1[charge]; 
        } 



?>
          
        <?php $com = $pra2[selected_package]; ?>
                                <tr style="<?php if($total=='' OR $total=='0') { echo 'display:none'; } ?>" >
                                    <td><a href="daily_monthly_report_full.php?<?php if(isset($_GET[selected_date])) { echo '&selected_date='; echo $_GET[selected_date];  } ?><?php if(isset($_GET[selected_month])) { echo '&selected_month='; echo $_GET[selected_month];  } ?><?php if(isset($_GET[show])) { echo '&show='; echo $_GET[show];  } ?>&teacher_id=<?php echo $pra2[userID]; ?>" target="_blank"><?php echo $pra2[userName]; ?></a></td>
                                    <td class="type"><span class="paid"><?php echo $total; ?></span></td>
                                    <td class="type"><span class="finished"><?php echo $pra2[selected_package]; echo ' ('.$com.') '; ?></span></td>
                                    <td class="type"><span class="proceed"><?php echo $to_institute = $total*$com; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $total-$to_institute; ?></span></td>    
                                </tr>
<?php } ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>



                
 <?php if(isset($_GET[selected_date]) || isset($_GET[selected_month])) { ?>



 <div style="color: white; font-size: large; text-align: left; padding: 20px 0; margin-top: 50px">
                        <span style="width: 300px;display: inline-block; margin-bottom: 10px;">Name of the Authorized Person </span>: ...................................... <br>

                        <span style="width: 300px;display: inline-block; margin-bottom: 10px;">Signature </span>: ...................................... <br>

                        <span style="width: 300px;display: inline-block; margin-bottom: 10px;">Date </span>: ...................................... </div>



<?php } ?>






<?php } ?> <!-- show all--> 















































































































<?php if($_GET[show] == 'cash') { ?><!-- show cash--> 
         
 <?php if(isset($_GET[selected_date])) { ?>

                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Cash Balance</th>
                                    <th>Total</th>
                                    <th class="hideprintedlink"></th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $tomorrow = date('Y-m-d',strtotime($_GET[selected_date] . "+1 days"));


        
        $sql2 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = 'Institute' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow'  ";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  

        $sql_new_2 = "SELECT * FROM category WHERE id='$pra2[lesson_id]' ORDER by id DESC";
        $result_new_2 = mysqli_query($connect, $sql_new_2);
        $pra_new_2 = mysqli_fetch_array($result_new_2);  
           $institute += $pra_new_2[charge];
        }

        

?>
                                <tr>
                                    <td><?php echo $_GET[selected_date]; ?></td>
                                    <td class="type"><span class="paid"><?php echo $institute; ?></span></td>
                                   
                                    <td class="type"><span class="postpay"><?php echo $institute; ?></span></td>    
                                    <td class="type hideprintedlink" style="max-width: 100px;"><a onclick="window.print();return false;"><span class="postpay" style="cursor:pointer;  background: darkblue; font-size: inherit; padding: 10px 20px; ">Generate PDF</span></a></td>    
                                </tr>
<?php //} ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>
















               
                    
 <?php if(isset($_GET[selected_date])) { ?>
 <?php  $total_amount = ''; ?>   

                <div class="row">
                    <div class="col-md-12">
                        <h3 style="color: white; text-align: center; padding: 20px 0;">Balance Sheet</h3>
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Total Amount</th>
                                    <th>%</th>
                                    <th>To Institute</th>
                                    <th>To Teacher</th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $tomorrow = date('Y-m-d',strtotime($_GET[selected_date] . "+1 days"));

        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


        $total = '';

        $sqlx = "SELECT * FROM products WHERE teacher_id = '$pra2[userID]' AND  status = 'Paid' AND paid_marked_by = 'Institute' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow'  ";
        $resultx = mysqli_query($connect, $sqlx);
        while($prax = mysqli_fetch_array($resultx)) {  

        $sql_new_1 = "SELECT * FROM category WHERE id='$prax[lesson_id]' ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        $pra_new_1 = mysqli_fetch_array($result_new_1);  
            $total += $pra_new_1[charge]; 
        } 



?>
          
        <?php $com = $pra2[selected_package]; ?>
        
                                <tr style="<?php if($total=='' OR $total=='0') { echo 'display:none'; } ?>" >
                                    <td><a href="daily_monthly_report_full.php?<?php if(isset($_GET[selected_date])) { echo '&selected_date='; echo $_GET[selected_date];  } ?><?php if(isset($_GET[selected_month])) { echo '&selected_month='; echo $_GET[selected_month];  } ?><?php if(isset($_GET[show])) { echo '&show='; echo $_GET[show];  } ?>&teacher_id=<?php echo $pra2[userID]; ?>" target="_blank"><?php echo $pra2[userName]; ?></a></td>
                                    <td class="type"><span class="paid"><?php echo $total; ?></span></td>
                                    <td class="type"><span class="finished"><?php echo $pra2[selected_package]; echo ' ('.$com.') '; ?></span></td>
                                    <td class="type"><span class="proceed"><?php echo $to_institute = $total*$com; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $total-$to_institute; ?></span></td>    
                                </tr>
<?php } ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>
























































           
 <?php if(isset($_GET[selected_month])) { ?>

                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Cash Balance</th>
                                    <th>Total</th>
                                    <th class="hideprintedlink"></th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $start = date('Y-m-01',strtotime($_GET[selected_month])); 
        $end_date = date('Y-m-d',strtotime($start . "+1 months"));


        
        $sql2 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = 'Institute' AND active = '1' AND posted_date between '$start' AND '$end_date'  ";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  

        $sql_new_2 = "SELECT * FROM category WHERE id='$pra2[lesson_id]' ORDER by id DESC";
        $result_new_2 = mysqli_query($connect, $sql_new_2);
        $pra_new_2 = mysqli_fetch_array($result_new_2);  
           $institute += $pra_new_2[charge];
        }

        

?>
                                <tr>
                                    <td><?php echo $_GET[selected_month]; ?></td>
                                    <td class="type"><span class="paid"><?php echo $institute; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $institute; ?></span></td>  
                                    <td class="type hideprintedlink" style="max-width: 100px;"><a onclick="window.print();return false;"><span class="postpay" style="cursor:pointer;  background: darkblue; font-size: inherit; padding: 10px 20px; ">Generate PDF</span></a></td>    
                                </tr>
<?php //} ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>
















               
                    
 <?php if(isset($_GET[selected_month])) { ?>
 <?php  $total_amount = ''; ?>   

                <div class="row">
                    <div class="col-md-12">
                        <h3 style="color: white; text-align: center; padding: 20px 0;">Balance Sheet</h3>
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Total Amount</th>
                                    <th>%</th>
                                    <th>To Institute</th>
                                    <th>To Teacher</th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $start = date('Y-m-01',strtotime($_GET[selected_month])); 
        $end_date = date('Y-m-d',strtotime($start . "+1 months"));

        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


        $total = '';

        $sqlx = "SELECT * FROM products WHERE teacher_id = '$pra2[userID]' AND  status = 'Paid' AND paid_marked_by = 'Institute'  AND active = '1' AND posted_date between '$start' AND '$end_date'  ";
        $resultx = mysqli_query($connect, $sqlx);
        while($prax = mysqli_fetch_array($resultx)) {  

        $sql_new_1 = "SELECT * FROM category WHERE id='$prax[lesson_id]' ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        $pra_new_1 = mysqli_fetch_array($result_new_1);  
            $total += $pra_new_1[charge]; 
        } 



?>
          
        <?php $com = $pra2[selected_package]; ?>
                                <tr style="<?php if($total=='' OR $total=='0') { echo 'display:none'; } ?>" >
                                    <td><a href="daily_monthly_report_full.php?<?php if(isset($_GET[selected_date])) { echo '&selected_date='; echo $_GET[selected_date];  } ?><?php if(isset($_GET[selected_month])) { echo '&selected_month='; echo $_GET[selected_month];  } ?><?php if(isset($_GET[show])) { echo '&show='; echo $_GET[show];  } ?>&teacher_id=<?php echo $pra2[userID]; ?>" target="_blank"><?php echo $pra2[userName]; ?></a></td>
                                    <td class="type"><span class="paid"><?php echo $total; ?></span></td>
                                    <td class="type"><span class="finished"><?php echo $pra2[selected_package]; echo ' ('.$com.') '; ?></span></td>
                                    <td class="type"><span class="proceed"><?php echo $to_institute = $total*$com; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $total-$to_institute; ?></span></td>    
                                </tr>
<?php } ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>



                
 <?php if(isset($_GET[selected_date]) || isset($_GET[selected_month])) { ?>



 <div style="color: white; font-size: large; text-align: left; padding: 20px 0; margin-top: 50px">
                        <span style="width: 300px;display: inline-block; margin-bottom: 10px;">Name of the Authorized Person </span>: ...................................... <br>

                        <span style="width: 300px;display: inline-block; margin-bottom: 10px;">Signature </span>: ...................................... <br>

                        <span style="width: 300px;display: inline-block; margin-bottom: 10px;">Date </span>: ...................................... </div>



<?php } ?>





<?php } ?><!-- show cash--> 













































































































<?php if($_GET[show] == 'online') { ?><!-- show online--> 
         
 <?php if(isset($_GET[selected_date])) { ?>

                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Online Balance</th>
                                    <th>Total</th>
                                    <th class="hideprintedlink"></th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $tomorrow = date('Y-m-d',strtotime($_GET[selected_date] . "+1 days"));


        
        $sql2 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = 'Online' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow'  ";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  

        $sql_new_2 = "SELECT * FROM category WHERE id='$pra2[lesson_id]' ORDER by id DESC";
        $result_new_2 = mysqli_query($connect, $sql_new_2);
        $pra_new_2 = mysqli_fetch_array($result_new_2);  
           $institute += $pra_new_2[charge];
        }

        

?>
                                <tr>
                                    <td><?php echo $_GET[selected_date]; ?></td>
                                    <td class="type"><span class="paid"><?php echo $institute; ?></span></td>
                                   
                                    <td class="type"><span class="postpay"><?php echo $institute; ?></span></td>    
                                    <td class="type hideprintedlink" style="max-width: 100px;"><a onclick="window.print();return false;"><span class="postpay" style="cursor:pointer;  background: darkblue; font-size: inherit; padding: 10px 20px; ">Generate PDF</span></a></td>    
                                </tr>
<?php //} ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>
















               
                    
 <?php if(isset($_GET[selected_date])) { ?>
 <?php  $total_amount = ''; ?>   

                <div class="row">
                    <div class="col-md-12">
                        <h3 style="color: white; text-align: center; padding: 20px 0;">Balance Sheet</h3>
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Total Amount</th>
                                    <th>%</th>
                                    <th>To Institute</th>
                                    <th>To Teacher</th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $tomorrow = date('Y-m-d',strtotime($_GET[selected_date] . "+1 days"));

        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


        $total = '';

        $sqlx = "SELECT * FROM products WHERE teacher_id = '$pra2[userID]' AND  status = 'Paid' AND paid_marked_by = 'Online' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow'  ";
        $resultx = mysqli_query($connect, $sqlx);
        while($prax = mysqli_fetch_array($resultx)) {  

        $sql_new_1 = "SELECT * FROM category WHERE id='$prax[lesson_id]' ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        $pra_new_1 = mysqli_fetch_array($result_new_1);  
            $total += $pra_new_1[charge]; 
        } 



?>
          
        <?php $com = $pra2[selected_package]; ?>
                                <tr style="<?php if($total=='' OR $total=='0') { echo 'display:none'; } ?>" >
                                    <td><a href="daily_monthly_report_full.php?<?php if(isset($_GET[selected_date])) { echo '&selected_date='; echo $_GET[selected_date];  } ?><?php if(isset($_GET[selected_month])) { echo '&selected_month='; echo $_GET[selected_month];  } ?><?php if(isset($_GET[show])) { echo '&show='; echo $_GET[show];  } ?>&teacher_id=<?php echo $pra2[userID]; ?>" target="_blank"><?php echo $pra2[userName]; ?></a></td>
                                    <td class="type"><span class="paid"><?php echo $total; ?></span></td>
                                    <td class="type"><span class="finished"><?php echo $pra2[selected_package]; echo ' ('.$com.') '; ?></span></td>
                                    <td class="type"><span class="proceed"><?php echo $to_institute = $total*$com; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $total-$to_institute; ?></span></td>    
                                </tr>
<?php } ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>
























































           
 <?php if(isset($_GET[selected_month])) { ?>

                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Online Balance</th>
                                    <th>Total</th>
                                    <th class="hideprintedlink"></th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $start = date('Y-m-01',strtotime($_GET[selected_month])); 
        $end_date = date('Y-m-d',strtotime($start . "+1 months"));


        
        $sql2 = "SELECT * FROM products WHERE status = 'Paid' AND paid_marked_by = 'Online' AND active = '1' AND posted_date between '$start' AND '$end_date'  ";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  

        $sql_new_2 = "SELECT * FROM category WHERE id='$pra2[lesson_id]' ORDER by id DESC";
        $result_new_2 = mysqli_query($connect, $sql_new_2);
        $pra_new_2 = mysqli_fetch_array($result_new_2);  
           $institute += $pra_new_2[charge];
        }

        

?>
                                <tr>
                                    <td><?php echo $_GET[selected_month]; ?></td>
                                    <td class="type"><span class="paid"><?php echo $institute; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $institute; ?></span></td>  
                                    <td class="type hideprintedlink" style="max-width: 100px;"><a onclick="window.print();return false;"><span class="postpay" style="cursor:pointer;  background: darkblue; font-size: inherit; padding: 10px 20px; ">Generate PDF</span></a></td>    
                                </tr>
<?php //} ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>
















               
                    
 <?php if(isset($_GET[selected_month])) { ?>
 <?php  $total_amount = ''; ?>   

                <div class="row">
                    <div class="col-md-12">
                        <h3 style="color: white; text-align: center; padding: 20px 0;">Balance Sheet</h3>
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Teacher Name</th>
                                    <th>Total Amount</th>
                                    <th>%</th>
                                    <th>To Institute</th>
                                    <th>To Teacher</th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $start = date('Y-m-01',strtotime($_GET[selected_month])); 
        $end_date = date('Y-m-d',strtotime($start . "+1 months"));

        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


        $total = '';

        $sqlx = "SELECT * FROM products WHERE teacher_id = '$pra2[userID]' AND  status = 'Paid' AND paid_marked_by = 'Online'  AND active = '1' AND posted_date between '$start' AND '$end_date'  ";
        $resultx = mysqli_query($connect, $sqlx);
        while($prax = mysqli_fetch_array($resultx)) {  

        $sql_new_1 = "SELECT * FROM category WHERE id='$prax[lesson_id]' ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        $pra_new_1 = mysqli_fetch_array($result_new_1);  
            $total += $pra_new_1[charge]; 
        } 



?>
          
        <?php $com = $pra2[selected_package]; ?>
                                <tr style="<?php if($total=='' OR $total=='0') { echo 'display:none'; } ?>" >
                                    <td><a href="daily_monthly_report_full.php?<?php if(isset($_GET[selected_date])) { echo '&selected_date='; echo $_GET[selected_date];  } ?><?php if(isset($_GET[selected_month])) { echo '&selected_month='; echo $_GET[selected_month];  } ?><?php if(isset($_GET[show])) { echo '&show='; echo $_GET[show];  } ?>&teacher_id=<?php echo $pra2[userID]; ?>" target="_blank"><?php echo $pra2[userName]; ?></a></td>
                                    <td class="type"><span class="paid"><?php echo $total; ?></span></td>
                                    <td class="type"><span class="finished"><?php echo $pra2[selected_package]; echo ' ('.$com.') '; ?></span></td>
                                    <td class="type"><span class="proceed"><?php echo $to_institute = $total*$com; ?></span></td>
                                    <td class="type"><span class="postpay"><?php echo $total-$to_institute; ?></span></td>    
                                </tr>
<?php } ?>



                                </tbody>
                            </table>

                    </div></div>




                            </div>

<?php } ?>



                
 <?php if(isset($_GET[selected_date]) || isset($_GET[selected_month])) { ?>



 <div style="color: white; font-size: large; text-align: left; padding: 20px 0; margin-top: 50px">
                        <span style="width: 300px;display: inline-block; margin-bottom: 10px;">Name of the Authorized Person </span>: ...................................... <br>

                        <span style="width: 300px;display: inline-block; margin-bottom: 10px;">Signature </span>: ...................................... <br>

                        <span style="width: 300px;display: inline-block; margin-bottom: 10px;">Date </span>: ...................................... </div>



<?php } ?>





<?php } ?><!-- show online--> 




















                        </div>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->




     


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>