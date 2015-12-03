<?php

class CDate{
    public static function dgm($d){
        $now = time();
        $from = strtotime($d) ?: $now;
        $tday = date('j', $now) - date('j', $from);
        $time = $now - $from;

        if($tday == 0){
            if($time > 3600){
                return intval($time / 3600) . '小时前';
            }elseif($time > 60){
                return intval($time / 60) . '分钟前';
            }elseif($time > 0){
                return $time . '秒前';
            }else{
                return '刚刚';
            }
        }else{
            $_time = strtotime(date('Y-m-d 00:00:00', $now)) - strtotime(date('Y-m-d 00:00:00', $from));
            $dday = ceil($_time / 86400.0);
            if($dday > 0 && $dday < 7){
                if($dday <= 2){
                  return $dday == 1? '昨天' : '前天';
                }else{
                  return $dday . '天前';
                }
            }else{
                return date('n月j日 G:i', $from);
            }
        }
    }
}