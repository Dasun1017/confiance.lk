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


<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Student Inquiry - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        <!---->
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;">
                            <div class="content-wrapper">
                              
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            




  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }
      .postpay { background: black; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
  </style>          


                  

             

<?php 
        $sql3 = "SELECT * FROM inquiries WHERE active= '1' ";
        $result3 = mysqli_query($connect, $sql3);
        while($pra3 = mysqli_fetch_array($result3)) { 
?>


                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table" border="1">
                                <thead>
                                <tr>
                                    <th style=" background: black; color: white; padding: 5px; ">ID</th>
                                    <th style=" background: black; color: white; padding: 5px; ">ශ්‍රේණිය</th>
                                    <th style=" background: black; color: white; padding: 5px; ">විෂය</th>
                                    <th style=" background: black; color: white; padding: 5px; ">මාධ්‍යය</th>
                                    <th style=" background: black; color: white; padding: 5px; ">ඉල්ලුම් කරන ගුරුවරයාගේ නම</th>
                                    <th style=" background: black; color: white; padding: 5px; ">ඔබගේ නම</th>
                                    <th style=" background: black; color: white; padding: 5px; ">ඉගෙන ගන්නා ශ්‍රේණිය</th>
                                    <th style=" background: black; color: white; padding: 5px; ">දුරකථන අංකය</th>
                                </tr>
                                </thead>

                                <tbody>

                                <tr>
                                  
                                    <td><?php echo $pra3[id]; ?></td>
                                    <td><?php echo $pra3[grade]; ?></td>
                                    <td><?php echo $pra3[subject]; ?></td>
                                    <td><?php echo $pra3[medium]; ?></td>
                                    <td><?php echo $pra3[teacher_name]; ?></td>
                                    <td><?php echo $pra3[student_name]; ?></td>
                                    <td><?php echo $pra3[student_grade]; ?></td>
                                    <td><?php echo $pra3[contact_number]; ?></td>

                                </tr>


<?php } ?>
                                </tbody>
                            </table>

                    </div></div>







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