<?

/******************************************************
 * Class Button Navigation
 *
 * Display these button function like: Add, Edit, Save, Delete on Admin Page
 * For admin page purpose
 *
 * Project Name               :  VinaCorp.Vn
 * Package Name                    :
 * Program ID                 :  clsButtonNav.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  04/10/2017
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        04/10/2017        Ducnh          -        -     -     -
 *
 ********************************************************/
class ButtonNav
{
    var $arrBut = array();
    var $arrImg = array();
    var $arrHref = array();
    var $arrActive = array();
    var $arrJsFunc = array();
    var $arrJsArg = array();
    var $last_render = "";
    var $lang;

    function ButtonNav()
    {
    }

    function set($name, $src = "", $href = "", $active = 1, $jsfunc = "", $jsarg = "")
    {
        $this->arrBut[] = $name;
        if ($src != "")
            $this->arrImg[$name] = $src;
        if ($href != "")
            $this->arrHref[$name] = $href;
        if ($active != "")
            $this->arrActive[$name] = $active;
        if ($jsfunc != "")
            $this->arrJsFunc[$name] = $jsfunc;
        if ($jsarg != "")
            if (is_array(explode(",", $jsarg))) {
                $arg = "";
                foreach (explode(",", $jsarg) as $value) {
                    $arg .= "'$value'" . ",";
                }
                $this->arrJsArg[$name] = substr($arg, 0, -1);
            } else {
                $this->arrJsArg[$name] = "'$jsarg'";
            }
    }

    function showButton($name, $src = "", $href = "#", $active = 1)
    {
        global $core;
        //set attribute
        $this->set($name, $src, $href, $active);
        $html = "<button ";
        if ($this->arrActive[$name]) {
            $title = ($this->arrJsFunc[$name] != "") ? $this->arrHref[$name] : $name;
            $html .= "title='$title' class='button' ";
            if ($this->arrJsFunc[$name] != "") {
                $html .= "onclick=\"return " . $this->arrJsFunc[$name] . "(" . $this->arrJsArg[$name] . ");\" ";
            } else {
                $html .= "onclick=\"return gotoUrl('" . $this->arrHref[$name] . "');\" ";
            }
        } else {
            $html .= " class='button' ";
        }
        $html .= ">";
        if (@file_exists($this->arrImg[$name])) {
            $src = $this->arrImg[$name];
        } else
            if (@file_exists(ADMIN_DIR_IMAGES . $this->arrImg[$name])) {
                $src = ADMIN_URL_IMAGES . $this->arrImg[$name];
            }
        //echo $src;
        $html .= "<img src=\"" . $src . "\"/> ";
        $html .= $core->getLang($name);
        $html .= "</button> ";
        return $html;
    }

    function showButton1($name, $active = 1)
    {
        return $this->showButton($name, "", "", $active);
    }

    function render()
    {
        $html = "";
        if (is_array($this->arrBut)) {
            foreach ($this->arrBut as $key => $val) {
                $html .= $this->showButton1($val, $this->arrActive[$val]);
            }
        }
        $this->last_render = $html;
        return $html;
    }
}

?>