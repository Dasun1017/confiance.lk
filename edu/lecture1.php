
<?php
include 'functions/main.functions.php';   
require_once 'class.user.php';
$user_home = new USER(); 

?>



<?php
// Database connection
$servername = "localhost";
$username = "shimo"; // Add your database username
$password = "shimoNEW1"; // Add your database password
$dbname = "shimo"; // Add your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get lesson ID from URL
$lesson_id = isset($_GET['view']) ? intval($_GET['view']) : 0;

// Fetch lesson details
$sql = "SELECT * FROM category WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $lesson_id);
$stmt->execute();
$result = $stmt->get_result();
$lesson = $result->fetch_assoc();

// If lesson not found, redirect to main page
if (!$lesson) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title><?php echo $pra2[userName]; ?> - <?php echo $site_title; ?></title>
   <?php metas(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($lesson['name_of_class']); ?> - Lesson Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
       
            background-color: #f5f5f5;
        }
        .lesson-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .lesson-header {
            background: black;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .lesson-title {
            margin: 0;
            font-size: 24px;
           
        }
        .lesson-meta {
            display: flex;
            gap: 20px;
            margin: 15px 0;
            color: #666;
        }
        .lesson-meta i {
            margin-right: 5px;
        }
        .lesson-price {
            font-size: 20px;
            color: #007bff;
            margin: 10px 0;
        }
        .lesson-description {
            margin: 20px 0;
        }
        .lesson-note {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .back-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>


<?php real_header(); ?>



    <div class="lesson-container">
        <div class="lesson-header">
            <!-- <h1 style="color:white;" class="lesson-title"><?php echo htmlspecialchars($lesson['name_of_class']); ?></h1> -->
            <div class="lesson-meta">
                <span><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($lesson['lesson_date']); ?></span>
                <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($lesson['lesson_time']); ?></span>
                <span><i class="fas fa-users"></i> <?php echo htmlspecialchars($lesson['no_of_students']); ?> Students</span>
            </div>
           
        </div>

        <div class="lesson-description">
            <h3>Description</h3>
           
        </div>

        <div class="lesson-note">
            <h3><?php echo nl2br(htmlspecialchars($lesson['description'])); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($lesson['note'])); ?></p>
        </div>

        <?php if (!empty($lesson['target_audience_full'])): ?>
        <div class="lesson-audience">
            <h2>Target Audience</h2>
            <p><?php echo nl2br(htmlspecialchars($lesson['target_audience_full'])); ?></p>
        </div>
        <?php endif; ?>

        <a href="index.php" class="back-button">← Back to Lessons</a>
        <?php 
        if(!$user_home->is_logged_in() ) { ?>
        <a href="login2.php" class="back-button" style="background-color: green; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">← Enroll now</a>

        <?php } ?>

    </div>
</body>
</html>