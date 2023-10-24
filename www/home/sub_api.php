<?
define("APIKEY", "DVSEymSwHur1PGGSeuL3AmKxMW29XlgIQCtuGhdIZhlrEESopfkBXb2JQiP1D85r");
function api_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    exit();
}

/**
 * Lấy data của 1 user
 * */
function getData1User($user){
	$user['birthday'] = ($user['birthday']>0)? date("d/m/Y", $user['birthday']) : "";
	$user['reg_date'] = ($user['reg_date']>0)? date("d/m/Y", $user['reg_date']) : "";
	$user['last_visit'] = ($user['last_visit']>0)? date("d/m/Y", $user['last_visit']) : "";
	$user['gender'] = ($user['gender']>0)? "Male" : "Female";
	return array(
		"user_id"		=>	$user['user_id'],    			  
		"user_name"		=>	$user['user_name'],    			
		"avatar"		=>	($user['avatar']!="")? URL_UPLOADS."/".$user['avatar'] : "",
		"oauth_provider"=>	$user['oauth_provider'],
		"oauth_uid"		=>	$user['oauth_uid'],
		"fullname"		=>	$user['fullname'],
		"gender"		=>	$user['gender'],
		"birthday"		=>	$user['birthday'],
		"email"			=>	$user['email'],
		"phone"			=>	$user['phone'],
		"address"		=>	$user['address'],
		"reg_date"		=>	$user['reg_date'],
		"last_visit"	=>	$user['last_visit'],
		"active"		=>	$user['is_active'],
	);	
}

/**
 * Lấy data của 1 học thử
 * */
function getData1Trail($trail){
    $trail['reg_date'] = ($trail['reg_date']>0)? date("d/m/Y", $trail['reg_date']) : "";
    
    return array(
        "trial_id"          =>  $trail['trial_id'],                 
        "user_id"          =>  $trail['user_id'],                 
        "name"              =>  $trail['name'],                 
        "email"             =>  $trail['email'],                 
        "phone"             =>  $trail['phone'],                 
        "level_id"          =>  $trail['level_id'],                 
        "reg_date"          =>  $trail['reg_date'],                 
       
    );  
}


/**
 * Lấy danh sách kỳ thi thử
 * */
function getData1TestScore($score){
    $score['reg_date'] = ($score['reg_date']>0)? date("d/m/Y", $score['reg_date']) : "";
    
    return array(
        "trial_id"          =>  $score['trial_id'],                 
        "user_id"          =>  $score['user_id'],                 
        "name"              =>  $score['name'],                 
        "email"             =>  $score['email'],                 
        "phone"             =>  $score['phone'],                 
        "level_id"          =>  $score['level_id'],                 
        "reg_date"          =>  $score['reg_date'],                 
       
    );  
}



/*
	Upadte thông tin user
**/

function getData1Userinfo($user){
	return $getData1Userinfo;
}



function getData1Trial($trial){
	$trial['reg_date'] = ($trial['reg_date']>0)? date("d/m/Y", $trial['reg_date']) : "";
	return array(
	"lesson_id"		=>	$trial['lesson_id'],  
	"cat_id"		=>	$trial['cat_id'],  
	"name"			=>	$trial['name'],  
	"attachment"	=>	$trial['attachment'],  
	"video_id"		=>	$trial['video_id'],  
	"vimeo_id"		=>	$trial['vimeo_id'],  
	"image"			=>	($trial['image']!="")? URL_UPLOADS."/".$trial['image'] : "",
	"reg_date"		=>	$trial['reg_date'],
	"is_trial"		=>	$trial['is_trial'],
	"active"		=>	$trial['is_online'],

	);
}




function getData1Purchasedcourse($purchasedcourse){
	return array(
		"transaction_id" 	=> $purchasedcourse['transaction_id'],
		"user_id" 			=> $purchasedcourse['user_id'],
		"cat_id" 			=> $purchasedcourse['cat_id'], 
		"shipping_method" 	=> $purchasedcourse['shipping_method'], 
		"payment_method" 	=> $purchasedcourse['payment_method'], 
		"note" 				=> $purchasedcourse['note'], 
		"expired_time" 		=> $purchasedcourse['expired_time'], 
		"reg_date"			=> $purchasedcourse['reg_date'], 
		"status" 			=> $purchasedcourse['status'], 
		"name" 				=> $purchasedcourse['name'], 

	);

}

function getData1Question($question){
	return $question;
}


function getData1OneTestScore($score){

  return $score;
}

function getData1Highscores($highscores){
        
        return array(
        "fullname"    => $highscores['fullname'],
        "vocabulary_score"    => $highscores['vocabulary_score'],
        "reading_score"    => $highscores['reading_score'],
        "listening_score"    => $highscores['listening_score'],
        "total_score"    => $highscores['total_score'],

    );


}

function getData1Exams($exams){
    return $exams;
        
}



function getData1Stage($stage){
	return array(
		"stage_id" 		=> $stage['stage_id'],
		"cat_id" 		=> $stage['cat_id'],
		"name" 			=> $stage['name'],
		"des" 			=> $stage['des'],
		"cats" 			=> $stage['cats'],

	);
}

function getData1Otherlesson($otherlessons){
	$otherlessons['reg_date'] = ($otherlessons['reg_date']>0)? date("d/m/Y", $otherlessons['reg_date']) : "";
	return array(
		"lesson_id"		=>	$otherlessons['lesson_id'],    			  
		"cat_id"		=>	$otherlessons['cat_id'],    			
		"stage_id"		=>	$otherlessons['stage_id'],    			
		"name"			=>	$otherlessons['name'],    			
		"image"			=>	($otherlessons['image']!="")? URL_UPLOADS."/".$otherlessons['image'] : "",
		"video_id"		=>	$otherlessons['video_id'],
		"vimeo_id"		=>	$otherlessons['vimeo_id'],
		"duration"		=>	$otherlessons['duration'],
		"is_trial"		=>	$otherlessons['is_trial'],
		
	);
}




/*
* Đăng ký thi thử
*/


/*
* Lấy danh sách đăng ký thi thử
*/
function api_getListTrial()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Trial();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
        $arrJson["msg"] = "APIKEY is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10); if ($limit>100) $limit = 100;
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "reg_date DESC");
    $cond = "is_online=1";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit");
    $totalItem = $clsItems->countItem($cond);
    $datas = array();
    if (is_array($items)){
        foreach ($items as $key => $val){         
        $val['reg_date'] = ($val['reg_date']>0)? date("d/m/Y", $val['reg_date']) : "";          
          $data = array(
                "trial_id"    =>  $val['trial_id'],             
                "user_id"          =>  $val['user_id'],
                "name"          =>  $val['name'],
                "email"       =>  $val['email'],
                "phone"       =>  $val['phone'],
                "level_id"       =>  $val['level_id'],
                "reg_date"      =>  $val['reg_date'],
                "active"        =>  $val['is_online'],              
            );
            $datas[] = $data; 
        }
    }    

    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson["totalItem"] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();
}


/*
* Lấy chi tiết 1 đăng ký thi thử
*/
function api_getOneTrial()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Trial();
    $apikey = POST("apikey", "");
    $trial_id = POST("trial_id", 0);

    if ($apikey!=APIKEY || $trial_id == 0){
        $arrJson["msg"] = "APIKEY or Trial_id is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }
    $item = $clsItems->getOne($trial_id);
    $datas = array();

    $datas[] = getData1Trail($item);    



    $arrJson["msg"] = "";
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();
}


/*
* Bảng điểm của kỳ thi thử
*/


function api_getListTestScore()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new TrialTest();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
        $arrJson["msg"] = "APIKEY is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "tt_id DESC");
    $cond = "is_online=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit");
    $totalItem = $clsItems->countItem($cond);
    $datas = array();
    if (is_array($items)){
        foreach ($items as $key => $val){
            $val['reg_date']    = ($val['reg_date']>0)? date("d/m/Y", $val['reg_date']) : "";
            $val['start_date']  = ($val['start_date']>0)? date("d/m/Y", $val['start_date']) : "";
            $val['end_date']    = ($val['end_date']>0)? date("d/m/Y", $val['end_date']) : "";
            $data = array(
                "tt_id"         =>  $val['tt_id'],             
                "name"          =>  $val['name'],               
                "image"         =>  URL_UPLOADS."/".$val['image'],
                "reg_date"      =>  $val['reg_date'],
                "start_date"    =>  $val['start_date'],
                "end_date"      =>  $val['end_date'],
                "active"        =>  $val['is_online'],              
            );
            $datas[] = $data;
        }


    }
    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson["totalItem"] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

}



function api_getOneTestScore(){

    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID ,$dbconn;

    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new TrialTest();
    $clsTest = new Test();
    $clsCandidate = new Candidates();
    $apikey = POST("apikey", "");
    $tt_id = POST("tt_id", 0);
    $test_id = POST("test_id", 0);
    if ($apikey!=APIKEY || $tt_id==0){
        $arrJson["msg"] = "APIKEY or tt_id is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }
    $item = $clsItems->getOne($tt_id);    
    
    $datas = array();
    if (is_array($item)){      
            $item['reg_date']    = ($item['reg_date']>0)? date("d/m/Y", $item['reg_date']) : "";
            $item['start_date']  = ($item['start_date']>0)? date("d/m/Y", $item['start_date']) : "";
            $item['end_date']    = ($item['end_date']>0)? date("d/m/Y", $item['end_date']) : ""; 
        $data = array(
            "tt_id"         =>  $item['tt_id'],                
            "name"          =>  $item['name'],      
            "image"         =>  ($item['image']!="")? URL_UPLOADS."/".$item['image'] : "",        
            "end_date"      =>  $item['end_date'],
            "start_date"    =>  $item['start_date'],
            "end_date"      =>  $item['end_date'],
            "active"        =>  $item['is_online'],
        );

        // Get Test List
        $tests = $clsTest->getAll("tt_id=$tt_id ORDER BY name");     
            if (is_array($tests)){
                foreach ($tests as $k => $v){
                    $tests[$k] = getData1OneTestScore($v);

                }
            }
      
        $data['tests'] = $tests;


          // Top học viên đạt điểm cao
                        $sql = "SELECT a.*, b.*, c.fullname, c.avatar FROM _candidates a INNER JOIN (SELECT user_id, MAX(total_score) as max_score FROM _candidates WHERE test_id = $test_id GROUP BY user_id) AS b INNER JOIN _users c WHERE a.test_id = $test_id AND a.user_id = b.user_id AND a.user_id = c.user_id AND a.total_score = b.max_score AND a.total_score>0 GROUP BY a.user_id ORDER BY b.max_score DESC";

                        $highscores = $dbconn->GetAll($sql, false);

                        if (is_array($highscores)){
                            foreach ($highscores as $k => $v){
                                $highscores[$k] = getData1Highscores($v);
                            }
                        }
                        $data['highscores'] = $highscores;



        $datas[] = $data;
    }    

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();



}



/*
* Change Profile thông tin cá nhân
*/

function api_changeProfile()
{

    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $_LANG_ID;


	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsUsers = new Users();

    $apikey = POST("apikey", "");
    $user_id = POST("user_id","");
    $fullname = POST("fullname","");
    $ngay = POST("ngay","");
    $thang = POST("thang","");
    $nam = POST("nam","");
    $address = POST("address","");
    $province_id = POST("province_id","");
    $gender = POST("gender","");
    
    if ($apikey!=APIKEY || $user_id==""){
    	$arrJson["msg"] = "APIKEY or USERID is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }

    $ok = ($user_id>0)?  : 0;
    $datas = array();
    $data = array();
	$user = ($user_id>0)? $clsUsers->getOne($user_id) : 0;
	$error = array();
	if (is_array($user)){
        $avatar = $_FILES["avatar"];
		extract($_POST);
		if ($clsUsers->validateEditProfile($error)){			
			$_POST['birthday'] = strtotime("$thang/$ngay/$nam");

            if (is_array($avatar) && $avatar['size'] != 0) {
                $new_avatar = "";
                $ftmp_name = $avatar["tmp_name"];
                $fname = $avatar["name"];
                $errNo = 0;
                if (checkValidImageFile($avatar, "", "", $errNo)) {
                    if ($errNo == 0) {
                        $dir = DIR_UPLOADS . "/avatar/";
                        if (!file_exists($dir)) {
                            mkdir($dir);
                        }
                        $to_file = $user . "_" . $fname;
                        $ok = @move_uploaded_file($ftmp_name, $dir . $to_file);
                        if ($ok) {
                            $new_avatar = $to_file;
                            if ($user['avatar'] != "avatar/" . $to_file) {
                                unlink(DIR_UPLOADS . "/" . $user['avatar']);
                            }
                        }
                    }
                }
                if ($new_avatar != "") {
                    $clsUsers->doUpdateNewAvatar($user, $new_avatar);
                }
            }

			$ok = $clsUsers->doUpdateProfile($user_id);
			if ($ok) {
                $data['success'] = 1;                
            }else{
        		$data['success'] = 0;
            }
		}else{
			$data['success'] = 0;
		}
	}else{
		$data['success'] = 0;
	}

    $datas[] = $data;

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

}



/*
* Change Email thông tin cá nhân
*/

function api_updateEmail()
{
	global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $clsRewrite;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsUsers = new Users();

    $apikey = POST("apikey", "");
    $user_id = POST("user_id","");
    $email = POST("email","");

    if ($apikey!=APIKEY || $user_id==""){
    	$arrJson["msg"] = "APIKEY or USERID or USER_PASS or EMAIL is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }

    $datas = array();
    $data = array();
    $user = ($user_id>0)? $clsUsers->getOne($user_id) : 0;
    $error = array();
	if (is_array($user)){
		$valid = $clsUsers->validateEmail($email, "", $error);
        if ($valid) {        	
            $ok = $clsUsers->updateOne($user_id, "email='$email'");
            if ($ok) {
                $data['success'] = 1;                    
            }else{
        		$data['success'] = 0;
            }
        }else{
        	$data['success'] = 0;
        }
	}else{
		$data['success'] = 0;
	}

    $datas[] = $data;

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

}


/*
* Change Phone thông tin cá nhân
*/

function api_updatePhone()
{
	global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $clsRewrite;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsUsers = new Users();

    $apikey = POST("apikey", "");
    $user_id = POST("user_id","");
    $phone = POST("phone","");

    if ($apikey!=APIKEY || $user_id==""){
    	$arrJson["msg"] = "APIKEY or USERID  or PHONE is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }

    $datas = array();
    $data = array();
    $user = ($user_id>0)? $clsUsers->getOne($user_id) : 0;
    $error = array();
	if (is_array($user)){
	
            	
            $ok = $clsUsers->updateOne($user_id, "phone='$phone'");
            if ($ok) {
                $data['success'] = 1;                    
            }else{
        		$data['success'] = 0;
            }
      
	}else{
		$data['success'] = 0;
	}

    $datas[] = $data;

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

}




/*
* Change PASS thông tin cá nhân
*/

function api_updatePass()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $clsRewrite;
    global $core, $_LANG_ID;
    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsUsers = new Users();

    $apikey = POST("apikey", "");
    $user_id = POST("user_id", 0);
    $user_pass_old = POST("user_pass_old","");
    $user_pass = POST("user_pass","");
    $user_pass_confirm = POST("user_pass_confirm","");


    if ($apikey!=APIKEY || $user_id==0 || $user_pass_old=="" || $user_pass=="" || $user_pass_confirm==""){
        $arrJson["msg"] = "APIKEY or USERID  or PASSOLD or PASSNEW or PASSCONFIRM is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }

    $datas = array();
    $data = array();

    $arr_error = array();
    $msg = "";
    $valid = -1;
    $btnChangePass = "Register";
    if ($btnChangePass != "") {
        if ($user_id>0){
            $core->_USER = $clsUsers->getOne($user_id);
        }

        $valid = $clsUsers->validateChangePass($arr_error);
        if ($valid) {
            $ok = $clsUsers->updatePassword($user_id);
                if ($ok) {
                    $data['success'] = 1;     
                } else {
                    $msg = $core->getLang('Có lỗi xảy ra vui lòng thử lại!');
                }
            }else{
                $data['success'] = 0;
                $msg = $arr_error;
        }
    }
    
    $datas[] = $data;
    $arrJson["msg"] = $msg;    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

}




function api_register()

{

    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod , $clsRewrite ;
    global $core, $_LANG_ID;
    header('Content-Type: application/json; charset=utf-8');

    $clsUsers = new Users();

    $arrJson = array();
    $apikey = POST("apikey", "");
    $fullname = POST("fullname","");
    $user_name = POST("user_name","");
    $email = POST("email","");
    $mobile = POST("mobile","");
    $user_pass = POST("user_pass","");
    $user_pass_confirm = POST("user_pass_confirm","");
    $gender = POST("gender","");
    $_POST["agree"] = "agree";

    if ($apikey!=APIKEY || $fullname=="" || $user_name=="" || $email=="" || $mobile=="" || $user_pass="" || $user_pass_confirm="" || $gender==""){
        $arrJson["msg"] = "APIKEY or FULL NAME or USERNAME or EMAIL or MOBILE or PASS or PASSCONFIRM or GENDER";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }

    $datas = array();
    $data = array();

    $btnRegister = "Register";
    $valid = -1;
    $arr_error = array();
    $msg = "";
    if ($btnRegister != "") {
        $valid = $clsUsers->validateRegister($arr_error);
        if ($valid) {
            $ok = $clsUsers->doRegister();
            if ($ok) {
                $data['success'] = 1;
            } else {
                $data['success'] = 0;
                $msg = $core->getLang('Có lỗi xảy ra vui lòng thử lại!');
            }
        }else{            
            $data['success'] = 0;
            $msg = $arr_error;
        }
    }

    $datas[] = $data;

    $arrJson["msg"] = $msg;    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

}



/*
*  Lịch sử thi của 1 học viên
*/
function api_testHistory(){

global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
global $core, $_LANG_ID ,$dbconn;

    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsCandidate = new Candidates();
    $clsTest = new Test();
    $clsExam = new Exam();
    $clsQuestions = new Questions();

    $apikey = POST("apikey", "");
    $user_id = POST("user_id", 0);
    if ($apikey!=APIKEY || $user_id==0){
        $arrJson["msg"] = "APIKEY or USERID is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $sql = "SELECT * FROM _candidates a INNER JOIN _test b WHERE a.test_id = b.test_id AND user_id =$user_id ORDER BY a.reg_date DESC";
    $items = $dbconn->GetAll($sql, false);
    $datas = array();
    if (is_array($items)){
        foreach ($items as $key => $val){
             $val['reg_date'] = ($val['reg_date']>0)? date("d/m/Y", $val['reg_date']) : "";
            $data = array(
                "id"                =>  $val['id'],             
                "name"              =>  $val['name'],             
                "test_id"           =>  $val['test_id'],               
                "tt_id"             =>  $val['tt_id'],               
                "user_id"           =>  $val['user_id'],               
                "level_id"          =>  $val['level_id'],               
                "vocabulary_score"  =>  $val['vocabulary_score'],               
                "reading_score"     =>  $val['reading_score'],               
                "listening_score"   =>  $val['listening_score'],               
                "total_score"       =>  $val['total_score'],               
                "pass_score"        =>  $val['pass_score'],               
                "answers"           =>  $val['answers'],               
                "reg_date"          =>  $val['reg_date'],
                "active"            =>  $val['is_online'],              
            );
            $datas[] = $data;
        }
    }
    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();


}







/*
*  Đăng ký thi thử
*/

function api_registertrial()
{

    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod , $clsRewrite ;
    global $core, $_LANG_ID;


    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $apikey = POST("apikey", "");
    $user_id = POST("user_id","");
    $name = POST("name","");
    $phone = POST("phone","");
    $email = POST("email","");
    $level_id = POST("level_id","");


    if ($apikey!=APIKEY || $name=="" || $user_id=="" || $phone=="" || $email=="" || $level_id==""){
        $arrJson["msg"] = "APIKEY or FULL NAME or PHONE or EMAIL or LEVELID";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }

    $datas = array();
    $data = array();

    $reg_date = time();
    $clsTrial = new Trial();

    if ($email !='' && isEmail($email) && $clsTrial->insertOne(
        'name,phone,email,level_id,user_id,reg_date', 
        "'$name','$phone','$email','$level_id','$user_id',$reg_date"))

    {

        $data['success'] = 1;

    }  else {
        $data['success'] = 0;
                $msg = $core->getLang('Có lỗi xảy ra vui lòng thử lại!');
    }


    $datas[] = $data;

    $arrJson["msg"] = $msg;    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

}





/*
* Change Phone thông tin cá nhân
*/

function api_resetPass()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $clsRewrite;
    global $core, $_LANG_ID;
    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    
    $clsUsers = new Users();
    $clsPublicKey = new PublicKey();

    $apikey = POST("apikey", "");
    $user_name = POST("user_name", "");
    $email = POST("email","");

    if ($apikey!=APIKEY || $email=="" || $user_name==""){
        $arrJson["msg"] = "APIKEY or Email  is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }

    $datas = array();
    $data = array();

    $arr_error = array();
    $msg = "";

    $btnForgot = "Reset Pass";

    if ($btnForgot != "") {
            $valid = $clsUsers->validateForgot($arr_error);
            if ($valid) {
                $ok = $clsUsers->doForgot();
                if ($ok) {
                    $data['success'] = 1;     
                } else {
                     $msg = $core->getLang('Vui lòng nhập đúng thông tin đã đăng ký để có thể khôi phục mật khẩu!');
                }
            } else {
                if (is_array($arr_error) && count($arr_error) > 0) {
                    foreach ($arr_error as $e => $error) {
                        $message = $error;
                    }
                    $arr_error = array('status' => 'error', 'message' => $message);
                }
            }
        }

    
    $datas[] = $data;
    $arrJson["msg"] = $msg;    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

}




/*
* Lấy danh sách combo khóa học
*/
function api_getListCombo()
{
    
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Category();
    
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
        $arrJson["msg"] = "APIKEY is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "order_no ASC");
    $cond = "is_online=1 AND ctype=4 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit");
    $totalItem = $clsItems->countItem($cond);
    $datas = array();
    if (is_array($items)){
        foreach ($items as $key => $val){
            $data = array(
                "cat_id"        =>  $val['cat_id'],             
                "name"          =>  $val['name'],               
                "image"         =>  URL_UPLOADS."/".$val['image'],
                "level"         =>  $val['level_id'],
                "video_id"      =>  $val['video_id'],
                "duration"      =>  $val['duration'],
                "vimeo_id"      =>  $val['vimeo_id'],
                "price_vn"      =>  $val['price_vn'],
                "price_jp"      =>  $val['price_jp'],
                "description"   =>  $val['des'],
                "detail"        =>  $val['detail'],
                "instructions"  =>  $val['instructions'],
                "active"        =>  $val['is_online'],              
            );
            $datas[] = $data;
        }
    }
    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson["totalItem"] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();


}

/*
* Check login (user_name + user_pass)
*/
function api_checkUserLogin()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsUsers = new Users();
    $apikey = POST("apikey", "");
    $user_name = POST("user_name", "");
    $user_pass = POST("user_pass", "");
    if ($apikey!=APIKEY || $user_name=="" || $user_pass==""){
    	$arrJson["msg"] = "APIKEY or USER_NAME or USER_PASS is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $res = $clsUsers->checkValidUserPass($user_name, $user_pass); 
    $datas = array();
    $data = array();
    if (is_array($res) && !empty($res)){
    	$data['valid'] = 1;
    	$data['user'] = getData1User($res);
    }else{
    	$data['valid'] = 0;
    }
    $datas[] = $data;

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);

    exit();

}


/*
* Lấy danh sách Người dùng
*/
function api_getListUsers()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Users();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
    	$arrJson["msg"] = "APIKEY is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10); if ($limit>100) $limit = 100;
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "reg_date DESC");
    $cond = "is_active=1 AND user_group_id=2";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit");
    $totalItem = $clsItems->countItem($cond);
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){    		    	
    		$datas[] = getData1User($val);
    	}
    }    

    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson["totalItem"] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();
}
/*
* Lấy thông tin 1 Người dùng
*/
function api_getOneUser()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Users();
    $clsTransactions = new Transactions();
    $apikey = POST("apikey", "");
    $item_id = POST("user_id", 0);
    if ($apikey!=APIKEY || $item_id==0){
    	$arrJson["msg"] = "APIKEY or USERID is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $item = $clsItems->getOne($item_id);    
    $datas = array();
    if (is_array($item)){	

	$datas[] = getData1User($item);    

	// Khóa học đã mua
	$purchasedcourse= $clsTransactions->getAllTransactionsByUser($item_id);
	if (is_array($purchasedcourse)){
		foreach ($purchasedcourse as $k => $v){
			$purchasedcourse[$k] = getData1Purchasedcourse($v);
		}
	}
	$data['purchasedcourse'] = $purchasedcourse;

    }
    $datas[] = $data;


  

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();
}

/*
* Lấy thông tin 1 Người dùng đã mua khóa học
*/

/*

Mua khóa học
*/

function api_buycourses()
{

    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod , $clsRewrite ;
    global $core, $_LANG_ID;


    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $apikey = POST("apikey", "");
    $user_id = POST("user_id","");
    $fullname = POST("fullname","");
    $mobile = POST("mobile","");
    $cat_id = POST("cat_id","");
    $name = POST("name","");
    
    $payment_method = POST("payment_method","");
    $coupon = POST("coupon","");
    $note = POST("note","");
   
    if ($apikey!=APIKEY || $fullname=="" || $user_id=="" || $mobile==""){
        $arrJson["msg"] = "APIKEY or FULL NAME or Mobile";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }

    $datas = array();
    $data = array();


    $clsCoupon = new Coupon();
    $clsTransactions = new Transactions();
    $_LANG_ID = 'vn';

    // Get course info
    $course = (new Category)->getOne($cat_id);
    $price_vn = $course['price_vn'];
    $price_jp = $course['price_jp'];
    $expired_time = strtotime("+$course[duration] month");

    // Check coupon info
    $discount = $clsCoupon->getDiscount($coupon, $cat_id);

    if ($coupon != "" && is_array($discount)) {
        $price_vn = $discount['price_vn'];
        $price_jp = $discount['price_jp'];
    }
    // Check is exists?
    $reg_date = time();

    $transaction = $clsTransactions->getByCond("user_id = $user_id AND cat_id = $cat_id AND expired_time > $reg_date");

    if (is_array($transaction)) {

        $arrJson["msg"] = "Khoá học đã được đăng ký, vui lòng tải lại trang web.";
        $arrJson["code"] = 200;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }

    // Insert
    $field = "user_id, cat_id, coupon, payment_id, payment_method, price_vn, price_jp, expired_time, reg_date, lang_code, status, note";
    $value = "$user_id, $cat_id, '$coupon', $payment_method, $payment_method, $price_vn, $price_jp, $expired_time, $reg_date, '$_LANG_ID', 0, '$note'";

    if (!$clsTransactions->insertOne($field, $value)) {
        $arrJson["msg"] = "Có lỗi xảy ra. Vui lòng thử lại sau.";
        $arrJson["code"] = 200;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }

    $clsCoupon->useCoupon($coupon);
    $msg = "Gửi đăng ký thành công!";
    
    $datas[] = $data;

    $arrJson["msg"] = $msg;    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

}



/*
* Lấy danh sách Giáo trình
*/
function api_getListGiaoTrinh()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Articles();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
    	$arrJson["msg"] = "APIKEY is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "reg_date DESC");
    $cond = "is_online=1 AND ctype=3 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit");
    $totalItem = $clsItems->countItem($cond);
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$data = array(
    			"curriculum_id"	=>	$val['article_id'],    			
    			"name"			=>	$val['title'],
    			"sapo"			=>	$val['sapo'],
    			"content"		=>	$val['content'],
    			"image"			=>	URL_UPLOADS."/".$val['image'],
    			"view_num"		=>	$val['view_num'],
    			"active"		=>	$val['is_online'],    			
    		);
    		$datas[] = $data;
    	}
    }
    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson["totalItem"] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();
}


/*
* Lấy danh sách Giáo viên
*/
function api_getListGiaoVien()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Articles();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
    	$arrJson["msg"] = "APIKEY is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "reg_date DESC");
    $cond = "is_online=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit");
    $totalItem = $clsItems->countItem($cond);
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$data = array(
    			"teacher_id"	=>	$val['article_id'],    			
    			"name"			=>	$val['title'],
    			"sapo"			=>	$val['sapo'],
    			"content"		=>	$val['content'],
    			"image"			=>	URL_UPLOADS."/".$val['image'],
    			"view_num"		=>	$val['view_num'],
    			"active"		=>	$val['is_online'],    			
    		);
    		$datas[] = $data;
    	}
    }
    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson["totalItem"] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();
}


/*
* Lấy danh sách Trình Độ
*/
function api_getListLevel()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Level();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
    	$arrJson["msg"] = "APIKEY is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "order_no ASC");
    $cond = "is_online=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit");
    $totalItem = $clsItems->countItem($cond);
    $datas = array();

    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$val['reg_date'] = ($val['reg_date']>0)? date("d/m/Y", $val['reg_date']) : "";
    		$data = array(
    			"level_id"	=>	$val['level_id'],    			
    			"name"		=>	$val['name'],
    			"image"		=>	($val['image']!="")? URL_UPLOADS."/".$val['image'] : "",
    			"code"		=>	$val['code'],
    			"reg_date"	=>	$val['reg_date'],
    			"active"	=>	$val['is_online'],    			
    		);
    		$datas[] = $data;
    	}
    }
    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson["totalItem"] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();
}


/*
* Lấy danh sách Khóa học
*/
function api_getListDanhMucKhoaHoc()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Category();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
    	$arrJson["msg"] = "APIKEY is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "order_no ASC");
    $cond = "is_online=1 AND ctype=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit");
    $totalItem = $clsItems->countItem($cond);
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$data = array(
    			"cat_id"		=>	$val['cat_id'],    			
    			"name"			=>	$val['name'],    			
    			"image"			=>	URL_UPLOADS."/".$val['image'],
    			"level"			=>	$val['level_id'],
    			"video_id"		=>	$val['video_id'],
    			"duration"		=>	$val['duration'],
    			"vimeo_id"		=>	$val['vimeo_id'],
    			"price_vn"		=>	$val['price_vn'],
    			"price_jp"		=>	$val['price_jp'],
    			"description"	=>	$val['des'],
    			"detail"		=>	$val['detail'],
				"instructions"	=>	$val['instructions'],
    			"active"		=>	$val['is_online'],    			
    		);
    		$datas[] = $data;
    	}
    }
    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson["totalItem"] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();
}

/*
* Lấy thông tin một khóa học
*/
function api_getOneDanhMucKhoaHoc()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Category();
    $clsLessons = new Lessons();
    $clsQuestions = new Questions();
    $clsStage = new Stage();
    $apikey = POST("apikey", "");
    $item_id = POST("cat_id", 0);
    if ($apikey!=APIKEY || $item_id==0){
    	$arrJson["msg"] = "APIKEY or USERID is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $item = $clsItems->getOne($item_id);    
    $datas = array();
    if (is_array($item)){		
		$data = array(
			"cat_id"		=>	$item['cat_id'],    			
			"level"		=>	$item['level_id'],    			
			"name"			=>	$item['name'],    			
			"des"			=>	$item['des'],    			
			"detail"		=>	$item['detail'],    			
			"instructions"		=>	$item['instructions'],    			
			"image"			=>	($item['image']!="")? URL_UPLOADS."/".$item['image'] : "",
			"active"		=>	$item['is_online'],
		);

		//Lay Trial
		$trials = $clsLessons->getAllSimple("a.is_online =1 AND a.cat_id = $item_id AND a.video_id !='' AND a.is_trial=1 ORDER BY reg_date ASC LIMIT 0,1000");
		if (is_array($trials)){
			foreach ($trials as $k => $v){
				$trials[$k] = getData1Trial($v);
			}
		}
		$data['trials'] = $trials;

		//Lay Questions
		$bigQuestions = $clsQuestions->getAll("cat_id = $item_id AND parent_id=0 AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC");
		if (is_array($bigQuestions)) {
			foreach ($bigQuestions as &$bigQuestion) {
				$limit = "";

				if ($bigQuestion['question_limit'] > 0) {
					$limit = "LIMIT $bigQuestion[question_limit]";
				}

				$questions = $clsQuestions->getAll("parent_id = $bigQuestion[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC $limit");

				if (is_array($questions)) {
					foreach ($questions as &$question) {
						$smallQuestions = $clsQuestions->getAll("parent_id = $question[questions_id] AND is_online = 1 ORDER BY questions_id ASC");

						if (is_array($smallQuestions)) {
							foreach ($smallQuestions as &$smallQuestion) {
								getAnswers($smallQuestion);
							}

							$question['smallQuestions'] = $smallQuestions;
						} else {
							getAnswers($question);
						}
					}

					$bigQuestion['questions'] = $questions;

				} else {
					getAnswers($bigQuestion);
				}
			}
		}
		if (is_array($questions)){
			foreach ($questions as $k => $v){
				$questions[$k] = getData1Question($v);
			}
		}
		$data['questions'] = $bigQuestions;

		//Lay Giaidoan
		$stages = $clsStage->getAll("lang_code='$_LANG_ID' AND is_online=1 AND parent_id = 0 AND cat_id=$item_id ORDER BY order_no, reg_date ASC");
		if ($stages) {
			foreach ($stages as $key => $stage) {
				$cats = $clsStage->getAll("parent_id = {$stage['stage_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");

				if (is_array($cats)) {

					foreach ($cats as $key2 => $cat) {
						$lessons = $clsLessons->getAll("lang_code = '$_LANG_ID' AND is_online=1 AND stage_id={$cat['stage_id']} AND parent_id=0");

						if (is_array($lessons)) {
							foreach ($lessons as $k => $v) {
								$lessons[$k]['sublessons'] = $clsLessons->getAll("parent_id = {$v['lesson_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");
							}

							$cats[$key2]['lessons'] = $lessons;
						}
					}
				}

				$stages[$key]['cats'] = $cats;
			}
		}
		if (is_array($stages)){
			foreach ($stages as $k => $v){
				$stages[$k] = getData1Stage($v);
			}
		}
		$data['stages'] = $stages;

		$datas[] = $data;
    }    

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();
}



/*
* Danh sách kỳ thi thử
* Lựa chọn thời gian thi thử
*/
function api_getListBaiThiThu()
{

   global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Test();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
        $arrJson["msg"] = "APIKEY is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }
    $now = time();
    $clsTrialTest = new TrialTest();
    $arrOneTrialTesst = $clsTrialTest->getByCond("start_date<=$now AND end_date>=$now AND lang_code='$_LANG_ID' ORDER BY reg_date ASC LIMIT 1");
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "order_no ASC");
    $cond = "a.is_online=1 AND a.tt_id = $arrOneTrialTesst[tt_id] AND a.lang_code='$lang'";
   
    $items = $clsItems->getAllSimple("$cond ORDER BY $orderby LIMIT $start, $limit");
    $totalItem = $clsItems->countItem($cond);
    $datas = array();
    if (is_array($items)){
        foreach ($items as $key => $val){
            $val['reg_date'] = ($val['reg_date']>0)? date("d/m/Y", $val['reg_date']) : "";
            $data = array(
                "tt_id"             =>  $val['tt_id'],    
                "test_id"           =>  $val['test_id'],                  
                "level_id"          =>  $val['level_id'],   
                "name"              =>  $val['name'], 
                "image"             =>  URL_UPLOADS."/".$val['image'],
                "pass_score"        =>  $val['pass_score'],   
                "reg_date"          =>  $val['reg_date'],   
                "duration"          =>  $val['duration'],   
                "level_name"        =>  $val['level_name'], 
                "code"              =>  $val['code'], 
                "active"            =>  $val['is_online'], 
                             
            );
            $datas[] = $data;
        }
    }
    $arrJson["msg"] = "";
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson["totalItem"] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();


}


/*
* Lấy danh sách điểm học viên thi thủ
* Lấy theo test_id List bài thi thử
*/
function api_getListDiemThiThuHocVien()
{

    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID ,$dbconn;
    header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Test();

    $apikey = POST("apikey", "");
    $item_id = POST("test_id", 0);
    if ($apikey!=APIKEY || $item_id==0){
        $arrJson["msg"] = "APIKEY or TESTID is invalid";
        $arrJson["code"] = 404;
        $arrJson["error"] = 1;
        echo json_encode($arrJson);
        exit();
    }
    $item = $clsItems->getOne($item_id); 

    $datas = array();
    if (is_array($item)){       
            $item['reg_date'] = ($item['reg_date']>0)? date("d/m/Y", $item['reg_date']) : "";
        $data = array(

                "tt_id"             =>  $item['tt_id'],     
                "test_id"           =>  $item['test_id'],             
                "level_id"          =>  $item['level_id'],   
                "name"              =>  $item['name'], 
                "image"             =>  URL_UPLOADS."/".$item['image'],
                "pass_score"        =>  $item['pass_score'],   
                "reg_date"          =>  $item['reg_date'],   
                "duration"          =>  $item['duration'],   
                "level_name"        =>  $item['level_name'], 
                "code"              =>  $item['code'], 
                "active"            =>  $item['is_online'], 
        );

    $clsExam = new Exam();
    $clsQuestions = new Questions();
    // Lấy các kỹ năng thi thử
    $exams = $clsExam->getAll("is_online=1 AND test_id = $item_id AND lang_code='$_LANG_ID' ORDER BY order_no asc");
        foreach ($exams as &$exam) {
            $bigQuestions = $clsQuestions->getAll("exam_id = $exam[exam_id] AND parent_id = 0 AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC");

            if (is_array($bigQuestions)) {

                foreach ($bigQuestions as &$bigQuestion) {
                    $limit = "";

                    if ($bigQuestion['question_limit'] > 0) {
                        $limit = "LIMIT $bigQuestion[question_limit]";
                    }

                    $questions = $clsQuestions->getAll("exam_id = $exam[exam_id] AND parent_id = $bigQuestion[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC $limit");

                    if (is_array($questions)) {
                        foreach ($questions as &$question) {
                            $smallQuestions = $clsQuestions->getAll("parent_id = $question[questions_id] AND is_online = 1 ORDER BY questions_id ASC");

                            if (is_array($smallQuestions)) {
                                foreach ($smallQuestions as &$smallQuestion) {
                                    getAnswers($smallQuestion);
                                }

                                $question['smallQuestions'] = $smallQuestions;
                            } else {
                                getAnswers($question);
                            }
                        }

                        $bigQuestion['questions'] = $questions;

                    } else {
                        getAnswers($bigQuestion);
                    }
                }
            }

            $exam['bigQuestions'] = $bigQuestions;
        }

      if (is_array($exams)){
            foreach ($exams as $k => $v){
                $exams[$k] = getData1Exams($v);
            }
        }
        $data['exams'] = $exams;


        // Top học viên đạt điểm cao
        $sql = "SELECT a.*, b.*, c.fullname, c.avatar FROM _candidates a INNER JOIN (SELECT user_id, MAX(total_score) as max_score FROM _candidates WHERE test_id = $item_id GROUP BY user_id) AS b INNER JOIN _users c WHERE a.test_id = $item_id AND a.user_id = b.user_id AND a.user_id = c.user_id AND a.total_score = b.max_score AND a.total_score>0 GROUP BY a.user_id ORDER BY b.max_score DESC";

        $highscores = $dbconn->GetAll($sql, false);

        if (is_array($highscores)){
            foreach ($highscores as $k => $v){
                $highscores[$k] = getData1Highscores($v);
            }
        }
        $data['highscores'] = $highscores;

        $datas[] = $data;
    }    

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);

    exit();



}


/*
* Lấy danh sách Giai Đoạn
* Lấy theo cat_id (Khóa học N1 , N2 , N3 , N4 , N5)
*/
function api_getListGiaiDoan()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Stage();
    $apikey = POST("apikey", "");
    $item_id = POST("cat_id", 0);
    if ($apikey!=APIKEY){
    	$arrJson["msg"] = "APIKEY is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }

    $clsStage = new Stage();
    $clsLessons = new Lessons();
    $stages = $clsStage->getAll("lang_code='$_LANG_ID' AND is_online=1 AND parent_id = 0 AND cat_id=$item_id ORDER BY order_no, reg_date ASC");
	if ($stages) {
		foreach ($stages as $key => $stage) {
			$cats = $clsStage->getAll("parent_id = {$stage['stage_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");

			if (is_array($cats)) {

				foreach ($cats as $key2 => $cat) {
					$lessons = $clsLessons->getAll("lang_code = '$_LANG_ID' AND is_online=1 AND stage_id={$cat['stage_id']} AND parent_id=0");

					if (is_array($lessons)) {
						foreach ($lessons as $k => $v) {
							$lessons[$k]['sublessons'] = $clsLessons->getAll("parent_id = {$v['lesson_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");
						}

						$cats[$key2]['lessons'] = $lessons;
					}
				}
			}

			$stages[$key]['cats'] = $cats;
		}
	}
	if (is_array($stages)){
		foreach ($stages as $k => $v){
			$stages[$k] = getData1Stage($v);
		}
	}

    if (is_array($stages)){
    	$datas = $stages;
    }
    $arrJson["msg"] = "";
    $arrJson["totalItem"] = count($stages);    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();
}




/*
* Lấy thông tin một bài học
*/
function api_getOneBaiHoc()
{
  
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite, $VIMEO_API, $isMobile, $_LANG_ID, $core, $dbconn;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Lessons();
    $clsCategory = new Category();
    $clsQuestions = new Questions();
    $clsStage = new Stage();
    $apikey = POST("apikey", "");
    $item_id = POST("lesson_id", 0);
    if ($apikey!=APIKEY || $item_id==0){
    	$arrJson["msg"] = "APIKEY or LESSONID is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $item = $clsItems->getOne($item_id);    
    $datas = array();
    if (is_array($item)){		
    	$item['reg_date'] = ($item['reg_date']>0)? date("d/m/Y", $item['reg_date']) : "";
    	$item_parent_id = $item['parent_id'];
		$data = array(
			"lesson_id"		=>	$item['lesson_id'],    			  
			"cat_id"		=>	$item['cat_id'],    			
			"parent_id"		=>	$item['parent_id'],    			
			"stage_id"		=>	$item['stage_id'],    			
			"name"			=>	$item['name'],    			
			"video_id"		=>	$item['video_id'],    			
			"vimeo_id"		=>	$item['vimeo_id'],    			
			"duration"		=>	$item['duration'],    			
			"image"			=>	($item['image']!="")? URL_UPLOADS."/".$item['image'] : "",
			"reg_date"		=>	$item['reg_date'],
			"active"		=>	$item['is_online'],
		);

		// Bài học liên quan
		$otherlessons = $clsItems->getAll("parent_id = $item_parent_id AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");
		if (is_array($otherlessons)){
			foreach ($otherlessons as $k => $v){
				$otherlessons[$k] = getData1Otherlesson($v);
			}
		}
		$data['otherlessons'] = $otherlessons;

		// Bài tập nếu có 
		$bigQuestions = $clsQuestions->getAll("lesson_id = $item_id AND parent_id=0 AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC");
		if (is_array($bigQuestions)) {
			foreach ($bigQuestions as &$bigQuestion) {
				$limit = "";
				if ($bigQuestion['question_limit'] > 0) {
					$limit = "LIMIT $bigQuestion[question_limit]";
				}
				$questions = $clsQuestions->getAll("parent_id = $bigQuestion[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC $limit");
				if (is_array($questions)) {
					foreach ($questions as &$question) {
						$smallQuestions = $clsQuestions->getAll("parent_id = $question[questions_id] AND is_online = 1 ORDER BY questions_id ASC");

						if (is_array($smallQuestions)) {
							foreach ($smallQuestions as &$smallQuestion) {
								getAnswers($smallQuestion);
							}

							$question['smallQuestions'] = $smallQuestions;
						} else {
							getAnswers($question);
						}
					}
					$bigQuestion['questions'] = $questions;
				} else {
					getAnswers($bigQuestion);
				}
			}
		}
		if (is_array($questions)){
			foreach ($questions as $k => $v){
				$questions[$k] = getData1Question($v);
			}
		}
		$data['questions'] = $bigQuestions;
		// End
	
		$datas[] = $data;
    }    

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
   
    exit();
}




/*
* Lấy danh sách Giai Đoạn Con
* * Lấy theo parent_id ( Giao Đoạn Cha)	

*/
function api_getGiaiDoanCon()
{
   
   global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Stage();
    $apikey = POST("apikey", "");
    $item_id = POST("parent_id", 0);
    if ($apikey!=APIKEY || $item_id==0){
    	$arrJson["msg"] = "APIKEY or parent_id is invalid";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "order_no ASC");
    $cond = "parent_id = '$item_id' AND is_online=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit"); 
    $totalItem = $clsItems->countItem($cond);
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$val['reg_date'] = ($val['reg_date']>0)? date("d/m/Y", $val['reg_date']) : "";
    		$data = array(
    			"stage_id"		=>	$val['stage_id'],    			  
				"cat_id"		=>	$val['cat_id'],    			
				"parent_id"		=>	$val['parent_id'],    			
				"name"			=>	$val['name'],    			
				"des"			=>	$val['des'],    			
				"image"			=>	($val['image']!="")? URL_UPLOADS."/".$val['image'] : "",
				"reg_date"		=>	$val['reg_date'],
				"active"		=>	$val['is_online'],   			
		    		);
    		$datas[] = $data;
    	}
    } 

    $arrJson["msg"] = "";    
    $arrJson['data'] = $datas;
    $arrJson['totalItem'] = $totalItem;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();

}



/*
* Lấy danh sách bài giảng
*/

function api_getAllListBaiGiang()
{
   
   global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Lessons();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
    	$arrJson["msg"] = "APIKEY";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "order_no ASC");
    $cond = "is_online=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit"); 
    $totalItem = $clsItems->countItem($cond); 
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$val['reg_date'] = ($val['reg_date']>0)? date("d/m/Y", $val['reg_date']) : "";
    		$data = array(
    			"lesson_id"			=>	$val['lesson_id'],    			  
				"parent_id"			=>	$val['parent_id'],    			
				"cat_id"			=>	$val['cat_id'],    			
				"stage_id"			=>	$val['stage_id'],    			
				"user_id"			=>	$val['user_id'],    			
				"name"				=>	$val['name'],    			
				"is_trial"			=>	$val['is_trial'],  
				"des"				=>	$val['des'],    			
				"image"				=>	($val['image']!="")? URL_UPLOADS."/".$val['image'] : "",
				"reg_date"			=>	$val['reg_date'],
				"active"			=>	$val['is_online'],   			
		    		);
    		$datas[] = $data;
    	}
    } 

    $arrJson["msg"] = "";    
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson['totalItem'] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();

}




/*
* Lấy danh sách bài giảng
*/

function api_getListBaiHoc()
{
   
   global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Lessons();
    $apikey = POST("apikey", "");
    $item_id = POST("lesson_id", 0);
    if ($apikey!=APIKEY || $item_id==0){
    	$arrJson["msg"] = "APIKEY";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "order_no ASC");
    $cond = "parent_id ='$item_id' AND is_online=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit"); 
    $totalItem = $clsItems->countItem($cond); 
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$val['reg_date'] = ($val['reg_date']>0)? date("d/m/Y", $val['reg_date']) : "";
    		$data = array(
    			"lesson_id"			=>	$val['lesson_id'],    			  
				"parent_id"			=>	$val['parent_id'],    			
				"cat_id"			=>	$val['cat_id'],    			
				"stage_id"			=>	$val['stage_id'],    			
				"user_id"			=>	$val['user_id'],    			
				"video_id"			=>	$val['video_id'],    			
				"vimeo_id"			=>	$val['vimeo_id'],    			
				"duration"			=>	$val['duration'],    			
				"name"				=>	$val['name'],    		
				"attachment"		=>	($val['attachment']!="")? URL_UPLOADS."/".$val['attachment'] : "",
				"image"				=>	($val['image']!="")? URL_UPLOADS."/".$val['image'] : "",	
				"is_trial"			=>	$val['is_trial'],  
				"reg_date"			=>	$val['reg_date'],
				"active"			=>	$val['is_online'],   			
		    		);
    		$datas[] = $data;
    	}
    } 

    $arrJson["msg"] = "";    
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson['totalItem'] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();

}


/*
* Lấy danh sách tất cả câu hỏi theo bài học
*/

function api_getAllListCauhoi()
{
   
   global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Questions();
    $apikey = POST("apikey", "");
    if ($apikey!=APIKEY){
    	$arrJson["msg"] = "APIKEY";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "reg_date DESC");
    $cond = "is_online=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit"); 
    $totalItem = $clsItems->countItem($cond); 
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$data = array(
    			"questions_id"			=>	$val['questions_id'],    			  
				"parent_id"				=>	$val['parent_id'],    			
				"cat_id"				=>	$val['cat_id'],    			
				"exam_id"				=>	$val['exam_id'],    			
				"lesson_id"				=>	$val['lesson_id'],    			
				"name"					=>	$val['name'],    			
				"point"					=>	$val['point'],  
				"question_limit"		=>	$val['question_limit'],    			
				"attachment"					=>	($val['attachment']!="")? URL_UPLOADS."/".$val['attachment'] : "",	
				"question"				=>	$val['question'],    			
				"video_id"				=>	$val['video_id'],    			
				"answer_a"				=>	$val['answer_a'],    			
				"answer_b"				=>	$val['answer_b'],    			
				"answer_c"				=>	$val['answer_c'],    			
				"answer_d"				=>	$val['answer_d'],    			
				"correct_answer"		=>	$val['correct_answer'],    			
			
				"active"				=>	$val['is_online'],   			
		    		);
    		$datas[] = $data;
    	}
    } 

    $arrJson["msg"] = "";    
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson['totalItem'] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();

}


/*
* Lấy danh sách câu hỏi theo khóa học , giai đoạn , bài học
*/

function api_getListCauhoi()
{
   
   global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Questions();
    $apikey = POST("apikey", "");
   	$item_id = POST("lesson_id", 0);
   	$item_id1 = POST("questions_id", 0);
    if ($apikey!=APIKEY || $item_id == 0 || $item_id1 == 0){
    	$arrJson["msg"] = "APIKEY or lesson_id is invalid or questions_id invalid ";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "reg_date DESC");
    $cond = "lesson_id='$item_id' AND questions_id='$item_id1' AND is_online=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit"); 
    $totalItem = $clsItems->countItem($cond); 
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$data = array(
    			"questions_id"			=>	$val['questions_id'],    			  
				"parent_id"				=>	$val['parent_id'],    			
				"cat_id"				=>	$val['cat_id'],    			
				"exam_id"				=>	$val['exam_id'],    			
				"lesson_id"				=>	$val['lesson_id'],    			
				"name"					=>	$val['name'],    			
				"point"					=>	$val['point'],  
				"question_limit"		=>	$val['question_limit'],    			
				"attachment"			=>	($val['attachment']!="")? URL_UPLOADS."/".$val['attachment'] : "",	
				"question"				=>	$val['question'],    			
				"video_id"				=>	$val['video_id'],    			
				"answer_a"				=>	$val['answer_a'],    			
				"answer_b"				=>	$val['answer_b'],    			
				"answer_c"				=>	$val['answer_c'],    			
				"answer_d"				=>	$val['answer_d'],    			
				"correct_answer"		=>	$val['correct_answer'],    			
			
				"active"				=>	$val['is_online'],   			
		    		);
    		$datas[] = $data;
    	}
    } 

    $arrJson["msg"] = "";    
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson['totalItem'] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();

}



/*
* Lấy danh sách câu hỏi theo khóa học , giai đoạn , bài học
*/

function api_getListCauhoiNho()
{
   
   global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
	header('Content-Type: application/json; charset=utf-8');
    $arrJson = array();
    $clsItems = new Questions();
    $apikey = POST("apikey", "");
   	$item_id = POST("lesson_id", 0);
   	$item_id1 = POST("parent_id", 0);
    if ($apikey!=APIKEY || $item_id == 0 || $item_id1 == 0){
    	$arrJson["msg"] = "APIKEY or lesson_id is invalid or questions_id invalid ";
    	$arrJson["code"] = 404;
    	$arrJson["error"] = 1;
    	echo json_encode($arrJson);
    	exit();
    }
    $start = POST("start", 0);
    $limit = POST("limit", 10);
    $lang = POST("lang", "vn");
    $orderby = POST("orderby", "reg_date DESC");
    $cond = "lesson_id='$item_id' AND parent_id='$item_id1' AND is_online=1 AND lang_code='$lang'";
    $items = $clsItems->getAll("$cond ORDER BY $orderby LIMIT $start, $limit"); 
    $totalItem = $clsItems->countItem($cond); 
    $datas = array();
    if (is_array($items)){
    	foreach ($items as $key => $val){
    		$data = array(
    			"questions_id"			=>	$val['questions_id'],    			  
				"parent_id"				=>	$val['parent_id'],    			
				"cat_id"				=>	$val['cat_id'],    			
				"exam_id"				=>	$val['exam_id'],    			
				"lesson_id"				=>	$val['lesson_id'],    			
				"name"					=>	$val['name'],    			
				"point"					=>	$val['point'],  
				"question_limit"		=>	$val['question_limit'],    			
				"attachment"					=>	($val['attachment']!="")? URL_UPLOADS."/".$val['attachment'] : "",	
				"question"				=>	$val['question'],    			
				"video_id"				=>	$val['video_id'],    			
				"answer_a"				=>	$val['answer_a'],    			
				"answer_b"				=>	$val['answer_b'],    			
				"answer_c"				=>	$val['answer_c'],    			
				"answer_d"				=>	$val['answer_d'],    			
				"correct_answer"		=>	$val['correct_answer'],    			
			
				"active"				=>	$val['is_online'],   			
		    		);
    		$datas[] = $data;
    	}
    } 

    $arrJson["msg"] = "";    
    $arrJson["start"] = $start;
    $arrJson["limit"] = $limit;
    $arrJson['totalItem'] = $totalItem;
    $arrJson['data'] = $datas;
    $arrJson["code"] = 200;
    $arrJson["error"] = 0;
    echo json_encode($arrJson);
    exit();

    exit();

}









/**
 * Gửi email nhắc học: những ai đang học mà lâu không vào học lại
 * */
function api_nhachoc(){
	global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    global $dbconn;

    $now = time();
    $last5day = $now - 5*24*3600;
    $last30day = $now - 30*24*3600;

	$sql = "SELECT DISTINCT(a.user_id), a.user_name, a.email, a.last_visit, a.fullname, a.last_sent_mail FROM _users AS a JOIN _transactions AS b ON a.user_id = b.user_id WHERE a.is_active = 1 AND b.status=2 AND a.last_visit < $last5day";
	$arr = $dbconn->GetAll($sql);

	$list_users = array();
	$arr_bcc = $arr_user_id = array();
	$c = 0;
	if (is_array($arr)){
		foreach ($arr as $key => $val){
			if ($val['last_sent_mail']==0 || $val['last_sent_mail'] < $last30day){
				$c++;
				if ($c<100){
					$list_users[] = $val;
					if ($val['email']!=""){
						$arr_bcc[] = $val['email'];
					}
					$arr_user_id[] = $val['user_id'];
				}
			}
		}
	}

	if (!empty($list_users)){
		$to = $_CONFIG['webmaster_email'];
		//$bcc = implode(";", $arr_bcc);
		echo $bcc = "phuonghvmonkey@gmail.com,phuonghv@dichvuso.vn,tuanta@dichvuso.vn";

		$post = array();
		$ok = send_mail_form("mail_nhachoc", $to, $post, $bcc);

		if ($ok){
			$list_user_id = implode(",", $arr_user_id);
			$last_sent_mail = time();
			$sql = "UPDATE _users SET last_sent_mail=$last_sent_mail WHERE user_id IN ($list_user_id)";
			//$dbconn->Execute($sql);
		}
	}

	exit();

}
?>