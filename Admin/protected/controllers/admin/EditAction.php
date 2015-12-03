<?php
class EditAction extends CAction{
	public function run(){
		
		$id = Yii::app()->request->getParam('id');
		
		$data = array(
			'code'=>$code,
			'name'=>$name,
			'icon'=>$icon,
			'description'=>$description,
			'discountType'=>$discountType,
			'discount'=>$discount,
		);
		
		if(Yii::app()->request->isAjaxRequest){

			
			echo CJSON::encode($data);
		} else {
			
			// if(){
				$this->controller->render('edit',array(
					
				));
			// } else {
				// throw new CHttpException($result['code'],$result['message']);
				
			// }
		}
	}
}