<?
/******************************************************
 * Library File
 *
 * Contain file functions for project
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  lib_file.php
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
 * Return content of a file
 *
 * @param                : string $file
 * @return            : string
 */
function read_file($file)
{
    $handle = fopen($file, "rb");
    $contents = "";
    do {
        $data = fread($handle, 8192);
        if (strlen($data) == 0) {
            break;
        }
        $contents .= $data;
    } while (true);
    fclose($handle);
    return $contents;
}

/**
 * Save content to a file
 *
 * @param                : string $file, string $content, int $append, int $binary
 * @return            : string
 */
function save_file($file, $content, $append = 0, $binary = 0)
{
    if ($binary) {
        $b = 'b';
    } else {
        $b = 't';
    }
    if ($append) {
        $mode = "a$b";
    } else {
        $mode = "w$b";
    }
    $fp = @fopen($file, $mode);
    $err = '';
    if ($fp) {
        fwrite($fp, $content);
        fclose($fp);
        //@chmod($file, 0666);
    } else {
        $err = " Can't write file $file. Check file/directory permissions.";
    }
    return $err;
}

/**
 * Get size text of a interger
 *
 * @param                : float $size
 * @return            : string
 */
function get_size($size)
{//bytes
    $kb = 1024;
    $mb = 1024 * $kb;
    $gb = 1024 * $mb;
    $tb = 1024 * $gb;
    if ($size < $kb) {
        $file_size = "$size Bytes";
    } elseif ($size < $mb) {
        $final = round($size / $kb, 2);
        $file_size = "$final KB";
    } elseif ($size < $gb) {
        $final = round($size / $mb, 2);
        $file_size = "$final MB";
    } elseif ($size < $tb) {
        $final = round($size / $gb, 2);
        $file_size = "$final GB";
    } else {
        $final = round($size / $tb, 2);
        $file_size = "$final TB";
    }
    return $file_size;
}

if (!function_exists('file_put_contents')) {
    /**
     * Rewrite function file_put_contents if not exists
     */
    function file_put_contents($filename = "", $str)
    {
        if (is_writable($filename)) {
            $fp = fopen($filename, "w");
            fwrite($fp, $str);
            fclose($fp);
            return 1;
        } else {
            return 0;
        }
    }
}
if (!function_exists('file_get_contents')) {
    /**
     * Rewrite function file_get_contents if not exists
     */
    function file_get_contents($filename = "")
    {
        $fp = fopen($filename, "w");
        $str = fread($fp, filesize($filename));
        fclose($fp);
        return $str;
    }
}
/**
 * Get files in a directory
 *
 * @param string $dir
 * @param string $ext
 */
function getFilesInDir($dir, $ext = 'php')
{
    $arr = array();
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if (substr($file, -3) == $ext)
                array_push($arr, $file);
        }
        closedir($dh);
    }
    return $arr;
}

/**
 * Get all dir in directory
 *
 * @param                : string $dir
 * @return            : array
 */
function getDirectory($dir)
{
    $arr = "";
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && is_dir($dir . "/" . $file)) {
                $arr[] = $file;
            }
        }
        closedir($handle);
    }
    return $arr;
}

/**
 * Detect OS Line Break
 *
 * @param                : bool $true_val
 * @return            : char
 */
function _get_os_linebreak($true_val = false)
{
    $os = strtolower(PHP_OS);
    switch ($os) {
        # not sure if the string is correct for FreeBSD
        # not tested
        case 'freebsd' :
            # not sure if the string is correct for NetBSD
            # not tested
        case 'netbsd' :
            # not sure if the string is correct for Solaris
            # not tested
        case 'solaris' :
            # not sure if the string is correct for SunOS
            # not tested
        case 'sunos' :
            # linux variation
            # tested on server
        case 'linux' :
            $nl = "\n";
            break;
        # darwin is mac os x
        # tested only on the client os
        case 'darwin' :
            # note os x has \r line returns however it appears that the ifcofig
            # file used to source much data uses \n. let me know if this is
            # just my setup and i will attempt to fix.
            if ($true_val) $nl = "\r";
            else $nl = "\n";
            break;
        # defaults to a win system format;
        default :
            $nl = "\r\n";
    }
    return $nl;
}

function readMailTemplate($mailtemplate, &$subjectmail)
{
    $str = "";
    $fin = fopen($mailtemplate, "r");
    if (!$fin) {
        return false;
    }
    $i = 0;
    while (!feof($fin)) {
        $line = fgets($fin);
        if ($i == 0) {
            $subjectmail = $line;
        }
        $i++;
        if ($i > 2) {
            $str .= $line;//trim($line, "\r\n")."\r";
        }
    }
    fclose($fin);
    return $str;
}

/**
 * Save to file mail template
 *
 * @param string $title
 * @param string $body
 */
function saveMailTemplate($file, $mail_title="", $mail_body=""){
    $mail_content = $mail_title."\n====\n";
    $mail_content.= "<html>\n";
    $mail_content.= "<body>\n";
    //$mail_body = html_entity_decode($mail_body);
    $mail_content.= br2nl($mail_body)."\n";
    $mail_content.= "</body>\n";
    $mail_content.= "</html>";
    @file_put_contents($file, $mail_content);
}

function resize_avatar($file_name = "", $new_file_name = "", $width = 220, $height = 298)
{
    if (file_exists($file_name)) {
        if (strtolower(substr($file_name, -3)) == "jpg" || strtolower(substr($file_name, -4)) == "jpeg") {
            $obj_image = imagecreatefromjpeg($file_name);
            $obj_image_type = "jpg";
        } else
            if (strtolower(substr($file_name, -3)) == "gif") {
                $obj_image = imagecreatefromgif($file_name);
                $obj_image_type = "gif";
            } else
                if (strtolower(substr($file_name, -3)) == "png") {
                    $obj_image = imagecreatefrompng($file_name);
                    $obj_image_type = "png";
                }
        $o_wd = imagesx($obj_image);
        $o_ht = imagesy($obj_image);
        $o_x = $o_y = 0;
        $newwidth = $width;
        $newheight = round($o_ht * $newwidth / $o_wd);
        $o_y = round(($newheight - $height) / 2);
        $obj_temp = imageCreateTrueColor($width, $height);
        imageCopyResampled($obj_temp, $obj_image, 0, 0, $o_x, $o_y, $newwidth, $newheight, $o_wd, $o_ht);
        if ($obj_image_type == "jpg") {
            imagejpeg($obj_temp, $new_file_name, 100);
        } elseif ($obj_image_type == "gif") {
            imagegif($obj_temp, $new_file_name);
        } elseif ($obj_image_type == "png") {
            imagepng($obj_temp, $new_file_name);
        }
        return 1;
    }
    return 0;
}

function resize_thumbs($file_name = "", $new_file_name = "", $width = 160, $height = 120)
{
    if (file_exists($file_name)) {
        if (strtolower(substr($file_name, -3)) == "jpg" || strtolower(substr($file_name, -4)) == "jpeg") {
            $obj_image = imagecreatefromjpeg($file_name);
            $obj_image_type = "jpg";
        } else
            if (strtolower(substr($file_name, -3)) == "gif") {
                $obj_image = imagecreatefromgif($file_name);
                $obj_image_type = "gif";
            } else
                if (strtolower(substr($file_name, -3)) == "png") {
                    $obj_image = imagecreatefrompng($file_name);
                    $obj_image_type = "png";
                }
    }
    $o_wd = imagesx($obj_image);
    $o_ht = imagesy($obj_image);
    if ($o_wd >= $width) return 1;
    if ($o_wd * $height >= $o_ht * $width) $i = 1; else $i = 2;
    $o_x = $o_y = 0;
    if ($i == 1) {
        $newheight = $height;
        $newwidth = round($o_wd * $newheight / $o_ht);
        $o_x = round(($newwidth - $width) / 2);
    } else {
        $newwidth = $width;
        $newheight = round($o_ht * $newwidth / $o_wd);
        $o_y = round(($newheight - $height) / 2);
    }
    $obj_temp = imageCreateTrueColor($width, $height);
    imageCopyResampled($obj_temp, $obj_image, 0, 0, $o_x, $o_y, $newwidth, $newheight, $o_wd, $o_ht);
    //if (file_exists($file_name)) @unlink($file_name);
    if ($obj_image_type == "jpg") {
        imagejpeg($obj_temp, $new_file_name, 100);
    } elseif ($obj_image_type == "gif") {
        imagegif($obj_temp, $new_file_name);
    } elseif ($obj_image_type == "png") {
        imagepng($obj_temp, $new_file_name);
    }
    return 1;
}

function resizeImage($filename, $new_file_name, $newwidth, $newheight)
{
    list($width, $height, $type) = getimagesize($filename);
    if ($width > $height && $newheight < $height) {
        $newheight = $height / ($width / $newwidth);
    } else if ($width < $height && $newwidth < $width) {
        $newwidth = $width / ($height / $newheight);
    } else {
        $newwidth = $width;
        $newheight = $height;
    }
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    if ($type == 3) {
        $source = imagecreatefrompng($filename);
    } else
        if ($type == 2) {
            $source = imagecreatefromjpeg($filename);
        } else
            if ($type == 6) {
                $source = imagecreatefrombmp($filename);
            }
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    if ($type == 3) {
        return imagepng($thumb, $new_file_name);
    } else
        if ($type == 2) {
            return imagejpeg($thumb, $new_file_name, 100);
        } else
            if ($type == 6) {
                return imagejpeg($thumb, $new_file_name, 100);
            }
}

if (!function_exists("imagecreatefrombmp")) {
    function imagecreatefrombmp($p_sFile)
    {
        $file = fopen($p_sFile, "rb");
        $read = fread($file, 10);
        while (!feof($file) && ($read <> ""))
            $read .= fread($file, 1024);
        $temp = unpack("H*", $read);
        $hex = $temp[1];
        $header = substr($hex, 0, 108);
        if (substr($header, 0, 4) == "424d") {
            $header_parts = str_split($header, 2);
            $width = hexdec($header_parts[19] . $header_parts[18]);
            $height = hexdec($header_parts[23] . $header_parts[22]);
            unset($header_parts);
        }
        $x = 0;
        $y = 1;
        $image = imagecreatetruecolor($width, $height);
        $body = substr($hex, 108);
        $body_size = (strlen($body) / 2);
        $header_size = ($width * $height);
        $usePadding = ($body_size > ($header_size * 3) + 4);
        for ($i = 0; $i < $body_size; $i += 3) {
            if ($x >= $width) {
                if ($usePadding)
                    $i += $width % 4;
                $x = 0;
                $y++;
                if ($y > $height)
                    break;
            }
            $i_pos = $i * 2;
            $r = hexdec($body[$i_pos + 4] . $body[$i_pos + 5]);
            $g = hexdec($body[$i_pos + 2] . $body[$i_pos + 3]);
            $b = hexdec($body[$i_pos] . $body[$i_pos + 1]);
            $color = imagecolorallocate($image, $r, $g, $b);
            imagesetpixel($image, $x, $height - $y, $color);
            $x++;
        }
        unset($body);
        return $image;
    }
}

if (!function_exists("get_html_content")) {
    /**
     * Get content of an URL
     *
     * @param string $url
     * @return mixed
     */
    function get_html_content($url = "", $filter = 1)
    {
        require_once(DIR_INCLUDES . "/PEAR/Request.php");
        $req = new HTTP_Request($url);
        $req->addHeader('User-Agent', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.2.6) Gecko/20100625 Firefox/3.6.6');
        $req->sendRequest();
        $content = $req->getResponseBody();
        if ($filter == 1) {
            $content = remove_bullshit($content);
        }
        return $content;
    }
}

if (!function_exists("remove_bullshit")) {
    /**
     * Remove buillshit chars
     *
     * @param unknown $str
     * @return mixed
     */
    function remove_bullshit($str)
    {
        $str = str_replace("\n", " ", $str);
        $str = str_replace("\r", " ", $str);
        $str = str_replace("\n\r", " ", $str);
        $str = eregi_replace("<javascript[^>]*>([^<]*)<\/script>", "", $str); //remove javascripts
        $str = eregi_replace("<script[^>]*>([^<]*)<\/script>", "", $str); //remove scripts
        $str = preg_replace("/<!\s*--.*--\s*>/Us", "", $str); // Strip HTML Comments
        return $str;
    }
}
?>