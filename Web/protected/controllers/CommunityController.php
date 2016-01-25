<?php
class CommunityController extends Controller{
	public function filters(){
        return array(
            'accessControl','main'
        );
    }

    public function accessRules(){
        return array(
            array('allow',
                'actions' => array('serviceslist','servicescompany','companylist','memberlist'),
                'users' => array('@'),
            ),
            array('deny',
               'users' => array('*'),
            ),
        );
    }
	public function actions(){
		return array(
				'serviceslist' => 'application.controllers.community.ServicesListAction',
				'servicescompany' => 'application.controllers.community.ServicesCompanyAction',
				'companylist' => 'application.controllers.community.CompanyListAction',
				'memberlist' => 'application.controllers.community.MemberListAction'
			);
	}
}