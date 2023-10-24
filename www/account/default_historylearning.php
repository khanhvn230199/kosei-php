<?php 
function default_historylearning(){


    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite, $VIMEO_API, $isMobile, $_LANG_ID, $core, $dbconn;

    require_once DIR_COMMON . "/clsPaging.php";

    if (!$core->_SESS->isLoggedin()) {
        redirectURL($clsRewrite->url_home());
    }

    $clsTransactions = new Transactions();
    $clsCategory = new Category();
    $clsCandidates = new Candidates();
    $clsTest = new Test();
    $clsExam = new Exam();
    $clsQuestions = new Questions();
    $clsStage = new Stage();
    $clsLessons = new Lessons();


    $user_id = $core->_USER['user_id'];
    
    // Lấy danh sách giao dịch khóa học đã mua
    $arrListTransactions = $clsTransactions->getAllTransactionsByUser($user_id);

    if (is_array($arrListTransactions)){
        foreach ($arrListTransactions as $key => $cat){
            if ($cat['status']!=2) continue;
            $row = $clsLessons->getCatHistory($user_id, $cat['cat_id']);            
            if (is_array($row) && !empty($row)){
                $arrListTransactions[$key]['total_time'] = $row['total_time'];
                $arrListTransactions[$key]['first_time'] = $row['first_time'];
                $arrListTransactions[$key]['last_time'] = $row['last_time'];
            }
        }
    }    
    //print_r($arrListTransactions);
    $cat_id = GET("cid", 0);
 
    // Lấy danh sách giai đoạn và bài học khóa học đã mua
    
    $stages = 0;
    if ($cat_id>0){

    $arrOneCourse = $clsCategory->getByCond("is_online =1 AND cat_id = $cat_id");
    $assign_list["arrOneCourse"] = $arrOneCourse;

    // lấy bài học gần đây nhất dự vào thời gian học cuối cùng 
    $sql = "SELECT `lesson_id`, MAX(last_time) FROM _study_history WHERE user_id = $user_id AND course_id =$cat_id";
    // echo $sql;
    $arrone = $dbconn->GetAll($sql);
    if (is_array($arrone)){
        foreach ($arrone as $k => $v) {
                
            $lessons_id = $v['lesson_id'];
            $arrOneLesson = $clsLessons->getByCond("is_online = 1 AND lesson_id = $lessons_id");

            // print_r($arrOneLesson);

            $assign_list["arrOneLesson"] = $arrOneLesson;
        }

    }
    //End 

       
    $stages = $clsStage->getAll("lang_code='$_LANG_ID' AND is_online=1 AND parent_id = 0 AND cat_id=$cat_id ORDER BY order_no, reg_date ASC");
    }
    // print_r( $stages);
    // die();

    if (is_array($stages) && !empty($stages)) {
        foreach ($stages as $key => $stage) {
            $cats = $clsStage->getAll("parent_id = {$stage['stage_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");

            if (is_array($cats)) {

                foreach ($cats as $key2 => $cat) {
                    $lessons = $clsLessons->getAll("lang_code = '$_LANG_ID' AND is_online=1 AND stage_id={$cat['stage_id']} AND parent_id=0");

                    if (is_array($lessons)) {
                        foreach ($lessons as $k => $v) {
                            $sublessons = $clsLessons->getAll("parent_id = {$v['lesson_id']} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");

                            if (is_array($sublessons)){
                                foreach ($sublessons as $kk => $vv){
                                    $studyhistory = $clsLessons->getStudyHistory($user_id, $vv['lesson_id']);
                                    $total_time = $studyhistory['total_time'];
                                    $sublessons[$kk]['total_time'] = $total_time;
                                }
                            }

                            $lessons[$k]['sublessons'] = $sublessons;                            
                        }

                        $cats[$key2]['lessons'] = $lessons;
                    }
                }
            }

            $stages[$key]['cats'] = $cats;
        }
    }


    $assign_list['arrListTransactions'] = $arrListTransactions;
    $assign_list["stages"] = $stages;
    //Begin SeoMoz
    $page_title = $core->getLang("Activation_account");
    $_CONFIG["page_title"] = $page_title . " - " . $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz




}










 ?>