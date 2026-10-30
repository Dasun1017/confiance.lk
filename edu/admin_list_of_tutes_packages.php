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
if (isset($_POST['posted'])){
    
$time = time();
$date = date('Y-m-d h:s');

                $sql = "UPDATE list_of_tutes_packed_or_not SET posted_date='$_POST[posted_date]', posted_date_actual_date = '$date' WHERE packed_date='$_POST[packed_date]' AND tute_id = '$_GET[tute_id]' ";
                mysqli_query($connect, $sql);
}           
?>



<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>List of Tute Packages</title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    

<style>
    .table thead>tr>th { color: #313342; font-size: 16px; font-weight: 500; padding: 10px; } 
</style>
    



    
    
    <section class="hero-area4 bgimage">
        <div class="hero-content content_above" style="padding: 10px 0 50px 0;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            






                            














                <div class="row">
                  

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Packed Date</th>
                                    <th>Tute Name</th>
                                    <th>Numbe of Tutes</th>
                                    <th>Posted Date</th>
                                    <th>Change Date</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM list_of_tutes_packed_or_not WHERE tute_id = '$_GET[tute_id]' AND active = 1  GROUP by packed_date  ORDER by id ASC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


        $sql_cat_tute = "SELECT * FROM list_of_tutes  WHERE id = '$pra_cat[tute_id]'  AND active = 1 ORDER by id ASC";
        $result_cat_tute = mysqli_query($connect, $sql_cat_tute);
        $pra_cat_tute = mysqli_fetch_array($result_cat_tute);

        $sql_cat2 = "SELECT * FROM list_of_tutes_packed_or_not WHERE packed_date = '$pra_cat[packed_date]' AND tute_id = '$_GET[tute_id]' AND active = 1  ";
        $result_cat2 = mysqli_query($connect, $sql_cat2);
        $rowcount=mysqli_num_rows($result_cat2);


?>     

                                <tr>
                                    <td><?php echo $pra_cat[packed_date]; ?></td>
                                    <td><?php echo $pra_cat_tute[tute_name]; ?></td>
                                    <td><?php echo $rowcount; ?></td>
                                    <td><?php if($pra_cat[posted_date] != '') { echo $pra_cat[posted_date]; } ?></td>
                                    <td style="padding:0px">             
                                        <form action="" method="post" enctype="multipart/form-data">
                                                <div class="login--form">
                    
                                                    <div class="form-group" style="padding:10px">
                                                        <input value="<?php if($pra_cat[posted_date] != '') { echo $pra_cat[posted_date]; } else { echo $date_time = date("Y-m-d"); } ?>" name="posted_date" type="date" style=" width: 130px; height: 30px; line-height: 14px; border-radius: 3px; padding: 3px 15px; font-size: 12px; float: left; ">
                                                    
                                                        <input type="hidden" name="packed_date" value="<?php echo $pra_cat[packed_date]; ?>">
                                                        <input class="btn btn--md register_btn btn-common" type="submit" name="posted" value="Save Now">
                                                    </div>
                                                   
                                            </div>
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