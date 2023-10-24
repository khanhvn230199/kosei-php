<?php
define("DIALOG_OPEN",0); //Open & upload 1 file
define("DIALOG_MULTI",1); //Open & Upload multi file
/******************************************************
 * Class DIALOD
 *
 * DIALOD Handling
 *
 * Project Name               :  
 * Package Name            	  :
 * Program ID                 :  dialog.inc.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.9.1
 * Create Date                :  14/03/2014
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	07/02/2018    	Tuanta          -  		-     -     -
 *
 ********************************************************/
class DIALOG {
	var $parentDir="";
	var $currentDir="";
	var $fileInRow=10;
	var $boxHeight="";
	var $boxWidth="";

	var $icons=null;
	var $iconDir="";
	var $dialogtype	= 0; //0: Open & upload 1 file, 1: Open & Upload multi file
	var $filetypes="";
	var $basedir = "";
	var $baseURL = "";
	var $maxFileSize = 2097152000;//2GB
	var $inputname = "InputName";

	var $filesincurrdir=array();
	var $dirincurrdir=array();
	
	/**
	 * Init Dialog
	 * 
	 * @param string $parentDir
	 * @param string $type
	 * @param number $boxHeight
	 * @param number $boxWidth
	 */
	function DIALOG($parentDir=".",$type=DIALOG_OPEN,$boxHeight=600,$boxWidth=830){
		$this->setParentDir($parentDir);
		$this->currentDir=$this->parentDir;
		$this->boxHeight=$boxHeight;
		$this->boxWidth=$boxWidth;
		$this->dialogtype=$type;
		$this->iconDir=$this->basedir."/dialogimg/";
		$this->icons = array(
			// Microsoft Office
			'doc' => array('doc', 'Word Document'),
			'xls' => array('xls', 'Excel Spreadsheet'),
			'ppt' => array('ppt', 'PowerPoint Presentation'),
			'pps' => array('ppt', 'PowerPoint Presentation'),
			'pot' => array('ppt', 'PowerPoint Presentation'),
		
			'mdb' => array('access', 'Access Database'),
			'vsd' => array('visio', 'Visio Document'),
			'rtf' => array('rtf', 'RTF File'),
		
			// XML
			'htm' => array('htm', 'HTML Document'),
			'html' => array('htm', 'HTML Document'),
			'xml' => array('xml', 'XML Document'),
		
			 // Images
			'jpg' => array('image', 'JPEG Image'),
			'jpe' => array('image', 'JPEG Image'),
			'jpeg' => array('image', 'JPEG Image'),
			'gif' => array('image', 'GIF Image'),
			'bmp' => array('image', 'Windows Bitmap Image'),
			'png' => array('image', 'PNG Image'),
			'tif' => array('image', 'TIFF Image'),
			'tiff' => array('image', 'TIFF Image'),
			
			// Audio
			'mp3' => array('audio', 'MP3 Audio'),
			'wma' => array('audio', 'WMA Audio'),
			'mid' => array('audio', 'MIDI Sequence'),
			'midi' => array('audio', 'MIDI Sequence'),
			'rmi' => array('audio', 'MIDI Sequence'),
			'au' => array('audio', 'AU Sound'),
			'snd' => array('audio', 'AU Sound'),
		
			// Video
			'mpeg' => array('video', 'MPEG Video'),
			'mpg' => array('video', 'MPEG Video'),
			'mpe' => array('video', 'MPEG Video'),
			'wmv' => array('video', 'Windows Media File'),
			'avi' => array('video', 'AVI Video'),
			
			// Archives
			'zip' => array('zip', 'ZIP Archive'),
			'rar' => array('zip', 'RAR Archive'),
			'cab' => array('zip', 'CAB Archive'),
			'gz' => array('zip', 'GZIP Archive'),
			'tar' => array('zip', 'TAR Archive'),
			'zip' => array('zip', 'ZIP Archive'),
			
			// OpenOffice
			'sdw' => array('oo-write', 'OpenOffice Writer document'),
			'sda' => array('oo-draw', 'OpenOffice Draw document'),
			'sdc' => array('oo-calc', 'OpenOffice Calc spreadsheet'),
			'sdd' => array('oo-impress', 'OpenOffice Impress presentation'),
			'sdp' => array('oo-impress', 'OpenOffice Impress presentation'),
		
			// Others
			'txt' => array('txt', 'Text Document'),	
			'js' => array('js', 'Javascript Document'),
			'dll' => array('binary', 'Binary File'),
			'pdf' => array('pdf', 'Adobe Acrobat Document'),
			'php' => array('php', 'PHP Script'),
			'ps' => array('ps', 'Postscript File'),
			'dvi' => array('dvi', 'DVI File'),
			'swf' => array('swf', 'Flash'),
			'chm' => array('chm', 'Compiled HTML Help'),
		
			// Unkown
			'default' => array('txt', 'Unkown Document'),
		);
	}
	/**
	 * Set base URL
	 * 
	 * @param string $_baseURL
	 */
	function setBaseURL($_baseURL=""){
		$this->baseURL = $_baseURL;
	}
	/**
	 * Set base Dir
	 * 
	 * @param string $dir
	 */
	function setBaseDir($dir){
		$this->basedir = str_replace("\\","/",$dir);
		$this->iconDir = $this->basedir."/dialogimg/";
	}
	/**
	 * Set max file size
	 *
	 * @param string $_maxFileSize
	 */
	function setMaxFileSize($_maxFileSize=0){
		$this->maxFileSize = $_maxFileSize;
	}
	/**
	 * Set input name
	 *
	 * @param string $_inputname
	 */
	function setInputName($_inputname=0){
		$this->inputname = $_inputname;
	}
	/**
	 * Set current directory
	 *
	 * @param string $currDir
	 */
	function setCurrentDir($currDir){
		$this->currentDir=str_replace("\\","/",$currDir);
	}
	/**
	 * Set parent directory
	 *
	 * @param string $parentDir
	 */
	function setParentDir($parentDir) {
		if($parentDir=="/")
			$this->parentDir="/";
		elseif(preg_match("/\/$/",$parentDir))
			$this->parentDir=substr_replace($parentDir,"",-1);
		else 
			$this->parentDir=$parentDir;
		$this->parentDir = str_replace("\\","/",$this->parentDir);
	}
	/**
	 * Set file type
	 *
	 * @param string $filetye
	 */
	function setFileType($filetye){
		$this->filetypes=$filetye;
	}
	/**
	 * Set dialog type (0: single, 1: multi)
	 *
	 * @param string $type
	 */
	function setDialogType($type){
		$this->dialogtype=$type;
	}
	/**
	 * Read all files in current directory
	 *
	 * @param none
	 */
	function readDir(){
		if(!empty($this->filesincurrdir) || !empty($this->dirincurrdir))
			return;
		$this->filesincurrdir=$this->get_all_files($this->currentDir, $this->filetypes, false, $this->dirincurrdir);
		return true;
	}
	/**
	 * Get all files in a directory
	 *
	 * @param string $parent_dir
	 * @param string $file_type
	 * @param string $include_sub_dir
	 * @param string $parent_dir
	 */
	function get_all_files($parent_dir=".", $file_type="", $include_sub_dir=true, &$dir_arr=NULL){
		static $file_arr=array();
		if (is_dir($parent_dir)){
			$file_type=strtolower($file_type);
			if(!preg_match("/\/$/",$parent_dir))
				$parent_dir.="/";
			if ($dh = opendir($parent_dir))
			{
				while (($file = readdir($dh)) !== false)
				{
					if(is_dir($parent_dir.$file) && $file!="." && $file!="..")
					{
						$dir_arr[]=$parent_dir.$file;
						if($include_sub_dir)
							$sub_dir=$this->get_all_files($parent_dir.$file,$file_type,$include_sub_dir,$dir_arr);
					}
					elseif(is_file($parent_dir.$file)&& $file!="." && $file!="..")
					{

						$path_parts = pathinfo($file);
						$ext=$path_parts["extension"];
						if(!isset($ext)|| trim($ext)=="")
						  $ext="12356";
						if(strstr($file_type,strtolower($ext))||$file_type=="")
						   $file_arr[]=$parent_dir.$file;
					}

				}
				closedir($dh);
			}
			usort($file_arr, "cmpstr");
			usort($dir_arr, "cmpstr");
			$return = $file_arr;
			unset($file_arr);
			return $return;
		}
		return 0;
	}
	/**
	 * Get file icon
	 *
	 * @param string $file
	 */
	function getFileIcon($file){	
		$l = strlen($this->parentDir);
		$rfile = substr($file, $l+1);
		$furl = $this->baseURL."/".$rfile;
		$furl = str_replace(" ", "%20", $furl);
		
		if(!is_file($file))
			return false;
		$bfile = basename($file);
		$file_extension = strtolower(substr(strrchr($bfile,"."),1));
		$file_icon=$this->icons[$file_extension];
		
		$icon=$this->iconDir.$file_icon[0].".gif";
		if(!is_file($icon))
			$icon=$this->iconDir."txt.gif";
		$file_info="Type: ".$file_icon[1]." \n";
		$file_info.="Date Modified: ".@date ("m/d/Y H:i A", @filemtime($file))." \n";
		$file_info.="Size: ".get_size(@filesize($file))." bytes";
		
		
		$arrExt = array("jpg", "jpe", "jpeg", "gif", "bmp", "png");
		$onomousemove = "";
		if (in_array($file_extension, $arrExt)){
			$onmousemove = "onmousemove='return viewFile(this, \"".$furl."\")'";
		}
		$html = "<a href='#' title='$file_info' data-name='$bfile' data-type='".$file_icon[1]."' data-modif='".@date ("m/d/Y H:i A", @filemtime($file))."' data-size='".get_size(@filesize($file))."' onclick='return selFile(this, \"".$rfile."\", \"$furl\")' $onmousemove ><img src='$icon' border=0 align='top'>&nbsp;".$bfile."</a>";
		
		return $html;
	}
	/**
	 * Get file thumb
	 *
	 * @param string $file
	 */
	function getFileThumb($file){
		$l = strlen($this->parentDir);
		$rfile = substr($file, $l+1);
		$furl = $this->baseURL."/".$rfile;
		$furl = str_replace(" ", "%20", $furl);
	
		if(!is_file($file))
			return false;
		$bfile = basename($file);
		$file_extension = strtolower(substr(strrchr($bfile,"."),1));
		$file_icon=$this->icons[$file_extension];
	
		$icon=$this->iconDir.$file_icon[0].".gif";
		if(!is_file($icon))
			$icon = $this->iconDir."txt.gif";
		$file_info="Name: ".$bfile." \n";
		$file_info.="Type: ".$file_icon[1]." \n";
		$file_info.="Date Modified: ".@date ("m/d/Y H:i A", @filemtime($file))." \n";
		$file_info.="Size: ".get_size(@filesize($file))." bytes";
	
	
		$arrExt = array("jpg", "jpe", "jpeg", "gif", "bmp", "png");
		$onomousemove = "";
		$fcontent = "";
		if (in_array($file_extension, $arrExt)){//If is image
			$onmousemove = "onmousemove='return viewFile(this, \"".$furl."\")'";
			$fcontent = "<img src='$furl' style='height:80px'>";
		}else{
			$fcontent = "<img src='$icon' border=0 align='top'>&nbsp;".$bfile;
		}
		$html = "<a href='#' title='$file_info' data-name='$bfile' data-type='".$file_icon[1]."' data-modif='".@date ("m/d/Y H:i A", @filemtime($file))."' data-size='".get_size(@filesize($file))."' onclick='return selFile(this, \"".$rfile."\", \"$furl\")' $onmousemove >$fcontent</a>";
	
		return $html;
	}
	/**
	 * Get parent dir for current directory
	 *
	 * @param none
	 */
	function getParentDirForCurrentDir(){
		$curr_dir=str_replace($this->parentDir,"",$this->currentDir);
		return preg_split("/\//",$curr_dir,-1,PREG_SPLIT_NO_EMPTY);
	}
	/**
	 * Get files in current directory and show by List
	 *
	 * @param none
	 */
	function getFilesInCurrentDir0(){
		$return="<!---Begin BoxFile-->\n";
		$return.="<table cellpadding='0' cellspacing='0' style='margin-left:5px; font-size: 12px' width='100%'>\n";
		$return.="<tr>";
		$this->readDir();
		//$gapinlist = "300px";
		$gapinlist = "auto";
		
		$file_arr= $this->filesincurrdir;
		$dir_arr=$this->dirincurrdir;
		$totalFile = count($file_arr);
		$totalDir = count($dir_arr);
		$rem=0;
		$c = 0;
		if ($totalDir>0){
			foreach ($dir_arr as $i => $val){
				$c++;
				$return.= "<td width='1%'><input type='checkbox' name='dcheck1[]' value='".basename($dir_arr[$i])."' onClick='check_selected();'></td>";
				$return.= "<td class='tddir' nowrap>";
				$return.= "<a href='#' onclick='javascript:chDir(\"".$dir_arr[$i]."\")'><img src='".$this->iconDir."folder.gif' border=0 align='top'>".basename($dir_arr[$i])."</a>";
				$return.= "</td>";
				if ($c%2==0){
					$return.= "</tr><tr>";
				}
			}
		}
		if ($totalFile>0){
			foreach ($file_arr as $i => $val){
				$c++;
				$return.= "<td width='1%'><input type='checkbox' name='dcheck2[]' value='".basename($file_arr[$i])."' onClick='check_selected();'></td>";
				$return.= "<td class='tddir' nowrap>";
				$return.= $this->getFileIcon($file_arr[$i]);
				$return.= "</td>";
				if ($c%2==0){
					$return.= "</tr><tr>";
				}
			}
		}
		
		$return.="</tr><tr><td>&nbsp;</td></tr></table><!---End BoxFile-->\n";
		return $return;
	}
	/**
	 * Get files in current directory and show by Thumbnail
	 *
	 * @param none
	 */
	function getFilesInCurrentDir1(){
		$return = "<!---Begin BoxFile-->\n";
		$return.= "<div id='boxFile'>";
		$this->readDir();
		$file_arr= $this->filesincurrdir;
		$dir_arr=$this->dirincurrdir;
		$totalFile = count($file_arr);
		$totalDir = count($dir_arr);
		if ($totalDir>0){
			foreach ($dir_arr as $i => $val){
				$box = "<div class='box' onclick='javascript:chDir(\"".$dir_arr[$i]."\")' title='Directory'>";
				$box.= "<img src='".$this->iconDir."folder.gif' border=0 align='top'><br>".basename($dir_arr[$i]);
				$box.= "</div>";
				$return.= $box; 
			}
		}
		if ($totalFile>0){
			foreach ($file_arr as $i => $val){
				$box = "<div class='box'>";
				$box.= $this->getFileThumb($file_arr[$i]);
				$box.= "<br><input type='checkbox' name='dcheck2[]' value='".basename($file_arr[$i])."' onClick='check_selected();'>";
				$box.= "</div>";
				$return.= $box;
			}
		}
		$return.= "<div class='clearfix'></div>";
		$return.= "</div>";
		$return.= "<!---End BoxFile-->\n";
		return $return;
	}
	/**
	 * Get files in current directory
	 *
	 * @param none
	 */
	function getFilesInCurrentDir($view=0){
		if ($view==0){
			return $this->getFilesInCurrentDir0();
		}else{
			return $this->getFilesInCurrentDir1();
		}		
	}
	/**
	 * Make a new directory
	 *
	 * @param none
	 */
	function makeDir($dir){
		if(empty($dir))
			return;
		@mkdir($this->currentDir."/".trim($dir));
	}
	/**
	 * Show dialog
	 *
	 * @param string $dialogLink
	 */
	function showDialog($dialogLink=""){
		
		$content="window.open('".$this->basedir."/dialogbox.php?pDir=$this->parentDir&type=$this->dialogtype&filetypes=$this->filetypes&maxfilesize=".$this->maxFileSize."&inputname=".$this->inputname."&s=".session_id()."','dialogwin','width=".$this->boxWidth."px,height=".$this->boxHeight."px,resizable=no,toolbar=no,status=no');";
		$html = "";
		$html.= "<a href='javascript:showOpenDialog_".$this->inputname."()'>";
		if(!empty($dialogLink))
			$html.= $dialogLink;
		else 
			$html.= "<img src='".$this->iconDir."folderopen.gif' border=0 title='Open' alt='Open'>";
		$html.= "</a>";
		$html.= "<script>function showOpenDialog_".$this->inputname."(){".$content."}</script>";
		return $html;
	}
}
//=============================================================================
if (!file_exists("cmpstr")){
	function cmpstr($a, $b){ return strcmp(strtolower($a), strtolower($b)); }
}
if (!function_exists("get_size")){
	function get_size($size) {//bytes
		if ($size=="" || $size==NULL) return 0;
		$kb = 1024;
		$mb = 1024 * $kb;
		$gb = 1024 * $mb;
		$tb = 1024 * $gb;
		if ($size < $kb) {
			$file_size = "$size Bytes";
		}
		elseif ($size < $mb) {
			$final = round($size/$kb,2);
			$file_size = "$final KB";
		}
		elseif ($size < $gb) {
			$final = round($size/$mb,2);
			$file_size = "$final MB";
		}
		elseif($size < $tb) {
			$final = round($size/$gb,2);
			$file_size = "$final GB";
		} else {
			$final = round($size/$tb,2);
			$file_size = "$final TB";
		}
		return $file_size;
	} 
}
//=============================================================================
?>