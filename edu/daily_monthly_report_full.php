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
                        
             








        









 <?php  $total_amount = ''; ?>   

                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Total Amount</th>
                                    <th>Institute</th>
                                    <th>Date</th>
                                    <th>Mobile</th>
                                    <th>Grade</th>
                                </tr>
                                </thead>





                                <tbody>
<?php 
        $tomorrow = date('Y-m-d',strtotime($_GET[selected_date] . "+1 days"));
        $start = date('Y-m-01',strtotime($_GET[selected_month])); 
        $end_date = date('Y-m-d',strtotime($start . "+1 months"));
?>







        





        





        

<?php if($_GET[show] == 'all' OR $_GET[show] == '') { ?> <!-- show all-->                     
                         
    <?php if(isset($_GET[selected_date])) { ?>
        <?php $sqlx = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow' GROUP by student_id ORDER BY  student_id ASC";  ?>
    <?php } ?>
            
    <?php if(isset($_GET[selected_month])) { ?>
        <?php $sqlx = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND active = '1' AND posted_date between '$start' AND '$end_date' GROUP by student_id ORDER BY  student_id ASC";  ?>
    <?php } ?>


<?php } ?> <!-- show all--> 




<?php if($_GET[show] == 'cash') { ?><!-- show cash--> 
                        
    <?php if(isset($_GET[selected_date])) { ?>
        <?php $sqlx = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND paid_marked_by = 'Institute' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow' GROUP by student_id ORDER BY  student_id ASC";  ?>
    <?php } ?>

    <?php if(isset($_GET[selected_month])) { ?>
        <?php $sqlx = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND paid_marked_by = 'Institute' AND active = '1' AND posted_date between '$start' AND '$end_date' GROUP by student_id ORDER BY  student_id ASC";  ?>
    <?php } ?>


<?php } ?><!-- show cash--> 




<?php if($_GET[show] == 'online') { ?><!-- show online--> 

    <?php if(isset($_GET[selected_date])) { ?>
        <?php $sqlx = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND paid_marked_by = 'Online' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow' GROUP by student_id ORDER BY  student_id ASC";  ?>
    <?php } ?>

    <?php if(isset($_GET[selected_month])) { ?>
        <?php $sqlx = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND paid_marked_by = 'Online' AND active = '1' AND posted_date between '$start' AND '$end_date' GROUP by student_id ORDER BY  student_id ASC";  ?>
    <?php } ?>


<?php } ?><!-- show online--> 






        





        





        
<?php   $resultx = mysqli_query($connect, $sqlx);
        while($prax = mysqli_fetch_array($resultx)) {  



        $total = '';
        $classes = '';

?>







        





        





        

<?php if($_GET[show] == 'all' OR $_GET[show] == '') { ?> <!-- show all-->                     
                         
    <?php if(isset($_GET[selected_date])) { ?>
        <?php $sqlx2 = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow' AND student_id = '$prax[student_id]' ";   ?>
    <?php } ?>
            
    <?php if(isset($_GET[selected_month])) { ?>
        <?php $sqlx2 = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND active = '1' AND posted_date between '$start' AND '$end_date' AND student_id = '$prax[student_id]' ";   ?>
    <?php } ?>


<?php } ?> <!-- show all--> 




<?php if($_GET[show] == 'cash') { ?><!-- show cash--> 
                        
    <?php if(isset($_GET[selected_date])) { ?>
        <?php $sqlx2 = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND paid_marked_by = 'Institute' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow' AND student_id = '$prax[student_id]' ";   ?>
    <?php } ?>

    <?php if(isset($_GET[selected_month])) { ?>
        <?php $sqlx2 = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND paid_marked_by = 'Institute' AND active = '1' AND posted_date between '$start' AND '$end_date' AND student_id = '$prax[student_id]' ";   ?>
    <?php } ?>


<?php } ?><!-- show cash--> 




<?php if($_GET[show] == 'online') { ?><!-- show online--> 

    <?php if(isset($_GET[selected_date])) { ?>
        <?php $sqlx2 = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND paid_marked_by = 'Online' AND active = '1' AND posted_date between '$_GET[selected_date]' AND '$tomorrow' AND student_id = '$prax[student_id]' ";   ?>
    <?php } ?>

    <?php if(isset($_GET[selected_month])) { ?>
        <?php $sqlx2 = "SELECT * FROM products WHERE teacher_id = '$_GET[teacher_id]' AND status = 'Paid' AND paid_marked_by = 'Online' AND active = '1' AND posted_date between '$start' AND '$end_date' AND student_id = '$prax[student_id]' ";   ?>
    <?php } ?>


<?php } ?><!-- show online--> 






        





        



        
 <?php $resultx2 = mysqli_query($connect, $sqlx2);
        while($prax2 = mysqli_fetch_array($resultx2)) {  


        $sql_new_1 = "SELECT * FROM category WHERE id='$prax2[lesson_id]' ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        $pra_new_1 = mysqli_fetch_array($result_new_1);  
            $total += $pra_new_1[charge];  
            $total2 += $pra_new_1[charge]; 
            $classes += $pra_new_1[active]; 

        }

        $sql2 = "SELECT * FROM tbl_users WHERE type = '3' AND userID = '$prax[student_id]' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2); 

        $student_id += $pra2[userID]; 



?>
          
        
                                <tr style="" >
                                    <td><a href="admin_students_active.php?student=<?php echo $pra2[userID]; ?>" target="_blank"><?php echo $pra2[userName]; ?></a></td>
                                    <td><?php echo $total; ?></span></td>
                                    <td class="type"><a href="print_now2.php?student=<?php echo $pra2[userID]; ?>&start=<?php echo $_GET[selected_date]; ?>&finish=<?php echo $tomorrow; ?>" target="_blank"><span class="paid"><?php echo $classes; ?></span></a></td>   
                                    <td><?php echo $prax[posted_date]; ?></td>
                                    <td><?php echo $pra2[mobile]; ?></td>
                                    <td><?php echo $pra2[grade]; ?></td>
                                </tr>
<?php } ?>
          
        
                                <tr>
                                    <td></td>
                                    <td class="type"><span class="finished"><?php echo $total2; ?></span></td>
                                    <td class="type"></td>  
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