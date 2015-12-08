<?php
class CompanyController extends Controller{
	public function actions(){
		return array(
			'profile' => 'application.controllers.company.ProfileAction',
			'updateprofile' => 'application.controllers.company.UpdateProfileAction',
		);
	}
}