<?
class Tags extends dbBasic{
	function Tags(){
		$this->pkey = "tag_id";
		$this->tbl 	= "_tags";
	}	
	//SELECT
	function getSlug($pkey_id=0){
		$arr = $this->getOne($pkey_id, 0);
		return (is_array($arr) && $arr[$this->pkey]>0)? $arr['slug'] : '';
	}
	function getFromSlug($slug=""){
		$arr = $this->getByCond("slug='$slug'", 0);
		return (is_array($arr) && $arr[$this->pkey]>0)? $arr : '';
	}
	function incSearchCount($tag){
		$this->updateByCond("slug='$tag'", "total_search = total_search + 1");
	}
	function getStrSampleTags($t='news_id'){
		global $dbconn;
		$sql = "SELECT DISTINCT(slug), name, is_online, total_search FROM ".$this->tbl." WHERE is_online=1 AND $t>0 ORDER BY slug, total_search DESC";
		$arr = $dbconn->GetAll($sql);
		$str = "";
		if (is_array($arr))
		foreach ($arr as $k => $v){
			$str .= ($str=="")? "'".$v['name']."'" : ", '".$v['name']."'";
		}
		return $str;
	}
	//INSERT
	/**
	 * Insert tags by string with multi tags
	 * 
	 * @param string $tags
	 * @param string $t
	 * @param number $t_id
	 * @return number
	 */
	function insertTags($tags="", $t='news_id', $t_id=0){
		$this->updateByCond("$t=$t_id", "is_online=0");
		if ($tags!="" && $t_id!=0){
			$arr_tags = (strpos($tags, ',')!==false)? explode(',', $tags) : array(0 => $tags);
			foreach ($arr_tags as $key => $tag){
				$this->insertTag(trim($tag), $t, $t_id, $cat_id);
			}
		}
		$this->deleteByCond("$t=$t_id AND is_online=0");
		return 1;
	}
	/**
	 * Insert one tag
	 * 
	 * @param string $tag
	 * @param string $t
	 * @param number $t_id
	 * @return number
	 */
	function insertTag($tag='', $t='news_id', $t_id=0){		
		if ($tag=='') return 0;
		$slug = utf8_nosign_noblank(trim($tag));
		$arr = $this->getByCond("slug='$slug' AND $t=$t_id");
		if (is_array($arr) && $arr['tags_id']>0){			
			$set = "is_online=1";
			$ok = $this->updateOne($arr['tags_id'], $set);
		}else{			
			$fields = "name, slug, $t, is_online";
			$values = "'$tag', '$slug', $t_id, 1";
			$ok = $this->insertOne($fields, $values, 0);
		}
		return $ok;
	}
	//UPDATE
	function updateTag($slug='', $page_title='', $meta_keywords='', $meta_des=''){
		$set = "page_title='$page_title', meta_keywords='$meta_keywords', meta_des='$meta_des'";
		$cond = "slug='$slug'";
		return $this->updateByCond($cond, $set);
	}
	//DELETE
	function deleteTag($tags_id=0){
		$arrOneTags = $this->getOne($tags_id);
		if ($arrOneTags['news_id']>0){
			$t = 'news_id';
			$t_id = $arrOneTags['news_id'];
		}
		$ok = $this->deleteTagName($arrOneTags['name'], $t, $t_id);
		if ($ok){
			return $this->deleteOne($tags_id);
		}
		return 0;
	}
	function deleteTagName($tag='', $t='news_id', $t_id=0){
		if ($t=='news_id'){
			$clsNews = new News();
			$arrOneNews = $clsNews->getOne($t_id);
			$tags = trim($arrOneNews['tags']);
			$tags.= ',';
			$tags = str_replace($tag.',', '', $tags);
			return $clsNews->updateOne($t_id, "tags='$tags'");		
		}
	}
}
?>