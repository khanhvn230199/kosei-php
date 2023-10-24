<?php

function default_preview()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $isMobile, $_LANG_ID, $dbconn;

    //Begin GetVars
    $test_id = isset($_GET["test_id"]) ? $_GET["test_id"] : "";
    $slug = isset($_GET["slug"]) ? $_GET["slug"] : "";

    if (isset($_GET["test_id"]) && "$test_id" != $_GET["test_id"] && $_GET["test_id"] != "") {
        $act = "notfound";
        return;
    }
    //End GetVars

    //Begin Init
    $clsTrialTest = new TrialTest();
    $clsTest = new Test();
    $clsExam = new Exam();
    $clsQuestions = new Questions();
    $clsCandidates = new Candidates();
    $clsUser = new Users();

    $arrOneUser = $clsUser->getOne($core->_USER['user_id']);

    if ($test_id == "" || $test_id == 0) {
        if ($slug != "") {
            $arrTmp = $clsExam->getByCond("slug='$slug'");
            if (is_array($arrTmp) && $arrTmp['test_id'] != 0) {
                $test_id = $arrTmp['test_id'];
            }
        } else {
            $act = "notfound";
            return;
        }
    }

    $test_id = intval($test_id);
    //End Init

    $arrOneTest = $clsTest->getOneSimple("a.test_id=$test_id AND a.lang_code='$_LANG_ID' AND a.is_online = 1");
    if (!is_array($arrOneTest) || $arrOneTest["test_id"] != $test_id) {
        $act = "notfound";
        return;
    }

    // Lấy các kỹ năng
    $exams = $clsExam->getAll("is_online=1 AND test_id = $test_id AND lang_code='$_LANG_ID' ORDER BY order_no asc");

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

    // Top học viên đạt điểm cao
    $sql = "SELECT a.*, b.*, c.fullname, c.avatar FROM _candidates a INNER JOIN (SELECT user_id, MAX(total_score) as max_score FROM _candidates WHERE test_id = $test_id GROUP BY user_id) AS b INNER JOIN _users c WHERE a.test_id = $test_id AND a.user_id = b.user_id AND a.user_id = c.user_id AND a.total_score = b.max_score AND a.total_score>0 GROUP BY a.user_id ORDER BY b.max_score DESC";

    $highScores = $dbconn->GetAll($sql, false);

    if (!$dbconn->Execute($sql)) {
        trigger_error("Cannot run SQL: `$sql`", E_USER_ERROR);
        return 0;
    }

    // Assign
    $assign_list["arrOneUser"] = $arrOneUser;
    $assign_list["arrOneTest"] = $arrOneTest;
    $assign_list["arrListOtherTest"] = $arrListOtherTest;
    $assign_list["exams"] = $exams;
    // $assign_list["arrListExams"] = $arrListExams;
    $assign_list["highScores"] = $highScores;

    //Begin SEOmoz
    $page_title = $arrOneTest['name'];
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;

    unset($tags, $des);
}

function default_preview_old()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $isMobile, $_LANG_ID;
    //Begin GetVars
    $test_id = isset($_GET["test_id"]) ? $_GET["test_id"] : "";
    $slug = isset($_GET["slug"]) ? $_GET["slug"] : "";
    if (isset($_GET["test_id"]) && "$test_id" != $_GET["test_id"] && $_GET["test_id"] != "") {
        $act = "notfound";
        return;
    }
    //End GetVars

    //Begin Init
    $clsTrialTest = new TrialTest();
    $clsTest = new Test();
    $clsExam = new Exam();
    $clsQuestions = new Questions();

    if ($test_id == "" || $test_id == 0) {
        if ($slug != "") {
            $arrTmp = $clsExam->getByCond("slug='$slug'");
            if (is_array($arrTmp) && $arrTmp['test_id'] != 0) {
                $test_id = $arrTmp['test_id'];
            }
        } else {
            $act = "notfound";
            return;
        }
    }
    $clsUser = new Users();
    $arrOneUser = $clsUser->getOne($core->_USER['user_id']);
    $test_id = intval($test_id);
    //End Init
    $now = time();
    $arrOneTest = $clsTest->getOneSimple("a.test_id=$test_id");
    if (!is_array($arrOneTest) || $arrOneTest["test_id"] != $test_id) {
        $act = "notfound";
        return;
    }

    $arrListOtherTest = $clsTest->getAllSimple("a.test_id <> $test_id AND a.level_id = $arrOneTest[level_id] AND a.lang_code='$_LANG_ID' AND a.start_date <= $now AND a.end_date >= $now AND a.is_online=1 LIMIT 5");

    $arrListExams = $clsExam->getAll("is_online=1 AND test_id = $test_id AND lang_code='$_LANG_ID' ORDER BY order_no asc");
    if (is_array($arrListExams) && count($arrListExams) > 0) {
        foreach ($arrListExams as $e => $exam) {
            $arrListQuestions = $clsQuestions->getAll("exam_id = $exam[exam_id] AND parent_id = 0 AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC");
            if (is_array($arrListQuestions) && count($arrListQuestions) > 0) {
                foreach ($arrListQuestions as $q => $question) {
                    $limit = "";
                    if ($question['question_limit'] > 0) {
                        $limit = "LIMIT $question[question_limit]";
                    }
                    $arrChild = $clsQuestions->getAll("exam_id = $exam[exam_id] AND parent_id = $question[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC $limit");
                    if (is_array($arrChild) && count($arrChild) > 0) {
                        foreach ($arrChild as $cq => $cquestions) {
                            $arrChild[$cq]['child'] = $clsQuestions->getAll("exam_id = $exam[exam_id] AND parent_id = $cquestions[questions_id] AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY questions_id ASC");
                        }
                    }
                    $arrListQuestions[$q]['child'] = $arrChild;
                }
            }
            $arrListExams[$e]['questions'] = $arrListQuestions;
        }
    }

    //Begin Assign
    $assign_list["arrOneUser"] = $arrOneUser;
    $assign_list["arrOneTest"] = $arrOneTest;
    $assign_list["arrListOtherTest"] = $arrListOtherTest;
    $assign_list["arrListExams"] = $arrListExams;
    //End Assign
    //Begin SEOmoz
    $page_title = $arrOneTest['name'];
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    unset($tags, $des);
    //End SEOmoz
}
