<?php

use framework\icf\pattern\Controller;

class Test extends Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->view->render('/test/modal');
	}
	
}

?>