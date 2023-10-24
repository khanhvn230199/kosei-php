<?php

class Adapter
{
    public static function encodeProductId($id)
    {
        return substr_replace(($id + 1200000) . "", "-", 3, 0);
    }

    public static function decodeProductId($id)
    {
        return intval(str_replace('-', '', $id)) - 1200000;
    }

    public static function currencyFormat($number)
    {
        return number_format($number);
    }

    public static function arrayToRlikePattern($array)
    {
        if (!is_array($array)) {
            return "";
        }

        return array_reduce($array, function ($carry, $item) {
            return $carry ? $carry . '|' . $item : $item;
        }, '');
    }

    public static function highlightMatchedText($pattern, $text)
    {
        return preg_replace("/$pattern/", "<span>$1</span>", $text);
    }

    public static function stringToSearchPattern($string)
    {
        $string = utf8_nosign_noblank($string);
        $array = preg_split('/[\s-\.]/', $string);
        $length = count($array);

        $result = [];

        for ($i = 0; $i < $length; $i++) {
            for ($j = 1; $j <= $length - $i; $j++) {
                $result[] = array_slice($array, $i, $j);
            }
        }

        usort($result, function ($a, $b) {
            return (count($b) > count($a)) ? 1 : -1;
        });

        $result = array_reduce($result, function ($carry, $item) {
            $item = implode("-", $item);
            return $carry .= "|" . $item;
        }, "");

        $result = trim($result, "|");

        return $result;
    }

    public static function pairNameWithSlug($name, $slug)
    {
        $matches = [
            0 => [],
        ];

        preg_match_all("/<span>|<\/span>/", $slug, $matches, PREG_OFFSET_CAPTURE);

        if (!count($matches[0])) {
            return $name;
        }

        $matches = $matches[0];

        for ($i = 0; $i < count($matches); $i++) {
            $span = "<span>";

            if ($i % 2 === 1) {
                $span = "</span>";
            }

            $pos = $matches[$i][1];

            $name = mb_substr($name, 0, $pos) . $span . mb_substr($name, $pos);
        }

        return $name;
    }

    public static function priceFormat($price)
    {
        global $currency;

        switch ($currency) {
            case "VND":
                $price = round((float) $price);
                return number_format($price);
            case "USD":
                $price = round((float) $price * 100) / 100;
                $arr = explode(".", $price);
                $tail = $arr[1] ? substr($arr[1] . "00", 0, 2) : "00";
                return number_format($arr[0]) . '.' . $tail;
            default:
                return number_format($price);
        }
    }
}
