<div id="roomshow">
	<div class="option">
	<input type='hidden' name='id' value='<?php echo $data['id']?>'>
	<input type='hidden' name='hubid' value='<?php echo '1'?>'>
	<input type='hidden' name='my' data-my='<?php echo $my?>'>
	<input type='hidden' name='other' data-other='<?php echo $other?>'>
		<div class="imgWrapper">
			<img src="<?php echo $data['picture']?>" alt="">
			<div class="detail">
				<h3><?php echo $data['name']?></h3>
				<p><span class="floor"><?php echo $data['floor']?></span>FL<span class="peoples"><?php echo $data['seats']?></span></p>
			</div>
		</div>
		<input type="date" class="date" value="<?php echo $date?>" min="<?php echo date('Y-m-d') ?>" max="<?php echo (date('Y')+2).'-'.date('m-d')?>">
		<div class="time">
			<label>Starts</label>
			<select class="starts">
				<option value='none'>无</option>
				<!-- <option value='0'>9:00</option>
				<option value='2'>10:00</option>
				<option value='4'>11:00</option>
				<option value='6'>12:00</option>
				<option value='8'>13:00</option>
				<option value='10'>14:00</option>
				<option value='12'>15:00</option>
				<option value='14'>16:00</option>
				<option value='16'>17:00</option>
				<option value='18'>18:00</option>
				<option value='20'>19:00</option>
				<option value='22'>20:00</option>
				<option value='24'>21:00</option>
				<option value='26'>22:00</option> -->
			</select>
		</div>
		<div class="hour">
			<label>Times</label>
			<select class='times'>
				<option value=''>无</option>
				<option value='0.5'>0.5 hr</option>
				<option value='1'>1 hr</option>
				<option value='1.5'>1.5 hr</option>
				<option value='2'>2 hr</option>
				<option value='2.5'>2.5 hr</option>
				<option value='3'>3 hr</option>
			</select>
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
	<h2 class="submit" >SAVE</h2>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_roomshowjs', null ,true);
    $cs->registerScript('room', $js, CClientScript::POS_END);
?>