<?
/******************************************************
 * Child Module of module [articles]
 *
 * Contain functions of child module: [default], each function has prefix is 'default_'
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  index.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        20/01/2018        banglcb          -        -     -     -
 *
 ********************************************************/
/**
 * Module: [articles]
 * Category function with $sub=default, $act=default
 * Display Category Page, display list of posts
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $_LANG_ID;
    require_once DIR_COMMON . "/clsPaging.php";
    $level_id = isset($_GET["level_id"]) ? $_GET["level_id"] : "";
    $skill_id = isset($_GET["skill_id"]) ? $_GET["skill_id"] : "";
    if ($level_id == "" && $skill_id == "") {
        $act = "notfound";
        return;
    }

    $clsExam = new Exam();
    $clsUser = new Users();
    $arrListExams = $clsExam->getAllSimple("c.level_id = $level_id AND a.skill_id = $skill_id AND a.is_online = 1 AND a.test_id = 0 AND a.lang_code ='$_LANG_ID' ORDER BY a.order_no LIMIT 15");
    if (is_array($arrListExams) && count($arrListExams) > 0) {
        foreach ($arrListExams as $r => $result) {
            $arrListExams[$r]['list_user'] = $clsUser->getAll("user_id IN (SELECT user_id FROM _results) LIMIT 3");
        }
    }

    $assign_list['arrListExams'] = $arrListExams;

    $assign_list["rowPerPage"] = 15;
    //End Assign

    //Begin SEOmoz
    $page_title = $core->getLang('JLPT_exam_inventory');
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    //End SEOmoz
}

?>