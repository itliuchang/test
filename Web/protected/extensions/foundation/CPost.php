<?php
class CPost{
	public function getlist($page=1,$size=2){
		$result = Yii::app()->db->createCommand()->setText('SELECT a.*,b.nickName,b.portrait,b.title,c.name as companyName,d.name as location from post a  LEFT JOIN user b on b.id = a.userId left join company c on c.id = b.company left join hub d on d.id = b.location where a.status=1  ORDER BY a.createTime desc limit '.($page-1)*$size.','.$size)->queryAll();
		foreach($result as &$value){
			$item =Like::model()->findByAttributes(array('userId'=>Yii::app()->user->id,'postId'=>$value['id'],'status'=>1));
			$value['islike'] = $item?1:0;
			$value['likeId'] = $item->id;
		}
		return array(
				'code'=>200,
				'mes'=>'success',
				'data'=> $result
			);
		// SELECT a.*,b.nickName,b.portrait,c.name,d.name as location from post a  LEFT JOIN user b on b.id = a.userId left join company c on c.id = b.company left join hub d on d.id = b.location  ORDER BY a.createTime asc limit 10
	}
}