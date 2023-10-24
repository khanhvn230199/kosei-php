<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     htmlDecode<br>
 * Date:     Mar 03, 2015
 * Purpose:  getLang of string
 * @version  1.0
 * @author   dvs
 * @param 	string
 * @return 	string
 */
function smarty_modifier_lang($string)
{	global $core;
	return $core->getLang($string);
}

/* vim: set expandtab: */

?>
