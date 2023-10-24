<?
/******************************************************
 * Class Gallery
 *
 * Gallery Handling
 * 
 * Project Name               :  Daihoithammyquocte.com
 * Package Name            		:  
 * Program ID                 :  class_Gallery.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	20/01/2018    	banglcb          -  		-     -     -
 *
 ********************************************************/
class Gallery extends dbBasic{
	function Gallery(){
		$this->pkey = "gallery_id";
		$this->tbl 	= "_gallery";
	}	
	//SHORTCODE
	function parse_shortcode($params){
		$gallery_id = preg_replace('/[^0-9]/', '', htmlDecode($params['id']));
		if (isset($params['column'])){
			$column = preg_replace('/[^0-9]/', '', htmlDecode($params['column']));
			if (!is_numeric($column)) $column = 3;
		}else{
			$column = 3;
		}
		if (isset($params['type'])){
			$type = preg_replace('/[\'|"]/', '', htmlDecode($params['type']));
		}else{
			$type = 'grid';
		}
		if (isset($params['height'])){
			$height = preg_replace('/[^0-9]/', '', htmlDecode($params['height']));
			if (!is_numeric($height)) $height = 300;
		}else{
			$height = 300;
		}
		if (isset($params['autoplay'])){
			$autoplay = $params['autoplay'];
		}else{
			$autoplay = false;	
		}
		if (isset($params['autoplayTimeout'])){
			$autoplayTimeout = $params['autoplayTimeout'];
		}else{
			$autoplayTimeout = 3000;
		}
		
		$arrOneGallery = $this->getOne($gallery_id);
		$list_images = $arrOneGallery['list_images'];
		$arr_images = explode(',', $list_images);
		if ($type=='grid'){
			$html = " <script src='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js'></script>
				<link href='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css' rel='stylesheet'>
<style>				
.shortcode_mygallery {
	-webkit-column-count: ".$column."; /* Chrome, Safari, Opera */
	-moz-column-count: ".$column."; /* Firefox */
    column-count: ".$column.";
}	
.shortcode_mygallery img{ width: 100%; padding: 7px 0;}
				
@media (max-width: 500px) {
		
.shortcode_mygallery {
	-webkit-column-count: 1; /* Chrome, Safari, Opera */
    -moz-column-count: 1; /* Firefox */
    column-count: 1;
}
		
}
</style>
<script>
$(document).ready(function ($) {
	// disable wrapping
	$(document).on('click', '[data-toggle=\"lightbox\"][data-gallery=\"gallery-".$gallery_id."\"]', function(event) {
	event.preventDefault();
	return $(this).ekkoLightbox({
	    wrapping: false
	});
	});
});
</script>				
";
		}else{
			$html = "<script src='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js'></script>
				<link href='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css' rel='stylesheet'>
<style>
#mygallery_".$gallery_id." .item{padding:5px; overflow:hidden;}
#mygallery_".$gallery_id." img{ width: 100%!important; height:".$height."px;}
@media (max-width: 575px) {
	#mygallery_".$gallery_id." img{ height:150px!important;}
}
.mygallery_prev {
    position: absolute;
    top: 48%;
    left: 20px;
    display: inline-block;
    width: 17px;
    height: 30px;
    background: url(".URL_IMAGES."/icon-prev.png) center center no-repeat;
    cursor: pointer;
    z-index: 2;
}
.mygallery_next {
    position: absolute;
    top: 48%;
    right: 20px;
    display: inline-block;
    width: 17px;
    height: 30px;
    background: url(".URL_IMAGES."/icon-next.png) center center no-repeat;
    cursor: pointer;
    z-index: 2;
}		
</style>
<script>
function mygallery_next_OWL(obj) {
    $('#' + obj).trigger('next.owl.carousel');
}

function mygallery_prev_OWL(obj) {
    $('#' + obj).trigger('prev.owl.carousel');
}
//END Next prev slider OWL
$(document).ready(function ($) {
	var mygallery = $('#mygallery_".$gallery_id."'); 
	if (mygallery.length > 0) {
        mygallery.owlCarousel({
			loop: true,
			autoplay: ".$autoplay.",
			autoplayTimeout: ".$autoplayTimeout.",
			autoHeight: true,
       		items: ".$column.", //10 items above 1000px browser width
            itemsDesktop: [1000, 3], //5 items between 1000px and 901px
            itemsDesktopSmall: [900, 2], // 3 items betweem 900px and 601px
            itemsTablet: [600, 1], //2 items between 600 and 0;
            itemsMobile: [400, 1], // itemsMobile disabled - inherit from itemsTablet option
            pagination:false,
        });
    }
    // disable wrapping
	$(document).on('click', '[data-toggle=\"lightbox\"][data-gallery=\"gallery-".$gallery_id."\"]', function(event) {
	event.preventDefault();
	return $(this).ekkoLightbox({
	    wrapping: false
	});
	});
});
</script>
";
		}
		if (is_array($arr_images)){
			$class = ($type=='slider')? "owl-carousel" : "";
			$metadata = ($type=='slider')? "data-toggle='lightbox' data-gallery='gallery-$gallery_id'" : "data-toggle='lightbox' data-gallery='gallery-$gallery_id'";
			$html.= "<div style='position:relative'>
					<div class='shortcode_mygallery $class' id='mygallery_".$gallery_id."'>";
			$imgstyle = "";//($type=='slider')? "style='height:".$height."px!important'" : "";
			foreach ($arr_images as $key => $val){
				$html.= "<div class='item'>";
				$html.= "<a href='".URL_UPLOADS."/".$val."' $metadata >";
				$html.= "<img src='".URL_UPLOADS."/".$val."' title='Nhấn để phóng to' $imgstyle >";
				$html.= "</a>";
				$html.= "</div>";
			}
			$html.= "</div>";
			if ($type=='slider'){
				$html.= "<a class='mygallery_prev' onclick=\"mygallery_prev_OWL('mygallery_".$gallery_id."');\"></a><a class='mygallery_next' onclick=\"mygallery_next_OWL('mygallery_".$gallery_id."');\"></a>";
			}
			$html.= "</div>";
		}
		return $html;
	}
	//SELECT
	//INSERT
	//UPDATE
	//DELETE

}
?>