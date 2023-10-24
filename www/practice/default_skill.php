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
function default_skill()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $isMobile, $_LANG_ID;
    //Begin GetVars
    $level_id = isset($_GET["level_id"]) ? $_GET["level_id"] : "";
    if (isset($_GET["level_id"]) && "$level_id" != $_GET["level_id"] && $_GET["level_id"] != "") {
        $act = "notfound";
        return;
    }
    //End GetVars
    //Begin Init
    $clsSkills = new Skills();
    $arrListSkills = $clsSkills->getAll("is_online = 1 AND lang_code = '$_LANG_ID' AND level_id = $level_id AND skill_id IN (SELECT skill_id FROM _exam as e INNER JOIN _category c on e.cat_id = c.cat_id WHERE c.level_id = $level_id) ORDER BY order_no");

    //Begin Assign
    $assign_list['arrListSkills'] = $arrListSkills;
    //End Assign
    //Begin SEOmoz
    $page_title = $core->getLang("Choose_skill");
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    unset($tags, $des);
    //End SEOmoz
}

?>