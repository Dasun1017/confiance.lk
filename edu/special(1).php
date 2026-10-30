1<?php 
include 'functions/main.functions.php';   

ini_set('date.timezone', 'Asia/Colombo');
date_default_timezone_set('Asia/Colombo');

$actual_link = "$_SERVER[HTTP_HOST]";
$time = time();
$date = date("Y/m/d G:i");
?>

<?php if(!isset($_GET[random_number])) {   header('Location: /');  } ?>
<?php 
                    $random_number = mysqli_real_escape_string($connect, $_GET[random_number]);

                    $sql = "SELECT id, posted_time, active, zoom_api_key, zoom_api_secret, zoom_meeting_id  FROM category WHERE posted_time='$random_number' AND active = '1' ";
                    $result = mysqli_query($connect, $sql);
                    $rowcount=mysqli_num_rows($result);



                    if($rowcount == '' OR $rowcount == '0') { 
                      $message = "<div class='alert alert-danger solid alert-rounded '>Meeting is Expired!</div>";
                      $invalid = '1';
                    }
                    $row=mysqli_fetch_array($result);
                    $group_id = $row[id];
?>


<?php

//create zoom link //

           

            function new_getLink4($api_key, $api_secret, $first_name, $last_name, $email, $meeting_id, $auto_approve)
            {   
                $url = 'https://aws-zoom-security.itsignature.lk/api/add-registrant';

                $fields =  array(
                    "api_key" => $api_key,
                    "api_secret" => $api_secret,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
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

                curl_close($ch);
                
                return $response;
            }



echo '<span style="display: none">';

                                        $ITS = rand(99999, 111110000);
                                        $email = $ITS.'@gmail.com';


                                        echo $result3 = new_getLink4 (
                                            "$row[zoom_api_key]", 
                                            "$row[zoom_api_secret]", 
                                            "Special", 
                                            "$ITS", 
                                            "$email", 
                                            "$row[zoom_meeting_id]",
                                            'true'
                                        );

                                         $data3 = json_decode($result3);
                                         $join_url3 = $data3->join_url;



                                        $date = date('Y-m-d h:s');
                                        $time = time();
                                        $actual_date = date("Y/m/d");
                                        
                                        
                                        flush();
                                        header('Location: '.$join_url3.''); 
                                        echo '<script>window.location.replace("'.$join_url3.'")</script>';


echo '</span>';

//finish zoom link //

?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Special Zoom Link - <?php echo $site_title; ?></title>
   <?php metas(); ?>
</head>

<body>
   <!--[if lte IE 9]>
   <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

   <!--header-area start-->
   <?php real_header(); ?>
   <!--header-area end-->
   
   <!--banner-area start-->
   <div class="banner-area bg-1 pt-30 pb-111" style="background:none">
      <div class="container">
        



      
                    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-12">


                    <div class="authincation-content">
                        <div class="row no-gutters">








<lable style="font-size: large;padding: 10px 0 0 0;text-align: center;color: red;width: 100%;z-index: 9999;">කෙටි වේලාවකින් ඔබව Zoom පන්තියට සම්බන්ධ කරනු ඇත</lable>





<img style="width: 65%;height: auto;margin: -20px auto;position: relative;" src="https://cdn.dribbble.com/users/1186261/screenshots/3718681/_______.gif" width="784" height="588">



                            <div class="col-xl-12">


   <script>
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   </script>






                                <div class="auth-form">
                                    
                                                                        
                                                                            <form action="" method="post" autocomplete="off">
                                            
                                            <div class="text-center">
                                                <button type="submit" name="join_now2" class="btn btn-primary btn-block" style=" font-size: large; padding: 3px 20px; text-transform: uppercase; width: fit-content; margin: 0 auto; height: 45px; ">Try Again!</button>
                                            </div>
                                        </form>
                                                                        
                                </div>



                            </div>

<!-- second message -->



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    




                    
      </div>
   </div>
   <!--banner-area end-->
   
   

    








   <!--team-area start-->















   
   <!--footer-area start-->
   <?php footer(); ?>
   <!--footer-area end-->
   
   
   
   
  
</body>
</html>
