<?
function ajax_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    exit();
}

function ajax_save_score()
{
    global $core, $_LANG_ID;
    $clsResutls = new Results();
    $clsExam = new Exam();
    $user_id = $core->_USER['user_id'];
    if (is_array($_POST) && count($_POST) != 0 && $user_id != 0) {
        $arrOneExam = $clsExam->getOne($_POST['exam_id']);
        $arrOneResult = $clsResutls->getByCond("user_id = $user_id AND exam_id = $_POST[exam_id] AND questions = '$_POST[questions]' AND lang_code='$_LANG_ID'");
        $status = 0;
        if (is_array($arrOneExam) && count($arrOneExam) != 0 && $arrOneExam['pass_score'] >= $_POST['scores']) {
            $status = 1;
        }

        $field = "user_id, lang_code, reg_date, status";
        $value = "$user_id, '$_LANG_ID', " . time() . ", $status";
        $set = "status = $status";
        foreach ($_POST as $f => $v) {
            $field .= ", $f";
            $value .= ", '$v'";
            if ($f != "exam_id") {
                $set .= ", $f = '$v'";
            }
        }

        if (!is_array($arrOneResult) || count($arrOneResult) == 0) {
            $clsResutls->insertOne($field, $value);
        } else {
            $clsResutls->updateOne($arrOneResult['result_id'], $set);
        }
        echo "$status";
    }
    exit();
}

?>