<?php

use framework\icf\library\Base;
use framework\icf\pattern\Controller;

require_once Base::site_dir('/model/Model_Spk.php');
use model\Model_Spk;

class Cetak_SPK extends Controller {
	
	private $_mSpk;
	
	public function __construct()
	{
		parent::__construct();
		$this->auth->authenticate();
		
		$this->_mSpk = new Model_Spk();
	}
	
	public function index($args, $request)
	{
		$g = $request['get'];
		
		$id = Base::savecho($g['id'], '', true);
		
		$viewData = array(
			'nomor' => $id
		);
		
		$this->view->render('cetak_spk/index', $viewData);
	}
	
	public function preview($args, $request)
	{
		$g = $request['get'];
		
		$id = isset($g['id']) ? $g['id'] : '';
		
		$this->_createReport($id);
	}
	
	private function _createReport($id)
	{
		$file = Base::site_dir('/report/spk.html');
	
		$content = file_get_contents($file);
		
		if(!empty($id)) {
			
			$search  = array();
			$replace = array();
			
			$data = $this->_mSpk->search('nomor', $id, '=');
			
			$data = $data[0];
			
			foreach ($data as $field => $value) {
				$search[]  = '{' . $field . '}';
				if($field == 'file_stiker') {
					$replace[] = "http://" . Base::site_url($value);
					//echo "http://" . Base::site_url($value);
				} else {
					$replace[] = $value;
				}
			}
			
			$content = str_replace($search, $replace, $content);
		}
		
		echo $content;
	}
	
}

?>