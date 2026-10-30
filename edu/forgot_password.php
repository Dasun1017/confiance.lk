<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 


if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	
            	$slidesql="SELECT userID FROM tbl_users WHERE userEmail='$email' LIMIT 1";
              $slideexe=mysqli_query($connect, $slidesql);
              $row=mysqli_fetch_array($slideexe); 
	
	
$num_rows = mysqli_num_rows($slideexe);
				  
				  
	if($num_rows != "0")
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		
		
             $slidesql2="UPDATE tbl_users SET tokenCode='$code' WHERE userEmail='$email' ";
              $slideexe2=mysqli_query($connect, $slidesql2);
		
		
		$message= "
				   Hello , $email
				   <br /><br />
				   We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
				   <br /><br />
				   Click Following Link To Reset Your Password 
				   <br /><br />
				   <a href='https://$actual_domain_without_http/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
				   <br /><br />
				   thank you :)
				   ";
		$subject = "Password Reset";
		        
                    //mail sending    
                        $from = $site_info_mail_address;
                        $headers = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
                        $headers .= "From:" . $from;
                         mail($email,$subject,$message,$headers);

		
		
		
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry!</strong>  this email not found. 
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
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Forgot Password - <?php echo $site_title; ?></title>

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
			else
			{
				?>
                     	
            <div class='alert alert-danger'>
                <button class='close' data-dismiss='alert'>&times;</button>
                
				Please enter your email address. <br><strong>You will receive a link to create a new password via email.!</strong>
            </div>
        
        
         
                <?php
      }
      ?>
                
                        
                    

                    
                  <h3>Forgot Password</h3>
    	            <h4 class=""></h4>
    	            <form class="register-form outer-top-xs" role="form" action="" method="post" autocomplete="off">
                		<div class="form-group">
                		    <input type="email" class="form-control unicase-form-control text-input" id="" name="txtemail" required="required" placeholder="Email Address" style="text-align: center;">
                		</div>
                	  
                		
                	  	<button type="submit" class="btn-upper btn btn-common checkout-page-button" name="btn-submit">Generate new Password</button>
                	</form>





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