1<?php 
include 'functions/main.functions.php';   

ini_set('date.timezone', 'Asia/Colombo');
date_default_timezone_set('Asia/Colombo');

$actual_link = "$_SERVER[HTTP_HOST]";
$time = time();
$date = date("Y/m/d G:i");
?>

<?php if(!isset($_GET[email])) {   header('Location: https://myguiders.com/');  } ?>



<?php

//create zoom link //

           

            function new_getLink($api_key, $api_secret, $first_name, $last_name, $email, $meeting_id, $auto_approve)
            {   
                $url = 'https://aws-zoom-security2.zoomlock.lk/public/api/add-registrant';

                $fields =  array(
                    "api_key" => $api_key,
                    "api_secret" => $api_secret,
                    "first_name" => $last_name,
                    "last_name" => $first_name,
                    "email" => $email,
                    "meeting_id" => $meeting_id,
                    "auto_approve" => $auto_approve
                );

                $payload = $fields;

                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch,CURLOPT_POST, true);
                curl_setopt($ch,CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);

                //echo "here3"; var_dump($response); //die();
                curl_close($ch);
                
                return $response;
            }



echo '<span style="display: none">';

        $sql_category = "SELECT id, zoom_meeting_id, zoom_api_key, zoom_api_secret FROM category WHERE id='$_GET[cat_id]' AND zoom_meeting_id != ''";
        $result_category = mysqli_query($connect, $sql_category);
        $pra_category = mysqli_fetch_array($result_category);
        $num_check = mysqli_num_rows($result_category);
        if($num_check != '' OR $num_check != '0') { 


            $email = $_GET[email];

            $result = new_getLink (
                "$pra_category[zoom_api_key]", 
                "$pra_category[zoom_api_secret]", 
                "$_GET[first_name]", 
                "$_GET[first_name]", 
                "$email", 
                "$_GET[meeting_id]",
                'true'
            );

            $data = json_decode($result);

            $join_url = $data->join_url;
            header('Location: '.$join_url.''); 
            echo '<script>window.location.replace("'.$join_url.'")</script>';

        }


echo '</span>';

//finish zoom link //

?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Special Zoom Link</title>
   <?php metas(); ?>
</head>

<body>
Loading...
</body>
</html>
