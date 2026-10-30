<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title></title>
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
 





    <div class="row" style="margin: 0px 0 10px 0; width: 100%; margin-top: 50px">
        
        
<?php   
$sql_cat_Y = "SELECT * FROM gallery WHERE active = '1' ORDER BY id DESC";
$result_cat_Y = mysqli_query($connect, $sql_cat_Y);

while($pra_cat_Y = mysqli_fetch_array($result_cat_Y)) {   
?>      


<div class="col-lg-4 col-md-12" style="color: white;">
    <h4><?php echo htmlspecialchars($pra_cat_Y['gallery_name']); ?></h4>

    <!-- Image Section -->
    <?php   
    $sql_cat = "SELECT * FROM gallery_image WHERE gallery_id = '{$pra_cat_Y['id']}' AND image_or_video = '1' AND active = '1' ORDER BY id DESC";
    echo $sql_cat; 
    $result_cat = mysqli_query($connect, $sql_cat);
    $image_count = 0;
    $images = [];

    while ($pra_cat = mysqli_fetch_array($result_cat)) { 
        $image_count++;
        $images[] = $pra_cat;
        echo $images[] = $pra_cat;
    }

    // Check if there are more than 3 images
    if ($image_count > 0) {
        ?>
        <div id="carousel-<?php echo $pra_cat_Y['id']; ?>" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                foreach ($images as $index => $pra_cat) {
                    $activeClass = ($index === 0) ? 'active' : '';
                    ?>
                    <div class="carousel-item <?php echo $activeClass; ?>">
                        <a href="img.php?img_name=learning_meterials/<?php echo htmlspecialchars($pra_cat['file_name']); ?>" target="_blank">
                        <img src="simpleimages.php?file=learning_meterials/<?php echo htmlspecialchars($pra_cat['file_name']); ?>&width=400&height=300"

                                 style="width: 100%; border-radius: 10px; box-shadow: 0 17px 40px 0 rgb(54 59 91 / 35%); background: #fff;" 
                                 class="img_transition">
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carousel-<?php echo $pra_cat_Y['id']; ?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-<?php echo $pra_cat_Y['id']; ?>" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
    } else {
        foreach ($images as $pra_cat) {
            ?>
            <div class="col-lg-12 col-md-6_new2X">  
                <h6><?php echo htmlspecialchars($pra_cat['title']); ?></h6>
                <a href="img.php?img_name=learning_meterials/<?php echo htmlspecialchars($pra_cat['file_name']); ?>" target="_blank">
                    <img src="simpleimages.php?file=learning_meterials/<?php echo htmlspecialchars($pra_cat['file_name']); ?>&width=400&height=300" 
                         style="width: 100%; border-radius: 10px; box-shadow: 0 17px 40px 0 rgb(54 59 91 / 35%); background: #fff; margin-bottom: 30px; transition: 0.3s;" 
                         class="img_transition">
                </a>
            </div>
            <?php
        }
    }
    ?>

    <!-- Video Section -->
    <?php   
    $sql_cat = "SELECT * FROM gallery_image WHERE gallery_id = '{$pra_cat_Y['id']}' AND image_or_video = '2' AND active = '1' ORDER BY id DESC";
    $result_cat = mysqli_query($connect, $sql_cat);
    
    while($pra_cat = mysqli_fetch_array($result_cat)) { 
    ?>            
        <div class="col-lg-12asdasd col-md-6_new2X" style="margin-top: 20px"> 
            <h6><?php echo htmlspecialchars($pra_cat['title']); ?></h6>
            <iframe width="100%" height="200" src="https://www.youtube.com/embed/<?php echo htmlspecialchars($pra_cat['description']); ?>?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="box-shadow: 5px 8px 20px 0px rgb(180 180 180 / 73%); border-radius: 20px;"></iframe>
        </div>
    <?php } ?>

    </div>
<?php } ?>


    </div>

   <!--banner-area end-->
   
   

    








   <!--team-area start-->















   
   <!--footer-area start-->
   <?php footer(); ?>
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
