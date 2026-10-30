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
if (isset($_GET['remove'])){

                $sql = "UPDATE zoom_accounts SET active='0' WHERE id='$_GET[remove]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Deleted Successfully!')</script>";
}           
?>


<?php
if (isset($_POST['save'])){

$time = time();
$date = date('Y-m-d h:s');

            
          $save = mysqli_query($connect, "INSERT INTO zoom_accounts VALUES (NULL, '$_POST[email_address]',  '$_POST[zoom_name]', '$_POST[api_key]', '$_POST[api_secret]', '$date', '$time', '1' )");          
              
 $msg = "
                                    <div class='alert alert-success' style='width:100%'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Zoom Accounts has been Updated!</strong>  
                                    </div>";
    
} 

?>

<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
          <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <!-- viewport meta -->
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Zoom Settings</title>

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
                                <div class="col-lg-4 col-md-12">
                                    </div>
                                
                                <div class="col-lg-4 col-md-12 p-top-0">
                                    
                    
                              <?php echo $msg; ?>
                        
                    
                    
                        
                    

                    

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="cardify signup_form" style="background: white; border-radius: 10px; padding: 20px;">
                            <!-- end .login_header -->





<div class="section-title">
                  <h4 style="    margin-top: 0px;     text-align: center;">Manage Zoom Accounts </h4>
                </div>





                            <div class="login--form">


                                <div class="form-group">
                                    <input type="email" class="text_field" placeholder="Email Address" name="email_address" required="">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="text_field" placeholder="Name" name="zoom_name" required="">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="text_field" placeholder="API Key" name="api_key" required="">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="text_field" placeholder="API Secret" name="api_secret" required="">
                                </div>




                              <div class="row">
                                            
                                            
                                            <div class="col-lg-12 mt-30">
                                                 <input class="btn btn--md register_btn btn-common" type="submit" name="save" value="Save Now">
                                            </div>
                                        </div>
                                        
                                        
                               
                                
                                
                                            
                                            

                                
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    </form><!-- Ends: .product-single -->


                 

                                </div>
                                
                                
                                
                                
<div class="col-lg-4 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="teachers_active.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; display: none " >GO TO <strong>DASHBOARD</strong></span></a>

</div>



                            </div>



















                <div class="row">
                  

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>API Key</th>
                                    <th>API Secret</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM zoom_accounts  where active = '1' ORDER by id ASC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                    
                                    <td><?php echo $pra_cat[email_address]; ?></td>
                                    <td><?php echo $pra_cat[zoom_name]; ?></td>
                                    <td><?php echo $pra_cat[api_key]; ?></td>
                                    <td><?php echo $pra_cat[api_secret]; ?></td>
                                   
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