<?
/******************************************************
 * Class Menu
 *
 * Menu Handling
 * 
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:  
 * Program ID                 :  class_Menu.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	2014/02/10    	Banglcb          -  		-     -     -
 *
 ********************************************************/
class Menu extends dbBasic{
	function Menu(){
		$this->pkey = "menu_id";
		$this->tbl 	= "_menu";
	}	
	//SELECT
	function getAllMenu($mtype="horizon1", $parent_id=0){//horizon | vertical
		global $lang_code;
		$cond = "mtype='$mtype' AND lang_code='$lang_code' AND is_online=1";		
		$cond.= " AND parent_id=$parent_id";
		return $this->getAll("$cond ORDER BY order_no");
	}
	function getParentArray(){
		global $dbconn;
		$sql = "SELECT menu_id, mtype, name, order_no, parent_id, is_online FROM ".$this->tbl." WHERE is_online=1 ORDER BY order_no, menu_id";		
		$arrListMenu1 = $dbconn->GetAll($sql);
		$this->parents = array();
		if (is_array($arrListMenu1)){
			foreach ($arrListMenu1 as $k => $v){			
				$this->parents[$v['menu_id']] = $v['parent_id'];				
			}
		}
		return $this->parents;		
	}
	function getAllMenuStr($menu_id=0){
		global $dbconn;		
		$html = "";
		$ok = 0;	
		foreach ($this->parents as $k => $v)
		if ($v==$menu_id){			
			$html.= $k.",";
			$html.= $this->getAllCatStr($k);
		}
		return $html;
	}
	function getAllMenuArr($menu_id=0, $cond=""){
		global $dbconn;
		global $core, $lang_code;
		$sql = "SELECT * FROM _menu WHERE lang_code='$lang_code' AND is_online=1 AND parent_id='$menu_id'";
		if ($cond!="") $sql.= " AND $cond";
		$sql.= " ORDER BY order_no, menu_id";
		$arrListMenu1 = $dbconn->GetAll($sql);
		$arr = array();
		if (is_array($arrListMenu1)&& isset($arrListMenu1[0]['menu_id'])){
			foreach ($arrListMenu1 as $k => $v){
				$v['submenu'] = $this->getAllCatArr($v["menu_id"]);
				$arr[$k] = $v;
			}
			return $arr;
		}else{
			return 0;
		}
	}
	function getAllMenuLink($menu_id=0, $mtype='main'){
		global $lang_code,$clsRewrite;
		$arrListMenu1 = $this->getAll("lang_code='$lang_code' AND mtype='$mtype' AND parent_id=$menu_id AND is_online=1 ORDER BY order_no, menu_id");
		$arr = array();
		if (is_array($arrListMenu1)&& isset($arrListMenu1[0]['menu_id'])){
			foreach ($arrListMenu1 as $k => $v){
				$v1 = $v;
				$v1['title'] = $v['name'];
                $v1['slug'] = $v['slug'];
                $v1['image'] = $v['image'];
				$v1['page_id'] = $v1['cat_id'] = 0;
				if ($v['page_id']!=0){
					if ($v['page_id']>0){
						$clsPages = new Pages();
						$arrOnePage = $clsPages->getOne($v['page_id']);
						$v1['href'] = $clsRewrite->url_page($arrOnePage);
						$v1['ttype'] = 'page';
						$sub1 = ($v['allow_sub']==1)? $clsPages->getAllMenuLink($v['page_id'], $mtype) : array();
						$sub2 = array();
						$sub2 = $this->getAllMenuLink($v['menu_id'], $mtype);
						$v1['children'] = array_merge($sub1, $sub2);						
						unset($clsPages, $arrOnePage);
						
						$v1['page_id'] = $v['page_id'];
					}					
				}elseif ($v['cat_id']>0){
					$clsCategory = new Category();
					$clsArticles = new Articles();
					$arrOneCategory = $clsCategory->getOne($v['cat_id']);			
					$v1['href'] = $clsRewrite->url_category($arrOneCategory);
					$v1['ttype'] = 'category';
					if ($v1['is_megamenu']==2){
						$listnews = $clsArticles->getAllSimple2("cat_id=".$v['cat_id']." AND lang_code='$lang_code' AND is_online=1");
						$v1['listnews'] = $listnews;
					}
//					$sub1 = ($v['allow_sub']==1)? $clsCategory->getAllMenuLink($v['cat_id'], $mtype, $v1['is_megamenu']) : array();
					$sub1 = $clsCategory->getAllMenuLink($v['cat_id'], $mtype, $v1['is_megamenu']);
					$sub2 = array();
					$sub2 = $this->getAllMenuLink($v['menu_id'], $mtype);
					$v1['children'] = array_merge($sub1, $sub2);
					unset($clsCategory, $arrOneCategory, $sub1, $sub2);
					
					$v1['cat_id'] = $v['cat_id'];
				}else{
					$v1['href'] = ($v['custom_link']!="")? $v['custom_link'] : VNCMS_URL;
					$v1['ttype'] = 'custom';
					if (strpos($v1['href'], 'http://')===false && strpos($v1['href'], 'https://')===false){
						$v1['href'] = VNCMS_URL."/".$v1['href'];
					}
					$v1['children'] = $this->getAllMenuLink($v['menu_id'], $mtype);					
				}
				$v1['total_children'] = count($v1['children']);		
				$arr[$k] = $v1;
			}
			return $arr;	
		}
		return $arr;
	}
	//get breadcrumb in Admin Area
	function getMenuPathAdmin($menu_id=0, $tail="", $delimiter='&nbsp;&rarr;&nbsp;', $level=0){
		$arrCur = $this->getOne($menu_id);
		if (is_array($arrCur)){
			$cur_name = ($level==0)? '<b>'.$arrCur['name'].'</b>' : $arrCur['name'];
			$html = "<a href='?mod=menu&menu_id=".$arrCur['menu_id']."&".$tail."'>".$delimiter.$cur_name."</a>";
		}
		if ($arrCur['parent_id']>0){
			$html = $this->getMenuPathAdmin($arrCur['parent_id'], $tail, $delimiter, $level+1).$html;
		}else{
			$html = "<a href='?mod=menu'>Root</a>".$html;
		}
		return $html;
	}
	//repair slug of menu $menu_id
	function repairMenuName($menu_id=0, $debug=0){
		global $lang_code;
		$arrCur = $this->getOne($menu_id);
		$cur_slug = "";
		if (is_array($arrCur) && $arrCur['slug']!=""){
			$cur_slug = $arrCur['slug'];
		}
		if ($debug==1){			
		}
		$arrListMenu1 = $this->getAll("lang_code='$lang_code' AND is_online=1 AND parent_id='$menu_id'");
		if (is_array($arrListMenu1)&& isset($arrListMenu1[0]['menu_id'])){
			foreach ($arrListMenu1 as $k => $v){
				if ($cur_slug!=""){
					$new_slug1 = $cur_slug."-".utf8_nosign_noblank($v['name']);
				}else{
					$new_slug1 = utf8_nosign_noblank($v['name']);
				}
				$ok = $this->updateOne($v['menu_id'], "slug='".$new_slug1."'");
				if ($debug==1 && $ok){
					echo $new_slug1."<BR>";
				}
				$this->repairMenuName($v['menu_id'], $debug);				
			}
			return 1;
		}
		return 1;		
	}
	//delete menu $menu_id
	function deleteMenu($menu_id=0){
		if ($menu_id==0) return;
		$arrSub = $this->getAll("parent_id=$menu_id");
		if (is_array($arrSub)){
			foreach ($arrSub as $key => $val){
				$this->deleteMenu($val['menu_id']);
			}
		}
		//Begin RecycleBin
		$clsRecycleBin = new RecycleBin();
		$clsRecycleBin->AddNew("Menu", $menu_id, "slug", "Menu");
		//End RecycleBin
		$this->deleteOne($menu_id);		
	}
}
function makeListMenu($menu_id=0, $selectedid="", $level=0, $maxlevel=3, $cond=""){
	global $dbconn, $lang_code;
	$sql = "SELECT * FROM _menu WHERE parent_id='$menu_id' AND lang_code='$lang_code'";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= "  ORDER BY order_no, menu_id";
	$arrListMenu11 = $dbconn->GetAll($sql);
	$html = "";
	if (is_array($arrListMenu11)){
		foreach ($arrListMenu11 as $k => $v){
			$selected = ($v["menu_id"]==$selectedid)? "selected" : "";
			$value = $v["menu_id"];
			$option = $v["name"];
			$html.= "<option value=\"$value\" $selected>".str_repeat("__", $level).$option."</option>";
			$html.= makeListMenu($v["menu_id"], $selectedid, $level+1);
		}
		return $html;
	}else{
		return "";
	}
}
function makeArrayListMenu($menu_id=0, $level=0, $maxlevel=2, &$ret, $cond=""){
	if ($level==$maxlevel) return "";
	global $dbconn, $lang_code;
	$sql = "SELECT * FROM _menu WHERE parent_id='$menu_id' AND lang_code='$lang_code'";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= "  ORDER BY order_no, menu_id";
	$arrListMenu11 = $dbconn->GetAll($sql);
	$html = "";
	if (is_array($arrListMenu11)){
		foreach ($arrListMenu11 as $k => $v){			
			$value = $v["menu_id"];
			$option = $v["name"];
			$ret["$value"] = str_repeat("&brvbar;---", $level).$option;
			makeArrayListMenu($v["menu_id"], $level+1, $maxlevel, $ret);
		}
		return "";
	}else{
		return "";
	}
}

?>