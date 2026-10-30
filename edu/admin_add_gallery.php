<?php 
    include 'functions/main.functions.php';  
    require_once 'class.user.php';
    $user_login = new USER();
?>

<?php

if(!$user_login->is_logged_in())
{
     $user_login->redirect('login.php');
}




if($user_login->is_logged_in()!="")
{
    if($_SESSION['type'] == '3') { $user_login->redirect('login.php'); }
    if($_SESSION['type'] == '2') { $user_login->redirect('login.php'); }
}

?>

<?php 
if (isset($_GET['remove'])){

                $sql = "UPDATE gallery SET active='0' WHERE id='$_GET[remove]'";
                mysqli_query($connect, $sql);
                //echo "<script>alert('Deleted Successfully!')</script>";
}           
?>



<?php 
if(isset($_POST['add_now']))
{
        $date_time = date("Y/m/d - h:i:sa");
      
        $result = mysqli_query($connect, "INSERT INTO gallery VALUES (NULL, '$_POST[gallery_name]', '$date_time', '1'   )");


        if($result) 
        { 

        if($_SESSION['type'] == '1') { $user_login->redirect('admin_add_gallery.php'); }

    
        }
        else
        {
            echo "sorry , Query could no execute...";
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
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
       
        <div class="hero-content content_above" style="padding: 50px 0 50px 0;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-10 p-bottom-120">
                            












                            <div class="row">
                               
                                 <div class="col-lg-4 mt-sm-0"></div>
                             



























                                 <!--<div class="col-lg-2 mt-sm-40"></div>-->


                                 <div class="col-lg-4 mt-sm-40"  style="display:block;">



         <?php echo $msg; ?>









          <div class="input-form register-form mt-60">
            <form id="contactForm" data-toggle="validator" method="POST" action="" autocomplete="off">
              <div class="cardify signup_form row" style="background: white; border-radius: 10px; padding: 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 );    box-shadow: 5px 8px 20px 0px rgb(180 180 180 / 73%);
    padding: 11px;
    border-radius: 20px;
    background: radial-gradient(ellipse at right bottom,rgb(65 80 96 / 51%) 0,#626262 30%,#8387a1 50%,#434a5d 100%);
   ">

                <div class="col-sm-12 mt-25" >
                  <input type="text" class="text_field" placeholder="Gallery name" name="gallery_name"  required="" >
                </div>



                <div class="col-lg-12 mt-30">
                  <input class="btn-common" type="submit" name="add_now" value="Add Now ➢" style="background: #ff9800;display: block;color: white;padding: 10px 20px;font-size: larger;border-radius: 50px;text-align: center;height: 45px;line-height: 20px;width: 100%;border: none;cursor: pointer;">
                </div>
              </div>
            </form>


          </div>
        </div>



                            </div>
















                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                             

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM gallery  where active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>&view=<?php echo $_GET[view]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                    
                                    <td><?php echo $pra_cat[gallery_name]; ?></td>
                                    <td>
                                        <?php echo $pra_cat[date_and_time]; ?>
                                        
                                    </td>
                                   
                                    <td><a style=" font-weight: bold; color: #094976; " href="admin_add_gallery_collections.php?view=<?php echo $pra_cat[id]; ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">MANAGE</span></a>
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
   <?php //footer(); ?>
   <!--footer-area end-->
   
   <!-- modernizr js -->
   <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
   <!-- jquery-3.3.1 version -->
   <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
   <!-- jquery-migrate-3.0.0.min.js version -->
   <script src="assets/js/vendor/jquery-migrate-3.0.0.min.js"></script>
   <!-- bootstra.min js -->
   <script src="assets/js/bootstrap.min.js"></script>
   <!-- jquery-ui.min js -->
   <script src="assets/js/jquery-ui.min.js"></script>
   <!-- mmenu js -->
   <script src="assets/js/jquery.mmenu.js"></script>
   <!---venobox-js-->
   <script src="assets/js/venobox.min.js"></script>
   <!---slick-js-->
   <script src="assets/js/slick.min.js"></script>
   <!---counterup-js-->
   <script src="assets/js/jquery.counterup.min.js"></script>
   <!---waypoints-js-->
   <script src="assets/js/waypoints.js"></script>
   <!-- jquery.countdown js -->
   <script src="assets/js/jquery.countdown.min.js"></script>
   <!---isotop-js-->
   <script src="assets/js/isotope.pkgd.min.js"></script>
   <!---letteranimation-js-->
   <script src="assets/js/letteranimation.min.js"></script>
   <!-- plugins js -->
   <script src="assets/js/plugins.js"></script>
   <!-- main js -->
   <script src="assets/js/main.js"></script>
   
   
  
</body>
</html>