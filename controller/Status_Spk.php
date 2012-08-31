<?php

use framework\icf\library\Base;
use framework\icf\pattern\Controller;

require_once Base::site_dir('/model/Model_Spk.php');
use model\Model_Spk;

class Status_Spk extends Controller {
	
	private $_mSpk;
	
	public function __construct()
	{
		parent::__construct();
		$this->auth->authenticate();
		
		$this->_mSpk = new Model_Spk();
	}
	
	public function index($args, $request)
	{
		$p = $request['post'];
		$g = $request['get'];
		
		$sf = $searchField = Base::savecho($p['search_field'], '', true);
		$kw = $keyword = Base::savecho($p['keyword'], '', true);
		
		$df = $searchField = Base::savecho($g['df'], '', true);
		$dt = $keyword = Base::savecho($g['dt'], '', true);
		
		if(empty($sf) && empty($kw) && empty($df) && empty($dt)) {
			$data = $this->_mSpk->grab('*');
		}elseif(!empty($df) && !empty($dt)){
			$data = $this->_mSpk->filterByDate($df, $dt);
		} else $data = $this->_searchSpk($sf, $kw);
		
		$heading = $this->_getHeading(7);
		$heading[] = 'action';
		
		$fullHeading = $this->_getHeading(99);
		
		$viewData = array(
			'full_heading' => $fullHeading,
			'heading'      => $heading,
			'data'         => $this->_addActions($data)
		);
		
		$this->view->render('status_spk/index', $viewData);
	}
	
	private function _addActions($data)
	{
		foreach ($data as $row => $value)
		{
			$id = $value['nomor'];
			
			$editLink   = "http://" . Base::site_url('/spk?id=' . $id);
			$chooseLink = "http://" . Base::site_url('/cetak?id=' . $id);
			$deleteLink = "http://" . Base::site_url('/spk/delete?id=' . $id);
			
			//echo $editLink, ', ', $chooseLink, ', ', $deleteLink;die;
			
			$action = <<< PHREDOC
<div class="btn-group" style="width: 107px;">
	<a class="btn" href="$editLink"><i class="icon-pencil"></i></a>
	<a class="btn" href="$chooseLink"><i class="icon-active"></i></a>
	<a class="btn" href="$deleteLink"><i class="icon-trash"></i></a>
</div>
PHREDOC;
			$data[$row]['action'] = $action;
		}
		
		return $data;
	}
	
	private function _getHeading($max)
	{
		$desc = $this->_mSpk->describe();
		
		$cols = array();
		
		$limit = 0;
		
		foreach($desc as $col) {
			
			$cols[] = $col['Field'];
			
			$limit++;
			
			if($limit == $max) break;
			
		}
		
		return $cols;
	}
	
	private function _searchSpk($field, $keyword)
	{
		$data = $this->_mSpk->search($field, $keyword);
		
		return  $data;
	}
	
	public function ajaxChangeStatus($args, $request)
	{
		$g = $request['get'];
		
		$id = Base::savecho($g['id'], '', true);
		$status = Base::savecho($g['status'], '', true);
		
		if(!empty($id)) {
			$this->_mSpk->changeStatus($id, $status);
			echo json_encode(array('result' => true));
		} else {
			echo json_encode(array('result' => false));
		}
	}
}

?>