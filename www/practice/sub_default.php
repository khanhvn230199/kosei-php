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
    $clsLevel = new Level();

    $arrListLevel = $clsLevel->getAll("is_online = 1 AND lang_code = '$_LANG_ID' ORDER BY order_no");
    $assign_list['arrListLevel'] = $arrListLevel;
    //End Assign

    //Begin SEOmoz
    $page_title = $core->getLang('JLPT_exam_inventory');
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    //End SEOmoz
}

?>