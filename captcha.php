<?php
require_once("includes/common/class.Securimage.php");
$sid = isset($_GET["sid"])? $_GET["sid"] : "";
$t = isset($_GET["t"])? $_GET["t"] : "medium";
$img = new Securimage($sid);
if ($t=='small'){
	$width = 125;
	$height = 30;
	$font_size = 14;
}elseif ($t=='medium'){
	$width = 160;
	$height = 45;
	$font_size = 20;
}elseif ($t=='large'){
	$width = 200;
	$height = 60;
	$font_size = 24;
}
$img->font_size = $font_size;
$img->image_width = $width;
$img->image_height = $height;
$img->show(); // alternate use:  $img->show('/path/to/background.jpg');
?>
