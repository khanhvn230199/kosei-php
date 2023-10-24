<?
/******************************************************
 * Class PublicKey
 *
 * PublicKey Page Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:
 * Program ID                 :  class_PublicKey.php
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
class PublicKey extends DbBasic{
	function PublicKey(){
		$this->pkey = "id";
		$this->tbl = "_publickey";		
	}
	/**
	 * Get forgot key string
	 * 
	 * @return string
	 */
	function getForgotKey(){
		$key = md5(simpleRandString(16));
		$exp_date = time() + 3*24*60*60;
		$this->insertOne("id, exp_date", "'$key', $exp_date");
		return $key;
	}
	/**
	 * Check exists key?
	 * 
	 * @param unknown $keyid
	 * @return number
	 */
	function isExists($keyid=0){
		$now = time();
		$arr = $this->getByCond("id='$keyid' AND exp_date>$now");
		return (is_array($arr) && $arr['id']==$keyid)? 1 : 0;
	}
	/**
	 * Delete key by ID or expired
	 * 
	 * @param unknown $keyid
	 * @return number
	 */
	function deleteKey($keyid=0){
		$now = time();
		return $this->deleteByCond("id='$keyid' OR exp_date<$now");
	}
}
?>