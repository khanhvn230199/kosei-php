<?php

class DriveStream
{
    private $drive = '';
    private $bytes = '';
    private $useragent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36';

    public function ignition($proxylink, $cookie)
    {
        $this->drive = $this->grab_video_content($proxylink, $cookie);
        return $this->drive;
    }

    public function rangebyte($proxylink, $cookie)
    {
        $this->bytes = $this->grab_video_length($proxylink, $cookie);
        return $this->bytes;
    }

    private function grab_video_content($link, $cookie)
    {
        $curl = curl_init();
        $payload = array(
            CURLOPT_URL => $link,
            CURLOPT_HEADER => true,
            CURLOPT_USERAGENT => $this->useragent,
            CURLOPT_CONNECTTIMEOUT => 0,
            CURLOPT_TIMEOUT => 1000,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_NOBODY => true,
            CURLOPT_VERBOSE => 1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_COOKIE => 'DRIVE_STREAM=' . $cookie
        );
        curl_setopt_array($curl, $payload);
        curl_exec($curl);
        $solution = curl_getinfo($curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

        header("Content-Type: video/mp4");
        header("Content-length: " . $solution);

        if (isset($_SERVER['HTTP_RANGE'])) {
            $http = 1;
            preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $range);
            $initial = intval($range[1]);
            $final = $solution - $initial - 1;
        }

        if ($http == 1) {
            header('HTTP/1.1 206 Partial Content');
            header('Accept-Ranges: bytes');
            header('Content-Range: bytes ' . $initial . '-' . ($initial + $final) . '/' . $solution);
        } else {
            header('Accept-Ranges: bytes');
        }
    }

    private function grab_video_length($link, $cookie)
    {
        $curl = curl_init();
        $payload = array(
            CURLOPT_URL => $link,
            CURLOPT_HEADER => true,
            CURLOPT_USERAGENT => $this->useragent,
            CURLOPT_CONNECTTIMEOUT => 0,
            CURLOPT_TIMEOUT => 1000,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_NOBODY => true,
            CURLOPT_VERBOSE => 1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_COOKIE => 'DRIVE_STREAM=' . $cookie
        );
        curl_setopt_array($curl, $payload);
        curl_exec($curl);
        $solution = curl_getinfo($curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        return $solution;
    }

    public function stream()
    {
        echo $this->drive;
    }

    public function result()
    {
        return $this->bytes;
    }
}

?>
