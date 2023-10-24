<?
/******************************************************
 * Class Page
 *
 * Static Page Handling
 * 
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:  
 * Program ID                 :  class_Page.php
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
class Pages extends dbBasic{
	function Pages(){
		$this->pkey = "page_id";
		$this->tbl 	= "_pages";
	}
	//SELECT
	/**
	 * Get page by slug
	 * 
	 * @param string $slug
	 * @return Ambigous <number, unknown>
	 */
	function getBySlug($slug=""){
		global $lang_code;
		return $this->getByCond("slug='$slug' AND lang_code='$lang_code'");
	}
	/**
	 * Get first sub page
	 * 
	 * @param number $parent_id
	 */
	function getFirstSubPage($parent_id=0){
		global $dbconn, $lang_code;
		$sql = "SELECT page_id, name, page_title, slug, image, parent_id, lang_code, meta_keywords, meta_des
						FROM ".$this->tbl."
						WHERE parent_id=$parent_id AND lang_code='$lang_code' AND is_online=1
						ORDER BY order_no ASC, page_id ASC";
		return $dbconn->GetRow($sql);
	}
	/**
	 * Get list pages by ID or array ID
	 * 
	 * @param number $id
	 */
	function getListPagesById($id=0){
		$cond = "";
		if (is_numeric($id)){
			$cond = "page_id=$id";
		}else
		if (is_array($id)){
			$s = implode(',', $id);
			$cond = "page_id IN ($s)";
		}else
		if (strpos(',', $id)!==false){
			$cond = "page_id IN ($id)";
		}
		$cond.= " ORDER BY order_no";
		return $this->getAll($cond);
	}
	/**
	 * Get list sub pages
	 * 
	 * @param number $parent_id
	 */
	function getListSubPage($parent_id=0){
		global $dbconn, $lang_code;
		$sql = "SELECT page_id, name, page_title, slug, image, parent_id, lang_code, meta_keywords, meta_des
						FROM ".$this->tbl."
						WHERE parent_id=$parent_id AND lang_code='$lang_code' AND is_online=1
						ORDER BY order_no ASC, page_id ASC";
		return $dbconn->GetAll($sql);
	}
	/**
	 * Get list page for make sitemap
	 * 
	 * @return unknown
	 */
	function getListSiteMap(){
		global $dbconn, $lang_code;
		$sql = "SELECT page_id, name, page_title, slug, image, parent_id, lang_code, meta_keywords, meta_des
						FROM ".$this->tbl."
						WHERE parent_id=0 AND lang_code='$lang_code' AND is_online=1
						ORDER BY order_no ASC, page_id ASC";
		$arr = $dbconn->GetAll($sql);
		if (is_array($arr))
		foreach ($arr as $k => $v){
			$arr[$k]['subpage'] = $this->getListSubPage($v['page_id']);
		}
		return $arr;
	}
	//INSERT
	//UPDATE
	//DELETE
	//OTHER
	function getAllMenuLink($page_id=0){
		$arrListPage1 = $this->getAll("is_online=1 AND parent_id='$page_id' ORDER BY order_no, name");
		$arr = array();
		if (is_array($arrListPage1)&& isset($arrListPage1[0]['page_id'])){
			foreach ($arrListPage1 as $k => $v){
				$v1 = array();
				$v1['page_id'] = $v['page_id'];
				$v1['title'] = $v['name'];
				$v1['href'] = url_pagecontent($v);
				$v1['ttype'] = 'page';
				$v1['submenu'] = $this->getAllMenuLink($v['page_id']);
				$arr[$k] = $v1;
			}
		}
		return $arr;
	}
}
function makeListPage($parent_id=0, $selectedid="", $cond=""){
	global $dbconn, $lang_code;
	$sql = "SELECT * FROM _pages WHERE lang_code='$lang_code' AND parent_id=$parent_id";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= "  ORDER BY order_no ASC, slug ASC, page_id DESC";
	$arrListPage1 = $dbconn->GetAll($sql);
	$html = "";
	if (is_array($arrListPage1)){
		foreach ($arrListPage1 as $k => $v){
			$selected = ($v["page_id"]==$selectedid)? "selected" : "";
			$value = $v["page_id"];
			$option = $v["name"];
			if ($parent_id>0) $option = "&brvbar;--- ".$option;
			$html.= "<option value=\"$value\" $selected>".$option."</option>";
			if ($v['parent_id']==0){
				$html.= makeListPage($value, $selectedid, $cond);
			}
		}
		return $html;
	}else{
		return "";
	}
}
function makeArrayListPage($parent_id=0, &$ret, $cond=""){
	global $dbconn, $lang_code;
	$sql = "SELECT * FROM _pages WHERE lang_code='$lang_code' AND parent_id=$parent_id";
	if ($cond!="") $sql.= " AND $cond";
	$sql.= "  ORDER BY order_no ASC, slug ASC, page_id DESC";
	$arrListPage1 = $dbconn->GetAll($sql);
	$html = "";
	if (is_array($arrListPage1)){
		foreach ($arrListPage1 as $k => $v){			
			$value = $v["page_id"];
			$option = $v["name"];
			if ($parent_id>0) $option = "&brvbar;--- ".$option;
			$ret["$value"] = $option;		
			makeArrayListPage($value, $ret, $cond);
		}
		return "";
	}else{
		return "";
	}
}

?>