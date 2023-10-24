<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty phone_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     phone_format<br>
 * Purpose:  format strings via phone_format php function
 * @author   banglcb
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_phone_format($num, $slash = '.')
{
    $num_strip = preg_replace('/[^0-9]/', '', $num);
    $len = strlen($num_strip);
    switch ($len) {
        case 7:
            $num_strip = preg_replace('/([0-9]{2})([0-9]{2})([0-9]{3})/', '$1 $2 $3', $num_strip);
            break;
        case 8:
            $num_strip = preg_replace('/([0-9]{3})([0-9]{2})([0-9]{3})/', '$1 ' . $slash . ' $2 $3', $num_strip);
            break;
        case 9:
            $num_strip = preg_replace('/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/', '$1 ' . $slash . ' $2 $3 $4', $num_strip);
            break;
        case 10:
            $num_strip = preg_replace('/([0-9]{4})([0-9]{3})([0-9]{3})/', '$1' . $slash . '$2' . $slash . '$3', $num_strip);
            break;
        case 11:
            $num_strip = preg_replace('/([0-9]{4})([0-9]{3})([0-9]{4})/', '$1' . $slash . '$2' . $slash . '$3', $num_strip);
            break;
        default:
            $num_strip = $num;
    }

    return $num_strip;
}

/* vim: set expandtab: */

?>
