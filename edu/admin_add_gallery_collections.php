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

                $sql = "UPDATE gallery_image SET active='0' WHERE id='$_GET[remove]'";
                mysqli_query($connect, $sql);
                //echo "<script>alert('Deleted Successfully!')</script>";
}           
?>


<?php
if (isset($_POST['save'])){

$time = time();
$date = date('Y-m-d h:s');

            

            if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name']))  { 
                     $save = mysqli_query($connect, "INSERT INTO gallery_image VALUES (NULL, '$_POST[learning_title]',  '$_POST[learning_description]', '', '$_POST[category]', '$_GET[view]', '$date',  '1')");          
                } else {

                $allowedExts = array("jpg", "jpeg", "gif", "png", "pdf", "doc", "docx", "xls", "xlsm", "ppsx", "pptx");
                $extension = end(explode(".", $_FILES["file"]["name"]));

                if ($_FILES["file"]["type"] == "image/gif" || 
                    $_FILES["file"]["type"] == "image/jpg" || 
                    $_FILES["file"]["type"] == "image/jpeg" || 
                    $_FILES["file"]["type"] == "image/png" || 
                    $_FILES["file"]["type"] == "application/pdf" || 
                    $_FILES["file"]["type"] == "application/doc" || 
                    $_FILES["file"]["type"] == "application/docx" || 
                    $_FILES["file"]["type"] == "application/xls" || 
                    $_FILES["file"]["type"] == "application/xlsm" || 
                    $_FILES["file"]["type"] == "application/ppsx" || 
                    $_FILES["file"]["type"] == "application/pptx" 

                    && $_FILES["file"]["size"] < 2500000 && in_array($extension, $allowedExts)) {

                  if ($_FILES["file"]["error"] > 0) {

                    echo "<script>alert('";
                        echo "Error: " . $_FILES["file"]["error"] . "<br />";
                    echo ')</script>';

                  }
                  else {

                    //$fname = $_FILES["file"]["name"];
                    $fname = time().'.'."$extension";

                    move_uploaded_file($_FILES["file"]["tmp_name"], "learning_meterials/$fname");

                     $save = mysqli_query($connect, "INSERT INTO gallery_image VALUES (NULL, '$_POST[learning_title]',  '$_POST[learning_description]', '$fname', '$_POST[category]', '$_GET[view]', '$date', '1' )");


                  }

                }
                else {

                  echo "<script>alert('Invalid file type!')</script>";

                }

            } 


    
 $msg = "
                                    <div class='alert alert-success' style='width:100%'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Gallery Updated!</strong>  
                                    </div>";
    
} 

?>

<?php 
        $sql_cat = "SELECT * FROM gallery  where active = '1' AND id = '$_GET[view]' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        $pra_cat = mysqli_fetch_array($result_cat);

?>
<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EduVictoria.com - Life Long Victory (Kaduwela | Kottawa | Pannipitiya)">
    <meta name="keywords" content="EduVictoria.com, VictoriaGlobalEducation, EduVictoria.com - Life Long Victory (Kaduwela | Kottawa | Pannipitiya)">
   <title><?php echo $pra_cat[gallery_name]; ?> - EduVictoria.com - Life Long Victory (Kaduwela | Kottawa | Pannipitiya)</title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        <div class="hero-content content_above" style="padding: 20px 0 50px 0;">
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
                  <h4 style="    margin-top: 0px;     text-align: center;"><?php echo $pra_cat[gallery_name]; ?></h4>
                </div>





                            <div class="login--form">

                                <div class="form-group">
                                    <input type="text" class="text_field" placeholder="Title" name="learning_title" required="">
                                </div>


                                <div class="form-group">
                                    <textarea type="text" class="text_field" placeholder="Description" name="learning_description" style="    min-height: 100px;"></textarea>
                                </div>



                                <div class="form-group">
                                <input style="/* width: 110px; *//* color: transparent; */border: none;line-height: 30px;height: 40px;margin-right: 20px;" type="file" class="text_field" name="file">
                                </div>



                                <div class="form-group">
                                    
<select name="category" required="">
    <option value="1">Image</option>
    <option value="2">YouTube Video</option>
</select>

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
                    <h3 style=" background: #1dc9b7; border: none; color: white; margin: 0 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Images</h3>
                    <div class="col-md-12">      
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <tbody>

<?php   
        $sql_cat = "SELECT * FROM gallery_image  where gallery_id = '$_GET[view]' AND image_or_video = '1' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 
?>     
                                <tr>
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>&view=<?php echo $_GET[view]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td> 
                                    <td><?php echo $pra_cat[title]; ?></td>
                                    <td><?php echo $pra_cat[description]; ?></td>
                                    <td><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="learning_meterials/<?php echo $pra_cat[file_name]; ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>
                                    <?php } ?></td>
                                </tr>
<?php } ?>
                                </tbody>
                            </table>
                    </div>
                    </div>
            </div>






                <div class="row" style="margin-top: 50px">
                    <h3 style=" background: #1dc9b7; border: none; color: white; margin: 0 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">YouTube Videos</h3>
                    <div class="col-md-12"> 
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <tbody>

<?php   
        $sql_cat = "SELECT * FROM gallery_image  where gallery_id = '$_GET[view]' AND image_or_video = '2' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 
?>     
                                <tr>
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>&view=<?php echo $_GET[view]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td> 
                                    <td><?php echo $pra_cat[title]; ?></td>
                                    <td><?php echo $pra_cat[description]; ?></td>
                                    <td><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="learning_meterials/<?php echo $pra_cat[file_name]; ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>
                                    <?php } ?></td>
                                </tr>
<?php } ?>
                                </tbody>
                            </table>
                    </div>
                    </div>
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