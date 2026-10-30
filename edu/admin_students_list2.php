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
        $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]' AND active = '1'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>

<?php 
if (isset($_POST['change_student_status'])){
    
    
    if($_POST['change_student_status'] == 'D') { 
    
                $sql = "DELETE from tbl_users  WHERE userID='$_POST[student_id]'";
                mysqli_query($connect, $sql);
                
                
                $sql2 = "UPDATE products SET active='0' WHERE student_id='$_POST[student_id]'";
                mysqli_query($connect, $sql2);
                
                echo "<script>alert('Student Deleted Successfully!')</script>";
                
    }
    if($_POST['change_student_status'] != 'D') { 
    
                $sql = "UPDATE tbl_users SET userStatus='$_POST[change_student_status]' WHERE userID='$_POST[student_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Student Status Changed Successfully!')</script>";
                
    }
}           
?>

<?php 
if (isset($_POST['change_student_password'])){

                $password = md5($_POST['change_student_password']);
                $sql = "UPDATE tbl_users SET userPass='$password' WHERE userID='$_POST[student_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Student Password Changed Successfully!')</script>";
}           
?>


<?php 
if (isset($_POST['institute_id_verified'])){

                $sql = "UPDATE tbl_users SET institute_id='$_POST[institute_id]', institute_id_verified ='$_POST[institute_id_verified]' WHERE userID='$_POST[student_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Student ID Updated Successfully!')</script>";
}           
?>

<?php 

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

//////

$no_of_records_per_page = 1000;
$offset = ($pageno-1) * $no_of_records_per_page;

//////

$total_pages_sql = "SELECT * FROM tbl_users WHERE type = '3'         GROUP BY institute_id HAVING COUNT(institute_id) > 1           ORDER by userID DESC";
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
                            






                            




                            <div class="row">
<div class="col-lg-9 col-md-12 p-bottom-0">
    <br><br>
    <div class="login--header" style=" border-bottom: none; "> <h3 style=" font-size: initial; black: white; text-align: left; ">List of Students (<?php echo $num_rows; ?>)<h3p> </div>
</div>

<div class="col-lg-3 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="admin_teachers_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>TRAINERS/ TUTORS</strong></span></a>

</div>
                            </div>








  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }

      .form-control, input {border: 1px solid #262626; } 

      #display ul li { padding: 2px 10px; border: 1px solid #e8e8e8; border-radius: 5px; margin: 2px 0; } 
  </style>    
     
                        
                      
                    









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
                                                    <a class="page-link" href="?pageno=1" aria-label="Previous">
                                                        <span aria-hidden="true"><i class="fa fa-long-arrow-left"></i></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                </li>

                                                


                                                <li class="page-item <?php if($pageno <= 5){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 5){ echo '#'; } else {  $id_5 =  $pageno - 5; echo "?pageno=".($pageno - 5); } ?>"><?php echo $id_5; ?></a></li>
                                                <li class="page-item <?php if($pageno <= 4){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 4){ echo '#'; } else {  $id_4 =  $pageno - 4; echo "?pageno=".($pageno - 4); } ?>"><?php echo $id_4; ?></a></li>
                                                <li class="page-item <?php if($pageno <= 3){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 3){ echo '#'; } else {  $id_3 =  $pageno - 3; echo "?pageno=".($pageno - 3); } ?>"><?php echo $id_3; ?></a></li>
                                                <li class="page-item <?php if($pageno <= 2){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 2){ echo '#'; } else {  $id_2 =  $pageno - 2; echo "?pageno=".($pageno - 2); } ?>"><?php echo $id_2; ?></a></li>
                                                <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else {  $id_1 =  $pageno - 1; echo "?pageno=".($pageno - 1); } ?>"><?php echo $id_1; ?></a></li>



                                                <li class="page-item <?php if($pageno == $pageno){ echo 'active'; } ?>"><a class="page-link" href="<?php if($pageno > $total_pages_pag ){ echo '#'; } else {  $id0 =  $pageno + 0; echo "?pageno=".($pageno + 0); } ?>"><?php echo $id0; ?></a></li>


                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+0 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id1 =  $pageno + 1; echo "?pageno=".($pageno + 1); } ?>"><?php echo $id1; ?></a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+1 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id2 =  $pageno + 2; echo "?pageno=".($pageno + 2); } ?>"><?php echo $id2; ?></a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+2 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id3 =  $pageno + 3; echo "?pageno=".($pageno + 3); } ?>"><?php echo $id3; ?></a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+3 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id4 =  $pageno + 4; echo "?pageno=".($pageno + 4); } ?>"><?php echo $id4; ?></a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+4 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id5 =  $pageno + 5; echo "?pageno=".($pageno + 5); } ?>"><?php echo $id5; ?></a></li>
                                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                                <li class="page-item <?php if($pageno >= $total_pages_pag OR $pageno+9 >= $total_pages_pag){ echo 'disabled'; } ?>"><a class="page-link" href="<?php if($pageno >= $total_pages_pag){ echo '#'; } else {  $id10 =  $pageno + 10; echo "?pageno=".($pageno + 10); } ?>"><?php echo $id10; ?></a></li>


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












                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">


                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Contact</th>
                                    <th>Password</th>
                                    <th>Institute ID</th>
                                    <th>Lessons</th>
                                    <th>Requested</th>
                                    <th>Paid</th>
                                    <th>Free</th>
                                    <!--<th>PostPay</th>-->
                                    <td></td>
                                </tr>
                                </thead>

                                <tbody>

<?php   $num=1;

        if(isset($_GET[search])) { 
        $sql2 = "SELECT * FROM tbl_users WHERE type = '3' AND userID = '$_GET[search]'        GROUP BY institute_id HAVING COUNT(institute_id) > 1           ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; } else { 
        $sql2 = "SELECT * FROM tbl_users WHERE type = '3'        GROUP BY institute_id HAVING COUNT(institute_id) > 1           ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; }

        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  

        $sql4 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND active = 1";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);$num_rows4 = mysqli_num_rows($result4); 

        $sql5 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND status = 'Proceed' AND active = 1";
        $result5 = mysqli_query($connect, $sql5);
        $pra5 = mysqli_fetch_array($result5);$num_rows5 = mysqli_num_rows($result5);

        $sql6 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND status = 'Paid' AND active = 1";
        $result6 = mysqli_query($connect, $sql6);
        $pra6 = mysqli_fetch_array($result6);$num_rows6 = mysqli_num_rows($result6);  

        $sql7 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND status = 'Free' AND active = 1";
        $result7 = mysqli_query($connect, $sql7);
        $pra7 = mysqli_fetch_array($result7);$num_rows7 = mysqli_num_rows($result7);  

        $sql8 = "SELECT * FROM products WHERE student_id=$pra2[userID] AND status = 'PostPay' AND active = 1";
        $result8 = mysqli_query($connect, $sql8);
        $pra8 = mysqli_fetch_array($result8);$num_rows8 = mysqli_num_rows($result8);  

?>     

                                <tr>
                                    <td><?php echo $num; ?></td>
                                    <td><?php echo $pra2[userID]; ?></td>
                                    <td><a href="admin_students_active.php?student=<?php echo $pra2[userID]; ?>" target="_blankx"><?php echo $pra2[userName]; ?><br><?php echo $pra2[grade]; ?> - <?php echo $pra2[school]; ?></a></td>
                                    <td><?php echo $pra2[userEmail]; ?><br><?php echo $pra2[mobile]; ?></td>
                                    <td class="action">
                                        <form action="" method="post" onsubmit="return confirm('Are you sure you want to Change this Password?');">
                                            <input type="hidden" name="student_id" value="<?php echo $pra2[userID]; ?>">
                                            <input type="text" name="change_student_password" value="" required="">
                                        </form>
                                    </td>
                                    
                                    <td class="action">
                                        <form action="" method="post" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="student_id" value="<?php echo $pra2[userID]; ?>">
                                            <input type="text" name="institute_id" value="<?php echo $pra2[institute_id]; ?>" style="width: 100px;" >
                                            
                                            <select name="institute_id_verified" required=""  onchange="this.form.submit()" style=" 
                                            
                                            background: #<?php if($pra2[institute_id_verified] == 'Y') { echo '1dc9b7'; } if($pra2[institute_id_verified] == 'N') { echo 'f4516c'; }  ?>; 

                                            color: white; height: 30px; width: fit-content; font-weight: bold; ">
                                                
                                                <?php if($pra2[institute_id_verified] == 'Y') { ?><option value="Y">Class Student</option><option value="N">Not Class Student</option><?php } ?>
                                                
                                                <?php if($pra2[institute_id_verified] == 'N') { ?><option value="N">Not Class Student</option><option value="Y">Class Student</option><?php } ?>
                                            </select>
                                        </form>
                                    </td>


                                    <td><strong style="font-weight: bold;"><?php echo $num_rows4; ?></strong></td>
                                    <td><?php echo $num_rows5; ?></td>
                                    <td><?php echo $num_rows6; ?></td>
                                    <td><?php echo $num_rows7; ?></td>
                                    <!--<td><?php echo $num_rows8; ?></td>-->
                                    

                                    <td class="action">
                                        <form action="" method="post" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="student_id" value="<?php echo $pra2[userID]; ?>">
                                            <select name="change_student_status" required=""  onchange="this.form.submit()" style=" 
                                            
                                            background: #<?php if($pra2[userStatus] == 'Y') { echo '1dc9b7'; } if($pra2[userStatus] == 'N') { echo 'f4516c'; }  ?>; 

                                            color: white; height: 30px; width: fit-content; font-weight: bold; ">
                                                
                                                <?php if($pra2[userStatus] == 'Y') { ?><option value="Y">Activated</option><option value="N">De-Activate</option><option value="D">Delete</option><?php } ?>
                                                
                                                <?php if($pra2[userStatus] == 'N') { ?><option value="N">De-Activated</option><option value="Y">Activate</option><option value="D">Delete</option><?php } ?>
                                            </select>
                                        </form>
                                    </td>


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