<?
/******************************************************
 * Class Form
 *
 * Form elements handling
 * Support Input : Text, Select, Radio, Checkbox, File, TextArea with CKEditor
 *
 * Project Name               :
 * Package Name            		:
 * Program ID                 :  clsForm.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.1
 * Creation Date              :  2014/01/01
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	2014/01/01    	TuanTA          -  		-     -     -
 * 1.1       	2014/07/30    	TuanTA          -  		-     -     update CKEditor
 *
 ********************************************************/
define("NVCMS_ERROR_NULL", 		"<li>'#NAME#' không được bỏ trống!</li>");
define("NVCMS_ERROR_LENGTH", 	"<li>'#NAME#' quá dài, độ dài tối đa là #MAX_LEN# ký tự!</li>");
define("NVCMS_ERROR_FORMAT", 	"<li>'#NAME#' không đúng định dạng #TYPE#!</li>");
define("NVCMS_ERROR_INSERT",	"<li>Không thể ghi vào CSDL!</li>");
define("NVCMS_ERROR_UPDATE",	"<li>Không thể cập nhật vào CSDL!</li>");
class Form{
  /**
   *  Name of form, default is theForm
   *  @var string
   */
	var $formName 		= 	"theForm";
	/**
	 *	@var array
	 */
	var $fields			= 	array();
	/**
	 *	List of inputs stored
	 *	@var array
	 */
	var $inputs 		=	array();
	/**
	 *	List of hint text for inputs
	 *	@var array
	 */
	var $arr_hint		=	array();
	/**
	 *	Total of inputs
	 *	@var int
	 */
	var $totalInputs 	= 	0;
	/**
	 *	Method of form
	 *	@var string
	 */
	var $method 		= 	"";
	/**
	 *	String of Javascript need to put in HTML
	 *	@var string
	 */
	var $strJS			=	"";
	/**
	 *	Validation of form
	 *	@var bool (1 or 0)
	 */
	var $isValid 		=	1;
	/**
	 *	Error string if not validate
	 *	@var string
	 */
	var $errorStr		=	"";
	/**
	 *	Table name
	 *	@var string
	 */
	var $table			=	"";
	var $pkey 			= 	"";
	var $pval 			=	"";
	var $record			=	"";
	//
	var $isShowHD		=	0;//check for show Hidden Data
	var $isShowJSDate	=	0;
	var $isShowJSEditor	=	0;
	//
	var $showBgColor	=	1;
	/**
	 *	Type of Text Area (simple, full, SAPO, small)
	 *	@var string
	 */
	var $textAreaType	=	"simple";
	//
	var $attach_input 		= 	array();
	var $dir_uploads 			=	"";  //Ex: uploads, videos
	var $url_uploads 			=	"";  //Ex: uploads, videos
	var $defaultUploadDir 	=	"";  //Ex: gallery in uploads
	//

  /**
   * Constructor
	 *
   * @param string _formName (name of form)
	 * @param string _method (method of form GET/POST)
   */
	function Form($_formName="", $_method=""){
		global $core;
		if ($_formName!="") $this->formName = $_formName;
		if ($_method!="") $this->method = $_method;
		if ($this->dir_uploads==""){
			$this->dir_uploads = DIR_UPLOADS;
			$this->url_uploads = URL_UPLOADS;
		}
		$this->errorStr = "";
		$this->strJS = "
			<script language='javascript'>
			function savecontinue(){
				document.".$this->formName.".btnSave.value= \"SaveContinue\";
				document.".$this->formName.".submit();
			}
			function save(){
				document.".$this->formName.".btnSave.value= \"Save\";
				document.".$this->formName.".submit();
			}
			</script>"."\n";
	}
	function updateJS(){
		$js = "";
		if ($this->textAreaType!="" && $this->textAreaType!="none"){
			$this->strJS = "
				<script language='javascript'>
				function savecontinue(){
					$js
					document.".$this->formName.".btnSave.value= \"SaveContinue\";
					document.".$this->formName.".submit();
				}
				function save(){
					$js
					document.".$this->formName.".btnSave.value= \"Save\";
					document.".$this->formName.".submit();
				}
				</script>"."\n";
		}
		return $this->strJS;
	}
	//function
	function setDbTable($_table, $_pkey="", $_pval="", $flag=0){//default flag=0 is not call getGoodSQL()
		global $dbconn;
		$this->table = $_table;
		$this->pkey = $_pkey;
		$this->pval = $_pval;
		if ($_pval!=""){
			$sql = "SELECT * FROM ".$this->table." WHERE ".$this->pkey."='".$this->pval."'";
			$this->record = $dbconn->GetRow($sql, false, $flag);
		}
	}
	//function
	function getFieldValue($colname){
		return $this->record[$colname];
	}
	//function
	function setTitle($_title){
		$this->title = $_title;
	}
	function getLang($key){
		global $_LANG;
		if (strpos($key, " ")!==false){
			$arr = str_word_count($key, 1, '_');
			foreach ($arr as $k => $v){
				$val = trim($v, "'?,");
				$trans= (isset($_LANG[$val]))? $_LANG[$val] : $val;
				$key = str_replace($val, $trans, $key);

			}
			return $key;
		}else{
			$val = trim($key, "'?,");
			$trans= (isset($_LANG[$val]))? $_LANG[$val] : $val;
			$key = str_replace($val, $trans, $key);
			return $key;
		}
		return $key;
	}
	//function
	function getTitle(){
		return $this->title;
	}
	//function
	function setMethod($_method){
		$this->method = $_method;
	}
	//function
	function setShowErrorWithBgColor($_showBgColor){
		$this->showBgColor = $_showBgColor;
	}
	//function
	function setFormName($_formName){
		$this->formName = $_formName;
	}
	//function
	function setTextAreaType($_type=""){
		$this->textAreaType = $_type;
	}
	//function
	function setDirUploads($_dir_uploads=""){
		$this->dir_uploads = $_dir_uploads;
	}
	//function
	function addStrJS($_strJS){
		$this->strJS.= $_strJS;
	}
	//function
	function addField($field){
		array_push($this->fields, $field);
	}

	function addHint($colname="", $hint=""){
		$this->arr_hint[$colname] = $hint;
	}
	//function
	function addFieldString($fieldStr=""){
		if (strpos($fieldStr, ",")!==false){
			$arr = explode(',', $fieldStr);
			if (is_array($arr))
			foreach ($arr as $key => $val){
				array_push($this->fields, trim($val));
			}
		}
	}
	//Array Type, added 03/07/2014
	function addInputArray($colname, $value="", $coltitle="", $attr="", $arr_format=""){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"array", "attr"=>$attr,  "arr_format"=>$arr_format, "errNo" => 0, "errStr"	=>	"");
		$this->totalInputs++;
	}
	//Checkbox, added 04/07/2014
	function addInputCheckbox($colname, $value="", $coltitle="", $attr="", $truevalue=1){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"checkbox", "attr"=>$attr, 'truevalue'=>$truevalue);
		$this->totalInputs++;
	}
	//Label
	function addInputLabel($colname, $value="", $coltitle="", $len=80){
		if ($coltitle=="") $coltitle = $colname;
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"label", "len"=>$len);
		$this->totalInputs++;
	}
	//Text
	function addInputText($colname, $value="", $coltitle="", $len="", $allowNull=0, $attr="", $db_suggest=0){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"text",
								"len"=>$len, "allowNull"=>$allowNull, "attr"=>$attr, "errNo" => 0, "errStr"	=>	"",
								"db_suggest"=>$db_suggest
								);
		$this->totalInputs++;
	}
	//Password
	function addInputPassword($colname, $value="", $coltitle="", $len="", $allowNull=0, $attr=""){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"password",
								"len"=>$len, "allowNull"=>$allowNull, "attr"=>$attr, "errNo" => 0, "errStr"	=>	""
								);
		$this->totalInputs++;
	}
	//TextArea
	function addInputTextArea($colname, $value="", $coltitle="", $len="", $cols=10, $rows=5, $allowNull=0, $attr="", $cktype=''){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"textarea",
								"len"=>$len, "cols"=>$cols, "rows"=>$rows,
								"allowNull"=>$allowNull, "attr"=>$attr, "errNo" => 0, "errStr"	=>	"", "cktype" => $cktype
								);
		$this->totalInputs++;
		$this->updateJS();
	}
	//Number
	function addInputNumber($colname, $value="", $coltitle="", $len="", $allowNull=0, $attr=""){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"number",
								"len"=>$len, "allowNull"=>$allowNull, "attr"=>$attr, "errNo" => 0, "errStr"	=>	""
								);
		$this->totalInputs++;
	}
	//Url
	function addInputUrl($colname, $value="", $coltitle="", $len="", $allowNull=0, $attr=""){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"url",
								"len"=>$len, "allowNull"=>$allowNull, "attr"=>$attr, "errNo" => 0, "errStr"	=>	""
								);
		$this->totalInputs++;
	}
	//Email
	function addInputEmail($colname, $value="", $coltitle="", $len="", $allowNull=0, $attr=""){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"email",
								"len"=>$len, "allowNull"=>$allowNull, "attr"=>$attr, "errNo" => 0, "errStr"	=>	""
								);
		$this->totalInputs++;
	}
	//Date
	function addInputDate($colname, $value="", $coltitle="", $format="%m/%d/%Y %H:%M", $showTime=1, $allowNull=0, $attr="style='width:110px'"){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"date",
								"format"=>$format, "showTime"=>$showTime, "allowNull"=>$allowNull, "attr"=>$attr);
		$this->totalInputs++;
	}
	//Hidden
	function addInputHidden($colname, $value=""){
		//if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltype"=>"hidden");
		$this->totalInputs++;
	}
	//Select
	function addInputSelect($colname, $value="", $coltitle="", $arrOptions, $valueSameOption=0, $attr="", $allowNull=1){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"select", "attr"=>$attr, "arrOptions" => $arrOptions, "valueSameOption"=> $valueSameOption, "allowNull"=>$allowNull);
		$this->totalInputs++;
	}
	//MultiSelect
	function addInputMSelect($colname, $value="", $coltitle="", $arrOptions, $valueSameOption=0, $attr=""){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"mselect", "attr"=>$attr, "arrOptions" => $arrOptions, "valueSameOption"=> $valueSameOption);
		$this->totalInputs++;
	}
	//Radio
	function addInputRadio($colname, $value="", $coltitle="", $arrOptions, $valueSameOption=0, $attr=""){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"radio", "attr"=>$attr, "arrOptions" => $arrOptions, "valueSameOption"=> $valueSameOption);
		$this->totalInputs++;
	}
	//File
	function addInputFile($colname, $value="", $coltitle="", $filetypes="jpg,gif,jpeg,rar,zip,doc,xsl,exe,txt,ppt,pdf", $allowNull=0, $attr="", $dir_uploads="", $multiple=0){
		if ($coltitle=="") $coltitle = $colname;
		if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"file",
								"filetypes"=>$filetypes, "allowNull"=>$allowNull, "attr"=>$attr,
								"dir_uploads"=>$dir_uploads, "multiple" => $multiple
								);
		$this->totalInputs++;
	}
	//function
	function addInputCustom($colname, $value){
		//if ($this->pkey!="" && $this->pval!="") $value = $this->record[$colname];
		$this->inputs[] = array("colname"=>$colname, "value"=>$value, "coltype"=>"custom");
		//print_r($this->inputs[$this->totalInputs]);
		$this->totalInputs++;
	}
	//Begin Tuanta Added 17/02/2011
	function addAttachInput($input1, $input2){
		$this->attach_input[$input1] = $input2;
	}
	//End Tuanta Added 17/02/2011
	//function
	function getInput($colname){
		if (is_array($this->inputs))
		foreach ($this->inputs as $val)
		if ($val["colname"]==$colname){
			return $val;
		}
		return 0;
	}
	//function
	function getAllError(){
		return $this->errorStr;
	}
	//function
	function getErrorNo($colname){
		$input = $this->getInput($colname);
		return $input["errNo"];
	}
	//function, added 03/07/2014
	function showInputArray($input){
		global $dbconn;
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		if ($value!="") $arr_value = @unserialize($value);
		$arr_format = $input['arr_format'];
		$html = "";
		if (is_array($arr_format)){
			$html.="<table $attr >";
			foreach ($arr_format as $key => $format){
				$value = ($arr_value[$key]!="")? $arr_value[$key] : $format[2];
				$colname = $name.'['.$key.']';
				$coltitle = $format[0];
				$output = "";
				if ($key[0]=='t'){//text
					$input1 = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"text", "len"=>$format[1], "allowNull"=>1,
													"attr"=>"style='width:100%' placeholder='".$format[3]."'", "errNo" => 0
													);
					$output = $this->showInputText($input1);
				}elseif ($key[0]=='c'){//checkbox
					$truevalue = $format[1];
					$input1 = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"checkbox", "attr"=>"", 'truevalue'=>$truevalue);
					$output = $this->showInputCheckbox($input1);
				}elseif ($key[0]=='s'){//select box
					$arrOptions = $format[1];
					$input1 = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"select", "attr"=>"", "arrOptions" => $arrOptions, "valueSameOption"=> 0);
					$output = $this->showInputSelect($input1);
				}elseif ($key[0]=='r'){//radio
					$arrOptions = $format[1];
					$input1 = array("colname"=>$colname, "value"=>$value, "coltitle"=>$coltitle, "coltype"=>"radio", "attr"=>"", "arrOptions" => $arrOptions, "valueSameOption"=> 0);
					$output = $this->showInputRadio($input1);
				}
				$html.="<tr>";
				$html.= "<td width='5%' nowrap>+".$format[0]."</td><td width='5%'>&nbsp;</td><td>".$output."</td>";
				$html.="</tr>";
			}
			$html.="</table>";
		}
		return $html;
	}
	//function, added 04/07/2014
	function showInputCheckbox($input){
		global $dbconn;
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$checked = ($value==$input['truevalue'])? 'checked' : '';
		$html = "<input type='hidden' name='$name' value='0'/>\n";
		$html.= "<input type='checkbox' name='$name' id='$name' value='".$input['truevalue']."' $attr $checked />\n";
		return $html;
	}
	//function
	function showInputLabel($input){
		global $dbconn;
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$len = $input["len"];
		$html = wordwrap($value, $len, "<br>");
		return $html;
	}
	//function
	function showInputText($input){
		global $dbconn;
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$len = $input["len"];
		$html = "<input type=\"text\" name=\"$name\" id=\"$name\" maxlength=\"$len\" value=\"$value\" $attr />\n";
		if ($input["db_suggest"]==1){
			$sql = "SELECT DISTINCT($name) FROM ".$this->table;
			$arr = $dbconn->GetAll($sql);
			if (is_array($arr))
			foreach ($arr as $key => $val){
				$html.= "<a href='#' onClick=\"document.getElementById('$name').value='".$val[$name]."';\">".$val[$name]."</a>, ";
			}
		}
		return $html;
	}
	//function
	function showInputPassword($input){
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$len = $input["len"];
		$html = "<input type=\"password\" name=\"$name\" id=\"$name\" maxlength=\"$len\" value=\"$value\" $attr />\n";
		return $html;
	}
	//function
	function showInputTextAreaCKE($input){
		$cktype = $input['cktype'];
		if ($cktype=='') $cktype = $this->textAreaType;
		if ($this->isShowJSEditor==0 && $cktype!="" && $cktype!="none"){
			$html.= "<!-- Begin CKEditor -->\n";
			$html.= "<script language=\"javascript\" src=\"".VNCMS_URL."/includes/ckeditor/ckeditor.js\"></script>\n";
			$html.= "<!-- End CKEditor -->\n";
			$html.= "\n";
		}
		$SID = session_id();
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$len = $input["len"];
		$re = "/width:(?<width>\\d+).*height:(?<height>\\d+)/";
		preg_match($re, $input['attr'], $style);

		$html.= "<textarea rows=\"$this->rows\" cols=\"$this->cols\" name=\"$name\" id=\"$name\" $attr>$value</textarea>";
		if ($cktype!="" && $cktype!="none"){
			$toolbar = $toolbarGroups = "";
			if ($cktype=='SAPO'){
				$height = ($style['height']!="")? $style['height'] : 150;
				$toolbar = "toolbar:[
															[ 'PasteText', 'PasteFromWord'],			// Defines toolbar group without name.
															'-',
															{ name: 'basicstyles', items: [ 'RemoveFormat'  ] },
															{ name: 'links', items: [ 'Unlink' ] },
														], height:$height, ";
			}elseif ($cktype=='SMALL'){
				$height = ($style['height']!="")? $style['height'] : 200;
				$toolbar = "toolbar:[
															[ 'PasteText', 'PasteFromWord'],			// Defines toolbar group without name.
															'-',
															{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat'  ] },
															{ name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight']},
															{ name: 'links', items: [ 'Link', 'Unlink' ] },
															{ name: 'insert', items: [ 'Image'] },
														], height:$height,";
			}else{
				$height = ($style['height']!="")? $style['height'] : 400;
				$toolbar = "height:$height,";
			}
			$html.= "<script type='text/javascript'>
								var editor$name = CKEDITOR.replace( '$name',{
									$toolbar
									filebrowserBrowseUrl : '".VNCMS_URL."/dialogs/dialogbox.php?s=$SID&pDir=".$this->dir_uploads."&inputname=$name',
									filebrowserImageBrowseUrl : '".VNCMS_URL."/dialogs/dialogbox.php?s=$SID&pDir=".$this->dir_uploads."&inputname=$name',
								});
								function openFile_".$name."(value){
										$('.cke_editor_".$name."_dialog').find('input:first').val(value);
								}
							</script> ";
		}
		if ($this->isShowJSEditor==0) $this->isShowJSEditor = 1;
		return $html;
	}
	function showInputTextArea($input){
		return $this->showInputTextAreaCKE($input);
	}
	//function
	function showInputNumber($input){
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$len = $input["len"];
		$html = "<input type=\"number\" name=\"$name\" id=\"$name\" maxlength=\"$len\" value=\"$value\" $attr />\n";
		return $html;
	}
	//function
	function showInputEmail($input){
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$len = $input["len"];
		$html = "<input type=\"email\" name=\"$name\" id=\"$name\" maxlength=\"$len\" value=\"$value\" $attr />\n";
		return $html;
	}
	//function
	function showInputUrl($input){
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$len = $input["len"];
		$html = "<input type=\"text\" name=\"$name\" id=\"$name\" maxlength=\"$len\" value=\"$value\" $attr />\n";
		return $html;
	}
	//function
	function showInputSelect($input){
		$arrOptions = $input["arrOptions"];
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$valueSameOption = $input["valueSameOption"];
		$html = "<select name=\"$name\" id=\"$name\" $attr >\n";
		if (is_array($arrOptions)){
			foreach ($arrOptions as $key => $val){
				$val1 = ($valueSameOption==1)? $val : $key;
				$selected = ($val1==$value)? "selected" : "";
				$html.= "<option value='$val1' $selected >$val</option>\n";
			}
		}
		$html.= "</select>\n";
		return $html;
	}
	function showInputRadio($input){
		$arrOptions = $input["arrOptions"];
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$valueSameOption = $input["valueSameOption"];
		$html = "";
		if (is_array($arrOptions)){
			foreach ($arrOptions as $key => $val){
				$val1 = ($valueSameOption==1)? $val : $key;
				$selected = ($val1==$value)? "checked" : "";
				$html.= "<input type='radio' name='$name' value='$val1' $selected  $attr > $val &nbsp;&nbsp;";
			}
		}
		$html.= "\n";
		return $html;
	}
	function showInputMSelect($input){
		$arrOptions = $input["arrOptions"];
		$name = $input["colname"];
		$value = $input["value"];
		if ($value[strlen($value)-1]==',') $value[strlen($value)-1] = '';
		$arr_value = explode(',', $value);
		$attr = $input["attr"];
		$valueSameOption = $input["valueSameOption"];
		$html = "<select name=\"".$name."[]\" id=\"$name\" $attr multiple >\n";
		if (is_array($arrOptions)){
			foreach ($arrOptions as $key => $val){
				$val1 = ($valueSameOption==1)? $val : $key;
				$selected = (in_array($val1, $arr_value)==1)? "selected" : "";
				$html.= "<option value='$val1' $selected >$val</option>\n";
			}
		}
		$html.= "</select>\n";
		return $html;
	}
	//function
	function showInputHidden($input){
		$name = $input["colname"];
		$value = $input["value"];
		$html = "<input type=\"hidden\" name=\"$name\" id=\"$name\" value=\"$value\"/>\n";
		return $html;
	}

	function showInputFile($input){

		require_once(VNCMS_DIR."/dialogs/dialog.inc.php");
		$name = $input["colname"];
		$value = $input["value"];
		$attr = $input["attr"];
		$multiple = $input["multiple"];
		//------------------------------
		$maxFileSize = 1024*1024*2000;//2GB
		$diruploads = "";
		if ($input["dir_uploads"]!=""){
			$diruploads = $input["dir_uploads"];
		}else{
			$diruploads = $this->dir_uploads;
		}
		$current_dir = ($this->defaultUploadDir=="")? $diruploads : diruploads."/".$this->defaultUploadDir;
		$dialog=new DIALOG($diruploads);
		$dialog->setBaseDir(VNCMS_URL."/dialogs"); // path/to/dialog folder
		$dialog->setFileType($input["filetypes"]);
		$dialog->setInputName($name);
		$dialog->setDialogType($multiple);
		$dialog->setMaxFileSize($maxFileSize);
		$strJS = "<script>
function openFile_".$name."(value){
	var dtype = $multiple;
	if (document.".$this->formName.".".$name."){
		document.".$this->formName.".".$name.".value = value;
	}else{
		document.getElementById(".$name.").value = value;
	}
	if (dtype>0){
		var res = value.split(',');
		var n = res.length;
		var newImg = '';
		for (i=0; i<n; i++){
			newImg += \"<div class='CK_file_image'>\";
			newImg += \"<img src='".$this->url_uploads."/\"+res[i]+\"' style='max-width:100px; margin-right:10px' data-src='\"+res[i]+\"' title='Giữ chuột và di chuyển ảnh'/><br>\";
			newImg += \"<a class='btn_xoa' href='#' title='Xóa ảnh này' onclick='openFile_CK_delete_image(this)'>&nbsp;&nbsp;X&nbsp;&nbsp;</a>\";
			newImg += \"</div>\";
		}
		document.getElementById('CK_file_".$name."').innerHTML = newImg;
	}else
	if(/(\.png|\.gif|\.jpg|\.jpeg)$/i.test(value)) {
		var newImg = \"<img src='".$this->url_uploads."/\"+value+\"' style='max-width:100px; margin-right:10px' align=middle />\";
		document.getElementById('CK_file_".$name."').innerHTML = newImg;
	}
}
function openFile_CK_delete_image(obj){ $(obj).parent().remove();
	var spanname = 	'CK_file_".$name."';
	var str = '';
	$('#' + spanname + ' img').each(function () {
	    if (str=='') str = $(this).attr('data-src'); else str = str + ',' + $(this).attr('data-src');
	});
	$('#".$name."').val(str);
}
</script>
<style>
.sortable-placeholder{ background:#CCC; border: 1px dotted black; margin:10px; width:100px; height: 100px; float:left;}
.CK_file_image{width:100px; height:100px; margin:10px; border:1px solid #ccc; float:left; position:relative; overflow:hidden;}
.CK_file_image img{ max-width:100px; margin-right:10px; }
.CK_file_image .btn_xoa{ display:none; }
.CK_file_image:hover{ border:1px solid blue; }
.CK_file_image:hover .btn_xoa{ position: absolute; display:block; right:0px; bottom:0px; background:red; color:white; font-weight:bold;}
</style>
";
		$html = "";
		$html.= $strJS;
		$placeholder = ($multiple==0)? "Chọn 1 file từ server" : "Chọn 1 hoặc nhiều file từ server";

		if ($multiple==0){
			$extension = strtolower(substr(strrchr($value,"."),1));
			$allowExt="jpeg, jpg, png, gif";
			if ($extension!="" && strpos($allowExt, $extension)!==false){
				$newImg = "<img src='".$this->url_uploads."/".$value."' style='max-width:100px; margin-right:10px' align=middle >";
			}
			$html.= "<span id='CK_file_".$name."'>$newImg</span><input type='text' id='$name' name='$name' value='$value' $attr placeholder='$placeholder'>";
			$html.= "&nbsp;".$dialog->showDialog()."<br>";
		}else{
			$html.= "<input type='text' id='$name' name='$name' value='$value' $attr placeholder='$placeholder'>";
			$html.= "&nbsp;".$dialog->showDialog()."<br>";
			$newImg = "";
			if ($value!="") $arr_value = explode(',', $value);
			if (is_array($arr_value)){
				foreach ($arr_value as $k => $v){
					$newImg.= "<div class='CK_file_image'>
<img src='".$this->url_uploads."/".$v."' data-src='$v' title='Giữ chuột và di chuyển ảnh'><br>
<a class='btn_xoa' href='#' title='Xóa ảnh này' onclick='openFile_CK_delete_image(this)'>&nbsp;&nbsp;X&nbsp;&nbsp;</a>
</div>";
				}
			}
			$html.= "<span id='CK_file_".$name."' class='CK_file_sortable'>$newImg</span>";
			$html.= "<script>$( function() {
	$('.CK_file_sortable').sortable({connectWith: '.CK_file_sortable', placeholder: 'sortable-placeholder',
		update: function(){
			var spanname = 	'CK_file_".$name."';
			var str = '';
			$('#' + spanname + ' img').each(function () {
			    if (str=='') str = $(this).attr('data-src'); else str = str + ',' + $(this).attr('data-src');
			});
			$('#".$name."').val(str);
		}
	});
} );
</script>";
		}
		$readonly = ($input["allowNull"]==1)? "" : "disabled";

		unset($dialog);
		return $html;
	}
	//function
	function showInputDate($input){
		$name = $input["colname"];
		$value = $input["value"];
		$format = $input["format"];
		if ($format=="DATE"){
			if ($value==0) return "N/A";
			return date("d/m/Y", $value);
		}
		$showTime = $input["showTime"];
		$attr = $input["attr"];
		if (!class_exists("DatePicker")){
			require_once DIR_COMMON."/clsDatePicker.php";
		}
		$html = "";
		$clsDatePicker = new DatePicker($name, $value, $format, $showTime, $attr);
		if ($this->isShowJSDate==0){
			$html.= $clsDatePicker->showJSCSS();
		}
		$html.= $clsDatePicker->showInputDate();
		if ($this->isShowJSDate==0) $this->isShowJSDate = 1;
		return $html;
	}
	//function
	function showTitle($colname){
		$input = $this->getInput($colname);
		$html = $this->getLang($input["coltitle"]);
		if (isset($input["allowNull"]) && $input["allowNull"]==0){
			$html.= " * ";
		}
		return $html;
	}
	//function
	function showHint($colname){
		if ($this->arr_hint[$colname]=="") return "";
		$html = "<img src='".ADMIN_URL_IMAGES."/ico_help.png' border='0' title='".$this->arr_hint[$colname]."' align='middle' style='cursor:pointer'/>";
		return $html;
	}
	//function
	function showJS(){
		return $this->strJS;
	}
	//function
	function showInput($colname){
		$input = $this->getInput($colname);

		$html = $this->showHiddenData();
		switch ($input["coltype"]){
			case "label"	:	$html.= $this->showInputLabel($input); break;
			case "text"		:	$html.= $this->showInputText($input); break;
			case "password"	:	$html.= $this->showInputPassword($input); break;
			case "textarea"	:	$html.= $this->showInputTextArea($input); break;
			case "number"	:	$html.= $this->showInputNumber($input); break;
			case "email"	:	$html.= $this->showInputEmail($input); break;
			case "url"		:	$html.= $this->showInputUrl($input); break;
			case "select"	:	$html.= $this->showInputSelect($input); break;
			case "mselect":	$html.= $this->showInputMSelect($input); break;
			case "radio"	:	$html.= $this->showInputRadio($input); break;
			case "hidden"	:	$html.= $this->showInputHidden($input); break;
			case "date"		:	$html.= $this->showInputDate($input); break;
			case "file"		:	$html.= $this->showInputFile($input); break;
			case "array"	:	$html.= $this->showInputArray($input); break;
			case "checkbox"	:	$html.= $this->showInputCheckbox($input); break;
			case "custom": $html.= $input['value'];break;
		}
		return $html;
	}
	//function
	function showAllError(){
		$e = "<div style='background-color:#FFFFCC; color:#C60000; border:#FFCC00 2px solid;   width:auto; font-size:13px; margin:0pt 0pt 10px; background-image:url(".ADMIN_URL_IMAGES."/warning.gif);background-repeat:no-repeat;background-position:20px 14px;padding-left:80px;padding-top:5px; font-family:Tahoma' >";
		//$e.= "<img src='".ADMIN_URL_IMAGES."/warning.png' align=left style='padding-right:20px'>";
		$e.= "Hãy điền đầy đủ các thông tin dưới đây.";
		$e.= "<ul style='min-height:50px; margin-left:15px'>";
		$e.= $this->errorStr;
		$e.= "</ul>";
		$e.= "</div>";
		return $e;
	}
	//function
	function showError($colname){
		$input = $this->getInput($colname);
		return $input["errStr"];
	}
	//function
	function showHiddenData(){
		if ($this->isShowHD==1) return "";
		$html = "";
		$html.= "<input type='hidden' name='btnSave' id='btnSave' value=''>"."\n";
		if ($this->isShowHD==0) $this->isShowHD = 1;
		return $html;
	}
	//function
	function showForm(){
		$html = "";
		//show Hidden first
		foreach ($this->inputs as $key => $val)
		if ($val["coltype"]=="hidden"){
			$html.= $this->showInput($val["colname"])."\n";
		}
		//then show other
		$arr_tmp_show = array();

		foreach ($this->inputs as $key => $val)
		if ($val["coltype"]!="custom" && $val["coltype"]!="hidden" && $arr_tmp_show[$val['colname']]==0){
			$bcolor = ($this->inputs[$key]["errNo"]!=0 && $this->showBgColor==1)? "red" : "";
			if ($key<$this->totalInputs-1){
				$className1 = "gridrow";
				$className2 = "gridrow1";
			}else{
				$className1 = "gridrow2";
				$className2 = "gridrow3";
			}
			//Begin Added 18/02/2011
			$arr_tmp_show[$val['colname']] = 1;
			$attach_html = "";
			if ($this->attach_input[$val['colname']]!=""){
				$attach_colname = $this->attach_input[$val['colname']];
				if (strpos($attach_colname, ',')!==false){
					$arr = explode(',', $attach_colname);
					if (is_array($arr))
					foreach ($arr as $k => $v){
						$attach_html.= $this->showTitle($v)." ";
						$attach_html.= $this->showInput($v)."".$this->showHint($v)." ";
						$arr_tmp_show[$v] = 1;
					}
				}else{
					$attach_html.= $this->showTitle($attach_colname)." ";
					$attach_html.= $this->showInput($attach_colname)."".$this->showHint($attach_colname);
					$arr_tmp_show[$attach_colname] = 1;
				}
			}
			//End Added 18/02/2011
			if ($val["coltype"]=='textarea'){
				$html.= "<tr style='background:none' id='tr_".$val['colname']."'>\n";
			}else{
				$html.= "<tr id='tr_".$val['colname']."'>\n";
			}
			$html.= "<td class='$className1' width='30%' nowrap>".$this->showTitle($val["colname"])."</td>\n";
			$valign = ($val['coltype']=='radio')? '' : 'top';
			if ($val['coltype']=='label') $valign='middle';
			$html.= "<td class='$className2' nowrap bgcolor='$bgcolor' valign='$valign'>".$this->showInput($val["colname"])."".$this->showHint($val["colname"]).$attach_html."</td>\n";
			$html.= "</tr>\n";
		}else if ($val["coltype"]=="custom" && $arr_tmp_show[$val['colname']]==0){
			/*$html.= "<tr>
		<td colspan='2' class='gridheader1'>".$this->showTitle($val["colname"])."</td>
	</tr>";*/
			$html.= $val["value"];
		}
		return $html;
	}
	//function
	function validInputText(&$input){
		$errNo = 0;
		if (function_exists("checkValidText")){
			if (!checkValidText($input["value"], $input["len"], $errNo)){
				if ($errNo == 1 && $input["allowNull"])
					return 1;
				$input["errNo"] = $errNo;
				return 0;
			}
			return 1;
		}else{
			if ($input["value"]==""){
				if ($input["allowNull"])
					return 1;
				$input["errNo"] = 1;
				return 0;
			}
			return 1;
		}
	}
	function validInputPassword(&$input){
		$errNo = 0;
		if (function_exists("checkValidText")){
			if (!checkValidText($input["value"], $input["len"], $errNo)){
				if ($errNo == 1 && $input["allowNull"])
					return 1;
				$input["errNo"] = $errNo;
				return 0;
			}
			return 1;
		}else{
			if ($input["value"]==""){
				if ($input["allowNull"])
					return 1;
				$input["errNo"] = 1;
				return 0;
			}
			return 1;
		}
	}
	//function
	function validInputNumber(&$input){
		$errNo = 0;
		$valid = 1;
		if (function_exists("isNumber")){
			if (!isNumber($input["value"])){
				if ($input["value"]=="" && $input["allowNull"])
					return 1;
				$input["errNo"] = 3;
				return 0;
			}
			return 1;
		}else{
			if ($input["value"]==""){
				if ($input["allowNull"])
					return 1;
				$input["errNo"] = 1;
				return 0;
			}
			return 1;
		}
	}
	//function
	function validInputEmail(&$input){
		$errNo = 0;
		if (function_exists("checkValidEmail")){
			if (!checkValidEmail($input["value"], $input["len"], $errNo)){
				if ($errNo == 1 && $input["allowNull"]){
					return 1;
				}
				$input["errNo"] = $errNo;
				return 0;
			}
			return 1;
		}else{
			if ($input["value"]==""){
				if ($input["allowNull"])
					return 1;
				$input["errNo"] = 1;
				return 0;
			}
			return 1;
		}
	}
	//function
	function validInputUrl(&$input){
		$errNo = 0;
		if (function_exists("checkValidUrl")){
			if (!checkValidUrl($input["value"], $input["len"], $errNo)){
				if ($errNo == 1 && $input["allowNull"]){
					return 1;
				}
				$input["errNo"] = $errNo;
				return 0;
			}
			return 1;
		}else{
			if ($input["value"]==""){
				if ($input["allowNull"])
					return 1;
				$input["errNo"] = 1;
				return 0;
			}
			return 1;
		}
	}
	//function
	function validInputDate(&$input){
		$errNo = 0;
		if ($input["value"]==""){
			if ($input["allowNull"])
				return 1;
			$input["errNo"] = 1;
			return 0;
		}
		return 1;
	}
	//function
	function validInputFile(&$input){
		$errNo = 0;
		if ($input["value"]==""){
			if ($input["allowNull"])
				return 1;
			$input["errNo"] = 1;
			return 0;
		}
		return 1;
	}
	function validInputSelect(&$input){
		$errNo = 0;
		if ($input["value"]=="" || $input["value"]=="0"){
			if ($input["allowNull"])
				return 1;
			$input["errNo"] = 1;
			return 0;
		}
		return 1;
	}
	//function
	function validate(){
		global $core;
		if ($this->totalInputs==0) return 0;
		$this->isValid = 1;
		foreach ($this->inputs as $key => $val){
			if ($val['coltype']=="array"){
				$postvalue = $_POST[$val["colname"]];
			}else
			if (!is_array($_POST[$val["colname"]])){
				$postvalue = trim($_POST[$val["colname"]]);
			}
			if ($val["coltype"]=="custom"){
				continue;
			}
			if ($val["coltype"]=="mselect"){
				$postvalue = @implode(',', $_POST[$val["colname"]]);
				if ($postvalue!="") $postvalue.=',';
			}
			if ($val["coltype"]=="textarea" && $postvalue!=""){
				$postvalue = br2nl($_POST[$val["colname"]]);
				if ($postvalue=="&lt;br&gt;") $postvalue = $_POST[$val["colname"]] = "";
			}
			if ($val["coltype"]=="date" && $postvalue!=""){
				$postvalue = mystrtotime($postvalue, $val['format']);
			}
			if ($val["allowNull"])
				$this->inputs[$key]["value"] = $val["value"] = $postvalue;
			elseif ($postvalue!="")
				$this->inputs[$key]["value"] = $val["value"] = $postvalue;
			switch ($val["coltype"]){
				case "textarea"	:	$this->isValid*= $this->validInputText($this->inputs[$key]); break;
				case "text"		:	$this->isValid*= $this->validInputText($this->inputs[$key]); break;
				case "password"		:	$this->isValid*= $this->validInputPassword($this->inputs[$key]); break;
				case "number"	:	$this->isValid*= $this->validInputNumber($this->inputs[$key]); break;
				case "email"	:	$this->isValid*= $this->validInputEmail($this->inputs[$key]); break;
				case "url"		:	$this->isValid*= $this->validInputUrl($this->inputs[$key]); break;
				case "date"		:	$this->isValid*= $this->validInputDate($this->inputs[$key]); break;
				case "file"		:	$this->isValid*= $this->validInputFile($this->inputs[$key]); break;
				case "select"		:	$this->isValid*= $this->validInputSelect($this->inputs[$key]); break;
			}
			if ($this->inputs[$key]["errNo"]==1){
				$errStr = NVCMS_ERROR_NULL;
				$this->inputs[$key]["errStr"] = str_replace("#NAME#", $core->getLang($val["coltitle"]), $errStr);
			}else
			if ($this->inputs[$key]["errNo"]==2){
				$errStr = NVCMS_ERROR_LENGTH;
				$errStr = str_replace("#NAME#", $val["coltitle"], $errStr);
				$this->inputs[$key]["errStr"] = str_replace("#MAX_LEN#", $core->getLang($val["coltitle"]), $errStr);
			}else
			if ($this->inputs[$key]["errNo"]==3){
				$errStr = NVCMS_ERROR_FORMAT;
				$errStr = str_replace("#NAME#", $val["coltitle"], $errStr);
				$this->inputs[$key]["errStr"] = str_replace("#TYPE#", $val["coltype"], $errStr);
			}
			if ($this->inputs[$key]["errStr"]!=""){
				$this->errorStr.= $this->inputs[$key]["errStr"];
			}
		}
		return $this->isValid;
	}
	//function
	function saveData($mode="New"){
		if ($mode==""){
			$mode = ($this->pkey!="" && $this->pval!="")? "Edit" : "New";
		}
		if ($mode=="New"){//Insert mode
			return $this->insertDb();
		}else{//Update mode
			return $this->updateDb($this->pval);
		}
	}
	//function
	function insertDb(){
		global $dbconn, $_SITE_ID;
		$fields = "";
		$values = "";
		foreach ($this->inputs as $key => $val){
			if ($val["coltype"]=="custom" || $val["coltype"]=="label"){
				continue;
			}
			if ($val['coltype']=="array"){
				$val["value"] = serialize($val["value"]);
			}else
			if ( !is_array($val["value"]) ){
				$val["value"] = trim($val["value"]);
			}
			if (!get_magic_quotes_gpc() && !is_array($val["value"]) ) {
				$val["value"] = addslashes($val["value"]);
			}
			if ($val["coltype"]=="password"){
				$val["value"] = Users::encrypt($val["value"]);
			}
			$fields.= ($fields=="")? $val["colname"] : ",".$val["colname"];
			$values.= ($values=="")? "'".$val["value"]."'" : ", '".$val["value"]."'";
		}
		//Begin Added 19/03/2014
		if ($_SITE_ID>0 && strpos($fields, 'site_id')===false){
			$fields.= ", site_id";
			$values.= ", $_SITE_ID";
		}
		//End
		$sql  = "INSERT INTO ".$this->table."($fields) VALUES($values)";
		//die($sql);
		if (!$dbconn->Execute($sql)){
			$this->isValid = 0;
			$this->errorStr.= NVCMS_ERROR_INSERT;
			return 0;
		}
		return 1;
	}
	//function
	function updateDb($_pkey=""){
		global $dbconn, $_SITE_ID;
		$set = "";
		foreach ($this->inputs as $key => $val){
			if ($val["coltype"]=="custom" || $val["coltype"]=="label"){
				continue;
			}
			if ($val['coltype']=="array"){
				$val["value"] = serialize($val["value"]);
			}else
			if ( !is_array($val["value"]) ){
				$val["value"] = trim($val["value"]);
			}
			if (!get_magic_quotes_gpc() && !is_array($val["value"]) ) {
				$val["value"] = addslashes($val["value"]);
			}
			if ($val["coltype"]=="password" && $val["value"]!=$this->getFieldValue("user_pass")){
				$val["value"] = Users::encrypt($val["value"]);
				$set.= ($set=="")? $val["colname"]."='".$val["value"]."'" : ",".$val["colname"]."='".$val["value"]."'";
			}else{
				$set.= ($set=="")? $val["colname"]."='".$val["value"]."'" : ",".$val["colname"]."='".$val["value"]."'";
			}
		}
		$where  = ($_pkey!="")? "WHERE ".$this->pkey."='$_pkey'" : "";
		$sql = "UPDATE ".$this->table." SET $set $where ";
		if ($_SITE_ID>0 && strpos($sql, 'site_id')===false){
			$sql = getGoodSQL($sql);
		}
		if (!$dbconn->Execute($sql)){
			$this->isValid = 0;
			$this->errorStr.= NVCMS_ERROR_UPDATE;
			return 0;
		}
		return 1;
	}
}
?>