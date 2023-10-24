<?
/******************************************************
 * Class Slider
 *
 * Slider Handling
 * 
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:  
 * Program ID                 :  class_Slider.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	2014/02/10    	Banglcb          -  		-     -     -
 *
 ********************************************************/
class Sliders extends dbBasic{
	function Sliders(){
		$this->pkey = "slider_id";
		$this->tbl 	= "_sliders";
	}	
	//SELECT
	function getListOn($slider_type=''){
		global $lang_code;
		$cond = "is_online=1 AND lang_code='$lang_code' AND slider_type='$slider_type' ORDER BY order_no ASC, slider_id";
		return $this->getAll($cond);	
	}
	//INSERT
	//UPDATE
	//DELETE

}
?>