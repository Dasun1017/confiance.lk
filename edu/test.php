<?php 
    include 'functions/main.functions.php'; 
?>
<?php

        //echo $sql2 = "SELECT batch, userID FROM tbl_users WHERE  batch = 'A/L Level 2021x' LIMIT 1000 ";
        //$result2 = mysqli_query($connect, $sql2);
        //while($pra2 = mysqli_fetch_array($result2)) { 


                //$sql = "DELETE from products  WHERE student_id='$pra2[userID]'";
                //mysqli_query($connect, $sql);

                //$sql3 = "DELETE from tbl_users  WHERE userID='$pra2[userID]'";
                //mysqli_query($connect, $sql3);
        //}


?>
<table>
    
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Mobile</td>
        <td>WhatsApp</td>
        <td>Address</td>
    </tr>
<?php

        //$sql2 = "SELECT userID, userName, userEmail, location, mobile FROM tbl_users WHERE batch = 'Grade 11 - 2023 May OL' LIMIT 10000";
        //$result2 = mysqli_query($connect, $sql2);
        //while($pra2 = mysqli_fetch_array($result2)) { 

 ?>
    <tr>
        <td><?php echo $pra2[userID]; ?></td>
        <td><?php echo $pra2[userName]; ?></td>
        <td><?php echo $pra2[userEmail]; ?></td>
        <td><?php echo $pra2[mobile]; ?></td>
        <td><?php echo $pra2[location]; ?></td>
    </tr>
<?php
        //}
?>


</table>