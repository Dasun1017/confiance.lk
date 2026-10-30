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
<html lang="en" style="background: white;">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>List of Tute Packages</title>


</head>
<body class="preload">

<style>

@page {
    size: 7in 9.25in;
    margin: 27mm 16mm 27mm 16mm;
}


    .div0 { width: 30px; float: left; margin-bottom: 0px; padding:1%; border: 1px solid black; height: 110px; } 
    .div1 { width: 220px; float: left; margin-bottom: 0px; padding:1%; border: 1px solid black; height: 110px; } 
    .div2 { width: 30px; float: left; margin-bottom: 0px; padding:1%; border: 1px solid black; height: 110px; } 
</style>














<?php if(isset($_GET[packed_date])) { ?>
<div class="row" style="font-family: arial">
                    <div class="col-md-12">
                        <div class="statement_table table-responsive" style="background: white">
                            <div>
                              

                                <div style=" float: left;width: 100%; font-size:12px;">

<?php   
        $x = 1;
        $sql_cat = "SELECT * FROM list_of_tutes_packed_or_not WHERE active = 1 AND status = '1' AND packed_date = '$_GET[packed_date]'   ORDER by id ASC";
        $result_cat = mysqli_query($connect, $sql_cat);
        while($pra_cat = mysqli_fetch_array($result_cat)) { 


        $sql_cat_tute = "SELECT * FROM list_of_tutes  WHERE id = '$pra_cat[tute_id]'  ORDER by id ASC";
        $result_cat_tute = mysqli_query($connect, $sql_cat_tute);
        $pra_cat_tute = mysqli_fetch_array($result_cat_tute);


        $sql_cat2 = "SELECT * FROM list_of_tutes_packed_or_not WHERE packed_date = '$pra_cat[packed_date]' AND  active = 1  ";
        $result_cat2 = mysqli_query($connect, $sql_cat2);
        $rowcount=mysqli_num_rows($result_cat2);

        $sql_cat_student = "SELECT * FROM tbl_users WHERE userID = '$pra_cat[student_id]'  ";
        $result_cat_student = mysqli_query($connect, $sql_cat_student);
        $pra_cat_student = mysqli_fetch_array($result_cat_student);


?>     

                                <div class="div0"> 
                                    <?php echo $x; $x++; ?>
                                </div>
                                <div class="div1" style=" font-size:17px;">
                                    <div><?php echo $pra_cat_student[userName]; ?></div> 
                                    <div><?php echo $pra_cat_student[location]; ?></div>  
                                    <div><?php echo $pra_cat_student[selected_subject]; ?></div>  
                                    <div>(<?php echo $pra_cat_tute[tute_name]; ?>)</div>
                                    
                                </div>
                                <div class="div2">
                                    <div><?php echo $pra_cat_student[userID]; ?></div> 
                                    
                                </div>
<?php } ?>


                                </div>
                            </div>

                    </div></div>
</div>

<?php } ?>



<script>window.onload = function () {  window.print();}</script>
     
  

  
</body>
</html>