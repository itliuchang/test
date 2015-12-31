<?php
class CCommunity{
	public function getServiceList(){
		$firstService = Yii::app()->db->createCommand()->setText('select * from service where parentId is null and status !=0 ')->queryAll();
		foreach($firstService as &$value){
			$tmp=Yii::app()->db->createCommand()->setText('select count( distinct a.companyId ) as num from service_company a left join service b on a.serviceId=b.id where a.status=1 and b.parentId='.$value['id'])->queryRow();
			$value['num'] = $tmp['num'];
		}
		return array(
				'code' => 200,
				'mes' => 'success',
				'data' => $firstService
			);
	}
	public function getCompanyList(){
		$result = Yii::app()->db->createCommand()->setText('select a.*,b.name as locationName from company a left join hub b on a.hubId=b.id where a.status !=0 ')->queryAll();
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
	public function getCompanyListByService($id=null){
		$result = Yii::app()->db->CreateCommand()->setText('select  distinct a.*,h.name as locationName from company a left join service_company  b on a.id=b.companyId left join hub h on a.hubId=h.id where a.id  in (select  c.companyId from service_company c left join service d  on c.serviceId=d.id  where c.status!=0 and d.parentId='.$id.')')->queryAll();
		return array(
				'code' => 200,
				'mes' => 'success',
				'data' => $result
			);
	}
}