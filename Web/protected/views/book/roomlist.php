<div id="roomlist">
	<select class="location">
		<option>fuxing</option>
	</select>
	<input type="date" id='date' value='<?php echo $date?>' min="<?php echo date('Y-m-d') ?>">
	<h3>NEAREST AVAILABLE:</h3>
	<?php foreach($data as $value): ?>
	<div class="option">
		<input type="hidden" name='id'  value='<?php echo $value['info']['id']?>'>
		<input type='hidden' name='my' data-my='<?php echo $value['my']?>'>
		<input type='hidden' name='other' data-other='<?php echo $value['other']?>'>
		<div class="imgWrapper">
			<img src="<?php echo $value['info']['picture'] ?>" alt="">
			<div class="detail">
				<h3><?php echo $value['info']['name'] ?></h3>
				<p><span class="floor"><?php echo $value['info']['floor'] ?></span>FL<span class="peoples"><?php echo $value['info']['seats'] ?></span></p>
			</div>
		</div>
		<div class="line clearfix">
			<div class="part">
				<p>9:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>10:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>11:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>12:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>13:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>14:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>15:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
		</div>
		<div class="line clearfix second">
			<div class="part">
				<p>16:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>17:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>18:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>19:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>20:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>21:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
			<div class="part lborder">
				<p>22:00</p>
				<div class="piece"></div>
				<div class="piece lborder"></div>
			</div>
		</div>
		<div class="footer row">
			<div class="col-xs-4 mybook"><span></span>My Booking</div>
			<div class="col-xs-4 available"><span></span>Available</div>
			<div class="col-xs-4 unavailable"><span></span>Unavailable</div>
		</div>
		
	</div>
	
	<?php endforeach; ?>
</div>

<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_roomlistjs', null ,true);
    $cs->registerScript('room', $js, CClientScript::POS_END);
?>