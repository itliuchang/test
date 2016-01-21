<div id='faq'>
	<div class='banner'>
		<h2>naked HUB</h2>
		<span class='menubar'>MENU</span>
	</div>
	<div class='menu'>
		<ul>
			<a href='/about/faq'><li>FAQ</li></a>
			<a href='/about/locations'><li>Locations</li></a>
			<a href='/about/membertype'><li>Membership Types</li></a>
			<a href='/about/terms'><li>Terms & Conditions</li></a>
			<a href='/about/community'><li class='select'>Community Guidelines</li></a>
		</ul>
	</div>
	<div class='main'>
		<h1>Community Guidelines </h1>
		<h2>Introduction</h2>
		<ul class='fir'>
			<li>The naked Hub network proudly serves the unique and diverse community of entrepreneurs, start-ups, freelancers, independent professionals, and mobile workers, who are all different yet kindred.   Within our communal workspace,  both physical and virtual, we hope to create meaningful connections, inspire great ideas, foster trust, and channel power for the creation of great enterprises in different forms and sizes.  </li>
			<li>To make this dream a reality, we need enthusiastic and constructive participation and contribution from every single one of you.  We have created this set of guidelines to help everyone understand how to be a productive and supportive naked Hub member.</li>
		</ul>
		<h2>What's naked</h2>
		<ul class='fir'>
			<li>Be fun, be creative.  naked Hub was born out of the desire to breathe life into work, therefore we welcome casual, genuine, and fun ideas.  Put up questions and announcements; share your audacious ideas; put a fun picture of yourself or your space on your profile; put a riddle on the community wall for everyone to solve – you get the picture.  Surprise us!</li>
			<li>Be generous and share:  knowledge, experience, resources. This is what naked Hub is all about – bringing minds together and empowering each other through sharing. </li>
			<li>Be open-minded and respectful.  A diverse community of people who are unlike each other will make us more creative, innovative, and worldly.  In all interaction with fellow members, don’t judge and show respect.  It’s good for the community and good for the respective businesses.</li>
			<li>Respect physical spaces.  We want you to feel completely comfortable, but be mindful of other members.  Please tidy up after you use the living room space, a meeting room, after a lunch, and please take care of the furniture as if it’s your own.  Please only use the desks and furniture that you have been allocated.  For security and tidiness, please don’t leave your belongings on the desks in the open area overnight.</li>
			<li>Be gracious in using communal resources: please book meeting rooms or events with the front desk, and give minimum of 1- hour notice if you need to cancel.  Please keep your food items clean and organized in the communal fridge by writing your name on them.  All unclaimed food will be thrown out on Fridays.  We also provide free coffee, beer, soft drinks, and heavily discounted food items to lubricate social interactions and fuel energy.  Enjoy, but don’t abuse – keep in mind that other members need them too!</li>
			<li>Be mindful of noise.  While we’re in a heated debate with our teammates, others might be concentrating on solving a problem, and vice versa. Use headphones in public spaces for music listening, video watching, etc., and take a heated debate into the living room or an available meeting room to avoid disrupting others. </li>
			<li>Be mindful of smells.  Nobody likes the stale smell of food, so please minimize it.  For teams in open-seating areas, please eat your lunch in the living room.  Let’s all be considerate with heavier-smelling foods, and not to have them inside naked Hub.</li>
			<li>Act green:  naked takes great pride in being an active advocate for sustainable growth, and we’d truly appreciate your support.  Please help us conserve energy by turning off your POD lights, POD air conditioning, and computer monitors at the end of your workday.  Please use the terraces on 3F and 4F if you need a cigarette.</li>
			<li>Please register all your guests with our front desk (name, email, mobile number).  We can’t treat your visitors as our guests unless we know who they are, and this is also for the security of the community.</li>
			<li>Fully leverage the designated zones:  naked Hub has built-in designated zones for us to escape from work when needed:  massage area, shower area, exercise area, and even a spot for a little napping in the meeting booth.  Take advantage of them, and avoid activities unrelated to work at the open desk area or the living room, so you don’t distract others.  </li>
			<li>Our communal workspace gives you great flexibility through different locations, and this also means that it will be harder for us to track your whereabouts.  Please arrange sending and receiving of deliveries on your own, and we can only temporarily accept deliveries/kuaidis for you when you’re not in the facility.  For the safety of all members, food delivery staff and couriers will never be allowed beyond the front desk.</li>
			<li>Take action.  If you see content on the Member Network that you feel violates these guidelines, please report the content and/or behavior to your Community Manager in person or by email cm.fuxing@nakedhub.cn.  We will keep your report anonymous.</li>
			<li>Living room/event space is for members to use, and any larger gatherings need to be signed up with naked Hub personnel.  Catering service is also available through naked, please enquire with your nearest Community Manager.</li>
		</ul>
		<h2>What's not naked</h2>
		<p>Our dream is to turn naked Hub into a collaborative, diverse, and inspiring place for all.  We will limit or revoke access for anyone who frequently acts against these guidelines, especially when it concerns the following:</p>
		<ul class='fir'>
			<li>Post content that is illegal, prohibited, threatening, or dangerous.  If we find you doing these things, your membership will be revoked and we'll take appropriate action including reporting you to the appropriate authorities if necessary.</li>
			<li>Vent your frustrations or rant at other members.  The naked Hub community is not a venue for you to harass, abuse, impersonate, or intimidate others.  We have a zero tolerance policy on direct verbal attacks or name-calling of another member in the community.  If we receive a valid complaint about your conduct, we will send you a warning or revoke your access.</li>
			<li>Spam.  The naked Hub community can be a great source of employees, collaborators, and even customers.  However, please be respectful of your audience.  If your posts are unwelcome, overly aggressive, or disrespectful of conversations, we reserve the ability to send you a warning, or disallow your participation in the community.</li>
			<li>Disrupt the work environment.  When you are in our physical spaces, please be respectful of your fellow members and their work space.  If you use a conference room or our event space, please clean up after yourself and leave it in suitable condition for the next member.</li>
			<li>naked Hub reserves the right to edit/update/add/delete the above rules as situations arise.</li>
		</ul>
		<h2>Conclusion</h2>
		<p>We offer our warmest welcome to our community, and look forward to your contribution toward making it a great place.  The guidelines serve as a reminder of how to have a great time without hindering others’ experience.  If you ever have any questions or comments, we'd love to hear from you.  Please feel free email our Community Manager directly at cm.fuxing@nakedhub.cn.</p>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_faqjs', null ,true);
    $cs->registerScript('room', $js, CClientScript::POS_END);
?>