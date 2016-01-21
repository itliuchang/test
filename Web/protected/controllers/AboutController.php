<?php 
class AboutController extends Controller{
	public function actions(){
		return array(
			'faq' => 'application.controllers.about.FaqAction',
			'locations' => 'application.controllers.about.LocationsAction',
			'membertype' => 'application.controllers.about.MembertypeAction',
			'terms' => 'application.controllers.about.TermsAction',
			'community' => 'application.controllers.about.CommunityAction'
		);
	}
}