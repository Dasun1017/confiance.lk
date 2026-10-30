<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
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
   
  
   <!--page-banner-area start-->
   <div class="page-banner height-100 bg-1" style=" margin-top: 20px; ">
      <div class="d-table">
         <div class="page-title vertical-middle text-center">
            <h2>පැමිණිලි හා යෝජනා</h2>
            
   <?php

    if(isset($_POST[send_message])) { 

        $time = time();
        $date = date('Y-m-d h:i:sa');

                $result = mysqli_query($connect, "INSERT INTO inquiries VALUES (NULL, 
                	'$_POST[grade]', '$_POST[subject]', '$_POST[medium]',  '$_POST[teacher_name]', 
                	'$_POST[student_name]', '$_POST[student_grade]', '$_POST[contact_number]', 
                	'$time', '$date', '1'  )");

		  if($result) { 
		        echo $msg = "
		              <div class='alert alert-success'>
		                    <strong>Great !</strong>  Thank you for your Inquiry, We will contact you Soon!
		              </div>
		              ";
		   } else { 
		        echo $msg = "
		              <div class='alert alert-danger'>
		                    <strong>Sorry !</strong>  We cant accept your Inquiry, please contact us 076 8875 095
		              </div>
		              ";	
		   }

    }
?>


         </div>
      </div>
   </div>
   <!--page-banner-area end-->
   
   
  
   <!--contact-us-area start-->
   <div class="contact-area mt-70">
      <div class="container">
         <div class="row" style="    border: 2px solid #00000085; border-radius: 15px; padding: 14px;">
            <div class="col-lg-5">
               <div class="customer-supporter">
                  <div class="section-title style-4">
                     <h3>How can we help?</h3>
                  </div>
                  <div class="single-supporter mt-70">
                     <div class="row">
                        <div class="col-md-4">
                           <img src="source_files/new_confiance_big - Copy.jpeg" style="border-radius: 20px;" />
                        </div>
                        <div class="col-md-8">
                           <div class="supporter-desc mt-sm-20">
                              <h3><?php echo $site_owner_name; ?></h3>
                              <p style=" margin-bottom: 0px; "> Director</p>
                              <strong><?php echo $site_website_name; ?></strong>

                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="single-supporter mt-65">
                     <div class="row">
                        <div class="col-md-12">
                            <div class="office-address_x">
                              
                                    <p style=" font-size: large; line-height: 180%; ">
                                    <?php echo $site_whatsapp; ?> - තොරතුරු විමසීම   <br>
                                    ඇමතුම මඟ හැරුනේ නම් Whatsapp පණිවිඩයක් තබන්න.  <br> <br>
                                    </p>
                           </div>
                        </div>
                     </div>
                  </div>


                  
               </div>
            </div>
            <div class="col-lg-7">
               <div class="contact-form input-form mt-sm-50">
                   
                   
                  <form id="contactForm" method="POST" action="">
                     <div class="row" style=" background: #f1f1f1; padding: 15px; border-radius: 15px; ">
                           
                         <p style="font-size: large;line-height: 180%;display: block;background: white ;width: 100%;border-radius: 10px;text-align: center;line-height: inherit;padding: 10px;"> දැන් ඔබට Online අධ්&zwj;යාපනය සදහා ඔබට අවශ්&zwj;ය ඕනෑම ගුරුවරයෙක් අපවෙත දැනුවත් කරන්න.  <br> (අප පුලුවන් උපරිමයෙන් ඔබ ඉල්ලා සිටින  ගුරුවරයා ලබා දීමට කටයුතු කරනු ඇත.)</p>




                        <div class="col-lg-6 col-sm-12 mb-10">
                                   
                            <select name="grade" required="" style="width: 100%; height: 40px; border: 1px solid #ebebeb; border-radius: 2px; padding: 0 15px;">
                                <option value="">ශ්‍රේණිය</option>
                                <option>ශිෂ්‍යත්ව</option>
                                <option>සාමාන්‍ය පෙල</option>
                                <option>උසස් පෙල</option>
                                <option>After A/L</option>
                            </select>
                            
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-10">
                           <input type="text" name="subject" placeholder="විෂය" required />
                        </div>
                        
                        <div class="col-lg-6 col-sm-12 mb-10">
                                <select name="medium" required="" style="width: 100%; height: 40px; border: 1px solid #ebebeb; border-radius: 2px; padding: 0 15px;">
                                    <option value="">මාධ්‍යය</option>
                                    <option>සිංහල</option>
                                    <option>ඉංග්‍රිසි</option>
                                </select>

                        </div>
                        <div class="col-lg-6 col-sm-12 mb-10">
                           <input type="text" name="teacher_name" placeholder="ඉල්ලුම් කරන ගුරුවරයාගේ නම" required />
                        </div>
                        
                        
                        <p style="font-size: large;line-height: 180%;display: block;background: #fff1f0;width: 100%;border-radius: 10px;text-align: center;line-height: inherit;padding: 10px;font-size: initial;"> පංති ගැන සහ අප ආයතනය ගැන වෙනත් පැමිණිලි හා යෝජනා පහතින් සදහන් කරන්න  දීමට කටයුතු කරනු ඇත.</p>



                        <div class="col-lg-6 col-sm-12 mb-10">
                           <input type="text" name="student_name" placeholder="ඔබගේ නම" required />
                        </div>
                        <div class="col-lg-6 col-sm-12 mb-10">
                           <input type="text" name="student_grade" placeholder="ඉගෙන ගන්නා ශ්‍රේණිය" required />
                        </div>
                        <div class="col-lg-12 col-sm-12 mb-10">
                           <input type="text" name="contact_number" placeholder="ඔබව සම්බන්ද කරගත හැකි දුරකථන අංකයක්" required />
                        </div>
                        
                        <div class="col-sm-12 mt-40" style="padding: 0px;">
                           <input type="submit" name="send_message" class="btn-common d-inline-block" value="Send Message"  
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--contact-us-area end-->
   
   












   
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   