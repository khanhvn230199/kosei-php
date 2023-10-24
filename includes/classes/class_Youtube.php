<?php

class Youtube
{
    /*
     * Video Id for the given url
     */
    private $video_id;

    /*
     * Video title for the given video
     */
    private $video_title;

    /*
     * Video itag for the given video
     */
    private $itag_info;

    /*
     * Video itag for the given video
     */
    private $proxy = false;

    /*
     * Video quality for the given video
     */
    private $quality;

    public function __construct()
    {
        $this->itag_info = array(
            5 => "FLV 400x240",
            6 => "FLV 450x240",
            13 => "3GP Mobile",
            17 => "3GP 144p",
            18 => "MP4 360p",
            22 => "MP4 720p (HD)",
            34 => "FLV 360p",
            35 => "FLV 480p",
            36 => "3GP 240p",
            37 => "MP4 1080",
            38 => "MP4 3072p",
            43 => "WebM 360p",
            44 => "WebM 480p",
            45 => "WebM 720p",
            46 => "WebM 1080p",
            59 => "MP4 480p",
            78 => "MP4 480p",
            82 => "MP4 360p 3D",
            83 => "MP4 480p 3D",
            84 => "MP4 720p 3D",
            85 => "MP4 1080p 3D",
            91 => "MP4 144p",
            92 => "MP4 240p HLS",
            93 => "MP4 360p HLS",
            94 => "MP4 480p HLS",
            95 => "MP4 720p HLS",
            96 => "MP4 1080p HLS",
            100 => "WebM 360p 3D",
            101 => "WebM 480p 3D",
            102 => "WebM 720p 3D",
            120 => "WebM 720p 3D",
            127 => "TS Dash Audio 96kbps",
            128 => "TS Dash Audio 128kbps"
        );
        $this->quality = array(
            5 => "LD",
            6 => "LD",
            13 => "LD",
            17 => "LD",
            18 => "LD",
            22 => "HD",
            34 => "LD",
            35 => "SD",
            36 => "LD",
            37 => "FHD",
            38 => "4K",
            43 => "LD",
            44 => "SD",
            45 => "HD",
            46 => "FHD",
            59 => "SD",
            78 => "SD",
            82 => "LD 3D",
            83 => "SD 3D",
            84 => "HD 3D",
            85 => "FHD 3D",
            91 => "LD",
            92 => "LD",
            93 => "LD",
            94 => "LD",
            95 => "SD",
            96 => "FHD",
            100 => "LD 3D",
            101 => "SD 3D",
            102 => "HD 3D",
            120 => "HD 3D",
            127 => "96kbps",
            128 => "128kbps"
        );
    }

    /*
     * Set the ID
     * @param string $video_id
     * @param boolean $proxy
     */
    public function setVideoID($video_id, $proxy = false)
    {
        $this->video_id = $video_id;
        $this->proxy = $proxy;
        return $this;
    }

    /*
     * Get the video information
     * @param proxy using proxy
     */
    private function getVideoInfo()
    {
        $return = null;
        if ($this->proxy == true) {
            $clsCURL = new CURL();
            $clsCURL->get('https://www.proxfree.com/', '', 2);
            $clsCURL->httpheader = array(
                'Referer:https://de.proxfree.com/permalink.php?url=eKcKvRAsZMJp3EkmD1K78%2Bqx%2FrqnRtIHySNzmMxUbxvJ%2FxfYKDbfQTtfxlzFz63ZA2PxrVLbAzRji7PR98co4KUo8OToTy25nhXHdedVcXsUt3WZdBKH09owwj58mvXq&bit=1',
                'Upgrade-Insecure-Requests:1',
                'Content-Type:application/x-www-form-urlencoded',
                'Cache-Control:max-age=0',
                'Connection:keep-alive',
                'Accept-Language:en-US,en;q=0.8,vi;q=0.6,und;q=0.4',
            );
            $u = "https://www.youtube.com/get_video_info?video_id=$this->video_id&cpn=CouQulsSRICzWn5E&eurl&el=adunit";
            $y = ($clsCURL->post('https://de.proxfree.com/request.php?do=go&bit=1', "pfipDropdown=default&get=$u", 4));
            $return = $clsCURL->get($y[0]["Location"], '', 2);
        } else {
            $return = get_html_content("https://www.youtube.com/get_video_info?video_id=$this->video_id&cpn=CouQulsSRICzWn5E&eurl&el=adunit", 0);
            if (!$return) {
                $clsCURL = new CURL();
                $return = $clsCURL->get("https://www.youtube.com/get_video_info?video_id=$this->video_id&cpn=CouQulsSRICzWn5E&eurl&el=adunit", '', 2);
            }
        }
        return $return;
    }

    /**
     * Get all video stream array
     *
     * @param string $format
     * @return array
     */
    public function getAllStream($format = "")
    {
        //parse the string separated by '&' to array
        parse_str($this->getVideoInfo(), $data);

        $player_response = json_decode($data['player_response'], true);
        //set video title
        $this->video_title = $player_response['videoDetails']["title"];
        //Get the youtube root link that contains video information
        $stream_map_arr = $this->getStreamData($player_response);
        $final_stream_map_arr = array();
        if ($stream_map_arr) {
            //Create array containing the detail of video
            foreach ($stream_map_arr as $stream) {
                $mime_type = explode(";", $stream["mimeType"]);
                $stream_format = ltrim(substr($mime_type[0], stripos($mime_type[0], "/")), "/");
                if ($format == $stream_format) {
                    $stream_data["itag"] = $stream["itag"];
                    $stream_data["title"] = $this->video_title;
                    $stream_data["url"] = $stream["url"];
                    $stream_data["mime"] = $mime_type[0];
                    $stream_data["format"] = $stream_format;
                    $stream_data["quality"] = $stream["quality"];
                    $stream_data["squality"] = $this->quality[$stream["itag"]];
                    $stream_data["qualityLabel"] = $stream["qualityLabel"];
                    unset($mime_type);
                    $final_stream_map_arr [] = $stream_data;
                }
            }
            $this->array_sort_by_column($final_stream_map_arr, 'qualityLabel', SORT_DESC);
        }
        return $final_stream_map_arr;
    }

    /**
     * Get first video stream array
     * @param string $format
     * @return mixed
     */
    public function getOneStream($format = "")
    {
        $arrStream = $this->getAllStream($format);
        return $arrStream[0];
    }

    /*
     * Get the youtube root data that contains the video information
     * return array
     */
    private function getStreamData($data)
    {
        $return = $data['streamingData']['formats'];
        if (is_array($return)) {
            return $return;
        }
        return NULL;
    }

    /*
     * Validate the given video url
     * return bool
     */
    public function hasVideo()
    {
        $valid = true;
        parse_str($this->getVideoInfo(), $data);
        if (count($data) == 0 || $data["status"] == "fail") {
            $valid = false;
        }
        return $valid;
    }

    /**
     * Sort Multi-dimensional array
     * @param array $arr array
     * @param string $col key for sort
     * @param int $dir
     */
    function array_sort_by_column(&$arr, $col, $dir = SORT_ASC)
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }
        array_multisort($sort_col, $dir, $arr);
    }

}