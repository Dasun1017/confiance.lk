<?php 
    include 'functions/main.functions.php'; 

    $status_code = $_POST['status_code'];
    $order_id = $_POST['order_id'];
    $payhere_amount = $_POST['payhere_amount'];

    if ($status_code == 2 ){
        

        $sql2x = "SELECT * FROM products WHERE posted_time='$order_id'";
        $result2x = mysqli_query($connect, $sql2x);
        $pra2x = mysqli_fetch_array($result2x); 

            $sql3 = "SELECT * FROM category WHERE id='$pra2x[lesson_id]' ORDER by id DESC";
            $result3 = mysqli_query($connect, $sql3);
            $pra3 = mysqli_fetch_array($result3);
            $newcharge = $pra3[charge].'.00';

            if($newcharge == $payhere_amount) { 
                $sql_paid = "UPDATE products SET status='Paid', paid_marked_by = 'Online' WHERE posted_time='$order_id'";
                mysqli_query($connect, $sql_paid);  
            }
    }

?>