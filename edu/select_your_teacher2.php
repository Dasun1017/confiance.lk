<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>


<?php 
  $_GET[view2] = $_GET[view];
  $_GET[view] = 'Tutors'; 
?>

<!doctype html>
<html class="no-js" lang="zxx" style="background: white">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>List of <?php echo $_GET[view]; ?> - The ISM Education Network - Wijerama | Nugegoda</title>
   <style type="text/css">
      .author-bio:hover { background: #fff !important; } 
        .author-bio h3 { font-size: initial !important; } 
        .author-bio:hover { background: #e8e8e8; border-radius: 29px; padding-left: 10px; transition: 0.3s }
        .author-bio:hover .span { transition: 0.3s }
        .author-bio .span { margin-left: 10px; margin-top: 5px; display: inline-block;  }
   </style>
   <?php metas(); ?>
</head>

<body>
   <!--[if lte IE 9]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end-->
   
   






















   <!--course-area start-->
   <div class="course-area mt-50">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               
               <div class="tab-content">
                  <!--single-tab-->
                  <div id="grid-products" class="tab-pane fade in show active">
                     <div class="row" style="width: 100%">
       




<?php 
  $_GET[view] = 'Tutors'; 
?>
<?php   if($_GET[view] == 'Tutors') { $grade = 'Tutor'; } 
        if($_GET[view] == 'Trainers') { $grade = 'Trainer'; } 

        if($_GET[type] == 'videos') { 
          $sql4x = "SELECT * FROM tbl_users WHERE type= '2' AND grade = '$grade'  and userStatus = 'Y' AND batch =  'YES' AND selected_ol_al_grade = '$_GET[view2]' GROUP by subject  ORDER by  CAST(order_by AS UNSIGNED) ASC";
        } else {
          $sql4x = "SELECT * FROM tbl_users WHERE type= '2' AND grade = '$grade'  and userStatus = 'Y' AND batch =  '' AND selected_ol_al_grade = '$_GET[view2]' GROUP by subject  ORDER by  CAST(order_by AS UNSIGNED) ASC"; //AND subject = '$_GET[group]' 
        }


        $result4x = mysqli_query($connect, $sql4x);
        while ( $pra4x = mysqli_fetch_array($result4x)) { 

        $i += 1;

?>


<?php   $sql_cat_group = "SELECT * FROM main_group  where active = '1' AND id = '$_GET[view2]' ORDER by id DESC";
        $result_cat_group = mysqli_query($connect, $sql_cat_group);
        $pra_cat_group = mysqli_fetch_array($result_cat_group); ?>     
            <div class="col-lg-12  mt-20 collapsible" style="cursor: pointer;">
               <div class="text-center" style="text-transform: uppercase;">
                  <h3 style="padding: 10px; border-radius: 10px; font-weight: 200; border-bottom: 1px solid black; background-image: linear-gradient(45deg, #2361b0 0%, #2361b0 100%); color: rgb(255, 255, 255); text-align: left; padding-left: 20px; font-family: sans-serif;    "><?php echo $pra_cat_group[main_group_name]; ?>
                    <span style="float:right;background: #2a2a2a;padding: 1px 10px;color: white;border-radius: 5px;font-weight: 500;">⋁</span>
                  </h3>
               </div>
            </div>


<div class="row" style="display:contents; <?php if($i == 1) { echo " display: contents !important"; } ?> ">

<?php   if($_GET[view] == 'Tutors') { $grade = 'Tutor'; } 
        if($_GET[view] == 'Trainers') { $grade = 'Trainer'; } 

        if($_GET[type] == 'videos') { 
          $sql4 = "SELECT * FROM tbl_users WHERE type= '2' AND grade = '$grade'  and userStatus = 'Y' AND selected_ol_al_grade = '$pra4x[selected_ol_al_grade]' AND batch =  'YES' ORDER by  CAST(order_by AS UNSIGNED) ASC"; //ORDER by userID ASC
        } else {
           $sql4 = "SELECT * FROM tbl_users WHERE type= '2' AND grade = '$grade'  and userStatus = 'Y' AND selected_ol_al_grade = '$pra4x[selected_ol_al_grade]' AND batch =  '' AND subject = '$pra4x[subject]'  ORDER by  CAST(order_by AS UNSIGNED) ASC"; //ORDER by userID ASC //
        }

        $result4 = mysqli_query($connect, $sql4);
        while ( $pra4 = mysqli_fetch_array($result4)) { 

?>



                        <div class="col-lg-3 col-sm-6" style=" height: 290px; ">
                        
                        <div class="author-bio text-left mt-0" style="padding: 5px; border:0px;padding-bottom: 0px;height: 40px;">
                           <a href="lecture.php?view=<?php echo $pra4[userID]; ?>">


                              <?php if( $pra4[p_picture] != '') { ?>
                                <div align="center"><img src="functions/uploads/<?php echo $pra4[p_picture]; ?>"  style="height: auto;"  />
                                </div>
                                <?php } else { ?>

                                <div align="center"><img src="source_files/fav2.png"  style="height: auto; width: 40%;"  />
                                </div>
                                <?php } ?>
                                <br>



                            <h3 style="height: 40px;font-size: 16px !important;font-family: 'Roboto';font-weight: normal;color: #555;" align="center">
                              <span class="span"><?php echo $pra4[userName]; ?></span>
                              <br>
                              <span class="span" style="color:red">(<?php echo $pra4[school]; ?>)</span>
                              <br>
                          
                           <span> <p class="btn-common" style="    margin: 10px 0 0 0; font-size: medium;height: 27px;line-height: revert;border-radius: 50px;width: fit-content;font-weight: 500;padding: 3px 20px; background: #f3f3f4; color: #0d0c22; box-shadow: 2px 3px 4px 0px rgb(168 168 168 / 76%); color: white; ">පන්ති පෙන්වන්න</p> </span>

                           </h3>

                           </a>


                          </div>  
                          
                     
                        </div>




<?php } ?>

</div>

<?php } ?>


<!--
            <div class="col-lg-12  mt-20">
              <br><br><img src="source_files/1.jpg" style="width: 100%;     border-radius: 20px;">
            </div>
-->
                     </div>
                  </div>
                  <!--single-tab-->
                  
               </div>
               
            </div>
         </div>
      </div>
   </div>
   <!--course-area end-->







    <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "contents") {
          content.style.display = "none";
        } else {
          content.style.display = "contents";
        }
      });
    }
    </script>





    <div style="height: 100px"></div>



   
   <!--footer-area start-->
   <?php //footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>
