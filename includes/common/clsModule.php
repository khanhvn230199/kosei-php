<?
/******************************************************
 * Class Module
 *
 * Run corsesponding function with there params: $mod, $sub, $act
 * 
 * Project Name               :  Vinapg.com
 * Package Name            		:  
 * Program ID                 :  clsModule.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	2018/07/25    	TuanTA          -  		-     -     -
 *
 ********************************************************/
if (!defined("DIR_MODULES")){
	trigger_error("Cannot find constant 'DIR_MODULES'", E_USER_ERROR);	
	die();
}

class Module extends DbBasic{
	var $mod = "";//name of module
	var $path = DIR_MODULES;//path to module file
	var $arrSub = array();//array submod of module
	var $arrAct = array();//array action of submod
	var $errNo = 0;//error code
	var $requireLogin = 0;//0 is no need log in
	//function
	function Module($_mod="", $_path=""){	
		$this->pkey = "moduleid";
		$this->tbl = "module";
		if ($_mod!="")
			$this->mod = $_mod;
		if ($_path!="")
			$this->path = $_path;
		if (!is_dir($this->path."/".$this->mod)){
			//ModuleFolder is not exists
			showErrorFatalBox("notfound");
			//trigger_error("Module Folder is not exists!", E_USER_ERROR);
			exit();
		}
	}
	//function
	function addSub($sub){
		array_push($this->arrSub, $sub);
		$this->arrAct[$sub] = array();
	}
	//function
	function addAct($sub, $act){
		array_push($this->arrAct[$sub], $act);
	}
	//function
	function existsSub($sub){
		return in_array($sub, $this->arrSub);
	}
	//function
	function existsAct($sub, $act){
		return in_array($act, $this->arrAct[$sub]);
	}
	//function
	function run($sub="default", $act="default"){
		global $_SITE_ROOT, $default_permiss_name ;
		$this->addSub($sub);
		$this->addAct($sub, $act);
		if ($this->existsSub($sub) && $this->existsAct($sub, $act)){
			$file_mod_sub = $this->path."/".$this->mod."/sub_".$sub.".php";
			$file_sub_act = $this->path."/".$this->mod."/".$sub."_".$act.".php";
			if (file_exists($file_sub_act)){
				require_once($file_sub_act);
			}else
			if (file_exists($file_mod_sub)){
				require_once($file_mod_sub);				
			}
			$funcdef = $sub."_default";
			$func = $sub."_".$act;
			if (function_exists($func)){
				//Begin Tuanta Added 22/10/2008
				if ($_SITE_ROOT=="admin"){
					global $core;
					$m = $this->mod."_".$sub."_".$act;
					$ok = 1;
					if ($default_permiss_name[$m]!=""){
						$ok = ($core->hasPermiss($m)==1);
					}
					if ($this->mod=="default" || $this->mod=="_login" || $ok==1){
						$func();//call function sub_act()
					}else{
						showErrorWarningBox();
						exit();
					}
				}else{
					$func();//call function sub_act()
				}
				//End Tuanta Added
			}else
				if (function_exists($funcdef)){
				$funcdef();//call function sub_default()
			}else{
				//function sub_act() is not installed
				showErrorFatalBox("notfound");
				//trigger_error("SubModule is not found!", E_USER_ERROR);
				exit();
			}
		}else{
			//not exists act of sub or act is not registered to sub
			showErrorFatalBox("notfound");
			//trigger_error("This Module did not install!", E_USER_ERROR);
			exit();					
		}
	}	
}
?>