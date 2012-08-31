<?php

use framework\icf\library\Base;
use framework\icf\pattern\Controller;

require_once Base::site_dir('/model/Model_Spk.php');
use model\Model_Spk;

class Home extends Controller{
	
	private $_mSpk;
	
	public function __construct()
	{
		parent::__construct();
		$this->auth->authenticate();
		
		$this->_mSpk = new Model_Spk();
	}
	
	public function index()
	{
		$count = $this->_mSpk->count();
		
		$viewData = array(
			'count'   => $count,
			'message' => 'Hello, welcome back ' . Base::strong(ucfirst($this->auth->getUsername())) . '!'
		);
		
		$this->view->render('home/index', $viewData);
	}
	
}

?>