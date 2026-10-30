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
if (isset($_POST['save'])){


                $sql = "UPDATE other_options SET 
                input_1 = '$_POST[input_1]',
                input_2 = '$_POST[input_2]',                
                input_3 = '$_POST[input_3]',
                input_4 = '$_POST[input_4]'
                WHERE id = '1' ";
                mysqli_query($connect, $sql);
                echo "<script>alert('Statistics Changed Successfully!')</script>";
}           
?>

<?php
        $sql = "SELECT * FROM other_options WHERE id = '1'";
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
    <title>Time Table - <?php echo $site_title; ?></title>

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
<div class="col-lg-2 col-md-12 p-bottom-0">

</div>

<div class="col-lg-10 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="admin_home_statistics.php" class="btn btn--md register_btn btn-primary" style=" float: right;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > <strong>STATISTICS</strong></span></a>
                            <a href="admin_students_list.php" class="btn btn--md register_btn btn-primary" style=" float: right;margin-right:25px;background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>LEARNERS/ STUDENTS</strong></span></a>
                            <a href="timetable.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px;  ">GO TO <strong>TIME TABLE</strong></a>
                            <a href="admin_home_page_courses.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px;  "><strong>HOME PAGE COURSES</strong></a>
                            <a href="admin_tutory_medici.php" class="btn btn--md register_btn btn-primary" style="float: right;margin-right:25px; background: #1dc9b7; border: #f4516c;line-height: inherit;    padding: 10px 20px; " ><strong>MAIN DASHBOARD</strong></span></a>

</div>
                            </div>
                            
                            
                            
                                </div>
                <div class="container featured-products2  p-top-0 p-bottom-10" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            





  <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="p-top-0 p-bottom-20">
                                                    
                                                    
                                                    <div style="border: none;width: fit-content;float: left;border-radius: 0 0 5px 5px;"> 
                                                        <h3 style="text-align: center;line-height: initial;height: auto;padding: 6px 10px;font-size: initial;">Our Statistics</h3> 
                                                    </div>
                                                    
                                                </div>
                                            </div><!-- end .col-md-12 -->




                                        <!-- end .col-md-12 -->
                                    </div>
                                    
                                    
                            




                <div class="row" style="margin-top:150px">
                    <div class="col-md-12 statement_table table-responsive">
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
              
                                
                                
                                
                                
<form action="" method = "post" style="margin-top:50px" onsubmit="return confirm('Are you sure?')">
                                <div class="row">
    
                                <div class="col-lg-4 col-md-12" style=" color: black; ">Registererd Students </div>
                                <div class="col-lg-8 col-md-12">
                                <input  type="text" value="<?php echo $pra[input_1]; ?>" class="text_field" placeholder="" name="input_1" >
                                </div> 
                                
                                <div class="col-lg-4 col-md-12" style=" color: black; ">Registererd Lecturers</div>
                                <div class="col-lg-8 col-md-12">
                                <input  type="text" value="<?php echo $pra[input_2]; ?>" class="text_field" placeholder="" name="input_2" >
                                </div> 
                                
                                <div class="col-lg-4 col-md-12" style=" color: black; ">Number of Programs</div>
                                <div class="col-lg-8 col-md-12">
                                <input  type="text" value="<?php echo $pra[input_3]; ?>" class="text_field" placeholder="" name="input_3" >
                                </div> 
                                
                                <div class="col-lg-4 col-md-12" style=" color: black; ">Number of Institutes/ Schools</div>
                                <div class="col-lg-8 col-md-12">
                                <input  type="text" value="<?php echo $pra[input_4]; ?>" class="text_field" placeholder="" name="input_4" >
                                </div> 
                                
                                <div class="col-lg-10 col-md-12" style=" float: right; "></div>
                                <div class="col-lg-2 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-primary" type="submit" name="save" value="Save" style="background: #442d00;float: right;margin-top: 20px;"
                                </div> 
                                
                                </div>
                                
                                    
</form>                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                        </div>


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