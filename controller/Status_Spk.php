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
		
		$heading = $this->_getHeading(8);
		$heading[] = 'action';
		
		$fullHeading = $this->_getHeading(99);
		
		$data = $this->_reformatDates($data);
		$data = $this->_proccessStatusProduksi($data);
		
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
			$id      = $value['nomor'];
			$tanggal = $value['tanggal'];
			
			$editLink   = "http://" . Base::site_url('/spk?id=' . $id);
			$chooseLink = "http://" . Base::site_url('/cetak?id=' . $id);
			$deleteLink = "http://" . Base::site_url('/spk/delete?id=' . $id);
			
			//echo $editLink, ', ', $chooseLink, ', ', $deleteLink;die;
			
			$action = <<< PHREDOC
<div class="btn-group" style="width: 107px;">
	<a class="btn" href="$editLink"><i class="icon-pencil"></i></a>
	<a class="btn" href="$chooseLink"><i class="icon-printer"></i></a>
	<a class="btn" href="$deleteLink" onclick="return confirm('Apakah Anda yakin ingin menghapus SPK No. $id tanggal $tanggal ini?');"><i class="icon-trash"></i></a>
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
			
			$spdata = Base::savecho($g['spdata'], '', true);
			
			if(!empty($spdata)) {
				
				$spData = json_decode($spdata);
				
				$id = $spData->id;
				
				$statusProduksi = $spData->sp;
				
				$this->_mSpk->changeStatusProduksi($id, $statusProduksi);
				
				echo json_encode(array('result' => true));
				
			} else 
				echo json_encode(array('result' => false));
		}
	}
	
	private function _reformatDates($arrData)
	{
		foreach ($arrData as $key => $data) {
			$arrData[$key] = Base::reformat_date($data, "d-m-Y", $this->_mSpk->dateFields);
		}
		
		return $arrData;
	}
	
	private function _proccessStatusProduksi($data)
	{
		foreach ($data as $key => $row) {
			
			$sp = isset($row['status_produksi']) && !empty($row['status_produksi']) ? 
				$row['status_produksi'] : "[]";
			
			$arrSp = json_decode($sp, true);
			
			if($arrSp == null) $arrSp = array();
			
			$last = end($arrSp);
			
			$nomor = $row['nomor'];
			
			$data[$key]['status_produksi'] = $this->_createSpUserControl($last, $sp, $nomor);
		}
		
		return $data;
	}
	
	private function _createSpUserControl($caption, $jsonStatus, $id)
	{
		$caption = empty($caption) ? 'New' : $caption;
		
		$html = '<a id="sp_caption_' . $id . '" href="#sp_caption_' . $id . '" onclick="app.showStatusProduksiCheck(' . "'$id'" . ')">' . $caption . '</a>';
		
		$cbx = $this->_mSpk->createStatusProduksiCheckbox($jsonStatus);
		
		$html .= <<< PHREDOC
<div id="sp_control_$id" style="display: none; margin-top: 5px;">
	<div>$cbx</div>
	<div style="margin-top: 5px;">
		<div class="btn-group">
			<a style="width: 30px;" class="btn btn-info" onclick="app.closeStatusProduksiCheck('$id', true)">OK</a>
			<a style="width: 30px;" class="btn btn-warning" onclick="app.closeStatusProduksiCheck('$id')">Batal</a>
		</div>
	</div>
<div>
PHREDOC;
		
		return $html;
	}
}

?>