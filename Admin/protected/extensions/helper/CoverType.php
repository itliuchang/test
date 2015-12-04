<?php
class CoverType{
    public static function getData(){
        return array(
            '00' => array(
                'id' => '00', 'name' => '区域景点',
                'sub' => array(
                    '0001' => array('id' => '0001', 'name' => '公园'),
                    '0002' => array('id' => '0002', 'name' => '山'),
                    '0003' => array('id' => '0003', 'name' => '美食广场'),
                    '0004' => array('id' => '0004', 'name' => '沙滩'),
                    '0005' => array('id' => '0005', 'name' => '码头'),
                    '0006' => array('id' => '0006', 'name' => '农场'),
                    '0007' => array('id' => '0007', 'name' => '牧场'),
                    '0008' => array('id' => '0008', 'name' => '工厂'),
                    '0009' => array('id' => '0009', 'name' => '商圈'),
                )
            ),
            '01' => array(
                'id' => '01', 'name' => '建筑',
                'sub' => array(
                    '0101' => array('id' => '0101', 'name' => '住宅'),
                    '0102' => array('id' => '0102', 'name' => '写字楼'),
                    '0103' => array('id' => '0103', 'name' => '寺庙', 'sub' => array(
                        '010301' => array('id' => '010301', 'name' => '佛教'),
                        '010302' => array('id' => '010302', 'name' => '道教'),
                        '010303' => array('id' => '010303', 'name' => '基督教'),
                        '010304' => array('id' => '010304', 'name' => '伊斯兰教'),
                    )),
                    '0104' => array('id' => '0104', 'name' => '学校'),
                    '0105' => array('id' => '0105', 'name' => '游乐场'),
                    '0106' => array('id' => '0106', 'name' => '古建筑', 'sub' => array(
                        '010601' => array('id' => '010601', 'name' => '中式'),
                        '010602' => array('id' => '010602', 'name' => '欧式'),
                        '010603' => array('id' => '010603', 'name' => '清真'),
                        '010604' => array('id' => '010604', 'name' => '日式'),
                    )),
                    '0107' => array('id' => '0107', 'name' => '博物馆'),
                    '0108' => array('id' => '0108', 'name' => '体育馆'),
                    '0109' => array('id' => '0109', 'name' => '商场'),
                    '0110' => array('id' => '0110', 'name' => '便利店'),
                    '0111' => array('id' => '0111', 'name' => '商店'),
                    '0112' => array('id' => '0112', 'name' => '饭店'),
                    '0113' => array('id' => '0113', 'name' => '休闲餐饮店'),
                )
            ),
            '02' => array('id' => '02', 'name' => '桥', 'sub' => array(
                '0201' => array('id' => '0201', 'name' => '现代钢结构'),
                '0202' => array('id' => '0202', 'name' => '石桥'),
                '0203' => array('id' => '0203', 'name' => '木桥'),
            )),
            '03' => array('id' => '03', 'name' => '雕塑'),
            '04' => array('id' => '04', 'name' => '塔', 'sub' => array(
                '0401' => array('id' => '0401', 'name' => '中式'),
                '0402' => array('id' => '0402', 'name' => '欧式'),
                '0403' => array('id' => '0403', 'name' => '金字塔'),
                '0404' => array('id' => '0404', 'name' => '钢塔'),
            )),
        );
    }

    private static function getChild($id, $data, $start = 0){
        $start = $start + 2;
        if($start == 2){
            $d = $data->{substr($id, 0, $start)} ?: '';
        }else{
            $d = $data['sub'][substr($id, 0, $start)] ?: '';
        }
        if(!empty($d)){
            if($start == strlen($id)){
                return $d;
            }else{
                return self::getChild($id, $d, $start);
            }
        }
        return array();
    }

    // print_r(CoverType::get('010603'));die;
    public static function get($id){
        $id = (string) $id;
        $len = strlen($id);
        $data = (object) self::getData();
        if($len == 2){
            //return $data->{'00'} ?: '';
            return $data->$id ?: array();
        }else if($len % 2 == 0){
            return self::getChild($id, $data);
        }
        return array();
    }
}