<?php

// function getAnswers(&$question)
// {
//     $answers = array();

//     foreach (['a', 'b', 'c', 'd'] as $char) {
//         if ($question['answer_' . $char]) {
//             $answers[] = array(
//                 "id" => $question['questions_id'] . "_" . $char,
//                 "name" => $question['questions_id'],
//                 "text" => $question['answer_' . $char],
//                 "point" => $question['point'],
//                 "ctype" => $question['ctype'],
//                 "is_correct" => $question['correct_answer'] === 1 || strtolower($question['correct_answer']) === $char,
//             );
//         }
//     }

//     $question['answers'] = $answers;

//     return $question;
// }

function default_history()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite, $core, $_LANG_ID, $dbconn;

    require_once DIR_COMMON . "/clsPaging.php";

    if (!$core->_SESS->isLoggedin()) {
        redirectURL($clsRewrite->url_home());
    }

    $clsTransactions = new Transactions();
    $clsCandidates = new Candidates();
    $clsTest = new Test();
    $clsExam = new Exam();
    $clsQuestions = new Questions();

    $user_id = $core->_USER['user_id'];

    // Lấy danh sách giao dịch
    $arrListTransactions = $clsTransactions->getAllTransactionsByUser($user_id);

    // Lấy danh sách thi thử
    // $sql = "SELECT * FROM _candidates a INNER JOIN _test b WHERE a.test_id = b.test_id ORDER BY a.reg_date DESC";
    // phuonghv add 12/07/2021
      $sql = "SELECT * FROM _candidates a INNER JOIN _test b WHERE a.test_id = b.test_id AND user_id =$user_id ORDER BY a.reg_date DESC";
    // End
    $candidates = $dbconn->GetAll($sql, false);

    // print_r($candidates);
    // die();

    // Lấy danh sách câu hỏi
    $candidate_id = GET("candidate_id");

    if ($candidate_id) {
        $candidate = $clsCandidates->getOne($candidate_id);

        if (is_array($candidate)) {
            $test_id = $candidate['test_id'];

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

            $assign_list['candidate'] = $candidate;
            $assign_list['exams'] = $exams;
        }
    }

    $assign_list['arrListTransactions'] = $arrListTransactions;
    $assign_list['candidates'] = $candidates;

    //Begin SeoMoz
    $page_title = $core->getLang("Activation_account");
    $_CONFIG["page_title"] = $page_title . " - " . $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz
}
