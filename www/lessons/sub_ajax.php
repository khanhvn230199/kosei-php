<?
function ajax_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    exit();
}

function ajax_save_score()
{
    global $core, $_LANG_ID;
    $clsHistory = new History();
    $user_id = $core->_USER['user_id'];
    if (is_array($_POST) && count($_POST) != 0 && $user_id != 0) {
        $arrOneHistory = $clsHistory->getByCond("user_id = $user_id AND lesson_id = $_POST[lesson_id] AND lang_code='$_LANG_ID'");

        $field = "user_id, lang_code, reg_date";
        $value = "$user_id, '$_LANG_ID', " . time();
        $set = "";
        foreach ($_POST as $f => $v) {
            $field .= ", $f";
            $value .= ", '$v'";
            if ($f != "lesson_id") {
                $set .= ($set != "") ? ", $f = '$v'" : "$f = '$v'";
            }
        }
        if (!is_array($arrOneHistory) || count($arrOneHistory) == 0) {
            $clsHistory->insertOne($field, $value);
        } else {
            $clsHistory->updateOne($arrOneHistory['history_id'], $set);
        }
    }
    exit();
}

function ajax_getlink()
{
    $drive = new DriveProxy();
    $drive->driveid('0B2yWma8W4fRud0VwWVY4clMzejA');
    echo $drive->proxy_link();
    exit();
}

function ajax_stream()
{
    ini_set('max_execution_time', 0);
    set_time_limit(0);

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'PWaanA*()!#EGyKaaZ';
    $secret_iv = 'PWAsrqWUN*()!#RETyAAga';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    $domain = base64_decode($_GET['domain']);
    $id = $_GET['id'];
    $itag = $_GET['itag'];
    $source = $_GET['source'];
    $requiressl = $_GET['requiressl'];
    $ttl = $_GET['ttl'];
    $susci = $_GET['susci'];
    $mm = $_GET['mm'];
    $mn = $_GET['mn'];
    $ms = $_GET['ms'];
    $mv = $_GET['mv'];
    $pl = $_GET['pl'];
    $ei = $_GET['ei'];
    $susc = $_GET['susc'];
    $driveid = openssl_decrypt(base64_decode($_GET['driveid']), $encrypt_method, $key, 0, $iv);
    $mime = $_GET['mime'];
    $cnr = $_GET['cnr'];
    $lmt = $_GET['lmt'];
    $mt = $_GET['mt'];
    $ip = $_GET['ip'];
    $ipbits = $_GET['ipbits'];
    $expire = $_GET['expire'];
    $cp = $_GET['cp'];
    $sparams = $_GET['sparams'];
    $signature = $_GET['signature'];
    $key = $_GET['key'];
    $app = $_GET['app'];
    $cookie = $_GET['token'];

    $googledrive = "" . $domain . "videoplayback?id=$id&itag=$itag&source=$source&requiressl=$requiressl&ttl=$ttl&mm=$mm&mn=$mn&ms=$ms&mv=$mv&pl=$pl&ei=$ei&susc=$susc&driveid=$driveid&mime=$mime&cnr=$cnr&lmt=$lmt&mt=$mt&ip=$ip&ipbits=$ipbits&susci=$susci&expire=$expire&cp=$cp&sparams=$sparams&signature=$signature&key=$key&app=$app";
    $useragent = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36";

    $proxystream = new DriveStream();
    $proxystream->ignition($googledrive, $cookie);
    $proxystream->stream();

    $curl = curl_init();
    $payload = array(
        CURLOPT_URL => $googledrive,
        CURLOPT_HEADER => false,
        CURLOPT_USERAGENT => $useragent,
        CURLOPT_TCP_FASTOPEN => 1,
        CURLOPT_VERBOSE => 1,
        CURLOPT_CONNECTTIMEOUT => 0,
        CURLOPT_TIMEOUT => 1000,
        CURLOPT_FRESH_CONNECT => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_NOBODY => false,
        CURLOPT_RETURNTRANSFER => false,
        CURLOPT_FOLLOWLOCATION => true,
    );

    if (isset($_SERVER['HTTP_RANGE'])) {
        preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $range);

        $range = new DriveStream();
        $range->rangebyte($googledrive, $cookie);
        $rangeresult = $range->result();

        $initial = intval($range[1]);
        $final = $rangeresult - $initial - 1;

        $header = array(
            'Cookie: DRIVE_STREAM=' . $cookie,
            'Range: bytes=' . $initial . '-' . ($initial + $final) . '',
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    } else {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Cookie: DRIVE_STREAM=" . $cookie));
    }
    curl_setopt_array($curl, $payload);
    curl_exec($curl);
}
