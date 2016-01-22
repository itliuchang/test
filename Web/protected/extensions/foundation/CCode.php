<?php
class CCode{
	public function getProduct($code){
		$result = Yii::app()->db->createCommand('select b.startDate,b.endDate,c.name,d.name as location from code a left join order_company_product b on a.ordercompanyproductId=b.id left join product_company c on  b.cproductId=c.id left join hub d on c.hubId = d.id where a.code ='."'".$code."'")->queryRow();
		if($result){
			return array(
					'code'=>200,
					'mes'=> 'success',
					'data'=> $result
				);
		}
	}
}