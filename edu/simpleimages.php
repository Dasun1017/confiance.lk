<?php
// The file
$filename = $_GET[file];

// Content type
header('Content-type: png/image/jpeg');

// Get new dimensions
list($width, $height) = getimagesize($filename);
$new_width = $_GET['width'];
$new_height = $_GET['height'];

// Resample
$image_p = imagecreatetruecolor($new_width, $new_height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Output
imagejpeg($image_p, null, 100);
?>