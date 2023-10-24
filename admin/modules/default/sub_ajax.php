<?
function ajax_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $_LANG_ID;
	exit();
}
//return slug of category
function ajax_get_cat_slug(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $_LANG_ID;
	$clsCategory = new Category();
	$name = GET("cat_name", "");
	$slug = "";
	if ($name!=""){
		$slug = utf8_nosign_noblank($name);
		$exists = $clsCategory->isExistsSlug($slug);
		if ($exists){
			$slug.= intval($exists) + 1;
		}
	}else{

	}
	echo $slug;
	exit();
}
function ajax_check_cat_slug(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $_LANG_ID;
	$clsCategory = new Category();
	$slug = GET("slug", "");
	$old_slug = GET("old_slug", "");
	if ($slug!=""){
		if(preg_match('/^[a-z][-a-z0-9]*$/', $slug)){
			$exists = $clsCategory->isExistsSlug($slug, $old_slug);
			echo ($exists==0)? 1 : 0;
		}else
			echo 0;
	}else{
		echo 0;
	}
	exit();
}
//return slug of exam
function ajax_get_exam_slug(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $_LANG_ID;
	$clsExam = new Exam();
	$name = GET("exam_name", "");
	$slug = "";
	if ($name!=""){
		$slug = utf8_nosign_noblank($name);
		$exists = $clsExam->isExistsSlug($slug);
		if ($exists){
			$slug.= intval($exists) + 1;
		}
	}
	echo $slug;
	exit();
}
function ajax_check_exam_slug(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $_LANG_ID;
    $clsExam = new Exam();
	$slug = GET("slug", "");
	$old_slug = GET("old_slug", "");
	if ($slug!=""){
		if(preg_match('/^[a-z][-a-z0-9]*$/', $slug)){
			$exists = $clsExam->isExistsSlug($slug, $old_slug);
			echo ($exists==0)? 1 : 0;
		}else
			echo 0;
	}else{
		echo 0;
	}
	exit();
}
//return slug of exam
function ajax_get_trialtest_slug(){
    global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    $clsTrialTest = new TrialTest();
    $name = GET("test_name", "");
    $slug = "";
    if ($name!=""){
        $slug = utf8_nosign_noblank($name);
        $exists = $clsTrialTest->isExistsSlug($slug);
        if ($exists){
            $slug.= intval($exists) + 1;
        }
    }
    echo $slug;
    exit();
}
function ajax_check_trialtest_slug(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $_LANG_ID;
    $clsTrialTest = new TrialTest();
	$slug = GET("slug", "");
	$old_slug = GET("old_slug", "");
	if ($slug!=""){
		if(preg_match('/^[a-z][-a-z0-9]*$/', $slug)){
			$exists = $clsTrialTest->isExistsSlug($slug, $old_slug);
			echo ($exists==0)? 1 : 0;
		}else
			echo 0;
	}else{
		echo 0;
	}
	exit();
}
function ajax_get_test_slug(){
    global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    $clsTest = new Test();
    $name = GET("test_name", "");
    $slug = "";
    if ($name!=""){
        $slug = utf8_nosign_noblank($name);
        $exists = $clsTest->isExistsSlug($slug);
        if ($exists){
            $slug.= intval($exists) + 1;
        }
    }
    echo $slug;
    exit();
}
function ajax_check_test_slug(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $_LANG_ID;
    $clsTest = new Test();
	$slug = GET("slug", "");
	$old_slug = GET("old_slug", "");
	if ($slug!=""){
		if(preg_match('/^[a-z][-a-z0-9]*$/', $slug)){
			$exists = $clsTest->isExistsSlug($slug, $old_slug);
			echo ($exists==0)? 1 : 0;
		}else
			echo 0;
	}else{
		echo 0;
	}
	exit();
}
function ajax_get_province(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $_LANG_ID;
	$region_id = GET("region_id", 0);
	$type = GET("type", 0);
	$html = ($region_id>0)? makeListProvince(0, "region_id=$region_id") : "";
	if ($type==0){
		$text0 = "Tỉnh/TP";
	}else{
		$text0 = "Không thay đổi gì";
	}
	$first = "<option value='0'>$text0</option>";
	$html = $first.$html;
	echo $html;
	exit();
}
function ajax_get_district(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $_LANG_ID;
	$province_id = GET("province_id", 0);
	$type = GET("type", 0);
	$html = ($province_id>0)? makeListDistrict(0, "province_id=$province_id") : "";
	if ($type==0){
		$text0 = "Quận/Huyện";
	}else{
		$text0 = "Không thay đổi gì";
	}
	$first = "<option value='0'>$text0</option>";
	$html = $first.$html;
	echo $html;
	exit();
}
?>