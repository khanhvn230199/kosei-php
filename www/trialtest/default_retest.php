<?php
/**
 * Module: [Exam]
 * Posts function with $sub=default, $act=retest
 * Display detail of a post
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
function default_retest()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $isMobile, $_LANG_ID;
    //Begin GetVars
    if (!$core->_SESS->isLoggedin()) {
        redirectURL($clsRewrite->url_login());
    }
    $result_id = isset($_GET["result_id"]) ? $_GET["result_id"] : "";
    $slug = isset($_GET["slug"]) ? $_GET["slug"] : "";
    if (isset($_GET["result_id"]) && "$result_id" != $_GET["result_id"] && $_GET["result_id"] != "") {
        $act = "notfound";
        return;
    }
    //End GetVars
    //Begin Init
    $clsResults = new Results();
    $clsExam = new Exam();
    $clsQuestions = new Questions();

    if ($result_id == "" || $result_id == 0) {
        $act = "notfound";
        return;
    }
    $arrOneResult = $clsResults->getOne($result_id);
    $exam_id = intval($arrOneResult['exam_id']);
    //End Init
    $arrOneExam = $clsExam->getOneSimple($exam_id);
    if (!is_array($arrOneExam) || $arrOneExam["exam_id"] != $exam_id) {
        $act = "notfound";
        return;
    }
    $arrListOtherExams = $clsExam->getAllSimple("a.exam_id <> $exam_id AND a.lang_code='$_LANG_ID' AND a.is_online=1 LIMIT 5");//c.level_id = $arrOneExam[level_id] AND 
    $arrListQuestions = $clsQuestions->getAll("questions_id IN ($arrOneResult[questions]) AND lang_code = '$_LANG_ID' AND is_online = 1");
    if (is_array($arrListQuestions) && count($arrListQuestions) > 0) {
        foreach ($arrListQuestions as $q => $question) {
            $arrChild = $clsQuestions->getAll("exam_id = $exam_id AND parent_id = $question[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY rand()");
            if (is_array($arrChild) && count($arrChild) > 0) {
                foreach ($arrChild as $cq => $cquestions){
                    $arrChild[$cq]['child'] = $clsQuestions->getAll("exam_id = $exam_id AND parent_id = $cquestions[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY rand()");
                }
            }
            $arrListQuestions[$q]['child'] = $arrChild;
        }
    }

    //Begin Assign
    $assign_list["arrOneExam"] = $arrOneExam;
    $assign_list["arrListQuestions"] = $arrListQuestions;
    $assign_list["arrListOtherExams"] = $arrListOtherExams;
    //End Assign
    //Begin SEOmoz
    $page_title = $arrOneExam['name'];
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    unset($tags, $des);
    //End SEOmoz
}

?>