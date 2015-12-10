<div id="roomshow">
	<h3>NEAREST AVAILABLE:</h3>
	<div class="option">
		<div class="imgWrapper">
			<img src="/images/banner/1.jpg" alt="">
			<div class="detail">
				<h3>Broccoli NO.10</h3>
				<p><span class="floor">4</span>FL<span class="peoples">6</span></p>
			</div>
		</div>
		<input type="date" class="date">
		<div class="time">
			<label>Starts</label>
			<input type="time">
		</div>
		<div class="hour">
			<label>Times</label>
			<select>
				<option>1</option>
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
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_roomlistjs', null ,true);
    $cs->registerScript('room', $js, CClientScript::POS_END);
?>