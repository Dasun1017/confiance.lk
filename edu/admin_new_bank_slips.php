<?php 
    include 'functions/main.functions.php';   
    require_once 'class.user.php';
    $user_home = new USER(); 
?>

<?php

if(!$user_home->is_logged_in())
{
     $user_home->redirect('/index.php');
}


if($user_home->is_logged_in()!="")
{
    if($_SESSION['type'] == '2' OR $_SESSION['type'] == '3' ) { $user_login->redirect('index.php'); }
}

?>

<?php
        $sql = "SELECT userName, subject, grade, userID FROM tbl_users WHERE userID=$_GET[teacher]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>

<?php 
if (isset($_POST['change_orders_status_X'])){

                $sql = "UPDATE products SET status='$_POST[change_orders_status]' WHERE id='$_POST[order_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Lesson Status Changed Successfully!')</script>";
}
?>


<?php 
if (isset($_POST['change_token'])){

                $sql = "UPDATE products SET system_token='$_POST[change_token]' WHERE id='$_POST[product_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('VOD Changed Successfully!')</script>";
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
    <title>Teachers Registry - <?php echo $site_title; ?></title>

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
                            





<?php if(!isset($_GET[status])) { ?><!--start-->


<form action="" method="get" style=" float: right;border: 0px; clear: both;    margin: 0 10px;">
                                            <select name="teacher_id" required="" onchange="this.form.submit()" style="     margin: 0 10px;background: black;color: white;height: 40px;display: block;line-height: 24px;border: 0px;border-radius: 3px;display: inline-block;padding: 5px 15px;color: #fff;font-weight: 400;font-size: larger;">
<?php if(isset($_GET[teacher_id])) { ?>
                                              <option value="">Change Teacher</option>
<?php } else { ?>
                                              <option value="">Select Group</option>
<?php } ?>
<?php 
        $sql2 = "SELECT * FROM tbl_users WHERE type = '2' AND userStatus = 'Y' ORDER by userID DESC";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {  
?>
    <option value="<?php echo $pra2[userID]; ?>" <?php if(isset($_GET[teacher_id])) { if($_GET[teacher_id] == $pra2[userID]) { echo ' selected ';}  } ?> ><?php echo $pra2[userName]; ?></option>
<?php } ?>

                                            </select>
                                            <input name="student" value="<?php echo $_GET[student];?>" type="hidden">
</form>






<?php if(isset($_GET[teacher_id])) { ?>

<form action="" method="get" style=" float: right;border: 0px; clear: both;    margin: 0 10px;">
                                            <select name="category_id" required="" onchange="this.form.submit()" style="     margin: 0 10px;background: #595858;color: white;height: 40px;display: block;line-height: 24px;border: 0px;border-radius: 3px;display: inline-block;padding: 5px 15px;color: #fff;font-weight: 400;font-size: larger;">

                                              <option value="">Select Class</option>

<?php 
         $sql2x = "SELECT * FROM category WHERE teacher_id=$_GET[teacher_id] AND active = 1  ORDER by lesson_date ASC";
        $result2x = mysqli_query($connect, $sql2x);
        while($pra2x = mysqli_fetch_array($result2x)) { 

?>   
    <option value="<?php echo $pra2x[id]; ?>" <?php if(isset($_GET[category_id])) { if($_GET[category_id] == $pra2x[id]) { echo ' selected ';}  } ?>  ><?php echo $pra2x[name_of_class]; ?></option>
<?php } ?>

                                            </select>
                                            <input name="student" value="<?php echo $_GET[student];?>" type="hidden">
                                            <input name="teacher_id" value="<?php echo $_GET[teacher_id];?>" type="hidden">
</form>
<?php } ?>





<?php if(isset($_GET[category_id])) { ?>

<form action="" method="get" style=" float: right;border: 0px; clear: both;    margin: 0 10px;">
                                           
                                            <input name="search_now" type="submit" value="Search Now">
                                            <input name="student" value="<?php echo $_GET[student];?>" type="hidden">
                                            <input name="teacher_id" value="<?php echo $_GET[teacher_id];?>" type="hidden">
                                            <input name="category_id" value="<?php echo $_GET[category_id];?>" type="hidden">
                                        </form>


<?php } ?>
          

<?php } ?><!--finish-->



    <form method="get">
        <table border="0" cellpadding="4" cellspacing="0" style="width: 100%;font-size: 15px;padding: 10px;border-radius: 5px;">
            <tbody>
                <tr>
                    <td align="center">
                        <table border="0" width="">
                            <tbody>
                                <tr>
                                    <td style="font-weight: 800;" width="80">From Date</td>
                                    <td width="308">
                                    
                                    D: <input name="fd" size="2" style="border: 1px solid #ccc; padding: 2px 6px; width: 40px; font-size: 15px; text-align: center;" type="text" value="<?php if(isset($_GET[fd])) {  echo $_GET[fd];  } else { echo date('d',strtotime("-1 days")); } ?>"> / 
                                    M: <input name="fm" size="2" style="border: 1px solid #ccc; padding: 2px 6px; width: 40px; font-size: 15px; text-align: center;" type="text" value="<?php if(isset($_GET[fm])) {  echo $_GET[fm];  } else { echo date("m"); } ?>"> / 
                                    Y:<input name="fy" size="4" style="border: 1px solid #ccc; padding: 2px 6px; width: 69px; font-size: 15px; text-align: center; margin-left: 10px;" type="text" value="<?php if(isset($_GET[fy])) {  echo $_GET[fy];  } else { echo date("Y"); } ?>"></td>
                                    
                                    <td style=" font-weight: 800;" width="60">To Date</td>
                                    <td width="297">
                                    
                                    D: <input name="td" size="2" style="border: 1px solid #ccc; padding: 2px 6px; width: 40px; font-size: 15px; text-align: center;" type="text" value="<?php if(isset($_GET[td])) {  echo $_GET[td];  } else { echo date("d"); } ?>"> / 
                                    M: <input name="tm" size="2" style="border: 1px solid #ccc; padding: 2px 6px; width: 40px; font-size: 15px; text-align: center;" type="text" value="<?php if(isset($_GET[tm])) {  echo $_GET[tm];  } else { echo date("m"); } ?>"> 
                                    Y:<input name="ty" size="4" style="border: 1px solid #ccc; padding: 2px 6px; width: 69px; font-size: 15px; text-align: center;" type="text" value="<?php if(isset($_GET[ty])) {  echo $_GET[ty];  } else { echo date("Y"); } ?>">
                                    
                                    </td>
                                    <td width="100"><input name="submit" style="border: none;background-image: linear-gradient(to right,#FF394F 0,#FF8090 100%);border-radius: 4px;text-decoration: none;height: 25px;padding: 2px 20px;font-size: small;color: #fff;margin: 5px;" type="submit" value="Go"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    
    
    



                            










                           

  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }
      .postpay { background: black; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
  </style>    


<div class="col-lg-12 col-md-12 p-top-50"><br></div>           
                        
                      
                    


                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th></th>
                                    <th>Student Name</th>
                                    <th>Other Details</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Token</th>
                                    <th>Requested</th>
                                    <td></td>
                                </tr>
                                </thead>

                                <tbody>

<?php

            $today = date('Y-m-d');
            $today_stamp = strtotime("$today");
            $before_1_month = date("Y-m-d", strtotime("-3 days", $today_stamp));
            $new_today = date("Y-m-d", strtotime("+1 days"));


if(isset($_GET[submit])) { 


    $todate=   $_GET[ty]."-".$_GET[tm]."-".$_GET[td];
    $fromdate= $_GET[fy]."-".$_GET[fm]."-".$_GET[fd];
    
    if($_GET[search_now]) { 
           $sql2 = "SELECT * FROM products WHERE posted_date between '$fromdate' AND '$new_today' AND teacher_id = '$_GET[teacher_id]' AND lesson_id = '$_GET[category_id]' AND active = 1 AND comments != '' AND status = 'Proceed' OR posted_date between '$fromdate' AND '$todate' AND active = 1 AND comments != '' AND status = 'PostPay' ORDER by paid_marked_by, status, posted_date DESC ";
    } else { 
           $sql2 = "SELECT * FROM products WHERE posted_date between '$fromdate' AND '$new_today' AND active = 1 AND comments != '' AND status = 'Proceed' OR posted_date between '$fromdate' AND '$todate' AND active = 1 AND comments != '' AND status = 'PostPay' ORDER by paid_marked_by, status, posted_date DESC ";
    }       
    
} else { 
    if($_GET[search_now]) { 
           $sql2 = "SELECT * FROM products WHERE posted_date between '$before_1_month' AND '$new_today' AND teacher_id = '$_GET[teacher_id]' AND lesson_id = '$_GET[category_id]' AND active = 1 AND comments != '' AND status = 'Proceed' OR posted_date between '$before_1_month' AND '$today' AND active = 1 AND comments != '' AND status = 'PostPay' ORDER by paid_marked_by, status, posted_date DESC "; 
    } else { 
           $sql2 = "SELECT * FROM products WHERE posted_date between '$before_1_month' AND '$new_today' AND active = 1 AND comments != '' AND status = 'Proceed' OR posted_date between '$before_1_month' AND '$today' AND active = 1 AND comments != '' AND status = 'PostPay' ORDER by paid_marked_by, status, posted_date DESC "; 
    } 


}



        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {             

        $sql3 = "SELECT userID, userName, grade, userEmail, mobile, school FROM tbl_users WHERE userID=$pra2[student_id]";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);
        

        

?>                                
    <?php
            $sql3x = "SELECT * FROM category WHERE id='$pra2[lesson_id]' ORDER by id DESC";
            $result3x = mysqli_query($connect, $sql3x);
            $pra3x = mysqli_fetch_array($result3x);

    ?>   

    <?php
            $sql3y = "SELECT userID, userName FROM tbl_users WHERE userID='$pra2[teacher_id]' ";
            $result3y = mysqli_query($connect, $sql3y);
            $pra3y = mysqli_fetch_array($result3y);

    ?>  
                                <tr>
                                    <td alt="<?php echo $pra2[id]; ?>" title="<?php echo $pra2[id]; ?>"><?php echo $pra3[userID]; ?></td>
                                    <td>

                                        <?php if($pra2[comments] != '') { ?><a href="<?php echo getImageUrl($pra2['comments'], $baseURL, $current_page); ?>" target="_blank">View Receipt</a>

                                    <br><span style="background: black;color: white;padding: 10px 10px;border-radius: 5px;font-size: 12px;width: 150px;display: block;text-align: center;margin-bottom: 0;margin-top: 10px;"><?php echo date('m/d/Y h:s A', $pra2[comments]); ?></span> 

                                    <?php } ?>
                                    </td>
                                    <td><a href="admin_students_active.php?student=<?php echo $pra3[userID]; ?>" target="_blank"><?php echo $pra3[userName]; ?></a>
                                        <br><?php echo $pra3[grade]; ?><br>
                                    <?php echo $pra3[userEmail]; ?><br><?php echo $pra3[mobile]; ?> <br>
                                    <?php echo $pra3[school]; ?> </td>

                                    <td> <a href="admin_teachers_active.php?teacher=<?php echo $pra3y[userID]; ?>" target="_blank">

                                            <h3 style="/* height: 30px; */padding: 0px 0 10px 0;border-radius: 5px;font-size: unset;color: red;"><?php echo $pra3y[userName]; ?></h3>

                                            <h2 style="background: #eba600;height: 30px;padding: 5px 10px;border-radius: 5px;font-size: unset;"><?php echo $pra3x[name_of_class]; ?></h2>
                                           <p style="color:#000000"><?php echo $pra3x[description]; ?></p></a>
                                       </td>
                                    <td class="type"><?php if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == 'Online' OR $pra2[status] == 'Proceed' && $pra2[paid_marked_by] == 'Online' ) { echo '<span class="proceed" style=" background: red; ">Online</span>'; } if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == '' ) { echo 'Deposit'; }?></td>
                                    <?php  
                                        if($pra2[status] == 'Proceed') { 
                                                    echo '<td class="type"> <span class="proceed">Requested</span> </td>';  
                                        }
                                        if($pra2[status] == 'Paid') { 
                                                    echo '<td class="type"> <span class="paid">Paid</span> </td>';  
                                        }
                                        if($pra2[status] == 'Free') { 
                                                    echo '<td class="type"> <span class="finished">Free</span> </td>';  
                                        }
                                        if($pra2[status] == 'PostPay') { 
                                                    echo '<td class="type"> <span class="postpay">PostPay</span> </td>';  
                                        }

                                    ?>
                                    
                                    
                                    
                                    
                                    <td class="action">
                                        <form action="" method="post" onsubmit="return confirm('Are you sure you want to Save?');">
                                            <input type="hidden" name="product_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="text" name="change_token" value="<?php echo $pra2[system_token]; ?>" required="">
                                        </form>
                                    </td>
                                    
                                    
                                    
                                    <td><?php echo $pra2[posted_date]; ?></td>

                                    <td class="action">
                                        <form action="" method="post">
                                            <input type="hidden" name="order_id" value="<?php echo $pra2[id]; ?>">
                                            <select name="change_orders_status" class="liveselect" id="status<?php echo $pra2[id]; ?>" data-id="<?php echo $pra2[id]; ?>" required=""  style=" background: #1dc9b7; color: white; height: 40px; width: fit-content; font-weight: bold; ">
                                                <option>Edit</option>
                                                <option value="Proceed">Requested</option> 
                                                <?php if($pra2[status] != 'Paid') { ?><option value="Paid">Paid</option> <?php } ?>
                                                <option value="Free">Free</option>
                                                <option value="PostPay">PostPay</option>
                                                <option value="Institute">Institute</option>
                                            </select>
                                        </form>
                                    </td>
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

    <!-- inject:js-->

      

    <!-- inject:js-->

     <script src="https://myonlineclass.lk/js/plugins.min.js"></script>

     <script src="https://myonlineclass.lk/js/script.min.js"></script>

     
      <script>
    $(document).ready(function(){
        $(document).on("change", ".liveselect", function(){
            var order_id=$(this).attr("data-id");
            var status=$("#status"+order_id+" option:selected").text();
            var password=$("#pass"+order_id).val();
            
            //alert(status);

            $.ajax({
                url: "live_update.php?lesson=<?php echo $_GET['lesson']; ?>&teacher=<?php echo $_GET['teacher']; ?>",
                type: "post",
                data: {order_id:order_id, status:status, password:password},
                success: function(data){
                    alert(data);
                }
            });
        });
    });
    </script>

   
   
   
   
  
</body>
</html>