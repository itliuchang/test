<?php
class CCommunity{
	public function getServiceList(){
		$firstService = Yii::app()->db->createCommand()->setText('select * from service where parentId is null and status !=0 ')->queryAll();
		foreach($firstService as &$value){
			$value['num']=Yii::app()->db->createCommand()->setText('SELECT COUNT(a.id) as num,a.id from service a left join service_company b on a.id=b.serviceId where a.parentId='.$value['id'])->queryRow()['num'];
		}
		return array(
				'code' => 200,
				'mes' => 'success',
				'data' => $firstService
			);
	}
	public function getCompanyList(){
		$result = Yii::app()->db->createCommand()->setText('select * from company where status !=0 ')->queryAll();
		return array(
				'code' => 200,
				'mes' => 'success',
				'data' => $result
			);
	}
	public function getMemberList(){
		$result = Yii::app()->db->CreateCommand()->setText('select a.*,b.name as locationName from user a left join hub b on a.location=b.id where a.status !=0')->queryAll();
		return array(
				'code' => 200,
				'mes' => 'success',
				'data' => $result
			);
	}
}