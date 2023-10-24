<?
/******************************************************
 * SubIndex File of module: [news]
 *
 * Control Module depend on 2 vars $sub, $act
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
 * 1.0        20/01/2018        Tuanta          -        -     -     -
 *
 ********************************************************/
//If run alone
if (!defined("VNCMS_DIR")) {
    die("Access denied!");
}

$sub = $stdio->GET("sub", "default");
$act = $stdio->GET("act", "default");
//Initialize class Module with param: $mod
$clsModule = new Module($mod);
//Call to run module (news, $sub, $act)
$clsModule->run($sub, $act);

$clsSlider = new Sliders();

$arrListSlider = $clsSlider->getListOn('main');
if (is_array($arrListSlider)) {
    foreach ($arrListSlider as $key => $val) {
        $arrListSlider[$key]['vars'] = unserialize($val['vars']);
    }
}
$assign_list["arrListSlider"] = $arrListSlider;

/*Load Menu START*/
global $_LANG_ID;
$clsCategory = new Category();
$clsArticles = new Articles();
$arrListCat = $clsCategory->getAll("is_online=1 AND lang_code='$_LANG_ID' AND ctype=" . CTYPE_BV);
if (is_array($arrListCat) && count($arrListCat) > 0) {
    foreach ($arrListCat as $key => $value) {
        $arrListCat[$key]['total_news'] = $clsArticles->countItem("is_online=1 AND lang_code='$_LANG_ID' AND cat_id=$value[cat_id]");
    }
}
$assign_list['arrListCat'] = $arrListCat;

//Assign vars to $assign_list
$assign_list["sub"] = $sub;
$assign_list["act"] = $act;
?>