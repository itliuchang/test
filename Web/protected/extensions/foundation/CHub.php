<?php 
class CHub{
	public function getHubList(){
		$result = Hub::model()->findAllByAttributes(array('status'=>1));
		if($result){
			$data = array(
				'code' => 200,
				'message' => 'SUCCESS',
				'data' => $result
			);
		}
		return $data;
	}

	public function getHubInfo($id){
		$result = Hub::model()->findByAttributes(array('status'=>1));
		if($result){
			$data = array(
				'code' => 200,
				'message' => 'SUCCESS',
				'data' => $result
			);
		}
		return $data;
	}
}