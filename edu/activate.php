<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user = new USER(); 


if(empty($_GET['code']))
{
   $user->redirect('login.php');
}

if(isset($_GET['code']))
{
   $code = $_GET['code'];
   
   $stmt = $user->runQuery("SELECT * FROM tbl_users WHERE tokenCode=:token");
   $stmt->execute(array(":token"=>$code));
   $rows = $stmt->fetch(PDO::FETCH_ASSOC);
   
   if($stmt->rowCount() == 1)
   {
      
         {
            $stmt = $user->runQuery("UPDATE tbl_users SET userStatus='Y' WHERE userID=:uid");
            $stmt->execute(array(":uid"=>$rows['userID']));
            
            $msg = "<div class='alert alert-success'>
                  <button class='close' data-dismiss='alert'>&times;</button>
                  Account Activated Successfully.
                  </div>";
            header("refresh:5;login.php");
         }
      
   }
   else
   {
      $msg = "<div class='alert alert-success'>
            <button class='close' data-dismiss='alert'>&times;</button>
            No Account Found, Try again
            </div>";
            
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
    <meta name="description" content="<?php echo $site_meta_description; ?>">
       <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Activate Account - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;background-image: url('img/bg2.jpg');background-attachment: fixed;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-10 p-bottom-120">
                            






                            











                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    </div>
                                
                                <div class="col-lg-6 col-md-12 p-top-0" style="text-align: center;">
                                    
                    
                        
               
                        
                    

        
        <?php
        if(isset($msg))
      {
         echo $msg;
      }
      ?>
       




                        </div><!-- end .cardify -->


                 

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