<?
/******************************************************
 * Class RecycleBin
 *
 * RecycleBin Handling
 * 
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:  
 * Program ID                 :  class_RecycleBin.php
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
class RecycleBin extends dbBasic{
	function RecycleBin(){
		$this->pkey = "id";
		$this->tbl = "_recyclebin";
	}
	function AddNew($classTable, $pvalTable, $fieldtitle, $objname){
		global $core;
		$clsClassTable = new $classTable;
		$arrOne = $clsClassTable->getOne($pvalTable);
		$tblname = $clsClassTable->tbl;
		$tblpkey = $clsClassTable->pkey;
		$tblpval = $pvalTable;
		$objvalue = @serialize($arrOne);
		$objtitle = $arrOne[$fieldtitle];
		$del_date = time();
		$user_id = $core->_USER['user_id'];
		$user_name = $core->_USER['user_name'];
		$fields = "tblname, tblpkey, tblpval, objtitle, objname, objvalue, del_date, user_id, user_name";
		$values = "'$tblname', '$tblpkey', '$tblpval', '$objtitle', '$objname', '$objvalue', '$del_date', '$user_id', '$user_name'";
		return $this->insertOne($fields, $values);
	}
	function Restore($id){
		global $dbconn;
		$arrThis = $this->getOne($id);
		$tblname = $arrThis['tblname'];
		$tblkey = $arrThis['tblpkey'];
		$tblpval = $arrThis['tblpval'];
		$objvalue = @unserialize($arrThis['objvalue']);
		$fields = $values = "";
		if (is_array($objvalue))
		foreach ($objvalue as $key => $val)
		if (!is_numeric($key)){
			$fields .= ($fields=="")? $key : ",".$key;
			$values .= ($values=="")? "'".$val."'" : ",'".$val."'";
		}
		$sql  = "INSERT INTO $tblname($fields) VALUES($values)";
		if ($dbconn->Execute($sql)){
			$this->deleteOne($id);
			return 1;
		}
		return 0;
	}
	function RemoveForever($id){
		$this->deleteOne($id);
	}
	function getIcon($totalItem, $maxItem=20000){
		if ($totalItem>0){
			$icon_recyclebin = ($totalItem>$maxItem)? "garbage_full.png" : "garbage.png";
		}else{
			$icon_recyclebin = "garbage_empty.png";
		}
		return $icon_recyclebin;
	}
}
?>