<?php 
//ob_start();
error_reporting(0);
date_default_timezone_set("Asia/Colombo");
session_start();


include 'source_files/site_settings.php';  

require_once 'class.user.php';
include 'source_files/site_settings2.php';  
$user_login = new USER(); 

include 'functions/db.php';
require_once("functions/db_new.php");

$db_handle = new DBController();


$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_domain = "https://$_SERVER[HTTP_HOST]/";


if($user_login->is_logged_in())
{
    
        $sql_zoom = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]'";
        $result_zoom = mysqli_query($connect, $sql_zoom);
        $pra_zoom = mysqli_fetch_array($result_zoom);
        if ($pra_zoom['selected_subject'] == '' && basename($_SERVER['PHP_SELF']) !== 'my_profile.php') {

            $user_login->redirect('my_profile.php?zoom');
        }
}


$primaryDomain = $actual_domain_without_http;
$baseURL = 'https://itsignature.lk/Website_Backups/' . $primaryDomain . '/public_html/functions/uploads/';
$baseURL2 = 'https://itsignature.lk/Website_Backups/' . $primaryDomain . '/public_html/learning_meterials/';
$current_page = 'https://' . $primaryDomain . '/';

function getImageUrl($fileName, $baseURL, $current_page) {
    $localFilePath = 'functions/uploads/' . $fileName;
    
    if (file_exists($localFilePath)) {
        return $current_page . $localFilePath;
    } else {
        return $baseURL . $fileName;
    }
}

function getImageUrl_Learning($fileName, $baseURL2, $current_page) {
    $localFilePath = 'learning_meterials/' . $fileName;
    
    if (file_exists($localFilePath)) {
        return $current_page . $localFilePath;
    } else {
        return $baseURL2 . $fileName;
    }
}


if(isset($_GET[view])) { 
$_GET[view] = mysqli_real_escape_string($connect, $_GET[view]);
$_GET['view'] = mysqli_real_escape_string($connect, $_GET[view]);
}

if(isset($_GET[success])) { 
$_GET[success] = mysqli_real_escape_string($connect, $_GET[success]);
$_GET['success'] = mysqli_real_escape_string($connect, $_GET[success]);
}

if(isset($_GET[remove])) { 
$_GET[remove] = mysqli_real_escape_string($connect, $_GET[remove]);
$_GET['remove'] = mysqli_real_escape_string($connect, $_GET[remove]);
}


if(isset($_GET[add])) { 
$_GET[add] = mysqli_real_escape_string($connect, $_GET[add]);
$_GET['add'] = mysqli_real_escape_string($connect, $_GET[add]);
}

if(isset($_GET[teacher_id])) { 
$_GET[teacher_id] = mysqli_real_escape_string($connect, $_GET[teacher_id]);
$_GET['teacher_id'] = mysqli_real_escape_string($connect, $_GET[teacher_id]);
}

if(isset($_GET[student_paying_to])) { 
$_GET[student_paying_to] = mysqli_real_escape_string($connect, $_GET[student_paying_to]);
$_GET['student_paying_to'] = mysqli_real_escape_string($connect, $_GET[student_paying_to]);
}

if(isset($_GET[done])) { 
$_GET[done] = mysqli_real_escape_string($connect, $_GET[done]);
$_GET['done'] = mysqli_real_escape_string($connect, $_GET[done]);
}

if(isset($_GET[cancel])) { 
$_GET[cancel] = mysqli_real_escape_string($connect, $_GET[cancel]);
$_GET['cancel'] = mysqli_real_escape_string($connect, $_GET[cancel]);
}



if(isset($_POST['sign_in_x']))
{
    $email = trim($_POST['username']);
    $upass = trim($_POST['password']);
    
    if($user_login->login($email,$upass))
    {
        if($_SESSION['type'] == '1') { $user_login->redirect('admin_teachers_list.php'); }
        if($_SESSION['type'] == '2') { $user_login->redirect('teachers_add_lesson.php'); }
        if(isset($_GET[view])) { 
          if($_SESSION['type'] == '3') { $user_login->redirect('lessons.php?view='.$_GET[view].''); }
        }if(!isset($_GET[view])) { 
          if($_SESSION['type'] == '3') { $user_login->redirect('select_your_teacher.php'); }
        }
    }
}











function metas() { 
    
include 'source_files/site_settings2.php';  
    echo '<link rel="shortcut icon" href="source_files/new_confiance_logo.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<meta property="og:site_name" content="'.$actual_domain_without_http.'">
<meta property="og:title" content="'.$site_website_name.'" />
<meta property="og:description" content="<?php echo $site_meta_description; ?>" />
<meta property="og:image" itemprop="image" content="https://'.$actual_domain_without_http.'/source_files/new_confiance_logo.png.png">
<meta property="og:type" content="website" />


   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="manifest" href="site.webmanifest">
   <link rel="apple-touch-icon" href="icon.png">
   <!-- Place favicon.ico in the root directory -->

   <!-- bootstrap v4.0.0 -->
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <!-- font-awesome css -->
   <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   <!-- themify-icons css -->
   <link rel="stylesheet" href="assets/css/themify-icons.css">
   <!-- themify-icons css -->
   <link rel="stylesheet" href="assets/css/ionicons.min.css">
   <!-- animate css -->
   <link rel="stylesheet" href="assets/css/animate.css">
   <!-- cssanimation css -->
   <link rel="stylesheet" href="assets/css/cssanimation.min.css">
   <!-- jquery-ui.min css -->
   <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
   <!-- venobox css -->
   <link rel="stylesheet" href="assets/css/venobox.css">
   <!-- jquery.mmenu css -->
   <link rel="stylesheet" href="assets/css/jquery.mmenu.css">
   <!-- slick css -->
   <link rel="stylesheet" href="assets/css/slick.css">
   <!-- slick-theme css -->
   <link rel="stylesheet" href="assets/css/slick-theme.css">
   <!-- helper css -->
   <link rel="stylesheet" href="assets/css/helper.css">
   <!-- style css -->
   <link rel="stylesheet" href="style.css">
   <!-- responsive css -->
   <link rel="stylesheet" href="assets/css/responsive.css">

   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Roboto:300,400,500,700,900|Satisfy">
<!--<script src="//code.tidio.co/lst6a05mzi0rghfacekumdpbuzldc5ur.js" async></script>-->
   

   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&amp;family=Fredoka:wght@300&amp;display=swap" rel="stylesheet">




   <style>
   .mm-listitem__text { text-transform: uppercase; }
    @media only screen and (max-width: 445px){  .position_static {     position: static !important; }   }  

    .mainmenu nav ul li a { font-family: "Roboto" !important; font-style: normal !important; color:black;}
   .stick { display: none; }
   
   @media (max-width: 768px) {
    .btn-login, .btn-register {
        display: none !important;  /* Hide on mobile */
    }

    .header-right .social-links {
        display: none; /* Optionally hide social links on mobile as well */
    }
}



.social-links {
    display: flex;
    align-items: center;
    gap: 10px;
    color: white;
}

.nav-item {
    color: white !important;
    font-size: 16px;
    text-decoration: none;
}

.header-right {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

/* Style for login and register buttons */
.btn-login, .btn-register {
    background: none;
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    margin-right: 10px;
    transition: all 0.3s ease;
}

.btn-login:hover, .btn-register:hover {
    color: #f1c40f; /* A soft hover color, adjust as needed */
}

/* Hiding the login/register buttons in mobile view */
@media (max-width: 768px) {
    .btn-login, .btn-register {
       
    }

    .social-links {
        display: none; /* Optionally hide social links on mobile */
    }
}


/* Style for social media icons */
.social-links {
    display: flex;
    align-items: center;
    gap: 10px; /* Add gap between the icons */
}

.social-icon i {
    font-size: 30px; /* Increase the size of icons */
    color: white;    /* Ensure icons are white */
    transition: transform 0.3s ease-in-out;
}

.social-icon i:hover {
    transform: scale(1.1); /* Optional: Hover effect to slightly enlarge the icon */
}

/* Add margin between the social icons and the login/register buttons */
.auth-links {
    margin-left: 20px; /* Adjust this value to your preference */
    display: flex;
    gap: 15px;
}

.auth-links a {
    color: white;
    font-size: 25px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
}

.auth-links a:hover {
    color: #ff6f61; /* Optional: Add hover effect for links */
}

/* Ensuring mobile view hides the login/register buttons and social links */
@media (max-width: 768px) {
    .btn-login, .btn-register {
        
    }

    .social-links {
        display: none;
    }
}

   
   
   
  

   html { background: ' . $html_background_color . '  }
   .btn-common {     padding: 0 0 0 0; background-color:' . $btn_common_bg_color . ' !important; color: ' . $btn_common_text_color . ' !important;   font-family: "Roboto" !important; font-style: normal; border:0 !important }
   .btn-common:hover { background-color: ' . $btn_common_hover_bg_color . ' !important; }
   .author-bio img { border-radius: 180px !important}
   body  { font-family: "Roboto"; font-style: normal;background:white;; }
   h1, h2, h3, h4, h5, h6  { font-family: "Roboto"; font-style: normal; }
   .mainmenu nav ul li a { margin-right: 20px;  padding: 6px 10px; border-radius: 5px; font-size: x-small; color: white; }

   .stick .mainmenu nav ul li a { margin-right: 20px; background: #d2e626; padding: 6px 10px; border-radius: 5px; font-size: x-small; color: black; color: #343e51 !important; }


   .btn-common { background-color: #28a745; font-size: initial;  color: #000000; border: 2px solid #ffffff; }


   .footer-top { background-color: #707a83   !important; padding: 30px 0 2px 0; width: 100%;}
   .footer-bottom { background-color: #707a83   !important; height: 80px;width: 100%;  }


   .header-area.stick .row { height: 90px !important; }

   .mainmenu nav ul li a {     margin-right: 20px; } 
   
   @media (max-width: 480px) { 
    .mm-listitem__text {     font-size: large;}

   .header-area.stick .row { height: 60px !important; }
    .my_page { min-width: 90px !important; padding: 0 1px; font-size: 12px; }
      .logo a img { height: 30px !important; padding: 0px  !important; box-shadow: none  !important; } 

    }     



   @media (max-width: 460px) {  
    .hide_in_mobile { display:none !important } 
    .show_in_mobile { display:block !important } 
   .my_page { min-width: 110px; padding: 0 10px; }
       
   } 
   
   @media (min-width: 460px) {  .hide_in_desktop { display:none !important }   } 
   
   
   
   .form-control { font-size: inherit; } 
   
   .overlay:before { background-color: rgba(255, 255, 255, 0);  } 
   .form-control, input, input.form-control, select, select.form-control, textarea { height: 50px; border: 1px solid #ebedf2; -webkit-border-radius: 3px; border-radius: 3px; color: #747b86; font-size: 16px; -webkit-transition: .3s ease; -o-transition: .3s ease; transition: .3s ease; }
   
   
   select {font-weight: 300; background: white; } 
   
   .statement_info_card { border-radius: 10px;box-shadow: 0 6px 3px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.09) !important;} 
   
   
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }
      .postpay { background: black; font-weight: bold;  }
      
      .table-responsive { background: white;border-radius: 10px;box-shadow: 0 6px 3px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.09) !important;margin: 50px 0 0 0; } 
      
      .credit_modules .modules__content, .shortcode_modules .modules__content, .upload_modules .modules__content, .withdraw_module .modules__content { padding: 30px 30px 10px 30px; }
      
      .table { font-size: inherit; width: 99%; } 
      textarea, textarea.form-control, textarea.text_field { border : 1px solid #c4c4c4; }
      .text_field { border: 1px solid #c4c4c4; }
      .form-control, input, input.form-control, select, select.form-control, textarea {  border: 1px solid #c4c4c4; }
      
      
   </style>
    ';
}

   

function real_header() { 
    
    
include 'source_files/site_settings2.php';  
include 'functions/db.php';
    
        $sql_header = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]'";
        $result_header = mysqli_query($connect, $sql_header);
        $pra_header = mysqli_fetch_array($result_header);
        
        
        
   

    echo '<header id="sticker" class="header-area" style="background-color: ' . $nav_bg_color . ' !important;"> 
      <div class="container-fluid">
         <div class="row height-100 align-items-center">
            <div class="col-xl-2 col-lg-2 col-sm-4 col-5">
               <div class="logo">
               <a href="index.php"><img src="source_files/new_confiance_logo.png" style=" padding: 5px; box-shadow: 0px 0px #000000; border-radius: 12px; height:70px;" class="logo_img" /></a> 
               </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-sm-2 col-2 hide_in_mobile">
               <div class="mainmenu">
                  <nav>                                
                     <ul>
                     
                     
              
                         
                              
                        
                               
                                
                                
<li><a href="login.php" class="nav-item" style="font-size: initial; background:#000;">HOME</a></li>
                                <li><a href="select_your_teacher.php" class="nav-item" style="font-size: initial; background:#000;">OUR CLASSES</a></li>
                                <li><a href="about-us.php" class="nav-item" style="font-size: initial; background:#000;">ABOUT US</a></li>
                                <li><a href="contact-us.php" class="nav-item" style="font-size: initial; background:#000;">CONTACT US</a></li>
                                <li><a href="gallery.php" class="nav-item" style="font-size: initial; background:#000;">NOTICES</a></li>';
                        
                        
$user_home = new USER(); 
if($user_home->is_logged_in()!="")
{
                       echo '
                
                        <li><a href="my_profile.php"  style="font-size: initial; background: BLACK; color:white;">Profile</a></li>';
}


                  echo '  
                 
                  </ul>
                  
                  
                  </nav>
               </div>
               <div class="d-hidden mobile-menu">
                  <nav id="mobile-menu">                                
                     <ul>';
                     
$user_home = new USER(); 
if($user_home->is_logged_in()!=""){ echo '<li><a href="login.php">Hi '.$pra_header["userName"].', </a> </li> '; }
if(!$user_home->is_logged_in()) { //echo '<li><a href="login.php">Login</a></li>'; 
}


                     
$user_home = new USER(); 
if($user_home->is_logged_in()!="")
{
                       echo '
                        <li><a href="my_profile.php">My Profile</a></li>';
}


echo '
                        <!--<li><a href="/" >Home</a></li>-->

                        <li><a href="students_cart_activate.php">
                        My Class
                        </a></li>
                        <li><a href="select_your_teacher.php">
                      අපගේ පන්ති
                        
                        </a></li>
                          <li><a href="about-us.php">
                            අප ගැන
                          </a></li>
                          
                          
                          
                        
                       
                        <li><a href="contact-us.php">
                        
                        
                    අප අමතන්න
                        
                        
                        </a></li>';
                        
$user_home = new USER(); 
if($user_home->is_logged_in()!="")
{
                       echo '
                        <li><a href="logout.php" style=" font-weight: 600; color: black; ">Logout </a> </li>';
}
echo '                     </ul>
                  </nav>
               </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-6 col-7">
               <div class="header-right text-right"> ';
               
$user_home = new USER(); 
if(!$user_home->is_logged_in())
{
    
}
if($user_home->is_logged_in()!="")
{
    echo '<div style="background: none;border: none;width: fit-content;float: left;border-radius: 0 0 5px 5px;" class="hide_in_mobile"> 
                                                        <h3 style="text-align: center;line-height: initial;height: auto;margin: 0px;padding: 6px 10px;font-size: initial;font-weight: 400;font-family: Roboto; color:black; ">Hi '.$pra_header["userName"].', </h3> 
                    </div>';
                    
    if($_SESSION['type'] == '1') { echo '<a href="admin_teachers_list.php" class="btn-common ds-md-none mr-0 hide_in_mobile_x my_page">Dashboard</a>'; } 
    if($_SESSION['type'] == '2') { echo '<a href="teachers_active.php" class="btn-common ds-md-none mr-0 hide_in_mobile_x my_page">Dashboard</a>'; } 
    
    
    //if($_SESSION['type'] == '3') { echo '<a href="students_cart_activate.php" class="btn-common ds-md-none mr-0 my_page hide_in_mobile"><img src="'; if( $pra_header[p_picture] == '') { echo 'source_files/logo_long_transparent.png'; } else {  echo 'functions/uploads/'.$pra_header[p_picture].''; } echo '" style="height: 47px;background: white;padding: 1px;box-shadow: 0px 0px #dddddd;border-radius: 100px;margin-top: -4px;margin-right: 5px;" class="logo_img">My Lessons</a>'; } 
    
    
    
    if($_SESSION['type'] == '2') { echo '<a href="lecture.php?view='.$_SESSION["userSession"].'" class="btn-common ds-md-none mr-25 hide_in_mobile " style="padding: 0 10px; min-width: 100px; margin-right: 15px !important;"><img src="'; if( $pra_header[p_picture] == '') { echo 'source_files/logo_long_transparent.png'; } else {  echo 'functions/uploads/'.$pra_header[p_picture].''; } echo '" style="height: 34px;background: white;padding: 1px;box-shadow: 0px 0px #dddddd;border-radius: 100px;margin-top: -4px;margin-right: 5px;" class="logo_img">My Class</a>'; } 
    echo '<a href="logout.php" class="hide_in_mobile" style=" font-weight: 600; color: black; ">Logout </a> ';
    
    
}

                  
                  
                  
                  
                  echo '
                        <div class="mini-cart">
                     <ul>
                        <li class="mmenu-icon"><a href="#mobile-menu"><i class="fa fa-bars" style="margin-top: 10px;"></i></a></li>
                     </ul>
                  </div>       
                  <!--<div class="register-login">
                     <a href="register.html">Register</a>
                     <span>/</span>
                     <a href="javascript:void(0);" data-toggle="modal" data-target="#login">Sign in</a>
                  </div>-->
               </div>
            </div>
         </div>
      </div>
   </header>
    ';
}







function footer() { 
    
    echo '
    <a href="https://wa.me/94760407677" class="whatsapp-float" target="_blank" rel="noopener noreferrer"
        style=" position: fixed;
                bottom: 17px;
                right: 30px;
                width: 60px;
                height: 60px;
                background: #25d366;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 30px;
                z-index: 999;
                transition: all 0.3s ease;
                box-shadow: 0 5px 25px rgba(37, 211, 102, 0.4);
                text-decoration: none;"
    >
        <i class="fab fa-whatsapp"></i>
    </a>
   <script src="assets/js/jquery.mmenu.js"></script>
   <script src="assets/js/main.js"></script>
   ';
    
}

   









?>