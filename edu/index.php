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
   
if($user_home->is_logged_in())
{
     $user_home->redirect('select_your_teacher.php');
}
   
?>