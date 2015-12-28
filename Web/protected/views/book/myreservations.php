<div id="myreservation">
	<div class="tabTitle">
		<div class="row wrapper">
			<div class="p col-xs-6">Previous Reservations</div>
			<div class="u col-xs-6 selected">Upcoming Reservations</div>
		</div>
	</div>
	<div class="upcoming">
		<?php foreach($upcominglist as $value): ?>
		<?php if($value['type']==2): ?>
		<div class="option" data-id=<?php echo $value['id'] ?>>
			<p class="title"><span><?php echo date('l',strtotime($value['startTime'])) ?></span><span><?php echo date('m-d',$value['endTime']) ?></span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start"><?php echo date('d',strtotime($value['startTime'])) ?></p>
					<p class="date"><?php echo date('Y-m',strtotime($value['startTime'])) ?></p>
				</div>
				<div class="mid">
					<p>conference room:</p>
					<h3><?php echo $value['roomname'] ?></h3>
					<p><?php echo date('H:i',strtotime($value['startTime'])) ?>-<?php echo date('H:i',strtotime($value['endTime'])) ?></p>
				</div>
				<a class="right">cancel</a>
			</div>
		</div>
		<?php elseif($value['type']==1): ?>
			<div class="option" data-id=<?php echo $value['id'] ?>>
			<p class="title"><span><?php echo date('l',strtotime($value['startTime'])) ?></span><span><?php echo date('m-d',$value['endTime']) ?></span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start"><?php echo date('d',strtotime($value['startTime'])) ?></p>
					<p class="date"><?php echo date('Y-m',strtotime($value['startTime'])) ?></p>
				</div>
				<div class="mid">
					<p>workspace:</p>
					<h3><?php echo $value['hubname'] ?></h3>
				</div>
				<a class="right">cancel</a>
			</div>
		</div>
		<?php endif; ?>
		<?php endforeach;?>
	</div>
	<div class="previous hide">
		<?php foreach($previouslist as $value): ?>
		<?php if($value['type']==2): ?>
		<div class="option">
			<p class="title"><span><?php echo date('l',strtotime($value['startTime'])) ?></span><span><?php echo date('m-d',$value['endTime']) ?></span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start"><?php echo date('d',strtotime($value['startTime'])) ?></p>
					<p class="date"><?php echo date('Y-m',strtotime($value['startTime'])) ?></p>
				</div>
				<div class="mid">
					<p>conference room:</p>
					<h3><?php echo $value['roomname'] ?></h3>
					<p><?php echo date('H:i',strtotime($value['startTime'])) ?>-<?php echo date('H:i',strtotime($value['endTime'])) ?></p>
				</div>
			</div>
		</div>
		<?php elseif($value['type']==1): ?>
			<div class="option">
			<p class="title"><span><?php echo date('l',strtotime($value['startTime'])) ?></span><span><?php echo date('m-d',$value['endTime']) ?></span></p>
			<div class="content">
				<div class="left">
					<h3>STARTS IN</h3>
					<p class="start"><?php echo date('d',strtotime($value['startTime'])) ?></p>
					<p class="date"><?php echo date('Y-m',strtotime($value['startTime'])) ?></p>
				</div>
				<div class="mid">
					<p>workspace:</p>
					<h3><?php echo $value['hubname'] ?></h3>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php endforeach;?>
	</div>
</div>
<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog" data-verticalAlign="true">
        <div class="modal-content">
            <div class="modal-body"><div class="message">sure cancel？</div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">no</button>
                <button type="button" class="btn btn-primary confirm">yes</button>
            </div>
        </div>
    </div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_myreservationsjs', null ,true);
    $cs->registerScript('reservation', $js, CClientScript::POS_END);
?>