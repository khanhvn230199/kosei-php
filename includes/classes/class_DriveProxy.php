<?php

class DriveProxy
{
    public $proxylink = '';
    private $cachedirectory = DIR_CACHE .'/drive/';

    public function driveid($googletoken)
    {
        $cache = $this->cachedirectory . md5($googletoken) . '.cache';
        $googleproxy = $this->grab_link($googletoken);

        if (file_exists($cache))
        {
            $data = file_get_contents($cache);
            $data = explode('@@', $data);
            if (is_array($data) && isset($data[1]) && (time() - $data[0]) <= 900)
            {
                $videolinks = trim($data[1]);
            }
        }

        if (empty($videolinks))
        {
            $videolinks = $googleproxy;
            $this->cache($cache, $googleproxy);
        }

        $this->proxylink = $videolinks;
    }

    private function grab_content($link)
    {
        $curl = curl_init();
        $curlopt = array(
            CURLOPT_URL => $link,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 1,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_FRESH_CONNECT=> true,
            CURLOPT_SSL_VERIFYPEER => 0
        );
        curl_setopt_array($curl, $curlopt);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    private function rnd($var)
    {
        $randomvar = array_rand($var);
        $random = $var[$randomvar];
        return $random;
    }

    private function grab_link($token)
    {
        $gdata = [];
        $gurl = 'https://drive.google.com/get_video_info?docid='.$token.'';
        $gparse = $this->grab_content($gurl);

        parse_str($gparse, $gstring);
        $data = explode(",", $gstring["fmt_stream_map"]);

        foreach($data as $d) {
            switch ((int)substr($d, 0, 2)) {
                case 18:
                    $r = "360P";
                    break;
                case 22:
                    $r = "720P";
                    break;
                case 37:
                    $r = "1080P";
                    break;
                case 59:
                    $r = "480P";
                    break;
                default:
                    break;
            }

            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $gparse, $drivestream);
            $cookies = array();
            foreach($drivestream[1] as $item)
            {
                parse_str($item, $cookie);
                $cookies = array_merge($cookies, $cookie);
            }
            $gck = str_replace("DRIVE_STREAM=" ,"" , $drivestream[1]);

            $encrypt_method = "AES-256-CBC";
            $secret_key = 'PWaanA*()!#EGyKaaZ';
            $secret_iv = 'PWAsrqWUN*()!#RETyAAga';
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);

            $hashdrive = base64_encode(openssl_encrypt($token,$encrypt_method, $key, 0, $iv));

            $var = explode('&',$d);
            $domain = $var[0];
            $redirector = preg_replace("@(.*)videoplayback(.*)@si","$1", $domain);
            $hiddomain = base64_encode(str_replace(array("18|https", "22|https", "37|https", "59|https","c.drive.google.com"),array("https", "https", "https", "https", "googlevideo.com"), $redirector));

            $modiapi = 'japnime';
            $rndserver = [
                VNCMS_URL."/lessons/ajax/stream"
            ];
            $streamdrtr = $this->rnd($rndserver);

            $o[$r] = substr(preg_replace(array("@&driveid=(.+?)&@si","/https:\/\/+[^\/]+\.google\.com\/videoplayback/","@&ip=(.+?)&@si"),array("&driveid=$hashdrive&driveapi=$modiapi&","$streamdrtr","&ip=$1&token=$gck[0]&domain=$hiddomain&"), $d), 3);
        }

        asort($o);

        foreach ($o as $quality => $file)
        {
            $urls = urldecode($file);
            if(empty($urls))
            {
                die();
            } else {
                $sources .= '{"type": "video/mp4", "label": "'.$quality.'", "file": "'.$urls.'&server=japnimeserver.com"},';
            }
        }

        return '['.rtrim($sources, ',').']';
    }

    private function cache($dir, $data)
    {
        if (!file_exists($this->cachedirectory)) {
            mkdir($this->cachedirectory, 0777, true);
        }

        $content = time().'@@'.$data;
        file_put_contents($dir, $content);
    }

    public function proxy_link()
    {
        echo $this->proxylink;
    }

}

?>
