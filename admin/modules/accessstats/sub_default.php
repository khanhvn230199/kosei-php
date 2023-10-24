<?
/**
*  Default Action
*  @author		: Tran Anh Tuan ()
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?admin");
	$mon = isset($_POST['mon'])? $_POST['mon']:date('m');
	$day = isset($_POST['day'])? $_POST['day']:date('d');
	$year = isset($_POST['year'])? $_POST['year']:date('Y');
	$statsCls = new Stats();
	//$statsNewsCls = new StatsNews();
	//$newsCls = new News();
	$sessionCls = new Session();
	
	$aStats = $statsCls->getOne(1);
	$regdate = gmmktime(0, 0, 0, $mon, $day, $year);
	//$dbconn->debug = true;
	$intTotalOnline = $sessionCls->countItem();
	/*echo "<script>".$regdateHtml[0]."</script>";	*/
	$assign_list["regdateHtml"] = $regdateHtml;		
	$assign_list["aStats"] = $aStats;
	$assign_list["newsCls"] = $newsCls;
	$assign_list["statsNewsList"] = $statsNewsList;
	$assign_list["intTotalOnline"] = $intTotalOnline;
}
/**
*  Add a new Item
*  @author		: Tran Anh Tuan ()
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_viewonline(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;

	$clsButtonNav->set("Cancel", "/icon/undo.png", "?admin&mod=$mod");

	//$newsCls = new News();
	$sessionCls = new Session();
	
	$intTotalOnline = $sessionCls->countItem();
	$arrListSession = $sessionCls->getAll();

	$assign_list["intTotalOnline"] = $intTotalOnline;
	$assign_list["arrListSession"] = $arrListSession;	
}

/**
*  List all Item
*  @author		: Tran Anh Tuan ()
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_list(){
	global $assign_list;
}

/**
*  Show detail an Item
*  @author		: Tran Anh Tuan ()
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_detail(){
	global $assign_list;
}
?>