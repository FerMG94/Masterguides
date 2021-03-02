<?php
session_start();
/* Si coge el texto (captcha) y la sesión (captcha) */
if(isset($_GET['captcha_text']) and isset($_SESSION['captcha'])){
/* Crea la imagen */
	$captcha_text = $_GET['captcha_text'];
	$image = imagecreate(100, 32);
	$background_color = imagecolorallocate($image, 0, 0, 0);
	$text_color = imagecolorallocate($image, 255, 255, 255);
	imagestring($image, 4, 25, 8, $captcha_text, $text_color);

	/* Mostrar imagen */
	header("Content-type: image/png");
	imagepng($image);
	imagecolorallocate($text_color);
	imagecolorallocate($background_color);
	imagedestroy($image);
}

?>