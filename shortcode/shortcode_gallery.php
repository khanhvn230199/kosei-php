<?php
/**
 * Parse shortcode gallery
 * 
 * @param unknown $atts
 * @return string
 */
function parse_shortcode_gallery($atts){
	$params = shortcode_atts(array(
   		'id' 		=> 	'0',
		'column'	=>	'3',
		'type'		=>	'grid',	//grid or slider
		'height'	=>	'300'	//unit: px
   	), $atts);
	
	$clsGallery = new Gallery();
	$out = $clsGallery->parse_shortcode($params);
	
	return $out;
}
add_shortcode("gallery", "parse_shortcode_gallery");