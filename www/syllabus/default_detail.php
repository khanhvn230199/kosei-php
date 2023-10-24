<?php
/**
 * Module: [articles]
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
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act;
    global $core, $isMobile, $_LANG_ID;
    //Begin GetVars
    $article_id = isset($_GET["article_id"]) ? $_GET["article_id"] : "";
    $slug = isset($_GET["slug"]) ? $_GET["slug"] : "";
    if (isset($_GET["article_id"]) && "$article_id" != $_GET["article_id"] && $_GET["article_id"] != "") {
        $act = "notfound";
        return;
    }
    //End GetVars
    //Begin Init
    $cat_id_thongbao = 12;
    $clsCategory = new Category();
    $clsArticles = new Articles();
    $clsUsers = new Users();

    $clsCategory->getParentArray();
    if ($article_id == "" || $article_id == 0) {
        if ($slug != "") {
            $arrTmp = $clsArticles->getByCond("slug='$slug'");
            if (is_array($arrTmp) && $arrTmp['article_id'] != 0) {
                $article_id = $arrTmp['article_id'];
            }
        } else {
            $act = "notfound";
            return;
        }
    }
    $article_id = intval($article_id);
    //End Init

    $arrOneSyllabus = $clsArticles->getOne($article_id);
    if (!is_array($arrOneSyllabus) || $arrOneSyllabus["article_id"] != $article_id) {
        $act = "notfound";
        return;
    }
    // Tags
    $tags = $arrOneSyllabus['tags'];
    $htmlTags = "";
    $arrListTags = array_filter(explode(",", $tags));
    if (is_array($arrListTags)) {
        foreach ($arrListTags as $k => $v) {
            $url_tags = url_tags($v);
            $htmlTags .= "<li class='nav-item'><a class='nav-link' href='$url_tags'>$v</a></li>";
        }
    }

    //Tăng lượt xem
    $clsArticles->updateOne($article_id, "view_num=view_num+1");
    $cat_id = $arrOneSyllabus["cat_id"];
    if ($cat_id > 0) {
        $curCat = $clsCategory->getOne($cat_id);
        if ($curCat['parent_id'] > 0) {
            $parCat = $clsCategory->getOne($curCat['parent_id']);
        }
    }
    $arrListOtherArticles = $clsArticles->getAllSimple("c.cat_id=$cat_id AND a.article_id<>$article_id ORDER BY a.reg_date DESC LIMIT 0,10");
    $arrAuthor = ($arrOneSyllabus['user_id'] > 0) ? $clsUsers->getOne($arrOneSyllabus['user_id']) : array();

    $arrListArticlesByCat = array();
    if ($curCat['parent_id'] > 0) {
        $arrListArticlesByCat = $clsCategory->getSubCatNews($curCat['parent_id'], 0);
    }
    if ($curCat['image'] == "") {
        $curCat['image'] = $parCat['image'];
    }

    //Begin Right Sidebar
    $arrListLatestArticles = $clsArticles->getListLastest();
    $assign_list["arrListLatestArticles"] = $arrListLatestArticles;
    //End Right Sidebar

    //Begin Assign
    $assign_list["curCat"] = $curCat;
    $assign_list["parCat"] = $parCat;
    $assign_list["arrOneSyllabus"] = $arrOneSyllabus;
    $assign_list["arrAuthor"] = $arrAuthor;
    $assign_list["htmlTags"] = $htmlTags;
    $assign_list["arrListOtherArticles"] = $arrListOtherArticles;
    $assign_list["arrListArticlesByCat"] = $arrListArticlesByCat;
    //End Assign
    //Begin SEOmoz
    $page_title = ($arrOneSyllabus['page_title'] != "") ? $arrOneSyllabus['page_title'] : $arrOneSyllabus['title'];
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    $_CONFIG['page_keywords'] = $arrOneSyllabus['meta_keywords'];
    $_CONFIG['page_description'] = $arrOneSyllabus['meta_des'];
    unset($tags, $des);
    //End SEOmoz
}

?>