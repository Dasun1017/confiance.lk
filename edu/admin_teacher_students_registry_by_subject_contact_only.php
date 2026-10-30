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

<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $site_meta_description; ?>">
    <meta name="keywords" content="<?php echo $site_keywords; ?>">
    <title>Export Contacts - <?php echo $site_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <?php metas(); ?>
</head>
<body class="preload">


<?php
        $sql2 = "SELECT * FROM products WHERE teacher_id='$_GET[teacher]' AND active = 1 AND lesson_id = '$_GET[lesson]' ORDER by status DESC ";
        $result2 = mysqli_query($connect, $sql2);
        while($pra2 = mysqli_fetch_array($result2)) {             

        $sql3 = "SELECT * FROM tbl_users WHERE userID=$pra2[student_id]";
        $result3 = mysqli_query($connect, $sql3);
        $pra3 = mysqli_fetch_array($result3);
        

        

?>     

                                    <div><?php 
                                    if($_GET[contact] == 'numbers') { echo $pra3[mobile]; }
                                    if ($_GET[contact] == 'emails') { echo $pra3[userEmail]; }
                                    if ($_GET[contact] == 'details') { echo $pra3[userID]; echo ' - '; echo $pra3[userEmail]; echo ' - '; echo $pra3[mobile]; echo ' - '; echo $pra2[status];}
                                    ?></div>


<?php } ?>
 
     
</body>
</html>