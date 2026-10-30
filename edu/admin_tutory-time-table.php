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
if (isset($_POST['edit'])){

$time_table_live_feed = mysqli_real_escape_string($connect, $_POST[time_table_live_feed]);
$time_table_iframe = mysqli_real_escape_string($connect, $_POST[time_table_iframe]);

                $sql = "UPDATE other_options SET  time_table_live_feed = '$time_table_live_feed', time_table_iframe = '$time_table_iframe'  WHERE id = '1' ";
                mysqli_query($connect, $sql);
                echo "<script>alert('Time Table Page Changed Successfully!')</script>";
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
    <title>Time Table Settings - <?php echo $site_title; ?></title>

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
                                <div class="container">
                                    <div class="row">
                                   

                                        
                                            <div class="col-md-12 col-lg-12">
                                                <div class="p-top-0 p-bottom-20">
                                                    <h2 style="background: #fff;height: 20px;border-radius: 5px 5px 5px 0;    margin: 0px;"></h2>
                                                    
                                                    
                                                    
                                                    
                                                    <div style="background: #fff;border: none;width: fit-content;float: left;border-radius: 0 0 5px 5px;"> 
                                                        <h3 style="text-align: center;line-height: initial;height: auto;padding: 6px 10px;font-size: initial;"><a href="admin_teachers_list.php" style=" font-weight: 600; color: black; ">List of Trainers/Tutors </a> </h3> 
                                                    </div>
                                                    
                                                </div>
                                            </div><!-- end .col-md-12 -->




                                        <!-- end .col-md-12 -->
                                    </div>
                                </div>
                <div class="container featured-products2  p-top-0 p-bottom-120">
                            






                            








  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

      .form-control, input {border: 1px solid #262626; } 
      
      .author_info, .card_style1, .card_style2, .cardify, .comment_area, .contact_tile, .content_title, .credit_modules, .featured_event, .google_map .location_address .addres_module, .payment_module, .shortcode_modules, .statement_info_card, .statement_table, .thread_sort_area, .upload_modules, .withdraw_module { background: #fff; -webkit-border-radius: 4px; border-radius: 4px; }
      
      
    .statement_info_card .info p { font-size: 28px; } 
  </style>    


                    














         
        
            
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
    
    
    
 
                
                
                
                
                
                
                
                
                
                
    
    

                <div class="row" style="margin-top:150px">
                    <div class="col-md-12">
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
              
                                
                                
                                
                                
<form action="" method = "post" style="margin-top:50px" onsubmit="return confirm('Are you sure?')">
                                <div class="row">
    
                                <div class="col-lg-4 col-md-12" style=" color: white; ">Time Table Live Feed </div>
                                <div class="col-lg-8 col-md-12">
                                <input  type="text" value="<?php echo $pra[time_table_live_feed]; ?>" class="text_field" placeholder="URL Only" name="time_table_live_feed" >
                                </div> 
                                
                                <div class="col-lg-4 col-md-12" style=" color: white; ">Video Code :<br>Ex: youtube.com/watch?v=<span style="color:red">CY7iOaB7Aa8</span></div>
                                <div class="col-lg-8 col-md-12">
                                <input  type="text" value="<?php echo $pra[time_table_iframe]; ?>" class="text_field" placeholder="Video Code" name="time_table_iframe"  >
                                </div> 
                                
                                <div class="col-lg-10 col-md-12" style=" float: right; "></div>
                                <div class="col-lg-2 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-primary" type="submit" name="edit" value="Edit" style="background: #f4516c;float: right;margin-top: 20px;"
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