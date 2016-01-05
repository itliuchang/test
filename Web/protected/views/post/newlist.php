<div id="newpostlist">
	
	<div class="write"></div>
</div>
<div class="container-fluid tbar" id="footer">
    <?php $this->widget('FTBarWidget',array('currentTab' => '/post/newlist')) ?>
</div>
<?php echo $this->renderPartial('_template') ?>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_newlistjs', null ,true);
    $cs->registerScript('post', $js, CClientScript::POS_END);
?>