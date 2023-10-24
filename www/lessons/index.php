<?
/******************************************************
 * SubIndex File of module: [products]
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
//Call to run module (products, $sub, $act)
$clsModule->run($sub, $act);

/*Load Menu START*/
$clsMenu = new Menu();
$assign_list["arrListTopMenu"] = $clsMenu->getAllMenuLink(0, "top");
$assign_list["arrListMainMenu"] = $clsMenu->getAllMenuLink(0, "main");
$assign_list["arrListBottomMenu"] = $clsMenu->getAllMenuLink(0, "bottom");
/*Load Menu END*/

$clsSlider = new Sliders();
$arrListSlider = $clsSlider->getListOn('main');
if (is_array($arrListSlider)) {
    foreach ($arrListSlider as $key => $val) {
        $arrListSlider[$key]['vars'] = unserialize($val['vars']);
    }
}
$assign_list["arrListSlider"] = $arrListSlider;

//Assign vars to $assign_list
$assign_list["sub"] = $sub;
$assign_list["act"] = $act;
?>