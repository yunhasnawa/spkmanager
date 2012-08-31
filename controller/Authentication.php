<?php

use framework\icf\library\Base;

use framework\icf\pattern\Controller;

class Authentication extends Controller{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function accountHome($args, $request)
	{
		$message = isset($request['get']['message']) ?
			$this->auth->decodeMessage($request['get']['message']) : '';
		
		$viewData = array(
			'message' => $message
		);
		
		$this->view->render('authentication/accountHome', $viewData);
	}
	
	public function login($args, $request)
	{
		$p = $request['post'];
		
		$username = $p['username'];
		$password = $p['password'];
		
		$this->auth->authenticate($username, $password);
		
		Base::redirect(Base::site_url());
	}
	
	public function logout()
	{
		$this->auth->deautenthicate();
	}
	
}

?>