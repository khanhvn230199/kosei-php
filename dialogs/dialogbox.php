<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
require_once("../configs/database.inc.php");
require_once("../includes/adodb5/adodb.inc.php");
require_once("../includes/lib/lib_validation.php");
//Begin Added 19/03/2014
define("VNCMS_DIR", $_SERVER['DOCUMENT_ROOT'].trim(dirname(" ".dirname(" ".$_SERVER['SCRIPT_NAME']))));
define("VNCMS_URL", "http://".$_SERVER['HTTP_HOST'].trim(dirname(" ".dirname(" ".$_SERVER['SCRIPT_NAME']))));
//End Added 19/03/2014
//Begin check logged in
$dbconn = &ADONewConnection(DB_TYPE);
if (isset($dbinfo) && is_array($dbinfo)){
	$dbconn->Connect($dbinfo['host'], $dbinfo['user'], $dbinfo['pass'], $dbinfo['db']);
}else{
	$dbconn->Connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}
if (!isset($_GET["s"]) || ($_GET["s"]=="")){
	showErrorWarningBox();
	die();
	exit();	
}
$session = $dbconn->GetRow("SELECT * FROM _session WHERE session_id='".$_GET['s']."'");
if (!is_array($session) || $session['loggedin']==0){
	showErrorWarningBox();
	die();
	exit();	
}
$dbconn->Close();
//End check logged in
//error_reporting(0);
$COOK = "cache_curr_dir";
$COOK_VIEW = 0; //0: list, 1:thumbnail
$baseURL = VNCMS_URL."/uploads";
$rootDIR = VNCMS_DIR."/uploads";
$nopic = "nopic.gif";
$thumbwidth = "200";
require_once("dialog.inc.php");
$inputname = $_REQUEST["inputname"];
$maxfilesize = $_REQUEST["maxfilesize"];
//get curent directory
$curr_dir = $_REQUEST['curr_dir'];
if ($_COOKIE[$COOK]!="" && $curr_dir==""){
	$curr_dir = $_COOKIE[$COOK];
}
setcookie($COOK, $curr_dir, time()+3600);
//get current view
$curr_view = isset($_REQUEST["view"])? $_REQUEST["view"] : "";
if ($curr_view==""){
	if ($_COOKIE[$COOK_VIEW]!="" && $curr_view==""){
		$curr_view = $_COOKIE[$COOK_VIEW]; 
	}else{
		$curr_view = 0;
	}
}
if (isset($_REQUEST["view"])){
	setcookie($COOK_VIEW, $curr_view, time()+3600);
}


$pDir=$_REQUEST['pDir'];
$pdir = strtolower($pDir);

$dtype = isset($_REQUEST['type'])? $_REQUEST['type'] : 0;
$filetypes = isset($_REQUEST['filetypes'])? $_REQUEST['filetypes'] : "jpg,jpeg,png,gif,xls,xlsx,doc,docx,rar,zip,ppt,pptx,gz,pdf,ies";
$basedir=$_REQUEST['basedir'];
$CKEditor = $_REQUEST["CKEditor"];
if(empty($curr_dir))
	$curr_dir=$pDir;
$dialog=new DIALOG($pDir,$dtype);
$dialog->setBaseDir(".");
$dialog->setBaseURL($baseURL);
$dialog->setCurrentDir($curr_dir);
$dialog->setFileType($filetypes);
$dialog->setInputName($inputname);

$title = "Quản lý Thư viện Media: ".(($dtype==0)? "Chọn 1 file" : "Chọn nhiều file");
$MSG_CANNOT_UPLOAD = "This file can\'t be uploaded to server!";
$MSG_NOT_ALLOW = "This file type is not allow!";
$MSG_OVER_MAXSIZE = "The maximum size of file is $maxfilesize!";
$MSG_DIR_NOT_ALLOW = "This directory is not allow to upload!";
$MSG_ACTION_NOT_ALLOW = "This action is not allow!";
	
//Add new directory
if($_POST['act']=='AddDir'){
	$dialog->makeDir($_POST['variable']);
}
//Delete selected files
if ($_POST['btnDelete']=="Delete selected"){
	$dcheck1 = $_POST['dcheck1'];
	$dcheck2 = $_POST['dcheck2'];
	if (is_array($dcheck1)){
		if (is_array($dcheck1)){
			foreach ($dcheck1 as $k => $ddir){
				@rmdir($curr_dir."/".$ddir);
			}
		}
	}
	if (is_array($dcheck2)){
		foreach ($dcheck2 as $k => $dfile){
			@unlink($curr_dir."/".$dfile);
		}
	}
}
//Move selected files to other dir
if ($_POST['btnMove']=="Move"){
	$dcheck1 = $_POST['dcheck1'];
	$dcheck2 = $_POST['dcheck2'];
	$newfolder = $_POST['newfolder'];
	if (file_exists($curr_dir."/".$newfolder)){
		$real_path = realpath($curr_dir."/".$newfolder);
		if (strlen($real_path)>= strlen($rootDIR)){
			if (is_array($dcheck1)){
				if (is_array($dcheck1)){
					foreach ($dcheck1 as $k => $ddir){
						if (copy($curr_dir."/".$ddir, $curr_dir."/".$newfolder."/".$ddir)){
							@rmdir($curr_dir."/".$ddir);
						}
						
					}
				}
			}
			if (is_array($dcheck2)){
				foreach ($dcheck2 as $k => $dfile){			
					if (copy($curr_dir."/".$dfile, $curr_dir."/".$newfolder."/".$dfile)){
						@unlink($curr_dir."/".$dfile);
					}
				}
			}
		}else{
			echo "<script>alert('".$MSG_ACTION_NOT_ALLOW."');</script>";
		}
	}
}
//Rename selected files to other dir
if ($_POST['btnRename']=="Rename"){
	$dcheck1 = $_POST['dcheck1'];
	$dcheck2 = $_POST['dcheck2'];
	$newname = $_POST['newname'];
	if (is_array($dcheck1)){
		foreach ($dcheck1 as $k => $file){
			$oldf = $curr_dir."/".$file;
			$newf = $curr_dir."/".$newname;
			if ($file!=$newname){
				@rename($oldf, $newf);
			}
			break;
		}
	}
	if (is_array($dcheck2)){
		foreach ($dcheck2 as $k => $file){
			$oldf = $curr_dir."/".$file;
			$newf = $curr_dir."/".$newname;
			if ($file!=$newname){
				@rename($oldf, $newf);
			}
			break;
		}
	}
}
//Upload file or multiple file
$uploaded_file = "";//str_replace($pDir."/", "", $curr_dir);
if ($_POST["btnUpload"]!=""){
	if ($dtype==0){
		if (!is_uploaded_file($_FILES["upfile"]["tmp_name"])){
			echo "<script>alert('".$MSG_CANNOT_UPLOAD."')</script>";
		}else{
			$ftmp_name = $_FILES["upfile"]["tmp_name"];
			$fname = $_FILES["upfile"]["name"];
			
			$errNo = 0;
			//Check php file
			if (strpos($fname, ".php")!==false){
				die("Shit!!!");
			}
			//Check writeable directory
			if (!is_writable($_POST["currentDir"])){
				echo "<script>alert('".$MSG_DIR_NOT_ALLOW."')</script>";
			}else
			if (dialog_checkValidImageFile($fname, $ftmp_name, $maxfilesize, $filetypes, $errNo)==1){
				if ($errNo==1){
					echo "<script>alert('".$MSG_NOT_ALLOW."')</script>";
				}else
				if ($erroNo==2){
					echo "<script>alert('".$MSG_OVER_MAXSIZE."')</script>";
				}else{
					$ok = @copy($ftmp_name, $_POST["currentDir"]."/".$fname);
					if ($ok==true){
						$uploaded_file = str_replace($dialog->parentDir."/", "", $_POST["currentDir"]."/".$fname);				
					}
				}
			}else{
				echo "<script>alert(".$MSG_CANNOT_UPLOAD.")</script>";
			}		
		}
	}else{
		$arr_uploaded_file = array();
		$countfiles = count($_FILES['upfile']['name']);
		$arr_tmp_name = $_FILES["upfile"]["tmp_name"];
		$arr_fname = $_FILES["upfile"]["name"];
		if ($countfiles>0 && is_array($arr_fname)){
			//Check php file
			for($i=0; $i<$countfiles; $i++){
				$ftmp_name = $arr_tmp_name[$i];
				$fname = $arr_fname[$i];
				if (strpos($fname, ".php")!==false){
					die("Shit!!!");
				}
			}
			//Check writeable directory
			if (!is_writable($_POST["currentDir"])){
				echo "<script>alert('".$MSG_DIR_NOT_ALLOW."')</script>";
			}else{
				for($i=0; $i<$countfiles; $i++){
					$ftmp_name = $arr_tmp_name[$i];
					$fname = $arr_fname[$i];
					if (dialog_checkValidImageFile($fname, $ftmp_name, $maxfilesize, $filetypes, $errNo)==1){
						//if no error
						if ($errNo==0){
							$ok = @copy($ftmp_name, $_POST["currentDir"]."/".$fname);
							if ($ok==true){
								$arr_uploaded_file[] = str_replace($dialog->parentDir."/", "", $_POST["currentDir"]."/".$fname);
							}
						}
					}//end if dialog_check...
				}
			}//end if check writeable...
			$uploaded_file = implode(',', $arr_uploaded_file);
		}//end if $countfile...
	}
}
//Check valid uploaded file
function dialog_checkValidImageFile($file_name, $file_tmp, $max_file_size="", $allowExt="", &$errNo){
	if ($max_file_size==""){
		$max_file_size = 10485760;
	}
	if ($allowExt==""){
		$allowExt="jpeg, jpg, gif, png";
	}
	$allowExt = strtolower($allowExt);
	$allowExt = str_replace("php3", "", $allowExt);
	$allowExt = str_replace("php", "", $allowExt);
	$allowExt = str_replace("asp", "", $allowExt);
	$allowExt = str_replace("aspx", "", $allowExt);
	$allowExt = str_replace("exe", "", $allowExt);
	$extension = strtolower(substr(strrchr($file_name,"."),1));
	//check extension
	if (strpos($allowExt, $extension)===false){
		$errNo = 1;//extension is not allow
		return 0;
	}
	//check size
	$size = @filesize($file_tmp);
	if ($size>$max_file_size){
		$errNo = 2;//size is not allow
		return 0;
	}	
	//else
	return 1;
}
?>
<html>
<head>
<title><?php echo $title?></title>
<meta charset="UTF-8">
<style>
body,td
{
	font-family:verdana;
	font-size:11px;
}
a{ text-decoration:none; color:#000000; }
a:hover{ text-decoration:underline; }
.clearfix{ overflow: hidden; height: 0px; clear: both;}
.title{
background-color:#999999;
color:#FFFFFF;
font-weight:bold;
height:25px;
padding-left:5px;
}
.filebox
{
	border:1px solid #CCCCCC;
	padding-top:5px;
	padding-bottom:5px;
	width:<?=($dialog->boxWidth-$thumbwidth-20);?>px;
	height:<?=($dialog->boxHeight-160);?>px;
	overflow:auto;
}
.inputfield{
	height:22px;
}
.btn{
	width:75px;
	height:22px;
}
.tddir, .tdfile{
	
}
.tddir a, .tdfile a{
	display: block;
	padding: 3px;
}
.tddir a:hover, .tdfile a:hover{
	background: #F1F1F1;
}
.button{
	border: 1px solid #CCC;
	margin: 0px 0px 5px 5px;
	cursor: pointer;
}
	.button:hover{
		background: #ccc;
	}
.link{
	cursor: pointer;
}
#boxFile{
	padding-bottom: 10px;
}
	#boxFile .box{
		float: left;
		width: 100px;
		height: 100px;
		margin:10px 0px 0px 10px;
		text-align: center;
		border: 1px solid #ddd;
		overflow: hidden;	
	}
	#boxFile .box:hover{
		cursor: pointer;
		border: 1px solid #000;
	}
	#boxFile .box:hover img{
		-moz-transform: scale(1.1);
	  -webkit-transform: scale(1.1);
	  transform: scale(1.1);
	}
</style>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" language="javascript">
var httpRequest = false; 
function makeRequest(url) {
	httpRequest = false;
	if (window.XMLHttpRequest) { 
		httpRequest = new XMLHttpRequest();
		if (httpRequest.overrideMimeType) {
			httpRequest.overrideMimeType('text/xml');
		}
	} else 
	if (window.ActiveXObject) {
		try {
			httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				alert(e.toString());
			}
		}
	}
	if (!httpRequest) {
		alert("Giving up : Cannot create an XMLHTTP instance");
		return false;
	}
	httpRequest.onreadystatechange = alertContents;
	httpRequest.open("POST",url, true);
	httpRequest.send("bb=bbbs");
}
function alertContents() {
	if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			//alert("Dimension:"+httpRequest.responseText);
			showDimension(httpRequest.responseText);
		} else {
			//alert("There was a problem with the request.");
		}
	}
}
function chDir(dir){
	if(dir==null || dir=="" )
		dir="<?php echo str_replace('\\','/',dirname($dialog->currentDir))?>";
	for(i=0;i<document.form1.curr_dir.options.length;i++)
	{
		if(document.form1.curr_dir.options[i].value==dir)
		{
			document.form1.curr_dir.options[i].selected=true;
			document.form1.submit();
		}
	}
}
function newDir(){
	newDir=prompt("Enter New Directory Name","New Folder")
	document.form1.act.value="AddDir";
	document.form1.variable.value=newDir;
	document.form1.submit();
}
function about(){
	alert("Open File Browser 1.9.1\nLast Update: 07/02/2018\nAuthor: MrPhpVn\nEmail: tuantavnu@gmail.com\n");
}
function selFile(obj, file, furl){	
	var dtype = <?=$dtype?>;
	if (dtype==0){
		document.form1.filename.value = file;
	}else{
		var cv = document.form1.filename.value;
		if (cv==""){
			document.form1.filename.value = file;
		}else{
			document.form1.filename.value = cv + ',' + file;
		}
	}
	return false;
}
function viewFile(obj, furl){
	var name = $(obj).attr("data-name");
	var type = $(obj).attr("data-type");
	var modif = $(obj).attr("data-modif");
	var size = $(obj).attr("data-size");
	if (document.thumb.src != furl){
		//document.getElementById("athumb").href = furl;
		document.thumb.src = furl;
		getImgSize("thumb");
		$("#afile_info").html("<b>Tên ảnh: " + name + "</b><br>Loại: " + type + "<br>Cập nhật: " + modif + "<br>Kích thước: " + size);
	}
	return false;
}
function openFile(){
	if (<?=($CKEditor!='')? 1 : 0;?>){
		window.opener.openFile<?="_".$inputname?>('<?=$baseURL?>/'+document.form1.filename.value);
	}else{
		window.opener.openFile<?="_".$inputname?>(document.form1.filename.value);
	}
	window.close();
}
function openFile1()
{
	window.opener.openFile("<?php echo $dialog->baseURL?>/"+document.form1.filename.value);
	window.close();
}
function PopupPic(sPicURL) { 
	window.open("popup.htm?"+sPicURL, "", "resizable=1,height=200,width=200,status=0");
}

function getWidthAndHeight() {
    //alert("'" + this.name + "' is " + this.width + " by " + this.height + " pixels in size.");
	showDimension("Độ phân giải: " + this.width+"x"+this.height);
	return true;
}
function loadFailure() {
    //alert("'" + this.name + "' failed to load.");
    return true;
}
function showDimension(val){
	if (document.form1.resolution){
		document.form1.resolution.value = val;
	}else{
		document.getElementById("resolution").value = val;
	}
}
function getImgSize(id){
	var pic = document.getElementById(id);
	var imgSrc = pic.src;
	showDimension("");
	var myImage = new Image();
	myImage.name = imgSrc;
	myImage.src = imgSrc;
	myImage.onload = getWidthAndHeight;
	myImage.onerror = loadFailure;
}
function enLarge(){
	PopupPic(document.thumb.src);
	//window.location = document.thumb.src;
}
function checkFileOpen(obj){
	if (obj.value==""){
		alert("Please choose at least on file");
		return false;
	}
	return true;
}
function checkAll() {
	 var fmobj = document.form1;
	 for (var i=0;i<fmobj.elements.length;i++) {
		 var e = fmobj.elements[i];
		 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
			 e.checked = 'true';
		 }
	 }	 
	 $("#btnDelete").prop('disabled', false);
	 $("#btnRename").prop('disabled', true);
	 $("#btnMove").prop('disabled', false);
	 return true;
}
function unCheckAll() {
	 var fmobj = document.form1;
	 for (var i=0;i<fmobj.elements.length;i++) {
		 var e = fmobj.elements[i];
		 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
			 e.checked = '';
		 }
	 }
	 $("#btnDelete").prop('disabled', true);
	 $("#btnMove").prop('disabled', true);	 
	 return true;
}
function confirmDelete() {
	var total = 0;
	var fmobj = document.form1;
	for (var i=0;i<fmobj.elements.length;i++) {
	 var e = fmobj.elements[i];
	 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
		 if (e.checked) total++;
	 }
	}
	if (total==0){ 
		alert("Please choose at least on file");
		return false;
	}
	if (confirm("Do you want to delete these item [OK]:Yes [Cancel]:No?")) {		
		return true;
	}
	unCheckAll();
	return false;
}
function confirmMove() {
	var total = 0;
	var fmobj = document.form1;
	for (var i=0;i<fmobj.elements.length;i++) {
	 var e = fmobj.elements[i];
	 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
		 if (e.checked) total++;
	 }
	}
	if (total==0){ 
		alert("Please choose at least on file");
		return false;
	}
	var newfolder = prompt("Please enter new Folder", "");
	if (newfolder != null) {
		$("#newfolder").val(newfolder);
		return true;
	}
	unCheckAll();
	return false;
}
function check_selected(){
	var total = 0;
	var fmobj = document.form1;
	for (var i=0;i<fmobj.elements.length;i++) {
	 var e = fmobj.elements[i];
	 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
		 if (e.checked) total++;
	 }
	}
	if (total>0){
		$("#btnRename").prop('disabled', false);
		$("#btnDelete").prop('disabled', false);
		$("#btnMove").prop('disabled', false);
	}else{
		$("#btnRename").prop('disabled', true);
		$("#btnDelete").prop('disabled', true);
		$("#btnMove").prop('disabled', true);
	}
}
function checkuploadfile(){
	if ($("#upfile").val()==""){
		alert("Please choose 1 file");
		return false;
	}
	return true;
}
function confirmRename(){
	var total = 0;
	var fmobj = document.form1;
	var oldname;
	for (var i=0;i<fmobj.elements.length;i++) {
	 var e = fmobj.elements[i];
	 if ((e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled)) {
		 if (e.checked){
			 oldname = e.value;
			  total++;
		 }
	 }
	}
	if (total==0){ 
		alert("Please choose at least on file");
		return false;
	}
	if (total>1){ 
		alert("Please choose only 1 file");
		return false;
	}
	var newname = prompt("Please enter new name", oldname);
	if (newname != null) {
		$("#newname").val(newname);
		return true;
	}
	return false;
}
function changeDisplay(view){
	window.location.assign(window.location.href + "&view=" + view);
}
</script>
</head>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" onload="window.focus();">
<table width='100%' border=0 cellpadding="0" cellspacing="0" height="100%">
<form name='form1' action="" method="POST" enctype="multipart/form-data">
<input type="hidden" name="title" value="<?php echo $title?>">
<input type="hidden" name="pDir" value="<?php echo $pDir?>">
<input type="hidden" name="currentDir" value="<?php echo $dialog->currentDir?>">
<input type="hidden" name="inputname" value="<?=$inputname?>">
<input type="hidden" name="maxfilesize" value="<?=$maxfilesize?>">
<input type="hidden" name="type" value="<?php echo $dtype?>">
<input type="hidden" name="filetypes" value="<?php echo $filetypes?>">
<input type="hidden" name="basedir" value="<?php echo $basedir?>">
<input type="hidden" name="act" value="xxx">
<input type="hidden" name="variable" value="xxx">
<tr class="title">
	<td colspan="2">
	<div style="width:40%; float:left;">&nbsp;<?php echo $title?></div>	
	<div style="width:50%; float:right; text-align: right; font-size:12px; padding-right:1%; font-weight:normal;">
	Hiển thị dạng: 
	<?php if ($curr_view==0){?>
	List | <a href="#" onclick="return changeDisplay(1);" title="Chuyển sang dạng ảnh Thumb">Thumbnail</a>
	<?php }else{?>
	<a href="#" onclick="return changeDisplay(0);" title="Chuyển sang dạng List">List</a> | Thumbnail
	<?php }?>
	</div>
	</td>
</tr>
<tr>
	<td width="<?=$thumbwidth?>" bgcolor="#FFFFFF" align="right">
		Look in:
	</td>
	<td align='left' valign="top" height="30">
		<table style='margin-left:10px' >
		<tr>
		<td>
			<?php
				$lookin = "<option value='".$dialog->parentDir."'>/</option>";
				$pdir_arr=$dialog->getParentDirForCurrentDir();
				$parentdir="";
				for($i=0;$i<count($pdir_arr);$i++){
					$parentdir.="/".$pdir_arr[$i];
					$lookin .= "<option value='".$dialog->parentDir.$parentdir."' selected>".$parentdir."</option>";
				}
				$dialog->readDir();
				$dir_arr=$dialog->dirincurrdir;
				for($i=0;$i<count($dir_arr);$i++){	
					$lookin .= "<option value='".$dir_arr[$i]."' >".str_replace($dialog->parentDir,"",$dir_arr[$i])."</option>";
				}
			?>
			<select name='curr_dir' onChange="javascript:document.form1.submit();"><?=$lookin?></select>
		</td> 
		<td style="padding-right:5px"><a href='javascript:chDir()' title="Parent Directory"><img src='<?php echo $dialog->iconDir."btnFolderUp.gif"?>' border=0></a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		<td style="padding-right:5px"><a href='javascript:newDir()' title="New Directory"><img src='<?php echo $dialog->iconDir."btnFolderNew.gif"?>' border=0></a></td>
		<td style="padding-right:5px"><a href='javascript:about()' title="About"><img src='about.gif' border=0></a></td>
		<td style="padding-left:5px">
		<?php if ($dtype==0){?>
		Upload file: <input type="file" name='upfile' id="upfile" class="inputfield" >
		<?php }else{?>
		Upload file: <input type="file" name='upfile[]' id="upfile" class="inputfield" multiple >
		<?php }?>
		<input type="submit" value="Upload" class="btn" name="btnUpload" onClick="return checkuploadfile();"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td style="border-top:solid #CCCCCC 1px;border-right:solid #CCCCCC 1px" align="center" valign="top">
		<a id="athumb" href="#" onClick="return enLarge();" title="Click to view orginal size!"><img name="thumb" id="thumb" src="<?=$nopic?>"  width="200px" border="0"></a>
		<input type="hidden" name="dfilename" value="">
		<input type="text" name="resolution" value="" style="width:100%;border:0px;text-align:center" readonly="">
		<div id="afile_info" style="word-wrap: break-word; max-width:200px;"></div>	
	</td>	
	<td align='left' valign="top">
		<div class="filebox">
		<table cellpadding="0" cellspacing="0" border="0" width="99%" height="100%;">		
		<tr>
			<td valign="top"><?php echo $dialog->getFilesInCurrentDir($curr_view);	?></td>
		</tr>
		<tr>
			<td style="border-top:1px solid #CCCC; height:30px" valign="bottom">
			<div style="float:left">&nbsp;
			<a class='link' onclick="checkAll()">Select All</a> | <a class='link' onclick="unCheckAll()">UnSelect All</a> 
			</div>
			<div style="float:right">
			<input type="hidden" name="newname" id="newname" value="">
			<input type="hidden" name="newfolder" id="newfolder" value="">
			<input class="button" type="submit" value="Move" name="btnMove" id="btnMove" onclick="return confirmMove();" disabled>
			<input class="button" type="submit" value="Rename" name="btnRename" id="btnRename" onclick="return confirmRename();" disabled>
			<input class="button" type="submit" value="Delete selected" name="btnDelete" id="btnDelete" onclick="return confirmDelete();" disabled>
			</div>
			</td>
		</tr>
		</table>
		</div>
		<table cellpadding="5" cellspacing="0" border="0" style='margin-left:5px' width="98%">
		<tr>
			<td nowrap>File Name:</td>
			<td><input type="text" name='filename' size="50" class="inputfield" value="<?=$uploaded_file?>" title="Loại file <?=$filetypes ?>" placeholder="<?=$filetypes ?>" onClick="return checkFileOpen(this);">
			<input type="button" name="saveFile" value="Open" class="btn" onClick="openFile()"><input type="button" onClick="javascript:window.close();" value="Cancel " class="btn"></td>
		</tr>
		<tr>
			<td nowrap></td>
			<td colspan="3"></td>
		</tr>
		</table>
	</td> 
</tr>
<tr>
	<td colspan="3" bgcolor="#EFEFEF" height="20px">&copy;2007-<?=date("Y"); ?> All Rights Reserved. DSI.,JSC </td>
</tr>
</form>
</table>
<script>
var oldWidth = $(window).width();
var oldHeight = $(window).height();
$(document).ready(function () {
	updateContainer();
});
$(window).on('resize', function(){
	window.focus();
    updateContainer();
});
function updateContainer() {
    var cWidth = $(window).width();
    var cHeight = $(window).height();
    var w, h;
    w = cWidth-<?=$thumbwidth;?>-20;
	h = (cWidth==oldWidth)? oldHeight - 160 : cHeight - 160;
    $('.filebox').css({
          width : w,
          height: h
    });    
}
</script>
</body>
</html>