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

    $arrOneArticle = $clsArticles->getOne($article_id);
    if (!is_array($arrOneArticle) || $arrOneArticle["article_id"] != $article_id) {
        $act = "notfound";
        return;
    }
    // Tags
    $tags = $arrOneArticle['tags'];
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
    $cat_id = $arrOneArticle["cat_id"];
    if ($cat_id > 0) {
        $curCat = $clsCategory->getOne($cat_id);
        if ($curCat['parent_id'] > 0) {
            $parCat = $clsCategory->getOne($curCat['parent_id']);
        }
    }
    $arrListOtherArticles = $clsArticles->getAllSimple("c.cat_id=$cat_id AND a.article_id<>$article_id ORDER BY a.reg_date DESC LIMIT 0,10");
    $arrAuthor = ($arrOneArticle['user_id'] > 0) ? $clsUsers->getOne($arrOneArticle['user_id']) : array();

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
    $assign_list["arrOneArticle"] = $arrOneArticle;
    $assign_list["arrAuthor"] = $arrAuthor;
    $assign_list["htmlTags"] = $htmlTags;
    $assign_list["arrListOtherArticles"] = $arrListOtherArticles;
    $assign_list["arrListArticlesByCat"] = $arrListArticlesByCat;
    //End Assign
    //Begin SEOmoz
    $page_title = ($arrOneArticle['page_title'] != "") ? $arrOneArticle['page_title'] : $arrOneArticle['title'];
    $page_title .= " - " . $_CONFIG['site_title'];
    $tags = $arrOneArticle['meta_keywords'];
    $page_keywords = ($tags != "") ? $tags : $_CONFIG['meta_keywords'];
    $des = $arrOneArticle['meta_des'];
    $page_description = ($des != "") ? $des : $_CONFIG['site_description'];
    $_CONFIG['page_title'] = $page_title;
    $_CONFIG['page_keywords'] = $page_keywords;
    $_CONFIG['page_description'] = $page_description;
    unset($tags, $des);
    //End SEOmoz
}

?>