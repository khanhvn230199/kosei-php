<?
/******************************************************
 * Library Common
 *
 * Contain common functions for project
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  lib_common.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        20/01/2018        banglcb          -        -     -     -
 *
 ********************************************************/
/**
 * Redirect Site to an URL
 *
 * @param                : string $url, int $type
 * @return            : no
 */
function redirectURL($url, $type = 0)
{
    if ($type == 0) {
        header("Location: $url");
        exit();
    } else
    if ($type == 1) {
        header("Refresh: 0; url=$url");
        exit();
    }
}

/**
 * Return string of options of an array
 *
 * @param                : array $_arr, int $sk, int $flag1, int $flag2, int $istext
 * @return            : string
 */
function makeHTMLOptions($_arr, $sk = 0, $flag1 = 0, $flag2 = 0, $istext = 0)
{
    $html = "";
    if (is_array($_arr)) {
        foreach ($_arr as $k => $v) {
            $value = $k;
            $option = $v;
            if ($flag2 == 1) {
                $value = $option;
            }

            if ($flag1 == 0) {
                $selected = ($value == $sk) ? "selected" : "";
            } else {
                $selected = ($option == $sk) ? "selected" : "";
            }
            $html .= "<option value='$value' $selected >" . $option . "</option>";
            if ($selected == 'selected' && $istext == 1) {
                return str_replace("|__", "", $option);
            }

        }
        if ($istext == 1) {
            return "";
        }

        return $html;
    } else {
        return "";
    }
}

/**
 * Return string of options of an array, without delimiter |__
 *
 * @param                : array $_arr, int $sk, int $flag1, int $flag2, int $istext
 * @return            : string
 */
function makeHTMLOptions1($_arr, $sk = "", $flag1 = 0, $flag2 = 0)
{
    $html = "";
    if ($sk == "") {
        $sk = -1;
    }

    if (is_array($_arr)) {
        foreach ($_arr as $k => $v) {
            $value = $k;
            $option = $v;
            if ($flag2 == 1) {
                $value = $option;
            }

            if ($flag1 == 0) {
                $selected = ($value == $sk) ? "selected" : "";
            } else {
                $selected = ($option == $sk) ? "selected" : "";
            }
            $html .= "<option value='$value' $selected >" . $option . "</option>";
        }
        return $html;
    } else {
        return "";
    }
}

/**
 * Return string of radios of an array
 *
 * @param                : array $_arr, int $sk is selected option, string $name is name of input, int $istext
 * @return            : string
 */
function makeHTMLRadios($_arr, $sk = 0, $name = "", $istext = 0)
{
    $html = "";
    if (is_array($_arr)) {
        foreach ($_arr as $k => $v) {
            $value = $k;
            $option = $v;
            $checked = ($value == $sk) ? "checked='checked'" : "";
            $html .= "<input type='radio' name='$name' value='$value' $checked class='radio' />" . $option . "&nbsp;";
            if ($istext == 1 && $checked != "") {
                return $option;
            }
        }
        if ($istext == 1) {
            return "";
        }

        return $html;
    } else {
        return "";
    }
}

/**
 * Return string of checkbox of an array
 *
 * @param                : array $_arr, int $sk is checked, string $name is name of input, int $istext
 * @return            : string
 */
function makeHTMLCheckBox($_arr, $sk = 0, $name = "", $istext = 0)
{
    $html = "";
    if (is_array($_arr)) {
        foreach ($_arr as $k => $v) {
            $value = $k;
            $option = $v;
            $checked = (isset($sk[$k]) && $value == $sk[$k]) ? "checked='checked'" : "";
            if ($istext == 1) {
                if ($checked != "") {
                    $html .= ($html == "") ? $option : ", " . $option;
                }

            } else {
                $html .= "<input type='checkbox' name='" . $name . "[$k]' value='$value' $checked class='radio' />" . $option;
            }
        }
        return $html;
    } else {
        return "";
    }
}

/**
 * Replace function in_array with fast search
 *
 * @param                : mix $elem is needle, array $array
 * @return            : string
 */
function fast_in_array($elem, $array) //for large array

{
    $top = sizeof($array) - 1;
    $bot = 0;
    while ($top >= $bot) {
        $p = floor(($top + $bot) / 2);
        if ($array[$p] < $elem) {
            $bot = $p + 1;
        } elseif ($array[$p] > $elem) {
            $top = $p - 1;
        } else {
            return true;
        }

    }
    return false;
}

/**
 * Get variable from POST if have, then GET if have, then Session if have
 *
 * @param                : mix $var, mix $default_value
 * @return            : string
 */
function getPOST($var = "", $default_value = "")
{
    $value = isset($_POST[$var]) ? trim($_POST[$var]) : "";
    if ($value == "") {
        $value = isset($_GET[$var]) ? trim($_GET[$var]) : "";
        if ($value == "") {
            if (vnSessionGetVar("sess_" . $var) != "") {
                $value = vnSessionGetVar("sess_" . $var);
            } else {
                $value = $default_value;
            }
        }
    }
    if (isset($_POST[$var])) {
        $value = trim($_POST[$var]);
        vnSessionSetVar("sess_" . $var, $value);
    } else
    if (isset($_GET[$var])) {
        $value = trim($_GET[$var]);
        vnSessionSetVar("sess_" . $var, $value);
    }
    return $value;
}

/**
 * Get variable from POST
 *
 * @param                : string $name, mix $def is default value
 * @return            : string
 */
function POST($name = "", $def = "")
{
    $value = isset($_POST[$name]) ? $_POST[$name] : $def;
    if (is_array($value)) {
        return $value;
    }

    return trim($value);
}

/**
 * Get variable from GET
 *
 * @param                : string $name, mix $def is default value
 * @return            : string
 */
function GET($name, $def = "")
{
    $value = isset($_GET[$name]) ? $_GET[$name] : $def;
    if (is_array($value)) {
        return $value;
    }

    return trim($value);
}

function getPost_remove($var)
{
    vnSessionDelVar("sess_" . $var);
}

function getCookie($var = '')
{
    if (isset($_COOKIE[$var])) {
        $var = $_COOKIE[$var];
    } else {
        $var = '';
    }
    return $var;
}
function countLeaf($arr)
{
    $x = 0;
    if (is_array($arr)) {
        foreach ($arr as $k => $v) {
            if (is_array($v['subcat'])) {
                $x = $x + countLeaf($v['subcat']);
            } else {
                $x++;
            }
        }
        return $x;
    }
}

function getAnswers(&$question)
{
    $answers = array();

    foreach (['a', 'b', 'c', 'd'] as $idx => $char) {
        if ($question['answer_' . $char]) {
            $answers[] = array(
                "id" => $question['questions_id'] . "_" . $char,
                "name" => $question['questions_id'],
                "text" => $question['answer_' . $char],
                "point" => $question['point'],
                "ctype" => $question['ctype'],
                "is_correct" => $question['correct_answer'] == ($idx + 1) || strtolower($question['correct_answer']) === $char,
            );
        }
    }

    $question['answers'] = $answers;

    return $question;
}

function validAvatar($image = '')
{
    if ($image == '' || strpos($image, "is_silhouette")) {
        return URL_IMAGES . "/no_profile.png";
    }

    if (substr($image, 0, 4) === "http") {
        return $image;
    }

    return URL_UPLOADS . '/' . $image;
}
