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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Tutory Medici - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">
    
   
   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end--> 
    


    



    
    
    <section class="hero-area4 bgimage">
        
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;">
                            <div class="content-wrapper">
                              
                <div class="container featured-products2  p-top-0 p-bottom-120">
                            






                            


               

<?php if($_POST[password]  != $actual_domain_without_http) { ?>
<div class="row">


                <div class="col-lg-4 col-md-12"> </div>

                <div class="col-lg-4 col-md-6 p-top-80">

                      <a href="admin_teachers_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px;     width: inherit;" >GO TO <strong>TRAINERS/ TUTORS</strong></span></a>
<br><br>

                    <form action="" method="post">
                        <div class="cardify signup_form" style="background: white; border-radius: 10px; padding: 20px;">


<div class="section-title">
                  <h3>MAIN DASHBOARD</h3>
                  <p style="    margin-top: 50px;"></p>
                </div>




                            <div class="login--form">
                                

                                <div class="form-group">
                                    
                                    <input type="Password" class="text_field" placeholder="Enter the Password" name="password" required="">
                                </div>

                              
                                <input class="btn btn--md register_btn btn-common" type="submit" name="login" value="ACCESS NOW" >

                                
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    </form><!-- Ends: .product-single -->


                </div>
</div>
<?php } ?>
















<?php if($_POST[password] == $actual_domain_without_http) { ?>


                            <div class="row">
<div class="col-lg-6 col-md-12 p-bottom-0">
    <div class="login--header" style=" border-bottom: none; "> <h3 style=" font-size: initial; color: black; text-align: left; ">MAIN DASHBOARD<h3p> </div>
    

</div>


<div class="col-lg-6 col-md-12 p-bottom-0">
                      <a href="admin_teachers_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px;        float: right;" >GO TO <strong>TRAINERS/ TUTORS</strong></span></a>
</div>


                            </div>








  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

      .form-control, input {border: 1px solid #262626; } 
      
      .author_info, .card_style1, .card_style2, .cardify, .comment_area, .contact_tile, .content_title, .credit_modules, .featured_event, .google_map .location_address .addres_module, .payment_module, .shortcode_modules, .statement_info_card, .statement_table, .thread_sort_area, .upload_modules, .withdraw_module { background: #fff; -webkit-border-radius: 4px; border-radius: 4px; }
      
      
    .statement_info_card .info p { font-size: 28px; } 
  </style>    


                      
                    














         

<div class="row" style=" margin: 50px -10px 30px -10px; ">
       
       
<?php
        $sql = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>
       
       
        <div class="col-lg-6 col-sm-6">
            <div class="statement_info_card">
                <div class="info_wrap">
                    <div class="info">

<?php

        $sql_new_1 = "SELECT * FROM products WHERE status='Paid' AND active = 1   ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        while($pra_new_1 = mysqli_fetch_array($result_new_1)) {  

        $sql_new_2 = "SELECT * FROM category WHERE id='$pra_new_1[lesson_id]' ORDER by id DESC";
        $result_new_2 = mysqli_query($connect, $sql_new_2);
        $pra_new_2 = mysqli_fetch_array($result_new_2);  

           $total_fees += $pra_new_2[charge]; //echo $pra_new_2[teacher_id];


          if($pra[grade] == 'Tutor') { 
            if($pra_new_2[virutual_or_full] == 'Virual Training Only - Payment Gateway Free')       {  $com =  '0.15';  } 
            if($pra_new_2[virutual_or_full] == 'Full Package')                                      {  $com =  '0.25';  }

            $total_expences += $pra_new_2[charge]*$com;
          }

          if($pra[grade] == 'Trainer') { 
            if($pra_new_2[virutual_or_full] == 'Virual Training Only - Payment Gateway Free')       {  $com =  '0.25';  } 
            if($pra_new_2[virutual_or_full] == 'Full Package')                                      {  $com =  '0.35';  }

            $total_expences += $pra_new_2[charge]*$com;
          }

          if($pra[grade] == 'Tutor') { 
            if($pra_new_2[virutual_or_full] == 'Virual Training Only - Payment Gateway Free')       {  $com =  '0.15';  } 
            if($pra_new_2[virutual_or_full] == 'Full Package')                                      {  $com =  '0.25';  }

            $total_expences += $pra_new_2[charge]*$com;
          }




        }
        
?>      
                        <p class="primary">Rs <?php if($total_fees == '') { echo '0'; } else { echo $total_fees; }  ?></p>
                        <span>Total Revenue</span>
                    </div>
                </div><!-- end .info_wrap -->
            </div><!-- end .statement_info_card -->
        </div><!-- end .col-lg-3 -->

        <div class="col-lg-2 col-sm-6">
            <div class="statement_info_card">
                <div class="info_wrap">
                    
                    <div class="info">


          
        <?php if($pra[selected_package] == 'Prime Super Mass')             {  $com =  '0.15';  } ?>
        <?php if($pra[selected_package] == 'Prime Special Hall')           {  $com =  '0.18';  } ?>
        <?php if($pra[selected_package] == 'Prime Special Mass')           {  $com =  '0.21';  } ?>
        <?php if($pra[selected_package] == 'Prime Special Group Medium')   {  $com =  '0.25';  } ?>
        <?php if($pra[selected_package] == 'Prime Special Group Small')    {  $com =  '0.20';  } ?>
        <?php if($pra[selected_package] == 'Prime Home groups')            {  $com =  '0.15';  } ?>
        <?php if($pra[selected_package] == 'Prime Individual')             {  $com =  '0.10';  } ?>


<?php     
     //$total_expences = $total_fees*$com;
        
?>      
                        
                                             
<?php
        $sql_new_3_x = "SELECT * FROM tutor_payouts WHERE status='Paid' AND active = 1 AND category = 'VAS'  ORDER by id DESC";
        $result_new_3_x = mysqli_query($connect, $sql_new_3_x);
        while($pra_new_3_x = mysqli_fetch_array($result_new_3_x)) {  

           $vas += $pra_new_3_x[amount];

        }
        
?>       


                         <p class="secondary"><?php if($total_expences == '' AND $vas == '') { echo '0'; } else { echo $total_expences+$vas; 
	//echo $total_expences; echo ' - '; echo $vas; 
}  ?></p>
                        <span>Website Balance</span>
                    </div>
                </div>
                <!-- end .info_wrap -->
            </div>
            <!-- end .statement_info_card -->
        </div>
        <!-- end .col-lg-3 -->

        
        <div class="col-lg-2 col-sm-6">
            <div class="statement_info_card">
                <div class="info_wrap">
                    <div class="info">
                            
       

<?php 
        $sql2_total_students = "SELECT * FROM tbl_users WHERE type = '3' ORDER by userID DESC";
        $result2_total_students = mysqli_query($connect, $sql2_total_students);
		$num_rows_total_students = mysqli_num_rows($result2_total_students);
			?>
                        <p class="info" style="color: violet;"> <?php echo $num_rows_total_students; ?></p>
                        <span>Students Count</span>
                    </div>
                </div><!-- end .info_wrap -->
            </div><!-- end .statement_info_card -->
        </div>

        <div class="col-lg-2 col-sm-6">
            <div class="statement_info_card">
                <div class="info_wrap">
                    <div class="info">
       					
<?php 
        $sql2_total_teachers = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2_total_teachers = mysqli_query($connect, $sql2_total_teachers);
		$num_rows_total_teachers = mysqli_num_rows($result2_total_teachers);
			?>
                        <p class="info"> <?php echo $num_rows_total_teachers; ?></p>
                        <span>Teachers Count</span>
                    </div>
                </div><!-- end .info_wrap -->
            </div><!-- end .statement_info_card -->
        </div><!-- end .col-lg-3 -->

        <!--<div class="col-lg-3 col-sm-12">
            <div class="statement_info_card">
                <div class="info_wrap">
                    <div class="info">
<?php 
						
        $sql_new_token = "SELECT * FROM buy_token_free WHERE active = 1 ORDER by id DESC";
        $result_new_token = mysqli_query($connect, $sql_new_token);
        while($pra_new_token = mysqli_fetch_array($result_new_token)) { 
						
           $total_token += $pra_new_token[token_price]*0.4;
		}
						?>
                        <p class="danger">Rs <?php echo $total_token; ?></p>
                        <span>VOD Income</span>
                    </div>
                </div>
            </div>
        </div>-->





    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    
    
    
    
    
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
         
    
 
                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Trainer/ Tutor</th>
                                    <th>Total Fees</th>
                                    <th>Total Charges</th>
                                    <th>VAS</th>
                                    <th>Payouts</th>
                                    <th>Available Balance </th>
                                </tr>
                                </thead>

                                <tbody>

<?php   $num=1;
        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


?>     
                          
<?php
        $total_fees = '';
        $total_expences = '';   
        $tutor_payouts = '';    
        $vas = '';  
        $total_balance = '';                                            
                                                    
        $sql = "SELECT * FROM tbl_users WHERE userID='$pra2[userID]' AND type = '2'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>
       
   

<?php
        $sql_new_1 = "SELECT * FROM products WHERE status='Paid' AND active = 1 AND teacher_id = '$pra2[userID]'  ORDER by id DESC";
        $result_new_1 = mysqli_query($connect, $sql_new_1);
        while($pra_new_1 = mysqli_fetch_array($result_new_1)) {  

        $sql_new_2 = "SELECT * FROM category WHERE id='$pra_new_1[lesson_id]' ORDER by id DESC";
        $result_new_2 = mysqli_query($connect, $sql_new_2);
        $pra_new_2 = mysqli_fetch_array($result_new_2);  

           $total_fees += $pra_new_2[charge];
           $total_fees2 += $pra_new_2[charge];




          if($pra[grade] == 'Tutor') { 
            if($pra_new_2[virutual_or_full] == 'Virual Training Only - Payment Gateway Free')       {  $com =  '0.15';  } 
            if($pra_new_2[virutual_or_full] == 'Full Package')                                      {  $com =  '0.25';  }

            $total_expences += $pra_new_2[charge]*$com;
            $total_expences2 += $pra_new_2[charge]*$com;
          }

          if($pra[grade] == 'Trainer') { 
            if($pra_new_2[virutual_or_full] == 'Virual Training Only - Payment Gateway Free')       {  $com =  '0.25';  } 
            if($pra_new_2[virutual_or_full] == 'Full Package')                                      {  $com =  '0.35';  }

            $total_expences += $pra_new_2[charge]*$com;
            $total_expences2 += $pra_new_2[charge]*$com;
          }

          if($pra[grade] == 'Tutor') { 
            if($pra_new_2[virutual_or_full] == 'Virual Training Only - Payment Gateway Free')       {  $com =  '0.15';  } 
            if($pra_new_2[virutual_or_full] == 'Full Package')                                      {  $com =  '0.25';  }

            $total_expences += $pra_new_2[charge]*$com;
            $total_expences2 += $pra_new_2[charge]*$com;
          }



        }
        
        
?>      
                                <tr style="<?php if($total_fees == '' OR $total_fees == '0') { echo 'display: nonex'; } else {   }  ?>">
                                    <td><?php echo $num; ?></td>
                                    <td style="    width: 200px; max-width:200px;"><a href="admin_teachers_active.php?teacher=<?php echo $pra2[userID]; ?>" target="_blankx"><?php echo $pra2[userName]; ?> <strong>(ID : <?php echo $pra2[userID]; ?>)</strong><br><?php echo $pra2[grade]; ?> - <?php echo $pra2[subject]; ?></a></td>
                                    
									
                                   
                                   
                                   
                                   
         
<td>Rs <?php if($total_fees == '') { echo '0'; } else { echo $total_fees;  }  ?></td>

  
        <?php if($pra[selected_package] == 'Prime Super Mass')             {  $com =  '0.15';  } ?>
        <?php if($pra[selected_package] == 'Prime Special Hall')           {  $com =  '0.18';  } ?>
        <?php if($pra[selected_package] == 'Prime Special Mass')           {  $com =  '0.21';  } ?>
        <?php if($pra[selected_package] == 'Prime Special Group Medium')   {  $com =  '0.25';  } ?>
        <?php if($pra[selected_package] == 'Prime Special Group Small')    {  $com =  '0.20';  } ?>
        <?php if($pra[selected_package] == 'Prime Home groups')            {  $com =  '0.15';  } ?>
        <?php if($pra[selected_package] == 'Prime Individual')             {  $com =  '0.10';  } ?>


<?php     
     //$total_expences = $total_fees*$com;
     //$total_expences2 = $total_fees2*$com;
        
?>      
<td>Rs <?php if($total_expences == '') { echo '0'; } else { echo $total_expences; }  ?></td>
        
                            
                                                

<?php
        $sql_new_3_x = "SELECT * FROM tutor_payouts WHERE status='Paid' AND active = 1 AND category = 'VAS' AND teacher_id = '$pra2[userID]' ORDER by id DESC";
        $result_new_3_x = mysqli_query($connect, $sql_new_3_x);
        while($pra_new_3_x = mysqli_fetch_array($result_new_3_x)) {  

           $vas += $pra_new_3_x[amount];
           $vas2 += $pra_new_3_x[amount];

        }
        
?>       

<td style="">Rs <?php if($vas == '') { echo '0'; } else { echo $vas; }  ?></td>
	                    
<?php
        $sql_new_3 = "SELECT * FROM tutor_payouts WHERE status='Paid' AND active = 1 AND category = 'Payouts' AND teacher_id = '$pra2[userID]' ORDER by id DESC";
        $result_new_3 = mysqli_query($connect, $sql_new_3);
        while($pra_new_3 = mysqli_fetch_array($result_new_3)) {  

           $tutor_payouts += $pra_new_3[amount];
           $tutor_payouts2 += $pra_new_3[amount];

        }
        
?>       
<td>Rs <?php if($tutor_payouts == '') { echo '0'; } else { echo $tutor_payouts; }  ?></td>

<td>Rs <?php echo $total_balance =  $total_fees-$total_expences-$tutor_payouts-$vas;
				  $total_balance2 =  $total_fees2-$total_expences2-$tutor_payouts2-$vas2; 			?></td>
    
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                    


                                </tr>


<?php $num++; } ?>
                               
                               <tr>
                                    <td style="background: #3d3d3d; color: white;font-weight: bold; font-size: larger;"></td>
                                    <td style="background: #3d3d3d; color: white;font-weight: bold; font-size: larger;">Total </a></td>
									<td style="background: #3d3d3d; color: white;font-weight: bold; font-size: larger;">Rs <?php echo $total_fees2; ?></td>
									<td style="background: #3d3d3d; color: white;font-weight: bold; font-size: larger;">Rs <?php echo $total_expences2; ?></td>
									<td style="background: #3d3d3d; color: white;font-weight: bold; font-size: larger;">Rs <?php echo $vas2; ?></td>
									<td style="background: #3d3d3d; color: white;font-weight: bold; font-size: larger;">Rs <?php echo $tutor_payouts2; ?></td>
									<td style="background: #3d3d3d; color: white;font-weight: bold; font-size: larger;">Rs <?php echo $total_balance2; ?></td>
                                </tr>
                                
                                
                                
                                </tbody>
                            </table>

                    </div></div>







                            </div>
    
    
    
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
    
    

                <div class="row" style="margin-top:150px">
                    <div class="col-md-12">
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
            
                                
                                
                                
                                
                                
                                
                        </div>


                            </div>



                        </div> <?php } ?>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->




     
  


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>