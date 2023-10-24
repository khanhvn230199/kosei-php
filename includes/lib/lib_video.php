<?
/******************************************************
 * Library Video
 *
 * Contain validate functions for project
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  lib_video.php
 * Environment                :  PHP  version 4, 5 ,7
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  17/04/2019
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        17/04/2019        banglcb          -        -     -     -
 *
 ********************************************************/
use Vimeo\Vimeo;

function getVideoInfo($filename)
{
    if (!file_exists(DIR_INCLUDES . "/getid3/getid3.php")) {
        return 0;
    }
    require_once(DIR_INCLUDES . "/getid3/getid3.php");
    $getID3 = new getID3();
    return (object)$getID3->analyze(DIR_UPLOADS . "/$filename");
}

function getDuration($videoID)
{
    $apikey = "AIzaSyB65fH4nol-AJtx6QIpEQzzPdOmt_mQ2y0"; // Like this AIcvSyBsLA8znZn-i-aPLWFrsPOlWMkEyVaXAcv
    $dur = get_html_content("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$videoID&key=$apikey");
    $VidDuration = json_decode($dur, true);
    if (is_array($VidDuration['items']) && count($VidDuration['items']) > 0) {
        foreach ($VidDuration['items'] as $vidTime) {
            $VidDuration = $vidTime['contentDetails']['duration'];
        }
        $date = new DateTime('2000-01-01');
        $date->add(new DateInterval($VidDuration));
        $vid_durH = $date->format('H');
        if ($vid_durH == "00") {
            $vid_dur = $date->format('i:s');
        } else {
            $vid_dur = $date->format('H:i:s');
        }
        return $vid_dur;
    }
    return null;
}

function getVideoCat($cat)
{
    global $VIMEO_API;

    if ($cat['video_id']) {
        $youtube = new Youtube();

        $obj = $youtube->setVideoID($cat['video_id']);

        if ($obj->hasVideo()) {
            $videoStream = $obj->getAllStream("mp4");

            if (is_array($videoStream) && !empty($videoStream)) {
                return $videoStream;
            }
        }
    }

    if ($cat['vimeo_id']) {
        $vimeo = new Vimeo($VIMEO_API['client_id'], $VIMEO_API['client_secret'], $VIMEO_API['access_token']);

        $videoStream = Vimeo_getAllStream($vimeo->request('/videos/' . $cat['vimeo_id']), "mp4");

        if (is_array($videoStream) && !empty($videoStream)) {
            return $videoStream;
        }
    }

    return null;
}

/**
 * Get all video stream array
 *
 * @param string $format
 * @return array
 */
function Vimeo_getAllStream($array = array(), $format = "")
{
    $final_stream_map_arr = array();
    if ($array['body']['files']) {
        foreach ($array['body']['files'] as $stream) {
            $stream_format = ltrim(substr($stream['type'], stripos($stream['type'], "/")), "/");
            if ($format == $stream_format && $stream["quality"] != "hls") {
                $stream_data["itag"] = $stream["itag"];
                $stream_data["title"] = $array['body']['name'];
                $stream_data["url"] = $stream["link"];
                $stream_data["mime"] = $stream['type'];
                $stream_data["format"] = $stream_format;
                $stream_data["quality"] = $stream["quality"];
                $stream_data["squality"] = strtoupper($stream["quality"]);
                $stream_data["qualityLabel"] = $stream["height"] . "p";
                $final_stream_map_arr [] = $stream_data;
            }
        }
    }
    usort($final_stream_map_arr, function($a, $b) {
        return $b['qualityLabel'] - $a['qualityLabel'];
    });
    return $final_stream_map_arr;
}

function getVimeoVideoDuration($vimeoId){
    global $VIMEO_API;
    $authorization = 'myaccesstoken';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.vimeo.com/videos/{$vimeoId}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$VIMEO_API['access_token'],
            "cache-control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    if (empty($err)) {
        $info = json_decode($response);
        if(isset($info->duration)){
            return (int)$info->duration;
        }
    }
    return false;
}
?>