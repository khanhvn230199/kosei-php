<?

function default_default ()
{
    global $assign_list, $_CONFIG;
    global $core, $_LANG_ID;

    require_once DIR_COMMON . "/clsPaging.php";

    // echo 123;

    $clsTest = new Test();
    $clsTrialTest = new TrialTest();
    $clsCandidates = new Candidates();
    $clsUser = new Users();
    $clsLevel = new Level();
    $now = time();
    $user_id = $core->_USER['user_id'];

    $arrOneTrialTesst = $clsTrialTest->getByCond("start_date<=$now AND end_date>=$now AND lang_code='$_LANG_ID' ORDER BY reg_date ASC LIMIT 1");

    $arrOneCandidates = $clsCandidates->getByCond("user_id=$user_id AND tt_id = $arrOneTrialTesst[tt_id]");

    $arrListTest = $clsTest->getAllSimple("a.is_online = 1 AND a.tt_id = $arrOneTrialTesst[tt_id] LIMIT 15");
    // print_r( $arrListTest );
    // a.level_id = $arrOneCandidates[level_id] AND

    if (is_array($arrListTest) && count($arrListTest) > 0) {
        foreach ($arrListTest as $r => $result) {
            $arrListTest[$r]['list_user'] = $clsUser->getAll("user_id IN (SELECT user_id FROM _candidates) LIMIT 3");
        }
    }

    // Lấy trình đội ở mod trình độ
    $arrListLevels = $clsLevel->getAll("is_online =1 AND lang_code ='$_LANG_ID' ORDER BY order_no ASC ");
    // print_r($arrListLevels);
    // End

    $arrOneLatestTest = $clsTrialTest->getByCond("start_date>=$now AND lang_code='$_LANG_ID' ORDER BY reg_date ASC LIMIT 1");
    $arrOneCandidates = $clsCandidates->getByCond("user_id=$user_id AND tt_id = $arrOneLatestTest[tt_id]");

    $assign_list['arrListTest'] = $arrListTest;
    $assign_list['arrOneLatestTest'] = $arrOneLatestTest;
    $assign_list['arrOneCandidates'] = $arrOneCandidates;
    $assign_list['arrListLevels'] = $arrListLevels;
    $assign_list["optionLevel"] = makeListLevel($assign_list['level_id']);


    $assign_list["rowPerPage"] = 15;
    // End Assign

    // Begin SEOmoz
    $page_title = $core->getLang('JLPT_exam_inventory');
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    // End SEOmoz
}
