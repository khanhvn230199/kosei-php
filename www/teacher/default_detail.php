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
    $article_id = isset($_GET["article_id"]) ? $_GET["article_id"] : "";
    $slug = isset($_GET["slug"]) ? $_GET["slug"] : "";
    if (isset($_GET["article_id"]) && "$article_id" != $_GET["article_id"] && $_GET["article_id"] != "") {
        $act = "notfound";
        return;
    }
    //End GetVars
    //Begin Init
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

    $arrOneTeacher = $clsArticles->getOne($article_id);
    if (!is_array($arrOneTeacher) || $arrOneTeacher["article_id"] != $article_id) {
        $act = "notfound";
        return;
    }
    // Tags
    $tags = $arrOneTeacher['tags'];
    $htmlTags = "";
    $arrListTags = array_filter(explode(",", $tags));
    if (is_array($arrListTags)) {
        foreach ($arrListTags as $k => $v) {
            $url_tags = $clsRewrite->url_tags($v);
            $htmlTags .= "<li class='nav-item'><a class='nav-link' href='$url_tags'>$v</a></li>";
        }
    }

    //Tăng lượt xem
    $clsArticles->updateOne($article_id, "view_num=view_num+1");
    $cat_id = $arrOneTeacher["cat_id"];
    if ($cat_id > 0) {
        $curCat = $clsCategory->getOne($cat_id);
        if ($curCat['parent_id'] > 0) {
            $parCat = $clsCategory->getOne($curCat['parent_id']);
        }
    }
    $arrListOtherTeacher = $clsArticles->getAllSimple("c.cat_id=$cat_id AND a.article_id<>$article_id ORDER BY a.reg_date DESC LIMIT 0,10");
    $arrAuthor = ($arrOneTeacher['user_id'] > 0) ? $clsUsers->getOne($arrOneTeacher['user_id']) : array();


    //Begin Assign
    $assign_list["curCat"] = $curCat;
    $assign_list["parCat"] = $parCat;
    $assign_list["arrOneTeacher"] = $arrOneTeacher;
    $assign_list["arrAuthor"] = $arrAuthor;
    $assign_list["htmlTags"] = $htmlTags;
    $assign_list["arrListOtherTeacher"] = $arrListOtherTeacher;
    //End Assign
    //Begin SEOmoz
    $page_title = ($arrOneTeacher['page_title'] != "") ? $arrOneTeacher['page_title'] : $arrOneTeacher['title'];
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    $_CONFIG['page_keywords'] = $arrOneTeacher['meta_keywords'];
    $_CONFIG['page_description'] = $arrOneTeacher['meta_des'];
    unset($tags, $des);
    //End SEOmoz
}

?>