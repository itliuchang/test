<?php

class Assist{
    public static function formatCount($i = 0){
        $i = $i ?: 0;
        return $i > 9999? '9999+' : $i;
    }

    public static function stripEmptyTag($content){
        return preg_replace('/<p><br\/?><\/p>/im', '', str_replace(array("\r\n", "\r", "\n"), '', $content));
    }

    public static function getHashcode($data){
        $str = '';
        foreach($data as $v) {
            $str .= $v['lng'] . '' . $v['lat'];
        }
        return md5($str);
    }
}