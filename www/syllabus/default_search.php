<?php
/**
 * Module: [Articles]
 * Posts function with $sub=default, $act=search
 * Display search of a articles
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
function default_search()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    $clsArticles = new Articles();
    $clsCategory = new Category;
    $clsCategory->getParentArray();
    require_once DIR_COMMON . "/clsPaging.php";

    $key = $_GET['key'];
    if ($key != '') {
        $slug = utf8_nosign_noblank($key);
        $cond = "is_online = 1 AND lang_code = '$_LANG_ID' AND title LIKE '%$key%' OR sapo LIKE '%$key%' OR content LIKE '%$key%' OR slug LIKE '%$slug%' ORDER BY reg_date DESC";
    }
    //Begin Paging
    $rowPerPage = 12;
    $curPage = (isset($_GET["page"]) && $_GET["page"] > 0) ? ($_GET["page"]) : 0;

    $clsPaging = new Paging($curPage, $rowPerPage, "articles");
    $clsPaging->setBaseURL(VNCMS_URL . "/articles/search?key=$key");
    $totalItem = $clsArticles->countItem($cond);
    $arrListArticles = $clsArticles->getAllSimple2($clsPaging->getQueryLimit($cond));

    $clsPaging->setTotalRows($totalItem);
    $clsPaging->setShowStatstic(false);
    $clsPaging->setShowGotoBox(false);

    //End Paging

    $assign_list["totalItem"] = $totalItem;
    $assign_list["arrListArticles"] = $arrListArticles;
    $assign_list["clsPaging"] = $clsPaging;
    $assign_list["key"] = $key;

}

?>