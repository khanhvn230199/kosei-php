<?php
/**
 * Module: [Teacher]
 * Posts function with $sub=default, $act=detail
 * Display detail of a post
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
function default_detail()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $isMobile, $_LANG_ID;
    //Begin GetVars
    $exam_id = isset($_GET["exam_id"]) ? $_GET["exam_id"] : "";
    $slug = isset($_GET["slug"]) ? $_GET["slug"] : "";
    if (isset($_GET["exam_id"]) && "$exam_id" != $_GET["exam_id"] && $_GET["exam_id"] != "") {
        $act = "notfound";
        return;
    }
    //End GetVars
    //Begin Init
    $clsExam = new Exam();
    $clsQuestions = new Questions();

    if ($exam_id == "" || $exam_id == 0) {
        if ($slug != "") {
            $arrTmp = $clsExam->getByCond("slug='$slug'");
            if (is_array($arrTmp) && $arrTmp['exam_id'] != 0) {
                $exam_id = $arrTmp['exam_id'];
            }
        } else {
            $act = "notfound";
            return;
        }
    }
    $exam_id = intval($exam_id);
    //End Init
    $arrOneExam = $clsExam->getOneSimple($exam_id);
    if (!is_array($arrOneExam) || $arrOneExam["exam_id"] != $exam_id) {
        $act = "notfound";
        return;
    }
    $arrListOtherExams = $clsExam->getAllSimple("a.exam_id <> $exam_id AND c.level_id = $arrOneExam[level_id] AND a.lang_code='$_LANG_ID' AND a.is_online=1 LIMIT 5");
    $arrListQuestions = $clsQuestions->getAll("exam_id = $exam_id AND parent_id = 0 AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC");
    if (is_array($arrListQuestions) && count($arrListQuestions) > 0) {
        foreach ($arrListQuestions as $q => $question) {
            $arrChild = $clsQuestions->getAll("exam_id = $exam_id AND parent_id = $question[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1 LIMIT $question[question_limit]");
            if (is_array($arrChild) && count($arrChild) > 0) {
                foreach ($arrChild as $cq => $cquestions){
                    $arrChild[$cq]['child'] = $clsQuestions->getAll("exam_id = $exam_id AND parent_id = $cquestions[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1");
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