<?php

//mengaktifkan session
session_start();
 
header("Content-type: image/png");
 
// menentukan session
$_SESSION["captcha_code"]="";
 
// membuat gambar dengan menentukan ukuran
$gbr = imagecreate(100, 40);

//warna background captcha
imagecolorallocate($gbr, rand(0,255), rand(0,255), rand(0,255));
 
// pengaturan font captcha
$color = imagecolorallocate($gbr, rand(0,255), rand(0,255), rand(0,255));
$font = "HVD_Comic_Serif_Pro.otf"; 
$ukuran_font = 20;
$posisi = 37;

// membuat kata acak dan ditampilkan pada gambar
$random_alpha=md5(rand());
$captcha_code = substr($random_alpha,0,6);
$_SESSION["captcha_code"]= $captcha_code;
 
$kemiringan= rand(0,15);
 	
imagettftext($gbr, $ukuran_font, $kemiringan, 5, $posisi, $color, $font,  $captcha_code);	

//untuk membuat gambar 
imagepng($gbr); 
imagedestroy($gbr);
?>

