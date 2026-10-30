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
        if (isset($_POST['packed_submit']) || isset($_POST['save_now'])) {

                $time = time();
                $date = date('Y-m-d h:i:sa');


                $sql_pack = "SELECT * FROM list_of_tutes_packed_or_not WHERE active = '1' AND student_id = '$_POST[student_id]' AND tute_id = '$_POST[tute_id]' ";
                $result_pack = mysqli_query($connect, $sql_pack);
                $rowcount_pack=mysqli_num_rows($result_pack); 
                $pra_pack = mysqli_fetch_array($result_pack);

                if($rowcount_pack == '' || $rowcount_pack == '0') { 

                                    $save = mysqli_query($connect, "INSERT INTO list_of_tutes_packed_or_not VALUES (NULL, '$_POST[tute_id]', '$_POST[student_id]', '$_POST[packed_submit]', '$date','$time', '1', '$_POST[packed_date]', '', '' )"); 
                                
                } else {
                                    $sql2 = "UPDATE list_of_tutes_packed_or_not SET status='$_POST[packed_submit]', packed_date = '$_POST[packed_date]' WHERE student_id='$_POST[student_id]' AND tute_id = '$_POST[tute_id]' AND active = '1'  ";
                                    mysqli_query($connect, $sql2); 
                                
                         } 

        } 
?>




<?php   if(isset($_GET[batch_only])) {
            $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]' AND batch = '$_GET[batch]' AND active = '1'";
        } else  { 
            $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]' AND active = '1'";
        } 
        //$result = mysqli_query($connect, $sql);
        //$pra = mysqli_fetch_array($result);

?>
<?php
        $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]' AND active = '1'";
        //$result = mysqli_query($connect, $sql);
        //$pra = mysqli_fetch_array($result);

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
if (isset($_POST['save_order'])) {
    
    // if (!empty($_POST['track_order_number'])) {
    //     $sql = "INSERT INTO tbl_users VALUES ('$_POST(real_email)')";
    //     $stmt = mysqli_prepare($connect, $sql);

    //     if ($stmt) {
           
    //         mysqli_stmt_bind_param($stmt, 's', $_POST['track_order_number']);

    //         if (mysqli_stmt_execute($stmt)) {
    //             echo "<script>alert('Saved Track Order Number!');</script>";
    //         } else {
    //             echo "<script>a}ert('Error saving Track Order Number.');</script>";
    //         }
    //         mysqli_stmt_close($stmt);
    //     } 
    // } else {
    //     echo "<script>alert('Please enter a Track Order Number.');</script>";
    // }

    
    $sql1 = "UPDATE tbl_users SET real_email='$_POST[track_order_number]' WHERE userID='$_POST[student_id]'";
    mysqli_query($connect, $sql1);
    echo "<script>alert('Student Status Changed Successfully!')</script>";
    
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
if (isset($_POST['change_student_emboss'])){

                $sql = "UPDATE tbl_users SET student_emboss='$_POST[change_student_emboss]', student_rfid='$_POST[change_student_rfid]' WHERE userID='$_POST[student_id]'";
                mysqli_query($connect, $sql);
}           
?>

<?php 
if (isset($_POST['save_note'])){

                $sql = "UPDATE tbl_users SET selected_ol_al_grade='$_POST[selected_ol_al_grade]' WHERE userID='$_POST[student_id]'";
                mysqli_query($connect, $sql);
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

$no_of_records_per_page = 50;
$offset = ($pageno-1) * $no_of_records_per_page;

//////
if(isset($_GET[batch_only])) {
            $total_pages_sql = "SELECT type, batch FROM tbl_users WHERE type = '3' AND batch = '$_GET[batch]' ";
        } else  { 
            $total_pages_sql = "SELECT type FROM tbl_users WHERE type = '3' ";
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
    


    

<style>
    .table thead>tr>th { color: #313342; font-size: 16px; font-weight: 500; padding: 10px; } 
</style>
    



    
    
    <section class="hero-area4 bgimage">
        <!---->
        <div class="hero-content content_above" style="padding: 100px 0 50px 0;">
                            <div class="content-wrapper">
                               
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            


                            <div class="row">
                                   




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
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>SMS Now</th>
                                    <th style="display: none">Institute ID</th>
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

//if(isset($_GET[search])) { 
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
                                    <td><?php echo $pra2[userID]; ?></td>
                                    <td><a href="admin_students_active.php?student=<?php echo $pra2[userID]; ?>" target="_blankx"><?php echo $pra2[userName]; ?> <?php echo $pra2[userName2]; ?><br>  <?php echo $pra2[location]; ?>, <?php echo $pra2[std_city]; ?> <?php if($pra2[selected_package] != '') { echo '<br>'; echo $pra2[selected_package];  } ?><br><?php echo $pra2[userEmail]; ?><br><?php echo $pra2[mobile]; ?><br><?php echo $pra2[telegram]; ?><br>
                                   
                                    <br><span style="color: red"><?php echo $pra2[institute_name]; ?></span></a>
                                    <br><span style="color: black"><?php echo $pra2[school]; ?></span>
                                    <br><span style="color: black"><?php echo $pra2[batch]; ?></span>
                                    
                                 
                                    <!-- <form action="" method="post">
                                    <input type="hidden" name="student_id" value="<?php echo $pra2[userID]; ?>">
                                    <input type="text" name="track_order_number" placeholder="Enter Track Order No" value="<?php echo $pra2[real_email]; ?>"><br>
                                    <input class="btn btn--md register_btn btn-common" type="submit" name="save_order" value="save" style=" clear: both; display: block; " > 
                                    
                                           
                                            </form>
                                                                                 -->

                                    <form action="" method="post" onsubmit="return confirm('Are you sure you want to Change this Password?');">

                                           
                                            <input type="hidden" name="student_id" value="<?php echo $pra2[userID]; ?>">
                                            <input type="text" name="change_student_password" value="" required="" placeholder="Password Change?">
                                    </form>

                                    <form action="" method="post"  style=" margin-top: 80px; ">

                                            <input type="hidden" name="student_id" value="<?php echo $pra2[userID]; ?>">

                                            <input type="text" name="change_student_emboss" value="<?php echo $pra2[student_emboss]; ?>" required="" placeholder="Emboss Number?" style=" max-width: 300px; margin-top: 10px; ">
                                            
                                            <input type="text" name="change_student_rfid" value="<?php echo $pra2[student_rfid]; ?>" required="" placeholder="Card?" style="max-width: 300px;">

                                            <input class="btn btn--md register_btn btn-common" type="submit" name="assign_card" value="Assign Card" style=" clear: both; display: block; " > 
                                    </form>

                                    </td> 
                                    <td></td>
                                    <td class="action">
                                        <form action="" method="post" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="student_mobile" value="<?php echo $pra2[userEmail]; ?>">
                                            <input type="hidden" name="student_id" value="<?php echo $pra2[userID]; ?>">
                                            <input type="text" name="sms_body" value="" required="" placeholder="Type Here">

                                            <input class="btn btn--md register_btn btn-common" type="submit" name="send_sms" value="Send Now" style="float: left;margin-top: 0px;" > 

                                        </form>




                                          <form action="" method="post" style="margin-top: 50px">
                                            <input type="hidden" name="student_mobile" value="<?php echo $pra2[userEmail]; ?>">
                                            <input type="hidden" name="student_id" value="<?php echo $pra2[userID]; ?>">
                                            <textarea name="selected_ol_al_grade" ><?php echo $pra2[selected_ol_al_grade]; ?></textarea>

                                            <input class="btn btn--md register_btn btn-common" type="submit" name="save_note" value="Save Note" style="float: left;margin-top: 0px;" > 

                                        </form>



                                    </td>
                                    
                                    <td class="action" style="display: none">
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
                                    

                                    <td class="action" style="width:300px">
                                        <form action="" method="post" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="student_id" value="<?php echo $pra2[userID]; ?>">
                                            <select name="change_student_status" required=""  onchange="this.form.submit()" style=" 
                                            
                                            background: #<?php if($pra2[userStatus] == 'Y') { echo '1dc9b7'; } if($pra2[userStatus] == 'N') { echo 'f4516c'; }  ?>; 

                                            color: white; height: 30px; width: fit-content; font-weight: bold; ">
                                                
                                                <?php if($pra2[userStatus] == 'Y') { ?><option value="Y">Activated</option><option value="N">De-Activate</option><option value="D">Delete</option><?php } ?>
                                                
                                                <?php if($pra2[userStatus] == 'N') { ?><option value="N">De-Activated</option><option value="Y">Activate</option><option value="D">Delete</option><?php } ?>
                                            </select>
                                        </form>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <br>
                                        
                                        
                                        
<?php   if(isset($_GET[search])) {
        $sql_cat = "SELECT * FROM list_of_tutes  where active = '1' ORDER by id ASC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 
?>     

        <div>   
            <p style=" background: #eaeaea; margin-bottom: 5px; text-align: center; border-radius: 5px;  "><?php echo $pra_cat[tute_name]; ?></pd>
            <form action="" method="post">

<?php 
        $sql_pack = "SELECT * FROM list_of_tutes_packed_or_not WHERE active = '1' AND student_id = '$pra2[userID]' AND tute_id = '$pra_cat[id]' ";
        $result_pack = mysqli_query($connect, $sql_pack);
        $rowcount_pack=mysqli_num_rows($result_pack); 
        $pra_pack = mysqli_fetch_array($result_pack);
?>
<?php if($rowcount_pack == '' || $rowcount_pack == '0') { ?>

                 <select name="packed_submit" required="" onchange="this.form.submit()" style="background: black;width: 130px;height: 30px;line-height: 14px;border: 0px;border-radius: 3px;padding: 3px 15px;color: #fff;font-size: 12px;float: left;">
                            <option value="0">Not Packed</option><option value="1">Packed</option>
                 </select>
<?php } else { ?>

                 <select name="packed_submit" required="" onchange="this.form.submit()" style=" background: black;width: 130px;height: 30px;line-height: 14px;border: 0px;border-radius: 3px;padding: 3px 15px;color: #fff;font-size: 12px;float: left;">

                <?php if($pra_pack[status] == '1' ) { ?>
                                                              <option value="1">Packed</option><option value="0">Not Packed</option>
                <?php } else { ?>
                                                              <option value="0">Not Packed</option><option value="1">Packed</option>
                <?php } ?>                                             
                 </select>
<?php } ?>



                 <input value="<?php if($pra_pack[packed_date] != '') { echo $pra_pack[packed_date]; } else { echo $date_time = date("Y-m-d"); } ?>" name="packed_date" type="date" style=" width: 130px; height: 30px; line-height: 14px; border-radius: 3px; padding: 3px 15px; font-size: 12px; float: left; ">
                 <p style=" width: 130px; height: 30px; line-height: 14px; border-radius: 3px; padding: 3px 15px; font-size: 12px; float: left; ">
                     <?php echo $pra_pack[posted_date];  ?>
                 </p>
                 
                 
                 <input value="<?php echo $pra2[userID]; ?>" name="student_id" type="hidden">
                 <input value="Save" name="save_now" type="submit" style="background: red; width: 60px; height: 20px; line-height: 14px; border: 0px; border-radius: 3px; padding: 3px 15px; color: #fff; font-size: 12px; float: left;">
                 <input value="<?php echo $pra_cat[id]; ?>" name="tute_id" type="hidden">
            </form>
            <br><br>
                                   
        </div>
<?php } } ?>













                                    </td>


                                </tr>


<?php $num++; } ?>

<?php //} ?>















                                </tbody>
                            </table>






                    </div></div>







                            </div>

<?php //} ?>








                        </div>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->




     
  


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>