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

                $sql = "UPDATE list_of_tutes SET active='0' WHERE id='$_GET[remove]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Deleted Successfully!')</script>";
}           
?>


<?php
if (isset($_POST['save'])){

$time = time();
$date = date('Y-m-d h:s');

            
          $save = mysqli_query($connect, "INSERT INTO list_of_tutes VALUES (NULL, '$_POST[tute_name]', '$_POST[tute_description]', '$date', '$time', '1' )");          
              
 $msg = "
                                    <div class='alert alert-success' style='width:100%'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>New Tute Created!</strong>  
                                    </div>";
    
} 

?>

<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>List of Tutes</title>

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
                  <h4 style="    margin-top: 0px;     text-align: center;">Manage Tutes </h4>
                </div>





                            <div class="login--form">


                                <div class="form-group">
                                    <input type="text" class="text_field" placeholder="Tute Name" name="tute_name" required="">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="text_field" placeholder="Description" name="tute_description" required="">
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
                                
        


                            </div>



















                <div class="row">
                  

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Tute Name</th>
                                    <!--<th>List of Packages</th>-->
                                    <th>Description</th>
                                    <th>#</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM list_of_tutes  where active = '1' ORDER by id ASC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                    
                                    <td><?php echo $pra_cat[tute_name]; ?></td>
                                    <!--<td><a target="_blank" href="admin_list_of_tutes_packages.php?tute_id=<?php echo $pra_cat[id]; ?>" >SHOW PACKAGES</a></td> -->
                                    <td><?php echo $pra_cat[tute_description]; ?></td>
                                    <td style="color: red"><?php if($pra_cat[active] == '0') { echo 'DELETED'; } ?></td>
                                   
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