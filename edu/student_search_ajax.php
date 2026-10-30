<?php

include 'functions/main.functions.php';   

if(isset($_POST['name']))
{
$name=trim($_POST['name']);
$query2=mysqli_query($connect, "SELECT userID,userName,userEmail,mobile,location,school, institute_id FROM tbl_users WHERE 
userID LIKE '%$name%' AND  type = 1 OR 
userName LIKE '%$name%' AND  type = 3 OR  
userEmail LIKE '%$name%' AND  type = 3 OR  
mobile LIKE '%$name%' AND  type = 3 OR  
location LIKE '%$name%' AND  type = 3 OR  
institute_id LIKE '%$name%' AND  type = 3 OR  
school LIKE '%$name%' AND  type = 3 "  );
echo "<ul>";
while($query3=mysqli_fetch_array($query2))
{
?>

<li onclick='fill("<?php echo $query3['userID']; ?>")' 	onchangex='this.form.submit()' ><?php echo $query3['userName']; ?></li>
<?php
}
}
?>
</ul>