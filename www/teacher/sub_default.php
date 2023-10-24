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
    //Begin GetVars
    $cat_id = isset($_GET["cat_id"]) ? $_GET["cat_id"] : 0;
    $cat_id = intval($cat_id);
    $slug = isset($_GET["slug"]) ? $_GET["slug"] : "";
    //End GetVars
    //Begin Init
    if (isset($_GET["cat_id"]) && "$cat_id" != $_GET["cat_id"] && $_GET["cat_id"] != "") {
        showErrorFatalBox("notfound");
        exit();
    }
    $clsArticles = new Articles();
    $clsCategory = new Category();
    $clsCategory->getParentArray();
    $curCat = array();
    if ($slug != "") {
        $arrTmp = $clsCategory->getBySlug($slug);
        if (is_array($arrTmp) && $arrTmp['cat_id'] != 0) {
            $cat_id = $arrTmp['cat_id'];
        }
    }
    if ($cat_id > 0) {
        $curCat = $clsCategory->getOne($cat_id);
        if ($curCat['parent_id'] > 0) {
            $parCat = $clsCategory->getOne($curCat['parent_id']);
        }
        $h1_title = $curCat['name'];
    } else {
        $h1_title = "Tin tức";
        $parCat = 0;
    }
    //End Init
    //Begin SQl Condition
    $cond = "a.lang_code='$_LANG_ID' AND a.is_online=1 AND a.ctype=" . CTYPE_GV;
    if ($cat_id != "" && $cat_id != "0") {
        $cat_id_str = $clsCategory->getAllCatStr($cat_id) . $cat_id;
        $cond .= (strpos($cat_id_str, ',') !== false) ? " AND a.cat_id in ($cat_id_str)" : " AND a.cat_id=$cat_id";
    }
    $orderby = " ORDER BY a.reg_date DESC";

    //End SQL Condition
    //Begin Paging
    $rowPerPage = 12;
    $curPage = (isset($_GET["page"]) && $_GET["page"] > 0) ? ($_GET["page"]) : 0;
    $clsPaging = new Paging($curPage, $rowPerPage, "news");
    $clsPaging->setBaseURL($clsRewrite->url_category($curCat));
    $cond_count = str_replace('a.', '', $cond);
    $totalItem = $clsArticles->countItem($cond_count);
    $clsPaging->setTotalRows($totalItem);
    $clsPaging->setShowStatstic(false);
    $clsPaging->setShowGotoBox(false);
    $assign_list["clsPaging"] = $clsPaging;
    //End Paging
    //Begin ListArticles
    $arrListTeacher = $clsArticles->getAllSimple($clsPaging->getQueryLimit($cond . $orderby));
    if ($curCat['parent_id'] == 0) {
        $arrListTeacherByCat = $clsCategory->getSubCatNews($cat_id);
    } else {
        $arrListTeacherByCat = $clsCategory->getSubCatNews($curCat['parent_id'], 0);
        if ($curCat['template'] == "default") {
            $curCat['template'] = "list";
        }
        if ($curCat['image'] == "") {
            $curCat['image'] = $parCat['image'];
        }
    }
    //End ListArticles

    //Begin Assign
    $assign_list["curCat"] = $curCat;
    $assign_list["parCat"] = $parCat;
    $assign_list["arrListTeacher"] = $arrListTeacher;
    $assign_list["arrListTeacherByCat"] = $arrListTeacherByCat;
    $assign_list["totalItem"] = $totalItem;
    $assign_list["h1_title"] = $h1_title;
    $assign_list["rowPerPage"] = $rowPerPage;
    //End Assign
    //Begin SEOmoz
    $page_title = ($curCat['page_title'] != "") ? $curCat['page_title'] : $curCat['name'];
    if ($page_title == "") $site_title = "Tin tức";
    $page_title .= " - " . $_CONFIG['site_title'];
    $tags = $curCat['meta_keywords'];
    $page_keywords = ($tags != "") ? $tags : $_CONFIG['meta_keywords'];
    $des = $curCat['meta_des'];
    $page_description = ($des != "") ? $des : $_CONFIG['site_description'];
    $_CONFIG['page_title'] = $page_title;
    $_CONFIG['page_keywords'] = $page_keywords;
    $_CONFIG['page_description'] = $page_description;
    //End SEOmoz
}

?>