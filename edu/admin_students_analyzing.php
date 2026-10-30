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

<?php   if(isset($_GET[batch_only])) {
            $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]' AND batch = '$_GET[batch]' AND active = '1'";
        } else  { 
            $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]' AND active = '1'";
        } 
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>
<?php
        $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]' AND active = '1'";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>

<?php
          if(isset($_POST[send_sms])) {  

          //textit        
                    $to = $_POST[student_mobile];
                    //$date_time = date("Y/m/d - h:i:sa");
                    $text = urlencode("$_POST[sms_body]");
                    $output4 = preg_replace('!\s+!', ' ', $text);
                    $baseurl ="https://www.textit.biz/sendmsg";
                    $url = "$baseurl/?id=$site_textit_username&pw=$site_textit_password&to=$to&text=$output4&eco=Y";
                    //$ret = file($url);     $res= explode(":",$ret[0]);         
//echo "<iframe style='height:1px; width:1px;display: none;' src='$url'></iframe>";                                               
                 
          //textit 
                  }
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

$no_of_records_per_page = 100;
$offset = ($pageno-1) * $no_of_records_per_page;

//////
if(isset($_GET[batch_only])) {
            $total_pages_sql = "SELECT * FROM tbl_users WHERE type = '3' AND batch = '$_GET[batch]' ORDER by userID DESC";
        } else  { 
            $total_pages_sql = "SELECT * FROM tbl_users WHERE type = '3' ORDER by userID DESC";
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
                               
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 98%; padding: 0px; max-width: 98%; ">
                            






                            




                            <div class="row">
                                   


<div class="col-lg-4 col-md-12 p-bottom-0" >

  <p style=" background: red; color: white; font-size: x-large; padding: 10px; text-align: left; border-radius: 5px; display: none ">
    SMS Balance : 
        <?php
          $user = $site_textit_username;
          $password = $site_textit_password;

          $text = urlencode($_REQUEST['text']);
          $baseurl ="https://www.textit.biz/creditchk";
              
                $url = "$baseurl/?id=$user&pw=$password";
                $ret = file($url);
                echo $ret[0]*2;
        ?>
  </p>
</div>

<div class="col-lg-8 col-md-12 p-bottom-0" ></div>

                                        
<div class="col-lg-6 col-md-12 p-bottom-0">
    <br><br>
    <div class="login--header" style=" border-bottom: none; "> <h3 style=" font-size: initial; black: white; text-align: left; ">List of Students (<?php echo $num_rows; ?>)<h3p> </div>
</div>

<div class="col-lg-2 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="admin_teachers_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>TRAINERS/ TUTORS</strong></span></a>

</div>


<div class="col-lg-2 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="address_print.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >ADDRESS <strong>PRINT</strong></span></a>

</div>

<div class="col-lg-2 col-md-12 p-top-20 " style=" color: white; text-align: right;">
                            <a href="subject_print.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >INSTITUTE <strong>PRINT</strong></span></a>

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







<?php if(isset($_GET[batch])) { ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-bar clearfix filter-bar2" style="margin-bottom: 0px">


<?php if(isset($_GET[search])) {  ?>
                            <div class="filter__items dashboard_purchase">
                                <div class="filter__option filter--search">
                                    <a href="admin_students_analyzing.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; ">GO TO <strong>LIST OF STUDENTS</strong></a>
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


                            <div class="filter__items dashboard_purchase" style="display: none">
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
                                <tr style="height: 250px;">
                                    <th></th>
                                    <th>Student Name</th>

<?php 
        $sql_X = "SELECT additional_information, active, name_of_class FROM category WHERE additional_information='$_GET[batch]' AND active = 1";
        $result_X = mysqli_query($connect, $sql_X);
        while ($pra_X = mysqli_fetch_array($result_X)) { 
                echo "<th style=' /* transform: rotate(-90deg); */ padding: 10px 0 30px 0px; width: 100px; '>$pra_X[name_of_class]</th>";
        }
?>
                                </tr>
                                </thead>

                                <tbody>

<?php   $num=1;


if(isset($_GET[batch_only])) {  

        if(isset($_GET[search])) { 
        $sql2 = "SELECT * FROM tbl_users WHERE type = '3' AND userID = '$_GET[search]' AND batch = '$_GET[batch]' ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; } else { 
        $sql2 = "SELECT * FROM tbl_users WHERE type = '3' AND batch = '$_GET[batch]' ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; }


        } else  { 
            


        if(isset($_GET[search])) { 
        $sql2 = "SELECT * FROM tbl_users WHERE type = '3' AND userID = '$_GET[search]' ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; } else { 
        $sql2 = "SELECT * FROM tbl_users WHERE type = '3'  ORDER by userID DESC LIMIT $offset, $no_of_records_per_page "; }


        }


        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  


                  

?>     


                                <tr>
                                    <td><?php echo $num; ?></td>
                                    <td><?php echo $pra2[userID]; ?><br><a href="admin_students_active.php?student=<?php echo $pra2[userID]; ?>" target="_blankx"><?php echo $pra2[userName]; ?><br> <?php echo $pra2[batch]; ?> - <?php echo $pra2[school]; ?> 
                                  </a>
                                  <br>
                                  <?php echo $pra2[userEmail]; ?><br><?php echo $pra2[mobile]; ?>

                                    </td> 

<?php 
        $sql_X = "SELECT id, additional_information, active, name_of_class FROM category WHERE additional_information='$_GET[batch]'  AND active = 1";
        $result_X = mysqli_query($connect, $sql_X);
        while ($pra_X = mysqli_fetch_array($result_X)) {

            echo '<td class="type" style=" /*transform: rotate(-90deg);*/ padding: 10px 0 30px 0px; ">';
 
            $sql2_Y = "SELECT * FROM products WHERE student_id = '$pra2[userID]' AND active = 1 AND lesson_id = '$pra_X[id]' ORDER by id DESC ";
            $result2_Y = mysqli_query($connect, $sql2_Y);
            $pra2_Y = mysqli_fetch_array($result2_Y);          

                                        if($pra2_Y[status] == 'Proceed') { 
                                                    echo '<span class="proceed">Requested</span>';  
                                        }
                                        if($pra2_Y[status] == 'Paid') { 
                                                    echo '<span class="paid">Paid</span>';  
                                        }
                                        if($pra2_Y[status] == 'Free') { 
                                                    echo '<span class="finished">Free</span>';  
                                        }
                                        if($pra2_Y[status] == 'PostPay') { 
                                                    echo '<span class="postpay">PostPay</span>';  
                                        }
                                        if($pra2_Y[status] == 'Institute') { 
                                                    echo '<span class="postpay">Institute</span>';  
                                        }

            echo '</td>';

            }
?>


                                </tr>


<?php $num++; } ?>















                                </tbody>
                            </table>






                    </div></div>







                            </div>





<?php } ?>



                        </div>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->




     
  


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>