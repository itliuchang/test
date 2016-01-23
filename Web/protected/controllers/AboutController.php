<?php 
class AboutController extends Controller{
	public function filters(){
        return array(
            'wechat','accessControl','main'
        );
    }

    public function accessRules(){
        return array(
            array('allow',
                'actions' => array('faq','locations','membertype','terms','community','aboutus'),
                'users' => array('@'),
            ),
            array('deny',
               'users' => array('*'),
            ),
        );
    }
	public function actions(){
		return array(
			'faq' => 'application.controllers.about.FaqAction',
			'locations' => 'application.controllers.about.LocationsAction',
			'membertype' => 'application.controllers.about.MembertypeAction',
			'terms' => 'application.controllers.about.TermsAction',
			'community' => 'application.controllers.about.CommunityAction',
			'aboutus' => 'application.controllers.about.AboutusAction'
		);
	}
}