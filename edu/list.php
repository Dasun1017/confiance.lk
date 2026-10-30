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

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

//////

$no_of_records_per_page = 100;
$offset = ($pageno-1) * $no_of_records_per_page;

//////
if(isset($_GET[batch_only])) {
            $total_pages_sql = "SELECT type, batch FROM tbl_users_2 WHERE type = '3' AND batch = '$_GET[batch]' ";
        } else  { 
            $total_pages_sql = "SELECT type FROM tbl_users_2 WHERE type = '3' ";
        }

$result_pag = mysqli_query($connect, $total_pages_sql);
$num_rows = mysqli_num_rows($result_pag);

$total_pages_pag = ceil($num_rows / $no_of_records_per_page);


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
    <title><?php echo $num_rows; ?> - Students Registry - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <link rel="shortcut icon" href="source_files/favicon.png" type="image/png">

<meta property="og:site_name" content="<?php echo $actual_domain_without_http; ?>">
<meta property="og:title" content="<?php echo $site_website_name; ?>" />
<meta property="og:description" content="<?php echo $site_meta_description; ?>" />
<meta property="og:image" itemprop="image" content="https://<?php echo $actual_domain_without_http; ?>/source_files/favicon.png">
<meta property="og:type" content="website" />


   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="manifest" href="site.webmanifest">
   <link rel="apple-touch-icon" href="icon.png">
   <!-- Place favicon.ico in the root directory -->

   
   <link rel="stylesheet" href="style.css">

   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Roboto:300,400,500,700,900|Satisfy">
<!--<script src="//code.tidio.co/lst6a05mzi0rghfacekumdpbuzldc5ur.js" async></script>-->
   

   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&amp;family=Fredoka:wght@300&amp;display=swap" rel="stylesheet">




   <style>
   .mm-listitem__text { text-transform: uppercase; }
    @media only screen and (max-width: 445px){  .position_static {     position: static !important; }   }  

    .mainmenu nav ul li a { font-family: "Fredoka One" !important !important; font-style: normal !important; }
   .stick { display: none; }
   .header-area { background-color: #000000; }
   html { background: black}
   .btn-common {     padding: 0 20px 0 0; background-color: #ff0100 !important; font-family: "Fredoka One" !important; font-style: normal; border:0 !important }
   .btn-common:hover { background-color: #ff0100 !important; }
   .author-bio img { border-radius: 180px !important}
   body  { font-family: "Fredoka One"; font-style: normal; }
   h1, h2, h3, h4, h5, h6  { font-family: "Fredoka One"; font-style: normal; }
   .mainmenu nav ul li a { margin-right: 20px; background: #000000; padding: 6px 10px; border-radius: 5px; font-size: x-small; color: white; }

   .stick .mainmenu nav ul li a { margin-right: 20px; background: #d2e626; padding: 6px 10px; border-radius: 5px; font-size: x-small; color: black; color: #343e51 !important; }


   .btn-common { background-color: #28a745; font-size: initial;  color: #fff; border: 2px solid #ffffff; }


   .footer-top { background-color: #f2f4f7; padding: 30px 0 21px 0; }
   .footer-bottom .row { height: 80px; }


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
    
    <style type="text/css">
        
            @media only screen and (max-width: 445px){  
                .p-top-0 { margin-top: 0px !Important }  
                .logo_img  { height: 125px; object-fit: cover;  }

            }  
    </style>
</head>
<body class="preload">
    
    
   


    



    
    
    <section class="hero-area4 bgimage">
        <!---->
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            






                            












  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

      .form-control, input {border: 1px solid #262626; } 

      #display ul li { padding: 2px 10px; border: 1px solid #e8e8e8; border-radius: 5px; margin: 2px 0; } 
  </style>    
     
                        
                      
                    






<form action="" method="get" style=" background: #d0d0d0; border-radius: 10px; margin-bottom: 40px ">
                        <div class="cardify signup_form">
                            <!-- end .login_header -->

                            <div class="login--form">
                                
<?php if(isset($_GET[batch_only])) {  ?>
    <h2>Showing only : <?php echo $_GET[batch]; ?></h2>

<?php } ?>
                                <div class="form-group">
                                <div class="row">
                            <div class="col-lg-6 col-md-12">
                                    
                                    <select name="batch" required="">
                                        <option>Select Grade</option>
                                        <?php echo $site_grades; ?>
                                    </select>
                                </div><div class="col-lg-6 col-md-12">
                                    
                                    <input class="btn btn--md register_btn btn-primary" type="submit" name="batch_only" value="List Students">
                                </div>
        
        
                                </div>
                                </div>

                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
</form>









                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-bar clearfix filter-bar2" style="margin-bottom: 0px">


<?php if(isset($_GET[search])) {  ?>
                            <div class="filter__items dashboard_purchase">
                                <div class="filter__option filter--search">
                                    <a href="admin_students_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; ">GO TO <strong>LIST OF STUDENTS</strong></a>
                                </div>
                                
                            </div><!-- ends: .pull-right -->
<?php } ?>


                            <div class="dashboard__title" <?php if(isset($_GET[search])) {  echo 'style="display:none"'; } ?>>

                                      <style>.disabled {display: none} </style>
                                        <!-- Start Pagination -->
                                        <nav class="pagination-default">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="?pageno=1<?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>" aria-label="Previous">
                                                        <span aria-hidden="true"><i class="fa fa-long-arrow-left"></i></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                </li>

                                                


                                                <li class="page-item <?php if($pageno <= 5){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 5){ echo '#'; } else {  $id_5 =  $pageno - 5; echo "?pageno=".($pageno - 5); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id_5; ?></a></li>
                                                <li class="page-item <?php if($pageno <= 4){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 4){ echo '#'; } else {  $id_4 =  $pageno - 4; echo "?pageno=".($pageno - 4); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id_4; ?></a></li>
                                                <li class="page-item <?php if($pageno <= 3){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 3){ echo '#'; } else {  $id_3 =  $pageno - 3; echo "?pageno=".($pageno - 3); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id_3; ?></a></li>
                                                <li class="page-item <?php if($pageno <= 2){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 2){ echo '#'; } else {  $id_2 =  $pageno - 2; echo "?pageno=".($pageno - 2); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id_2; ?></a></li>
                                                <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else {  $id_1 =  $pageno - 1; echo "?pageno=".($pageno - 1); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id_1; ?></a></li>



                                                <li class="page-item <?php if($pageno == $pageno){ echo 'active'; } ?>"><a class="page-link" href="<?php if($pageno > $total_pages_pag ){ echo '#'; } else {  $id0 =  $pageno + 0; echo "?pageno=".($pageno + 0); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id0; ?></a></li>


                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+0 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id1 =  $pageno + 1; echo "?pageno=".($pageno + 1); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id1; ?></a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+1 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id2 =  $pageno + 2; echo "?pageno=".($pageno + 2); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id2; ?></a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+2 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id3 =  $pageno + 3; echo "?pageno=".($pageno + 3); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id3; ?></a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+3 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id4 =  $pageno + 4; echo "?pageno=".($pageno + 4); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id4; ?></a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+4 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id5 =  $pageno + 5; echo "?pageno=".($pageno + 5); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id5; ?></a></li>
                                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+9 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id10 =  $pageno + 10; echo "?pageno=".($pageno + 10); } ?><?php if(isset($_GET[batch_only])) { echo '&batch_only&batch='.$_GET[batch].'';} ?>"><?php echo $id10; ?></a></li>


                                                <li class="page-item ">
                                                    <a class="page-link" href="?pageno=<?php echo $total_pages_pag; ?>" aria-label="Next">
                                                        <span aria-hidden="true"><i class="fa fa-long-arrow-right"></i></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav><!-- Ends: .pagination-default -->




                            </div>




<script src="js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        function fill(Value)
        {
        $('#name').val(Value);
        $('#display').hide();
        }
    
        $(document).ready(function(){
        $("#name").keyup(function() {
        var name = $('#name').val();
        if(name=="")
        {
        $("#display").html("");
        }
        else
        {
        $.ajax({
        type: "POST",
        url: "student_search_ajax.php",
        data: "name="+ name ,
        success: function(html){
        $("#display").html(html).show();
        }
        });
        }
        });
        });
    </script>


                            <div class="filter__items dashboard_purchase">
                                <div class="filter__option filter--search">
                                    <form action="" method="get">
                                        <input type="text" placeholder="Search Students" autofocus="autofocus" name ='search' id='name' value="<?php echo $val;?>">
                                        <button type="submit"><span class="icon-magnifier"></span></button>
                                        <div id="display"></div>
                                    </form>
                                </div>
                                
                            </div><!-- ends: .pull-right -->
                        </div><!-- ends: .filter-bar -->
                    </div><!-- ends: .col-md-12 -->
                </div>










                      
                    <form action="" method="post" class="row p-top-60">


                                <div class="col-lg-12 col-md-12" style=" font-size: inherit; padding: 0 0 10px 20px; ">Send Quick SMS</div>

                                <div class="col-lg-9 col-md-12">
                                    <textarea type="text" class="text_field" required="" placeholder="Type Here" name="sms_body" style="min-height: 20px;padding-top: 10px;line-height: 30px;height: 90px;" required=""></textarea>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-common" type="submit" name="send_sms2" value="Send Now" style="float: left;margin-top: 0px;" > 
                                </div>
                                
                  </form>


                      
                    
<?php  //if(isset($_GET[search])) {  ?>

                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">


                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Student Name</th>
                                    <th>School</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   $num=1;

if(isset($_GET[batch_only])) {
            
        if(isset($_GET[search])) { 
        $sql2 = "SELECT * FROM tbl_users_2 WHERE type = '3' AND userID = '$_GET[search]' AND batch = '$_GET[batch]' ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; } else { 
        $sql2 = "SELECT * FROM tbl_users_2 WHERE type = '3' AND batch = '$_GET[batch]' ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; }


        } else  { 
            


        if(isset($_GET[search])) { 
        $sql2 = "SELECT * FROM tbl_users_2 WHERE type = '3' AND userID = '$_GET[search]' ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; } else { 
        $sql2 = "SELECT * FROM tbl_users_2 WHERE type = '3'  ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; }


        }


        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


 //if($pra2[status] == 'Paid' OR $pra2[status] == 'Free') { 

          if(isset($_POST[send_sms2])) {  

          //textit        
                    $to = $pra2[userEmail];
                    //$date_time = date("Y/m/d - h:i:sa");
                    $text = urlencode("$_POST[sms_body]");
                    $output4 = preg_replace('!\s+!', ' ', $text);
                    $baseurl ="https://www.textit.biz/sendmsg";
                    $url = "$baseurl/?id=$site_textit_username&pw=$site_textit_password&to=$to&text=$output4&eco=Y";
                    //$ret = file($url);     $res= explode(":",$ret[0]);         
echo "<iframe style='height:1px; width:1px;display: none;' src='$url'></iframe>";                                               
                 
          //textit 
                  }
 //     }

                  

        $sql4 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND active = 1";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);$num_rows4 = mysqli_num_rows($result4); 

        $sql5 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND status = 'Proceed' AND active = 1";
        //$result5 = mysqli_query($connect, $sql5);
        //$pra5 = mysqli_fetch_array($result5);$num_rows5 = mysqli_num_rows($result5);

        $sql6 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND status = 'Paid' AND active = 1";
        //$result6 = mysqli_query($connect, $sql6);
        //$pra6 = mysqli_fetch_array($result6);$num_rows6 = mysqli_num_rows($result6);  

        $sql7 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND status = 'Free' AND active = 1";
        //$result7 = mysqli_query($connect, $sql7);
        //$pra7 = mysqli_fetch_array($result7);$num_rows7 = mysqli_num_rows($result7);  

        $sql8 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND status = 'PostPay' AND active = 1";
        //$result8 = mysqli_query($connect, $sql8);
        //$pra8 = mysqli_fetch_array($result8);$num_rows8 = mysqli_num_rows($result8);  

?>     


                                <tr style="<?php if(isset($_GET[onlypaid])) { if($num_rows6 == '0' OR $num_rows6 == '') { echo 'display: none'; }  }  ?>">
                                    <td><?php echo $num; ?></td>
                                    <td><a href="admin_students_active.php?student=<?php echo $pra2[userID]; ?>" target="_blankx"><?php echo $pra2[userName]; ?></a>
                                    <br><span style="color: black"><?php echo $pra2[location]; ?></span>
                                    <br><span style="color: black"><?php echo $pra2[std_city]; ?></span>
                                    <br><span style="color: black"><?php echo $pra2[userEmail]; ?><br><?php echo $pra2[mobile]; ?> </span>

                                    </td> 
                                    <td> <?php echo $pra2[school]; ?></td>
                                   

                                </tr>


<?php $num++; } ?>















                                </tbody>
                            </table>






                    </div></div>







                            </div>

<?php //} ?>








                        </div>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->




     
  
   
   
   
  
</body>
</html>