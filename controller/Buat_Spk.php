<?php

use framework\icf\library\Base;
use framework\icf\pattern\Controller;

require_once Base::site_dir('/model/Model_Spk.php');
use model\Model_Spk;

class Buat_Spk extends Controller{
	
	private $_mSpk;
	
	public function __construct()
	{
		parent::__construct();
		$this->auth->authenticate();
		
		$this->_mSpk = new Model_Spk();
	}
	
	public function Baru($args, $request)
	{
		$g = $request['get'];
		
		$id = Base::savecho($g['id'], '', true);
		
		$viewData = $this->_edit($id);
		
		$this->view->render('buat_spk/baru', $viewData);
	}
	
	public function save($args, $request)
	{
		$p = $request['post'];
		$f = $_FILES;
		
		$data = $p;
		
		$imgFile = $this->_proccessImage($f['file_stiker']);
		
		if(!empty($imgFile)) {
			
			$data['file_stiker'] = '/resource/images/spk/' . $imgFile;
		}
		
		$id = $p['nomor'];
		
		$search = $this->_mSpk->search('nomor', $id, '=');

		unset($data['submit']);
		
		$data = $this->_reformatDate($data, "Y-m-d"); // Turn to Y-m-d
		
		$data['status_produksi'] = isset($data['status_produksi']) && !empty($data['status_produksi']) ?
			json_encode($data['status_produksi']) : "[]";
		
		if(count($search) > 0) {
			
			$this->_mSpk->edit($data);
			
		} else {
		
			$this->_mSpk->add($data);
		
		}
		
		Base::redirect(Base::site_url('/status'));
	}
	
	private function _proccessImage($file)
	{
		$result = '';
		
		$isEmptyFileName = false;

		if(!empty($file['name']))
		{
			$name = $file['name'];
			$expl = explode('.', $name);
			$ext  = end($expl);
			
			$newName = md5($name) . '.' . $ext;
			
			if(!empty($newName)) {
				
				$tmpName = $file['tmp_name'];
				
				move_uploaded_file($tmpName, Base::site_dir('/resource/images/spk/' . $newName));
				
				$result = $newName;
			}
		}
		
		return $result;
	}
	
	public function delete($args, $request)
	{
		$g = $request['get'];
		
		$id = Base::savecho($g['id'], '', true);
		
		if(!empty($id)) $this->_mSpk->remove($id);
		
		Base::redirect(Base::site_url('/status'));
	}
	
	public function _edit($id)
	{	
		if(!empty($id)) $data = $this->_mSpk->search('nomor', $id, '=');
		else $data = array();
		
		if(count($data) > 0) {
			
			foreach ($data[0] as $key => $value) {
				
				if($key == 'file_stiker' && !empty($value)) {
					
					$data[0][$key] = 'http://' . Base::site_url($value);
					
				}
				
				if($key == 'status_produksi') {
					
					$data[0][$key] = $this->_mSpk->createStatusProduksiCheckbox($value);
					
				}
				
			}
			
		} else {
			$data[0]['nomor'] = (int) $this->_mSpk->getLastIndex() + 1;
			$data[0]['status_produksi'] = $this->_mSpk->createStatusProduksiCheckbox();
		}
		
		$editData = Base::reformat_date($data[0], "d-m-Y", $this->_mSpk->dateFields);
		
		return $editData;
	}
	
	private function _reformatDate($arrData, $format)
	{	
		$arrFields = array('tanggal', 'permintaan_kirim', 'tanggal_kirim'); 
		
		return Base::reformat_date($arrData, $format, $arrFields);
	}
	
}

?>