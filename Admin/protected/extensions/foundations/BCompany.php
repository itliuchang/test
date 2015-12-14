<?php 
class BCompany{

	public function getCompanyList($start,$size){
		$start = 0+$start;
 		$count = Companys::model()->count('status!=0');
 		$criteria = new CDbCriteria;
        $criteria->addCondition('t.status!=0');
        $criteria->limit=$size;
        $criteria->offset=$start;
        $result = Companys::model()->with('hub')->with('service')->findAll($criteria);
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>$count,
 				'data'=>$result
 			);
 		} else {
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'count'=>$count,
 				'data'=>''
 			);
 		}
 		return $data;
	}

	public function getCompanyInfo($id){
		$result = Companys::model()->with('hub')->with('service')->findByAttributes(array('id'=>$id));
 		if($result){
 			$data = array(
 				'code'=>200,
 				'message'=>'SUCCESS',
 				'data'=>$result
 			);
 		}
 		return $data;
	}

	public function deleteCompany($id){
		$result = Companys::model()->findByAttributes(array('id'=>$id));
 		$result->status='0';
 		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}

	public function createCompany($data){
		$result = new Companys;
		$result->createTime=date('Y-m-d H:i:s',time());
		foreach($data as $k=> $v){
			$result->$k=$v;
		}
		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}

	public function updateCompany($data,$id){
		$result = Companys::model()->findByAttributes(array('id'=>$id));
		$result->updateTime=date('Y-m-d H:i:s',time());
		foreach($data as $k=> $v){
			$result->$k=$v;
		}
		if($result->save()){
			$data = array(
				'code'=>200,
				'message'=>'SUCCESS'
			);
		}
 		return $data;
	}
}