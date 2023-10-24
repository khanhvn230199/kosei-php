<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty durationtime_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     durationtime_format<br>
 * Purpose:  format strings via durationtime_format php function
 * @author   banglcb
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_durationtime_format($second, $slash = '.')
{
    if ($second>=60){
        $minute = intval($second / 60);
        $second = $second - ($minute*60);

        if ($minute>=60){
            $hour = intval($minute / 60);
            $minute = $minute - ($hour*60);
        }
    }
    $st = "";
    if ($hour>0) $st.= "$hour giờ ";
    if ($minute>0) $st.= "$minute phút ";
    if ($second>0) $st.= "$second giây ";
    return $st;
}

/* vim: set expandtab: */

?>
