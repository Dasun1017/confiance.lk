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
        $sql = "SELECT * FROM tbl_users WHERE userID=$_GET[teacher]";
        $result = mysqli_query($connect, $sql);
        $pra = mysqli_fetch_array($result);

?>

<?php 
if (isset($_POST['change_orders_status'])){



    if($_POST['change_orders_status'] == 'D') { 
    
                
                $sql2 = "UPDATE products SET active='0' WHERE id='$_POST[order_id]'";
                mysqli_query($connect, $sql2);
                
                echo "<script>alert('Lesson for this Student Deleted Successfully!')</script>";
                
    }
    if($_POST['change_orders_status'] != 'D') { 
    
    
        $sqlx = "SELECT * FROM products WHERE id='$_POST[order_id]'";
        $resultx = mysqli_query($connect, $sqlx);
        $prax = mysqli_fetch_array($resultx);
            if($prax[teacher_id] ==  $_GET[teacher]) { 
                //$sql = "UPDATE products SET status='$_POST[change_orders_status]' WHERE id='$_POST[order_id]'";
                //mysqli_query($connect, $sql);
                //echo "<script>alert('Lesson Status Changed Successfully!')</script>";



                if($prax[status] != 'Paid') { 
                        $date = date('Y-m-d h:i:sa');
                                
                if($_POST[change_orders_status] == 'Institute') { 
                                $sql = "UPDATE products SET status='Paid', paid_marked_by='Institute', posted_date='$date', paid_marked_user = '$_SESSION[userSession]'  WHERE id='$_POST[order_id]'";
                                                                }
                if($_POST[change_orders_status] != 'Institute') { 
                                $sql = "UPDATE products SET status='$_POST[change_orders_status]', paid_marked_by = '', posted_date='$date', paid_marked_user = '$_SESSION[userSession]' WHERE id='$_POST[order_id]'";
                                                                }
                                mysqli_query($connect, $sql);
                                echo "<script>alert('Lesson Status Changed Successfully!')</script>";
                }   





                if($prax[status] == 'Paid') { 
                        $date = date('Y-m-d h:i:sa');
                                
                if($_POST[change_orders_status] == 'Institute') { 
                                $sql = "UPDATE products SET status='Paid', paid_marked_by='Institute', posted_date='$date', paid_marked_user = '$_SESSION[userSession]'  WHERE id='$_POST[order_id]'";
                                                                }
                if($_POST[change_orders_status] != 'Institute') { 
                                $sql = "UPDATE products SET status='$_POST[change_orders_status]', paid_marked_by = '', posted_date='$date', paid_marked_user = '$_SESSION[userSession]' WHERE id='$_POST[order_id]'";
                                                                }
                                mysqli_query($connect, $sql);
                                echo "<script>alert('Lesson Status Changed Successfully!')</script>";


                    
                }




            }         
    }

        
        
    }
?>


<?php 
if (isset($_POST['change_token'])){

                $sql = "UPDATE products SET system_token='$_POST[change_token]' WHERE id='$_POST[product_id]'";
                mysqli_query($connect, $sql);
                echo "<script>alert('Token Changed Successfully!')</script>";
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
    <title>Student Registry - <?php echo $site_title; ?></title>

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
                                   


<div class="col-lg-4 col-md-12 p-bottom-0" >

  <p style=" color: red; font-size: large; padding: 10px; text-align: left; border-radius: 5px; ">
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

                                        
                                   

                                        
                                            <div class="col-md-12 col-lg-12">
                                                <div class="p-top-0 p-bottom-20">
                                                   
                                                    
                                                    <div style="background: #fff;border: none;width: fit-content;float: left; border-radius: 0 0 5px 5px">
                                                        
                                                        <a href="admin_teachers_list.php" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " >GO TO <strong>TRAINERS/ TUTORS</strong></span></a>
                                                    </div>
                                                </div>
                                            </div><!-- end .col-md-12 -->




                                        <!-- end .col-md-12 -->
                                    </div>
                                </div>
                <div class="container featured-products2  p-top-0 p-bottom-120" style=" margin: 0px auto; width: 90%; padding: 0px; max-width: 90%; ">
                            






                            










<?php

        $sql4 = "SELECT * FROM category WHERE id=$_GET[lesson]";
        $result4 = mysqli_query($connect, $sql4);
        $pra4 = mysqli_fetch_array($result4);

?>
                            <div class="row">
                              



<div class="col-lg-6 col-md-12 p-bottom-0">

<br>
    <div class="login--header" style=" border-bottom: none; "> <p style=" font-size: initial; color: black; text-align: left; "><?php echo $pra[userName]; ?> - <?php echo $pra[grade]; ?> <br>

        <span style=" font-weight: bold; "><?php echo $pra4[name_of_class]; ?> (<?php echo $pra4[lesson_date]; ?> - <?php echo $pra4[lesson_time]; ?>)</span>
        <br>
        <span style=" font-weight: bold; "><?php echo $pra4[charge]; ?> LKR</span>

    </p> </div>

</div>


<div class="col-lg-6 col-md-12 p-top-20 " style=" color: white; text-align: right;">

                            <a href="admin_teachers_active.php?teacher=<?php echo $_GET[teacher]; ?>" class="btn btn--md register_btn btn-primary" style=" background: #f4516c; border: #f4516c;line-height: inherit;    padding: 10px 20px; " > TRAINER/TUTOR DASHBOARD</a>
                            
                            <a target="_blankx" href="admin_teacher_students_registry_by_subject_contact_only.php?teacher=<?php echo $_GET[teacher]; ?>&&lesson=<?php echo $_GET[lesson]; ?>&&contact=numbers" class="btn btn--md register_btn btn-primary" style=" background: white;line-height: inherit;padding: 5px 10px;color: black;margin-right: 5px;margin-top: 5px;" >Export Numbers</a>
                            <a target="_blankx" href="admin_teacher_students_registry_by_subject_contact_only.php?teacher=<?php echo $_GET[teacher]; ?>&&lesson=<?php echo $_GET[lesson]; ?>&&contact=emails" class="btn btn--md register_btn btn-primary" style=" background: white;line-height: inherit;padding: 5px 10px;color: black;margin-right: 5px;margin-top: 5px;" >Export Emails</a>
                            <a target="_blankx" href="admin_teacher_students_registry_by_subject_contact_only.php?teacher=<?php echo $_GET[teacher]; ?>&&lesson=<?php echo $_GET[lesson]; ?>&&contact=details" class="btn btn--md register_btn btn-primary" style=" background: white;line-height: inherit;padding: 5px 10px;color: black;margin-right: 5px;margin-top: 5px;" >Export Name, ID, Email</a>
                           
                            
</div>


                            </div>


  <style type="text/css">
      .proceed { background: #ffb822; font-weight: bold;  }
      .paid { background: #1dc9b7; color: white; font-weight: bold;  }
      .finished { background: #f4516c; font-weight: bold;  }
      .postpay { background: black; font-weight: bold;  }

      .table-responsive { display: block; width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
  </style>          


                      
                    <form action="" method="post" class="row p-top-60">


                                <div class="col-lg-12 col-md-12" style=" font-size: inherit; padding: 0 0 10px 20px; ">Send Quick SMS</div>

                                <div class="col-lg-9 col-md-12">
                                    <textarea type="text" class="text_field" required="" placeholder="Type Here" name="sms_body" style="min-height: 20px;padding-top: 10px;line-height: 30px;height: 90px;" required=""></textarea>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                
                                <input class="btn btn--md register_btn btn-common" type="submit" name="send_sms" value="Send Now" style="float: left;margin-top: 0px;" > 
                                </div>
                                
                  </form>


                      
                    
<?php
  if(isset($_GET[filter_to])) {
        if($_GET[filter_to] == 'Free')                   { $CodeWallTutorialArray = ["Free"]; }   
        if($_GET[filter_to] == 'Paid')                   { $CodeWallTutorialArray = ["Paid"]; }    
        if($_GET[filter_to] == 'PostPay')                { $CodeWallTutorialArray = ["PostPay"]; }   
        if($_GET[filter_to] == 'Request')                { $CodeWallTutorialArray = ["Proceed"]; }   
        if($_GET[filter_to] == 'All')                    { $CodeWallTutorialArray = ["Proceed", "Free", "PostPay", "Paid"]; }   
  } else { 
        $CodeWallTutorialArray = ["Proceed", "Free", "PostPay", "Paid"];
      }
?>

<?php 
        $arrayLength = count($CodeWallTutorialArray);
        
        $i = 0;
        while ($i < $arrayLength)
        {
            //echo $CodeWallTutorialArray[$i] ."<br />";

?>


                <div class="row">
                    <div class="col-md-12">
                                            
                        <div class="statement_table table-responsive" style="background: white">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th></th>
                                    <th>Student Name</th>
                                    <!--<th>Grade</th>-->
                                    <th>Contact</th>
                                    <!--<th>School</th>-->
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <!--<th>Token</th>-->
                                    <th>Requested</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>

<?php
        $sql2 = "SELECT * FROM products WHERE teacher_id='$_GET[teacher]' AND active = 1 AND lesson_id = '$_GET[lesson]' AND status = '$CodeWallTutorialArray[$i]' ORDER by paid_marked_by, status, comments DESC, posted_date DESC ";// ORDER by paid_marked_by, comments DESC ";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {             

        $sql3 = "SELECT * FROM tbl_users WHERE userID=$pra2[student_id]";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);
        

//if($pra2[status] == 'Paid' OR $pra2[status] == 'Free') { 

          if(isset($_POST[send_sms])) {  

          //textit        
                    $to = $pra3[userEmail];
                    //$date_time = date("Y/m/d - h:i:sa");
                    $text = urlencode("$_POST[sms_body]");
                    $output4 = preg_replace('!\s+!', ' ', $text);
                    $baseurl ="https://www.textit.biz/sendmsg";
                    $url = "$baseurl/?id=94202318241&pw=3144&to=$to&text=$output4&eco=Y";
                    //$ret = file($url);     $res= explode(":",$ret[0]);         
echo "<iframe style='height:1px; width:1px;display: none;' src='$url'></iframe>";                                               
                 
          //textit 
                  }
 //     }

?>    

                                <tr>
                                    <td alt="<?php echo $pra2[id]; ?>" title="<?php echo $pra2[id]; ?>"><?php echo $pra3[userID]; ?><?php if($pra2[reference] != '') { ?><br>(<span style="color:red"><?php echo $pra2[reference]; ?></span>)<?php } ?></td>
                                    <td><?php if($pra2[comments] != '') { ?><a href="<?php echo getImageUrl($pra2['comments'], $baseURL, $current_page); ?>" target="_blankx" style=" background: black; color: white; padding: 5px 10px; border-radius: 5px; "><!--<img src="<?php echo getImageUrl($pra2['comments'], $baseURL, $current_page); ?>" style="max-height: 70px;max-width: 275px;border: 2px solid white;border-radius: 5px;">-->Receipt</a><?php } ?></td>
                                    <td><a href="admin_students_active.php?student=<?php echo $pra3[userID]; ?>" target="_blank"><?php echo $pra3[userName]; ?></a> <?php if($pra3[institute_id_verified] == 'Y') { echo '<br> <span style="background:#1dc9b7; color: white;     padding: 2px 10px;">';echo $pra3[institute_id]; echo '</span>'; } ?> <br></td>
                                    <!--<td><?php echo $pra3[grade]; ?></td>-->
                                    <td><?php echo $pra3[userEmail]; ?><br><?php echo $pra3[mobile]; ?></td>
                                    <!--<td><?php echo $pra3[school]; ?> </td>-->
                                    <td class="type"><?php if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == 'Online' OR $pra2[status] == 'Proceed' && $pra2[paid_marked_by] == 'Online' ) { echo '<span class="proceed" style=" background: red; ">Online</span>'; } if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == '' ) { echo 'Deposit'; } if($pra2[status] == 'Paid' && $pra2[paid_marked_by] == 'Institute' ) { echo 'Institute'; }?></td>
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
                                        if($pra2[status] == 'Institute') { 
                                                    echo '<td class="type"> <span class="postpay">Institute</span> </td>';  
                                        }

                                    ?>
                                    
                                    
                                    
                                    
                                    <!--<td class="action">
                                        <form action="" method="post" onsubmit="return confirm('Are you sure you want to Save?');">
                                            <input type="hidden" name="product_id" value="<?php echo $pra2[id]; ?>">
                                            <input type="text" name="change_token" value="<?php echo $pra2[system_token]; ?>" required="">
                                        </form>
                                    </td>-->
                                    
                                    
                                    
                                    <td><?php echo $pra2[posted_date]; ?></td>

                                    <td class="action">
                                        <form action="" method="post">
                                            <input type="hidden" name="order_id" value="<?php echo $pra2[id]; ?>">
                                            <select name="change_orders_status" required=""  onchange="this.form.submit()" style=" background: #1dc9b7; color: white; height: 30px; width: fit-content; font-weight: bold; ">
                                                <option>Edit</option>
                                                <?php if($pra2[status] != 'Paid') { ?><option value="Proceed">Requested</option> <?php } ?>
                                                <?php if($pra2[status] != 'Paid') { ?><option value="Paid">Paid</option> <?php } ?>
                                                <option value="Free">Free</option>
                                                <option value="PostPay">PostPay</option>
                                                <option value="Institute">Institute</option>
                                                <option value="D">Delete</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>


<?php } ?>
                                </tbody>
                            </table>

                    </div></div>







                            </div>




<?php 
            $i++;
  } 
?>



                        </div>
                            </div>
        </div><!-- end hero-content -->
    </section><!-- ends: .hero-area -->




     
  


     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>