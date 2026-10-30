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
if (isset($_GET['remove'])){

                $sql = "UPDATE home_page SET active='0' WHERE id='$_GET[remove]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Deleted Successfully!')</script>";
}           
?>


<?php
if (isset($_POST['save'])){
    $save = mysqli_query($connect, "INSERT INTO home_page VALUES (NULL, '$_POST[category]',  '$_POST[lesson_id]', '1' )");
    
 $msg = "
                                    <div class='alert alert-success' style='width:100%'>
                                        <button class='close' data-dismiss='alert'>&times;</button>
                                        <strong>Your changes has been Updated!</strong>  
                                    </div>";
    
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
   <title>Home Page Settings - <?php echo $site_title; ?></title>

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
                               
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            






                            











                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    </div>
                                
                                <div class="col-lg-4 col-md-12 p-top-0">
                                    
                    
                              <?php echo $msg; ?>
                        
                    
                    
                        
                    

                    

                    <form action="admin_home_page_courses.php" method="post">
                        <div class="cardify signup_form" style="background: white; border-radius: 10px; padding: 20px;">
                            <!-- end .login_header -->





<div class="section-title">
                  <h3>Manage Courses<br>in Home Page</h3>
                  <p style="    margin-top: 50px;">Please provide SESSION/TRAINING ID Select Category in Homepage</p>
                </div>





                            <div class="login--form">
                                <div class="form-group">
                                    
                                    <input type="text" class="text_field" placeholder="Lesson ID" name="lesson_id" required="">
                                </div>

                                <div class="form-group">
                                    
<select name="category">
    <option value="1">Grade 1 - 11</option>
    <option value="2">Advanced Level</option>
    <option value="3">Professional Courses</option>
    <option value="4">Paper Corner</option>
</select>

                                </div>

                              <div class="row">
											
											
											<div class="col-lg-12 mt-30">
												 <input class="btn btn--md register_btn btn-common" type="submit" name="save" value="Save Now">
											</div>
										</div>
										
										
                               
                                
                                
											
											

                                
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    </form><!-- Ends: .product-single -->


                 

                                </div>
                                
                                
                                
                                
<div class="col-lg-4 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="admin_teachers_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>TRAINERS/ TUTORS</strong></span></a>

</div>



                            </div>



















                <div class="row">
                    <h3 style=" background: #1dc9b7; border: none; color: white; margin: 0 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Grade 1 - 11</h3>

                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Date & Time</th>
                                    <th>Trainer/Tutor</th>
                                    <th>Contact</th>
                                    <th>Session/ Program</th>
                                    <th>PayHere</th>
                                    <th>Request</th>
                                    <th>Paid </th>
                                    <th>Free</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM home_page  where category = '1' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 




        $num=1;
            $sql_new = "SELECT * FROM category WHERE id = $pra_cat[lesson_id]  ORDER by lesson_date DESC";


        $result_new = mysqli_query($connect, $sql_new);
        $pra_new = mysqli_fetch_array($result_new);


        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userID = '$pra_new[teacher_id]' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);


        $sql3 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Proceed' AND active = '1' AND paid_marked_by = 'ONLINE'";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);$num_rows3 = mysqli_num_rows($result3); 
        

        $sql5 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Proceed' AND active = 1 AND paid_marked_by = '' ";
        $result5 = mysqli_query($connect, $sql5);
        $pra5 = mysqli_fetch_array($result5);$num_rows5 = mysqli_num_rows($result5);

        $sql6 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Paid' AND active = 1";
        $result6 = mysqli_query($connect, $sql6);
        $pra6 = mysqli_fetch_array($result6);$num_rows6 = mysqli_num_rows($result6);  

        $sql7 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Free' AND active = 1";
        $result7 = mysqli_query($connect, $sql7);
        $pra7 = mysqli_fetch_array($result7);$num_rows7 = mysqli_num_rows($result7);  

        $sql8 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'PostPay' AND active = 1";
        $result8 = mysqli_query($connect, $sql8);
        $pra8 = mysqli_fetch_array($result8);$num_rows8 = mysqli_num_rows($result8);  

        $sql9 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Institute' AND active = 1";
        $result9 = mysqli_query($connect, $sql9);
        $pra9 = mysqli_fetch_array($result9);$num_rows9 = mysqli_num_rows($result9);  

?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                    <?php if( $pra_new[active] == '2') {  ?>
                                    <td class="type" align="center"> <span class="proceed">PENDING</span>  </td>
                                    <?php } ?>
                                    <?php if( $pra_new[active] == '1') {  ?>
                                    <td class="type" align="center"> <span class="paid" >APPROVED</span>  </td>
                                    <?php } ?>
                                    <?php if( $pra_new[active] == '0') {  ?>
                                    <td class="type" align="center"> <span class="finished">DECLINED</span>  </td>
                                    <?php } ?>


                                    <!--<td><?php echo $num; ?></td>-->
                                    <td><?php echo $pra_new[lesson_date]; ?><br><?php echo $pra_new[lesson_time]; ?></td>
                                    <td><a href="admin_teacher_students_registry_by_subject.php?teacher=<?php echo $pra2[userID]; ?>&&lesson=<?php echo $pra_new[id]; ?>" target="_blankx"><?php echo $pra2[userName]; ?> <strong>(ID : <?php echo $pra2[userID]; ?>)</strong><br><?php echo $pra2[grade]; ?> - <?php echo $pra2[subject]; ?></a></td>
                                    <td><?php echo $pra2[userEmail]; ?><br><?php echo $pra2[mobile]; ?></td>

                                    <td style="    width: 200px; max-width:200px;"> <span style=" background: blueviolet;padding: 3px 10px;border-radius: 5px;color: white;margin-right: 10px;line-height: initial;float: left; "><?php echo $pra_new[id]; ?></span>
<?php echo $pra_new[name_of_class]; ?> <strong>(<?php echo $pra_new[description]; ?>)</strong>

                                   
                                    <?php if( $pra_new[active] == '1') {  ?><a style=" font-weight: bold; color: #094976; " href="lessons.php?view=<?php echo $pra_new[id]; ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: right; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a><?php } ?>
                                  
                                    </td>
                                    

                                    <td><?php echo $num_rows3; ?></td>
                                    <td><?php echo $num_rows5; ?></td>
                                    <td><?php echo $num_rows6; ?></td>
                                    <td><?php echo $num_rows7; ?></td>
                                    



                                </tr>


<?php $num++; } ?>
                                </tbody>
                            </table>

                    </div></div>







                            </div>



































                <div class="row">
                    <h3 style=" background: #ffb822; border: none; color: white; margin: 40px 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Advanced Level</h3>
                    
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Date & Time</th>
                                    <th>Trainer/Tutor</th>
                                    <th>Contact</th>
                                    <th>Session/ Program</th>
                                    <th>PayHere</th>
                                    <th>Request</th>
                                    <th>Paid </th>
                                    <th>Free</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM home_page  where category = '2' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 




        $num=1;
            $sql_new = "SELECT * FROM category WHERE id = $pra_cat[lesson_id]  ORDER by lesson_date DESC";


        $result_new = mysqli_query($connect, $sql_new);
        $pra_new = mysqli_fetch_array($result_new);


        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userID = '$pra_new[teacher_id]' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);


        $sql3 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Proceed' AND active = '1' AND paid_marked_by = 'ONLINE'";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);$num_rows3 = mysqli_num_rows($result3); 
        

        $sql5 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Proceed' AND active = 1 AND paid_marked_by = '' ";
        $result5 = mysqli_query($connect, $sql5);
        $pra5 = mysqli_fetch_array($result5);$num_rows5 = mysqli_num_rows($result5);

        $sql6 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Paid' AND active = 1";
        $result6 = mysqli_query($connect, $sql6);
        $pra6 = mysqli_fetch_array($result6);$num_rows6 = mysqli_num_rows($result6);  

        $sql7 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Free' AND active = 1";
        $result7 = mysqli_query($connect, $sql7);
        $pra7 = mysqli_fetch_array($result7);$num_rows7 = mysqli_num_rows($result7);  

        $sql8 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'PostPay' AND active = 1";
        $result8 = mysqli_query($connect, $sql8);
        $pra8 = mysqli_fetch_array($result8);$num_rows8 = mysqli_num_rows($result8);  

        $sql9 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Institute' AND active = 1";
        $result9 = mysqli_query($connect, $sql9);
        $pra9 = mysqli_fetch_array($result9);$num_rows9 = mysqli_num_rows($result9);  

?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                        
                                    <?php if( $pra_new[active] == '2') {  ?>
                                    <td class="type" align="center"> <span class="proceed">PENDING</span>  </td>
                                    <?php } ?>
                                    <?php if( $pra_new[active] == '1') {  ?>
                                    <td class="type" align="center"> <span class="paid" >APPROVED</span>  </td>
                                    <?php } ?>
                                    <?php if( $pra_new[active] == '0') {  ?>
                                    <td class="type" align="center"> <span class="finished">DECLINED</span>  </td>
                                    <?php } ?>


                                    <!--<td><?php echo $num; ?></td>-->
                                    <td><?php echo $pra_new[lesson_date]; ?><br><?php echo $pra_new[lesson_time]; ?></td>
                                    <td><a href="admin_teacher_students_registry_by_subject.php?teacher=<?php echo $pra2[userID]; ?>&&lesson=<?php echo $pra_new[id]; ?>" target="_blankx"><?php echo $pra2[userName]; ?> <strong>(ID : <?php echo $pra2[userID]; ?>)</strong><br><?php echo $pra2[grade]; ?> - <?php echo $pra2[subject]; ?></a></td>
                                    <td><?php echo $pra2[userEmail]; ?><br><?php echo $pra2[mobile]; ?></td>

                                    <td style="    width: 200px; max-width:200px;"> <span style=" background: blueviolet;padding: 3px 10px;border-radius: 5px;color: white;margin-right: 10px;line-height: initial;float: left; "><?php echo $pra_new[id]; ?></span>
<?php echo $pra_new[name_of_class]; ?> <strong>(<?php echo $pra_new[description]; ?>)</strong>

                                   
                                    <?php if( $pra_new[active] == '1') {  ?><a style=" font-weight: bold; color: #094976; " href="lessons.php?view=<?php echo $pra_new[id]; ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: right; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a><?php } ?>
                                  
                                    </td>
                                    

                                    <td><?php echo $num_rows3; ?></td>
                                    <td><?php echo $num_rows5; ?></td>
                                    <td><?php echo $num_rows6; ?></td>
                                    <td><?php echo $num_rows7; ?></td>
                                    



                                </tr>


<?php $num++; } ?>
                                </tbody>
                            </table>

                    </div></div>







                            </div>


































                <div class="row">
                    <h3 style=" background: #f4516c; border: none; color: white; margin: 40px 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Professional Courses</h3>
                    
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Date & Time</th>
                                    <th>Trainer/Tutor</th>
                                    <th>Contact</th>
                                    <th>Session/ Program</th>
                                    <th>PayHere</th>
                                    <th>Request</th>
                                    <th>Paid </th>
                                    <th>Free</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM home_page  where category = '3' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 




        $num=1;
            $sql_new = "SELECT * FROM category WHERE id = $pra_cat[lesson_id]  ORDER by lesson_date DESC";


        $result_new = mysqli_query($connect, $sql_new);
        $pra_new = mysqli_fetch_array($result_new);


        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userID = '$pra_new[teacher_id]' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);


        $sql3 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Proceed' AND active = '1' AND paid_marked_by = 'ONLINE'";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);$num_rows3 = mysqli_num_rows($result3); 
        

        $sql5 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Proceed' AND active = 1 AND paid_marked_by = '' ";
        $result5 = mysqli_query($connect, $sql5);
        $pra5 = mysqli_fetch_array($result5);$num_rows5 = mysqli_num_rows($result5);

        $sql6 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Paid' AND active = 1";
        $result6 = mysqli_query($connect, $sql6);
        $pra6 = mysqli_fetch_array($result6);$num_rows6 = mysqli_num_rows($result6);  

        $sql7 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Free' AND active = 1";
        $result7 = mysqli_query($connect, $sql7);
        $pra7 = mysqli_fetch_array($result7);$num_rows7 = mysqli_num_rows($result7);  

        $sql8 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'PostPay' AND active = 1";
        $result8 = mysqli_query($connect, $sql8);
        $pra8 = mysqli_fetch_array($result8);$num_rows8 = mysqli_num_rows($result8);  

        $sql9 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Institute' AND active = 1";
        $result9 = mysqli_query($connect, $sql9);
        $pra9 = mysqli_fetch_array($result9);$num_rows9 = mysqli_num_rows($result9);  
?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                        
                                    <?php if( $pra_new[active] == '2') {  ?>
                                    <td class="type" align="center"> <span class="proceed">PENDING</span>  </td>
                                    <?php } ?>
                                    <?php if( $pra_new[active] == '1') {  ?>
                                    <td class="type" align="center"> <span class="paid" >APPROVED</span>  </td>
                                    <?php } ?>
                                    <?php if( $pra_new[active] == '0') {  ?>
                                    <td class="type" align="center"> <span class="finished">DECLINED</span>  </td>
                                    <?php } ?>


                                    <!--<td><?php echo $num; ?></td>-->
                                    <td><?php echo $pra_new[lesson_date]; ?><br><?php echo $pra_new[lesson_time]; ?></td>
                                    <td><a href="admin_teacher_students_registry_by_subject.php?teacher=<?php echo $pra2[userID]; ?>&&lesson=<?php echo $pra_new[id]; ?>" target="_blankx"><?php echo $pra2[userName]; ?> <strong>(ID : <?php echo $pra2[userID]; ?>)</strong><br><?php echo $pra2[grade]; ?> - <?php echo $pra2[subject]; ?></a></td>
                                    <td><?php echo $pra2[userEmail]; ?><br><?php echo $pra2[mobile]; ?></td>

                                    <td style="    width: 200px; max-width:200px;"> <span style=" background: blueviolet;padding: 3px 10px;border-radius: 5px;color: white;margin-right: 10px;line-height: initial;float: left; "><?php echo $pra_new[id]; ?></span>
<?php echo $pra_new[name_of_class]; ?> <strong>(<?php echo $pra_new[description]; ?>)</strong>

                                   
                                    <?php if( $pra_new[active] == '1') {  ?><a style=" font-weight: bold; color: #094976; " href="lessons.php?view=<?php echo $pra_new[id]; ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: right; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a><?php } ?>
                                  
                                    </td>
                                    

                                    <td><?php echo $num_rows3; ?></td>
                                    <td><?php echo $num_rows5; ?></td>
                                    <td><?php echo $num_rows6; ?></td>
                                    <td><?php echo $num_rows7; ?></td>
                                    



                                </tr>


<?php $num++; } ?>
                                </tbody>
                            </table>

                    </div></div>







                            </div>

































                <div class="row">
                    <h3 style=" background: #f4516c; border: none; color: white; margin: 40px 0 0 20px; padding: 10px 20px; border-radius: 10px; font-weight: 100; ">Paper Corner</h3>
                    
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Date & Time</th>
                                    <th>Trainer/Tutor</th>
                                    <th>Contact</th>
                                    <th>Session/ Program</th>
                                    <th>PayHere</th>
                                    <th>Request</th>
                                    <th>Paid </th>
                                    <th>Free</th>
                                </tr>
                                </thead>

                                <tbody>

<?php   

        $sql_cat = "SELECT * FROM home_page  where category = '4' AND active = '1' ORDER by id DESC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 




        $num=1;
            $sql_new = "SELECT * FROM category WHERE id = $pra_cat[lesson_id]  ORDER by lesson_date DESC";


        $result_new = mysqli_query($connect, $sql_new);
        $pra_new = mysqli_fetch_array($result_new);


        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userID = '$pra_new[teacher_id]' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        $pra2 = mysqli_fetch_array($result2);


        $sql3 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Proceed' AND active = '1' AND paid_marked_by = 'ONLINE'";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);$num_rows3 = mysqli_num_rows($result3); 
        

        $sql5 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Proceed' AND active = 1 AND paid_marked_by = '' ";
        $result5 = mysqli_query($connect, $sql5);
        $pra5 = mysqli_fetch_array($result5);$num_rows5 = mysqli_num_rows($result5);

        $sql6 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Paid' AND active = 1";
        $result6 = mysqli_query($connect, $sql6);
        $pra6 = mysqli_fetch_array($result6);$num_rows6 = mysqli_num_rows($result6);  

        $sql7 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Free' AND active = 1";
        $result7 = mysqli_query($connect, $sql7);
        $pra7 = mysqli_fetch_array($result7);$num_rows7 = mysqli_num_rows($result7);  

        $sql8 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'PostPay' AND active = 1";
        $result8 = mysqli_query($connect, $sql8);
        $pra8 = mysqli_fetch_array($result8);$num_rows8 = mysqli_num_rows($result8);

        $sql9 = "SELECT * FROM products WHERE lesson_id = '$pra_new[id]' AND teacher_id=$pra2[userID] AND status = 'Institute' AND active = 1";
        $result9 = mysqli_query($connect, $sql9);
        $pra9 = mysqli_fetch_array($result9);$num_rows9 = mysqli_num_rows($result9);    

?>     

                                <tr>
                                    
                                    <td><a href="?remove=<?php echo $pra_cat[id]; ?>" onclick="return confirm('Are you sure?')">&#10060;</a></td>    
                                        
                                    <?php if( $pra_new[active] == '2') {  ?>
                                    <td class="type" align="center"> <span class="proceed">PENDING</span>  </td>
                                    <?php } ?>
                                    <?php if( $pra_new[active] == '1') {  ?>
                                    <td class="type" align="center"> <span class="paid" >APPROVED</span>  </td>
                                    <?php } ?>
                                    <?php if( $pra_new[active] == '0') {  ?>
                                    <td class="type" align="center"> <span class="finished">DECLINED</span>  </td>
                                    <?php } ?>


                                    <!--<td><?php echo $num; ?></td>-->
                                    <td><?php echo $pra_new[lesson_date]; ?><br><?php echo $pra_new[lesson_time]; ?></td>
                                    <td><a href="admin_teacher_students_registry_by_subject.php?teacher=<?php echo $pra2[userID]; ?>&&lesson=<?php echo $pra_new[id]; ?>" target="_blankx"><?php echo $pra2[userName]; ?> <strong>(ID : <?php echo $pra2[userID]; ?>)</strong><br><?php echo $pra2[grade]; ?> - <?php echo $pra2[subject]; ?></a></td>
                                    <td><?php echo $pra2[userEmail]; ?><br><?php echo $pra2[mobile]; ?></td>

                                    <td style="    width: 200px; max-width:200px;"> <span style=" background: blueviolet;padding: 3px 10px;border-radius: 5px;color: white;margin-right: 10px;line-height: initial;float: left; "><?php echo $pra_new[id]; ?></span>
<?php echo $pra_new[name_of_class]; ?> <strong>(<?php echo $pra_new[description]; ?>)</strong>

                                   
                                    <?php if( $pra_new[active] == '1') {  ?><a style=" font-weight: bold; color: #094976; " href="lessons.php?view=<?php echo $pra_new[id]; ?>" target="_blankx"><span class="paid" style=" line-height: 24px; float: right; border-radius: 3px; display: inline-block; padding: 0 15px; color: #fff; font-weight: 400; font-size: 12px; background: #094976; ">VIEW</span></a><?php } ?>
                                  
                                    </td>
                                    

                                    <td><?php echo $num_rows3; ?></td>
                                    <td><?php echo $num_rows5; ?></td>
                                    <td><?php echo $num_rows6; ?></td>
                                    <td><?php echo $num_rows7; ?></td>
                                    



                                </tr>


<?php $num++; } ?>
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