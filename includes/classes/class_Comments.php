<?
/******************************************************
 * Class Comments (Post + Page)
 *
 * Comment Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:
 * Program ID                 :  class_Comments.php
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
class Comments extends dbBasic{
	function Comments(){
		$this->pkey = "comment_id";
		$this->tbl = "_comments";
	}
	//SELECT
	/**
	 * Validate comment form
	 *
	 * @param unknown $arr_error
	 * @return number
	 */
	function validateAdd(&$arr_error){
		global $core;
		$comment = POST("comment", "");
		if ($core->_SESS->isLoggedin()){
			$fullname = $core->_USER['fullname'];
			$email = $core->_USER['email'];
			$user_id = $core->_USER['user_id'];
		}else{
			$fullname = POST("fullname", "");
			$email = POST("email", "");
			$user_id = 0;
		}
		$is_type = POST("is_type", 0);
		$obj_id = POST("obj_id", 0);
		$valid = 1;
		if ($valid && $fullname==""){
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = "Chưa nhập họ tên";
			$valid = 0;
		}
		if ($valid && $email==""){
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = "Chưa nhập email";
			$valid = 0;
		}
		if ($valid && ($comment=="" || $obj_id==0)){
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = "Chưa nhập nội dung bình luận";
			$valid = 0;
		}
	
		return $valid;
	}
	/**
	 * Get List comment by type and obj
	 * 
	 * @param number $is_type
	 * @param number $obj_id
	 * @param number $limit
	 * @param number $start
	 */
	function getList($is_type=0, $obj_id=0, $orderby='reg_date DESC', $limit=10, $start=0){
		$cond = "is_type=$is_type AND is_online=1 AND obj_id=$obj_id";
		$cond.= " ORDER BY $orderby";
		$cond.= " LIMIT $start, $limit";
		return $this->getAll($cond);
	}
	//INSERT
	/**
	 * Add comment to database
	 *
	 * @param unknown $arr_error
	 */
	function addComment(&$arr_error){
		global $core;
		$comment = POST("comment", "");
		$is_type = POST("is_type", 0);
		$obj_id = POST("obj_id", 0);
		if ($core->_SESS->isLoggedin()){
			$fullname = $core->_USER['fullname'];
			$email = $core->_USER['email'];
			$user_id = $core->_USER['user_id'];
		}else{
			$fullname = POST("fullname", "");
			$email = POST("email", "");
			$user_id = 0;
		}
		$is_online = 0;//Wait for approve
		$ok = $this->insertC($is_type, $obj_id, $user_id, $fullname, $email, $comment, $is_online);
		if ($ok) {
			$arr_error['status'] = "OK";
			$arr_error['message'] = "Đã gửi bình luận thành công";
		}else{
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = "Không cập nhật được dữ liệu";
		}
		return $ok;
	}
	/**
	 * Insert comment to DB
	 *
	 * @param unknown $obj_id
	 * @param unknown $user_id
	 * @param unknown $fullname
	 * @param unknown $email
	 * @param unknown $content
	 * @param number $is_online
	 * @return number
	 */
	function insertC($is_type=0, $obj_id=0, $user_id=0, $fullname="", $email="", $content="", $is_online=1){
		$reg_date = time();
		$fields = "is_type, obj_id, user_id, fullname, email, content, is_online, reg_date";
		$values = "'$is_type', $obj_id, $user_id, '$fullname', '$email', '$content', '$is_online', $reg_date";
		return $this->insertOne($fields, $values);
	}
	
	//UPDATE
	/**
	 * Set a comment is Show
	 *
	 * @param unknown $comment_id
	 * @return Ambigous <void, number>
	 */
	function setOn($comment_id){
		return $this->updateOne($comment_id, "is_online=1");
	}
	/**
	 * Set a comment is Hidden
	 *
	 * @param unknown $comment_id
	 * @return Ambigous <void, number>
	 */
	function setOff($comment_id){
		return $this->updateOne($comment_id, "is_online=0");
	}
	
	//DELETE
	/**
	 * Remove a comment from DB
	 * 
	 * @param unknown $comment_id
	 * @return number
	 */
	function removeC($comment_id){
		return $this->deleteOne($comment_id);
	}
}
?>