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
if (isset($_POST['status'])){
                



                $date = date('Y-m-d h:i:sa');
                                
                if($_POST[status] == 'Institute') { 
                				//$sql = "UPDATE products SET status='$_POST[status]' WHERE id='$_POST[order_id]'";
                                $sql = "UPDATE products SET status='Paid', paid_marked_by='Institute', posted_date='$date', paid_marked_user = '$_SESSION[userSession]'  WHERE id='$_POST[order_id]'";
                                                                }
                if($_POST[status] != 'Institute') { 
                				//$sql = "UPDATE products SET status='$_POST[status]' WHERE id='$_POST[order_id]'";
                                $sql = "UPDATE products SET status='$_POST[status]', paid_marked_by = '', posted_date='$date', paid_marked_user = '$_SESSION[userSession]' WHERE id='$_POST[order_id]'";
                                                                }




                
                mysqli_query($connect, $sql);
                echo "Changed to $_POST[status]";
}
?>


