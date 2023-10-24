<?

function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $core, $_LANG_ID;

    $clsArticles = new Articles();
    $clsPages = new Pages();
    $clsLessons = new Lessons();
    $clsCategory = new Category();

    $arrListPages = $clsPages->getAll("lang_code = '$_LANG_ID' AND is_online = 1 AND at_home = 1 ORDER BY order_no");
    $arrListTeacher = $clsArticles->getAll("lang_code = '$_LANG_ID' AND ctype= " . CTYPE_GV . " AND is_online = 1 ORDER BY reg_date DESC LIMIT 4");

    // Lấy danh sách khoá học
    $courses = $clsCategory->getAll("is_online=1 AND ctype=" . CTYPE_KH . " ORDER BY order_no ASC");

    // Lấy danh sách các combo khoá học
    $combos = $clsCategory->getAll("is_online=1 AND ctype=" . CTYPE_CB . " ORDER BY order_no ASC");

    // Lấy các bài giảng xem thử theo trình độ N5 -> N2
    $trialLevels = (new Level)->getAll("is_online=1 ORDER BY order_no");

    if (is_array($trialLevels)) {
        $trialLevels = array_map(function ($level) use ($clsLessons) {
            $level_id = $level['level_id'];
            $level['lessons'] = $clsLessons->getAll("is_online=1 AND is_trial=1 AND parent_id<>0 AND cat_id in (SELECT cat_id FROM _category WHERE level_id=$level_id) ORDER BY reg_date");

            return $level;
        }, $trialLevels);
    }

    // print_r($trialLevels);


    $homeBanners = (new Adver)->getByPosition("banner");

    $assign_list['arrListPages'] = $arrListPages;
    $assign_list['arrListTeacher'] = $arrListTeacher;
    // $assign_list['arrListTrialLessons'] = $arrListTrialLessons;
    $assign_list['arrOnePromotion'] = $clsCategory->getOnePromotion();
    $assign_list['courses'] = $courses;
    $assign_list['combos'] = $combos;
    $assign_list['trialLevels'] = $trialLevels;
    $assign_list['homeBanners'] = $homeBanners;

    //Begin SeoMoz
    $_CONFIG["page_title"] = $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz
}



function default_page()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act;
    global $core, $_LANG_ID;
    $slug = GET("slug", "");
    $clsPages = new Pages();
    $arrOnePage = $clsPages->getBySlug($slug);
    //Assign to smarty
    $assign_list["arrOnePage"] = $arrOnePage;
    //Begin SEOmoz
    $clsMenu = new Menu();
    $assign_list["arrListMainMenu"] = $clsMenu->getAllMenuLink(0, "main-pages");
    $page_title = ($arrOnePage['page_title'] != "") ? $arrOnePage['page_title'] . " - " . $_CONFIG['site_title'] : $arrOnePage['name'] . " - " . $_CONFIG['site_title'];
    $tags = $arrOnePage['meta_keywords'];
    $page_keywords = ($tags != "") ? $tags : $_CONFIG['meta_keywords'];
    $des = $arrOnePage['meta_des'];
    $page_description = ($des != "") ? $des : $_CONFIG['site_description'];
    $_CONFIG['page_title'] = $page_title;
    $_CONFIG['page_keywords'] = $page_keywords;
    $_CONFIG['page_description'] = $page_description;
    unset($tags, $des);
    //End SEOmoz
}
