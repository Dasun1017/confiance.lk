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

<?php   if(isset($_GET[filter_students])) {
            $sql = "SELECT * FROM tbl_users WHERE userID='$_SESSION[userSession]' AND batch = '$_GET[filter_students]'  AND institute_name = '$_GET[institute_name]' AND active = '1'";
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
if(isset($_GET[filter_students])) {
            $total_pages_sql = "SELECT * FROM tbl_users WHERE type = '3' AND batch = '$_GET[filter_students]' AND institute_name = '$_GET[institute_name]' ORDER by userID DESC";
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
          <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
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
    







<div id="content_area_wrapper">

<br><br><br>

<div id="content_area">

<div class="hide_print" onclick="window.print();return false;" style="float: right;margin-top: 10px;margin-right: 20px;position: fixed;right: 0;"><p style="background: rgb(28, 184, 65);color: white;border-radius: 4px;text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);padding: 5px 10px;width: 100px;/* margin-right: 50px; */text-align: center;/* bottom: 0; */">PRINT NOW</p></div>


<page id="table_holder" size="A4" >
            
            
                        <style>
							 .freecard td {background-color: #FFEB3B !important;   	}
							 .freecard td.selected {background-color: #FFEB3B !important;   	}
							 .freecard td.over {background-color: #FFEB3B !important;   	}
							 @media print { #title_bar, #paging, .hide_print  { display: none !important; } }
							 page { background: white; display: block; margin: 0 auto; margin-bottom: 0.5cm; } 
							 page[size="A4"] { width: 21cm; }
							 .manual_height {   height: 227.8px	} 
                        </style>
						
        
            
            
            <?php 
				 
				 
					if(isset($_GET[filter_students])){ 
                $sql = "SELECT * FROM tbl_users WHERE type = '3' AND batch = '$_GET[filter_students]' AND institute_name = '$_GET[institute_name]' ORDER by userID DESC";
                $result = mysqli_query($connect, $sql);
				$num_rows = mysqli_num_rows($result);
					
				echo '<div id="paging" style="margin-bottom: 20px;"><p style="background: #ffeb3b; padding: 10px; text-align: -webkit-center;"> Total Students  <strong style="font-weight: 600; font-family: sans-serif;">'.$num_rows.'</strong> </p>';
					}
			?>	
				
<div style="position: relative; margin-top: -10px;">
	<div id="title" class="float_left" style="font-size: 14px;color: red;margin-left: 10px;font-weight:  bold;font-family:  sans-serif;"><?php if (isset($_GET['filter_students']))  { echo $_GET['filter_students'];} ?></div>
	<div id="new_button">
		
        <form action="" method="get">	
        <select name="filter_students" style="margin-top: 10px; background: #ff0000; border-radius: 4px; text-decoration: none; width: 220px; border: none; padding: 2px 20px; font-size: small; color: #fff; margin: 5px; height: 23px;">
        <?php  $sql = "SELECT * FROM tbl_users WHERE type = '3'  GROUP by batch ORDER by count(*) DESC";
                $result = mysqli_query($connect, $sql);
                while($prax = mysqli_fetch_array($result) ) {  
					
					
                echo $sql_x = "SELECT * FROM tbl_users WHERE type = '3'AND batch = '$prax[batch]' ORDER by userID DESC";
                $result_x = mysqli_query($connect, $sql_x);
				$num_rows_x = mysqli_num_rows($result_x);
					
					echo '<option value="'.$prax[batch].'">'.$prax[batch].' - ('.$num_rows_x.')</option>';
				}
        ?>

      </select>

       <select name="institute_name" style="margin-top: 10px; background: #ff0000; border-radius: 4px; text-decoration: none; width: 220px; border: none; padding: 2px 20px; font-size: small; color: #fff; margin: 5px; height: 23px;">
        <?php  $sql = "SELECT * FROM tbl_users WHERE type = '3'  GROUP by institute_name ORDER by count(*) DESC";
                $result = mysqli_query($connect, $sql);
                while($prax = mysqli_fetch_array($result) ) {  
          
          
                echo $sql_x = "SELECT * FROM tbl_users WHERE type = '3'AND institute_name = '$prax[institute_name]' ORDER by userID DESC";
                $result_x = mysqli_query($connect, $sql_x);
        $num_rows_x = mysqli_num_rows($result_x);
          
          echo '<option value="'.$prax[institute_name].'">'.$prax[institute_name].' - ('.$num_rows_x.')</option>';
        }
        ?>

      </select>
        	
<input id="submit" name="student_filter_submit" type="submit" value="Filter" style="margin-top: 10px; background-image: -webkit-linear-gradient(top,#EE6655,#C53927); border-radius: 4px; text-decoration: none; height: 10px; padding: 2px 20px; font-size: small; color: #fff; margin: 5px; height: 23px; border: 0;">
		</form>
        
        
</div>
</div>



<?php
echo '</div>';
					if(isset($_GET[filter_students])){ 
			echo '<div style="display: inline-table;     font-family: sans-serif;">';		
                $sql = "SELECT * FROM tbl_users WHERE type = '3' AND batch = '$_GET[filter_students]' AND institute_name = '$_GET[institute_name]' ORDER by userID DESC";
                $result = mysqli_query($connect, $sql);
                while($prax = mysqli_fetch_array($result) ) { 
				
					
					$prax_address = preg_replace('/(?<!,) {2,}/', ' ', $prax[location]);
					
					$prax_address2 = explode(",", $prax_address);
					$prax_address3 = implode(', ', $prax_address2);
                echo "
                <div style='width:33%; float:left; ' class='manual_height'>";
           
				echo "
					
					<div style='padding: 10px 20px;     text-transform: uppercase;     font-size: 15px;'><strong style='font-weight: bold; '>$prax[userName] ($prax[userID])</strong><br>  $prax_address3 <br>  $prax[userEmail]  <br>   $prax[std_city] </div>
					";
					
			
			
			
			
				echo "</div>"; }
                
               }	if(!isset($_GET[filter_students])){  echo "<div style='height:230px'></div>"; }	echo '</div>';
            ?>  
					
		
		
		
		
		
		
		
		
</page>
    
    
    
    
    <?php echo $message; ?>
</div>
</div>







     <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>


