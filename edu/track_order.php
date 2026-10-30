<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 

   //  echo $_SESSION[userSession];   
   
?>

<?php
    
$sql1 = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]'";
$result = mysqli_query($connect, $sql1);

if ($result) {
    // Fetch the result as an associative array
    $row = mysqli_fetch_assoc($result);

} else {
    echo "result is not working";
}

?>

<?php

if(!$user_home->is_logged_in())
{
     //$user_home->redirect('login.php');
}

?>


<!doctype html>
<html class="no-js" lang="zxx" style="background: white;">
<head>
   <meta charset="utf-8">
   <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Contact <?php echo $site_title; ?></title>
   <?php metas(); ?>


   <style>
      @media (max-width: 460px) {  .hide_in_mobile { display:none !important }  } 
      @media (max-width: 460px) {  .no_padding_in_mobile { padding: 0px !important }  } 
      .header-area.stick .no_padding_in_mobile { padding: 0px 40px !important ; height: -webkit-fill-available;}

      .metro-panel .space > div { padding-bottom: 0; border-radius: 5px; } 

      .metro-panel .space > div { padding: 10px 10px 15px 15px; min-height: 150px; text-align: center; position: relative; overflow: hidden; }

      .box-title, .featured-box-title, .featured-title { position: absolute; text-align: center; bottom: 8px;
    line-height: initial; width: 100%; left: 0px; font-size: initial; font-weight: 300; text-shadow: 1px 0 1px rgba(0, 0, 0, 0.2); }

      @media only screen and (min-width: 768px) { .large-6 { position: relative; width: 50%; }  }

      .column, .columns { position: relative; padding-left: 0.9375em; padding-right: 0.9375em; float: left; }
      .small-6 { position: relative; width: 50%; }

      .metro-panel .space { padding: 10px; color: #FFF; -webkit-animation-duration: 1.9s; -moz-animation-duration: 1.9s; animation-duration: 1.9s; display: table-cell; vertical-align: bottom; }
      .metro-panel .space a { color: #FFF; }

      .footer-top { background-color: #f2f4f7; padding: 20px 0 31px 0; }
      .mainmenu nav ul li .submenu {  min-width: 340px; } 

   </style>

   <link rel="stylesheet" href="assets/css/colors.css">

    </head>

<body>
   <!--[if lte IE 9]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end-->
   
 
   <center>
    
   <div style="display:flex; justify-content: center; align-items: center; margin: 200px auto;">
   <div class="cardify signup_form" style=" max-width:500px;   border: 1px solid black; border-radius: 10px; padding: 20px 20px 10px 20px;box-shadow: 12.5px 21.651px 49px 0px rgba( 58, 74, 88, .10 ); ">
                        
  <h2>Track your Order</h2> 
<br>

<div>
<p style="font-size:large; font-weight:400;line-height: 180%;background:white;width: 100%;border-radius: 10px;text-align: left;line-height: inherit;padding: 10px;font-size: initial;">Students can be viewd order details with using track order code and click on track order button, opened track order site.</p>
<?php if($row['real_email'] == "") { ?>

    <h3>No code</h3> 


 <?php } else {  ?>

   <h3 style="font-size:large; font-weight:400;line-height: 180%;background:#ebebeb;width: 100%;border-radius: 10px;text-align: center;line-height: inherit;padding: 10px;font-size: initial;">
   <?php   echo $row['real_email']; ?></h3>  


 <?php } ?>


</div>
<br>

<a href="https://promptxpress.lk/TrackItem.aspx#" style="font-size:large; font-weight:400;line-height: 180%;background: #1dc9b7; width: 100%; border-radius: 10px; text-align: center;line-height: inherit;padding: 10px ;font-size: initial; margine-right:10px; display:flex; justify-content:center">Track Order  </a>
<br><br>


</div>
   </div>


</center>

   
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
