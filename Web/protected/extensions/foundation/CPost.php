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
	}

	public function getpost($id){
		$result = Yii::app()->db->createCommand()->setText('SELECT a.*,b.nickName,b.portrait,b.title,c.name as companyName,d.name as location from post a  LEFT JOIN user b on b.id = a.userId left join company c on c.id = b.company left join hub d on d.id = b.location where a.status=1 and a.id='.$id)->queryRow();
		$item =Like::model()->findByAttributes(array('userId'=>Yii::app()->user->id,'postId'=>$result['id'],'status'=>1));
		$result['islike'] = $item?1:0;
		$result['likeId'] = $item->id;
		$likelist = Yii::app()->db->createCommand()->setText('select b.portrait,b.nickName,b.id as userId,b.title,c.name as companyName,d.name as locationName from `like` a left join user b on a.userId=b.id left join company c on c.id = b.company left join hub d on d.id=b.location where a.status=1 and a.postId='.$id)->queryAll();
		$commentlist = Yii::app()->db->createCommand()->setText('select b.id as userId,a.createTime,a.content,b.nickName,b.portrait,b.title,c.name as companyName,d.name as location from comment a left join user b on a.userId=b.id left join company c on b.company=c.id left join hub d on d.id=b.location where  a.status=1 and a.postId='.$id)->queryAll();
		return array(
				'code' => 200,
				'mes' => 'success',
				'data' => array(
						'post'=> $result,
						'likelist'=> $likelist,
						'commentlist' => $commentlist
					)
			);
	}

}