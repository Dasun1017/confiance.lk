<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>



<!doctype html>
<html class="no-js" lang="zxx">
<head>
   <meta charset="utf-8">
   <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Who We are</title>
   <?php metas(); ?>
</head>

<body>
   <!--[if lte IE 9]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end-->
   
   <!--banner-area start-->
   <div class="banner-area bg-1 pt-30 pb-111" style="background:none">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="section-title text-center">
                  <h2>About Me</h2>
               </div>
            </div>


<div class="row" style="margin-top:50px">
    
     <a href="source_files/banner 02_new.png" style="margin-bottom: 40px;"  target="_blank"><img src="source_files/banner 02_new.png" style="width:100%;border-radius:10px"></a>
   
    
    <div class="col-lg-4 mt-sm-0 mb-10">
        <a href="source_files/new_confiance_big.jpeg" target="_blank"><img src="source_files/new_confiance_big.jpeg" style="    width: 100%;
    border-radius: 20px;"></a>
    </div>
    
    <div class="col-lg-8 mt-sm-0 mb-10">
        <a href="" target="_blank">
            
            <div>
                <p style="font-weight:bold; margin-bottom:20px; font-size:20px; color:black; ">
                About us!
                </p>
                <p style=" color: grey;     line-height: 2;">
                 Add about us details here... 
                            

                </p>
                </p>
            </div>
            
        </a>
    </div>
    
    
    
</div>


<div class="row" style="margin-top:50px">
 
 
    
    <!-- <div class="col-lg-6 mt-sm-0 mb-10">
        <a href="" target="_blank">
            
            <div>
                <p style="font-weight:bold; margin-bottom:30px; font-size:20px; color:black; ">
                    Here's some details about our recently celebrated Avurudhu Event!
                </p>
                <p style=" color: grey;     line-height: 2;">

Recently, Prabath Ariyasinghe's Accounting Tuition Center celebrated the Avurudhu festival, bringing together students for a day of cultural festivities and bonding. The event was filled with traditional games, music, and food, allowing students to relax and enjoy a vibrant celebration of Sri Lankan heritage amidst their academic journey. This festive occasion not only provided a break from studies but also fostered a strong sense of community among students, highlighting the center's commitment to creating a supportive and enriching learning environment.

                </p>
            </div>
            
        </a>
    </div>
    
       <div class="col-lg-6 mt-sm-0 mb-10">
        <a href="source_files/aboutavurudhu.png" target="_blank"><img src="source_files/aboutavurudhu.png" style="width:100%;border-radius:10px"></a>
    </div> -->
    
    
    
</div>


         </div>



                    
      </div>
      
      
      <div class="container">
          
          <div class="row" style="margin-top:50px; row-gap: 20px;">
    
<?php   

        $sql_cat = "SELECT * FROM learning_meterials  where lesson_id = '$_GET[view]' AND category = 'banners' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


?>  <div class="col-lg-4 mt-sm-0">
        <a href="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" target="_blank"><img src="<?php echo getImageUrl_Learning($pra_cat['file_name'], $baseURL2, $current_page); ?>" style="width:100%;border-radius:10px"></a>
    </div>
    
    
<?php } ?>



    
</div>
          
          
      </div>
      

      
      
      
      
   </div>
   





    
   <!--banner-area end-->
   <!--team-area start-->
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>
