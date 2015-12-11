<?php
class CommunityController extends Controller{
	public function actions(){
		return array(
				'serviceslist' => 'application.controllers.community.ServicesListAction',
				'servicescompany' => 'application.controllers.community.ServicesCompanyAction',
				'companylist' => 'application.controllers.community.CompanyListAction',
				'memberlist' => 'application.controllers.community.MemberListAction'
			);
	}
}