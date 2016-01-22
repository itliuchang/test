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
			<a href='/about/terms'><li class='select'>Terms & Conditions</li></a>
			<a href='/about/community'><li class='last'>Community Guidelines</li></a>
		</ul>
	</div>
	<div class='main'>
		<h1>naked Hub Terms & Conditions</h1>
		<ol>
			<li>The naked Hub facility (the Facility) owned by Shanghai naked Hub Enterprise Management Consulting Co., Ltd (the Company) is located at 1237 Fuxing Middle Road, Floors 3, Xuhui District, Shanghai.</li>
			<li>By accepting this naked Hub Terms & Conditions (the Terms) upon signing or click 'Accept', you agree to all of the Terms and become a member of the Facility (the Member). The Terms shall constitute the entire agreement between the parties, shall supersede all prior and contemporaneous agreements or understandings, oral or written with respect to the Terms hereof.</li>
			<li>By joining the Facility, the Member agrees to pay the Company the recurring or nonrecurring membership fees (the Fees) as displayed to you at the time of your signup. Your use of the services may be immediately suspended if the Company is unable to receive the Fees by the first day of each month. The Company reserves the right to make changes to the Fees after the expiration of the Terms, and will communicate to the Member by email 30 days before the change.</li>
			<li>All intellectual property rights related to naked Hub or the Facility, including but not limited to copyrights, trademarks, or service marks, etc., are sole property of US or legally authorized to US. The foregoing intellectual property rights include, but are not limited to, (i) all rights to register, or to renew any registration(s) for, such intellectual property rights, (ii) all causes of action related to such intellectual property rights and (iii) any and all moral rights, so-called droids morale and rights of attribution. Without the written consent of US, the Member shall not attempt to register any intellectual property rights, or any part thereof, at the State Intellectual Property Office of China, National Copyright Administration Of China, the Trademark Office of State Administration for Industry and Commerce of China, or any foreign counterpart of either of these offices. </li>
			<li>All services and amenities of the Facility are subject to availability.</li>
			<li>The Company reserves the right to enter into all areas within the Facility with or without prior notification to the Member.</li>
			<li>To secure the safety of the Facility and the personnel and assets within, the Company is entitled to monitor and video surveillance the Facility.</li>
			<li>We will provide the Member a naked Hub membership card, which is specifically for the Member only, and cannot be borrowed, transferred, assigned or used by others. If your naked Hub membership card is lost or stolen, a new card will be issued for a replacement fee.</li>
			<li>The Member shall comply with all applicable laws and regulations and shall not engage in any activity against the laws and regulations, or engage in conduct that harms, disturbs or endangers others.</li>
			<li>The Company reserves the right to limit or terminate the Member's or any visitor's usage of the Facility if we consider it to be non-compliant with the Terms of use.</li>
			<li>The Member must register their visitors before their visit, and the Company reserves the right to restrict visitor's entrance into and usage of the Facility during none office hours.</li>
			<li>The Company shall bear no liability for any losses or damages suffered by the Member or their visitors within the Facility.</li>
			<li>The Member shall compensate the Company for any damages caused to the Facility by the Member or their visitors</li>
			<li>Any dispute arising from or in connection with the Terms shall be governed and construed by the laws of the People's Republic of China without regard to its conflicts of laws provisions. The Member hereby agrees that the courts of competent jurisdiction where the Company located shall have exclusive jurisdiction.</li>
		</ol>
	</div>
</div>
<?php
    $cs = Yii::app()->clientScript;
    $js = $this->renderPartial('_faqjs', null ,true);
    $cs->registerScript('room', $js, CClientScript::POS_END);
?>