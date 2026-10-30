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

                $sql = "UPDATE learning_meterials SET active='0' WHERE id='$_GET[remove]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Deleted Successfully!')</script>";
}           
?>


<?php
if (isset($_POST['save'])){

$time = time();
$date = date('Y-m-d h:s');

            

            if (!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name']))  { 
                     $save = mysqli_query($connect, "INSERT INTO learning_meterials VALUES (NULL, '$_POST[learning_title]',  '$_POST[learning_description]', '', '$_GET[view]', '$date', '$time', '$_POST[category]', '1' )");          
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

                     $save = mysqli_query($connect, "INSERT INTO learning_meterials VALUES (NULL, '$_POST[learning_title]',  '$_POST[learning_description]', '$fname', '$_GET[view]', '$date', '$time', '$_POST[category]', '1' )");


                  }

                }
                else {

                  echo "<script>alert('Invalid file type!')</script>";

                }

            } 


    
 $msg = "
                                    <div class='alert alert-success' style='width:100%'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>New Meterial has been Updated!</strong>  
                                    </div>";
    
} 

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
    <title>Home Page Ads - <?php echo $site_title; ?></title>

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
                  <h4 style="    margin-top: 0px;     text-align: center;">Home Page Ads </h4>
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
    <option value="slideshow">Homepage - Slide Show (1280px X 720px)</option>
    <option value="banners">Homepage - Banners (1600px X 1600px)</option>
    <option value="landing">Landing - Banners (800px X 715px)</option>
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
                                
                                
                                
                                
<div class="col-lg-4 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="teachers_active.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c;border: #f4516c;line-height: inherit;padding: 5px 20px;border-radius: 50px;" >GO TO <strong>DASHBOARD</strong></span></a>

</div>



                            </div>



















                <div class="row">
                    <h3 style=" background: #1dc9b7; border: none; color: white; margin: 0 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Slide Show</h3>

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <!--<th>Date & Time</th>-->
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Download</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = 'slideshow' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>&view=<?php echo $_GET[view]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                    
                                    <!--<td><?php echo $pra_cat[lesson_date]; ?></td>-->

                                    <td><?php echo $pra_cat[learning_title]; ?></td>
                                    <td>
                                        <?php echo $pra_cat[learning_description]; ?>
                                        
                                    </td>
                                   
                                    <td><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>
                                    <?php } ?></td>



                                </tr>
<?php } ?>


                                </tbody>
                            </table>

                    </div></div>







                            </div>







































                <div class="row" style="margin-top: 50px">
                    <h3 style=" background: #1dc9b7; border: none; color: white; margin: 0 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Banners</h3>

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <!--<th>Date & Time</th>-->
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Download</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = 'banners' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>&view=<?php echo $_GET[view]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                    
                                    <!--<td><?php echo $pra_cat[lesson_date]; ?></td>-->

                                    <td><?php echo $pra_cat[learning_title]; ?></td>
                                    <td>
                                        <?php echo $pra_cat[learning_description]; ?>
                                        
                                    </td>
                                   
                                    <td><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>
                                    <?php } ?></td>



                                </tr>
<?php } ?>


                                </tbody>
                            </table>

                    </div></div>







                            </div>











































                <div class="row" style="margin-top: 50px">
                    <h3 style=" background: #1dc9b7; border: none; color: white; margin: 0 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Landing Page</h3>

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <!--<th>Date & Time</th>-->
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Download</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = 'landing' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>&view=<?php echo $_GET[view]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                    
                                    <!--<td><?php echo $pra_cat[lesson_date]; ?></td>-->

                                    <td><?php echo $pra_cat[learning_title]; ?></td>
                                    <td>
                                        <?php echo $pra_cat[learning_description]; ?>
                                        
                                    </td>
                                   
                                    <td><?php if( $pra_cat[file_name] != '') {  ?><a style=" font-weight: bold; color: #094976; " href="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: none; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a>
                                    <?php } ?></td>



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
   
   
   
   
  
</body>
</html>