<?php

class CDate{
    //timestamp为10位的时间戳
    public static function countdown($endTimestamp){
        $timestamp = $endTimestamp - time();
        if($timestamp < 0){
            return array(
                'day' => 0, 'hour' => '0', 'minute' => 0, 'second' => 0
            );
        }
        $res = [];

        $oneDay = 86400;
        $res['day'] = floor($timestamp / $oneDay);
        $remain = $timestamp - ($res['day'] * $oneDay);

        $oneHour = 3600;
        $res['hour'] = floor($remain / $oneHour);
        $remain -= $res['hour'] * $oneHour;

        $oneMinute = 60;
        $res['minute'] = floor($remain / $oneMinute);

        $res['second'] = floor($remain - $res['minute'] * $oneMinute);

        if($res['day'] < 10 && $res['day'] > 0) $res['day'] = '0' . $res['day'];
        if($res['hour'] < 10 && $res['hour'] > 0) $res['hour'] = '0' . $res['hour'];
        if($res['minute'] < 10 && $res['minute'] > 0) $res['minute'] = '0' . $res['minute'];
        if($res['second'] < 10 && $res['second'] > 0) $res['second'] = '0' . $res['second'];
        return $res;
    }

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