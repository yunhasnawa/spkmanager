<?php

namespace model;

use framework\icf\pattern\Model;
use framework\icf\library\Sql;
use framework\icf\library\Base;

class Model_Spk extends Model{
	
	public $dateFields = array();
	
	private $_statusProduksiNames = array();
	
	public function __construct()
	{
		parent::__construct('spk');
		
		$this->dateFields = array('tanggal', 'permintaan_kirim', 'tanggal_kirim');
		
		$this->_statusProduksiNames = array(
			'Layout',
			'Plate',
			'Pisau',
			'Bahan',
			'Printing',
			'Die Cut',
			'Slit/Inspect'
		);
	}
	
	public function getStatusProduksiNames()
	{
		return $this->_statusProduksiNames;
	}
	
	public function add($values)
	{	
		$this->sql->setValues($values);
		
		$sql = $this->sql->generate(Sql::INSERT);
		
		$this->databaseAccess->executeUpdate($sql);
	}
	
	public function grab($fields, $offset = 0, $limit = 20)
	{
		$this->sql->setSelects($fields);
		
		$sql = $this->sql->createSelect();
		
		$data = $this->databaseAccess->executeNonUpdate($sql);
		
		return $data;
	}
	
	public function describe()
	{
		$sql = "SHOW COLUMNS FROM {$this->table}";
		
		$data = $this->databaseAccess->executeNonUpdate($sql);
		
		return $data;
	}
	
	public function count($condition = "") // TODO: $condition may not work
	{
		$select = "COUNT(*) AS count $condition";
		
		$this->sql->setSelects($select);
		
		$sql = $this->sql->createSelect();
		
		$data = $this->databaseAccess->executeNonUpdate($sql);
		
		return $data[0]['count'];
	}
	
	public function search($field, $keyword, $operator = 'LIKE')
	{
		$sql = "SELECT * FROM {$this->table} WHERE $field ";
		
		if(strtolower($operator) == 'like') {
			
			$sql .= "LIKE '%$keyword%'";
			
		} else {
			
			$sql .= "$operator '$keyword'";
			
		}
		
		$data = $this->databaseAccess->executeNonUpdate($sql);
		
		return $data;
	}
	
	public function filterByDate($from, $to)
	{
		$sql = "SELECT * FROM {$this->table} WHERE tanggal BETWEEN '$from' AND '$to'";
		
		$data = $this->databaseAccess->executeNonUpdate($sql);
		
		return $data;
	}
	
	public function remove($id)
	{
		$this->sql->setWheres(array('nomor' => $id));
		
		$sql = $this->sql->createDelete();
		
		$this->databaseAccess->executeUpdate($sql);
	}
	
	public function edit($data)
	{
		$this->sql->setWheres(array('nomor' => $data['nomor']));
		
		unset($data['nomor']);
		
		$this->sql->setSets($data);
		
		$sql = $this->sql->createUpdate();
		
		$this->databaseAccess->executeUpdate($sql);//die;
	}
	
	public function getLastIndex()
	{
		$sql = "SELECT nomor FROM {$this->table} ORDER BY nomor DESC LIMIT 1";
		
		$data = $this->databaseAccess->executeNonUpdate($sql);
		
		return $data[0]['nomor'];
	}
	
	public function changeStatus($id, $status)
	{
		$this->sql->setWheres(array('nomor' => $id));
		
		$this->sql->setSets(array('status' => $status));
		
		$sql = $this->sql->createUpdate();
		
		$this->databaseAccess->executeUpdate($sql);
	}
	
	public function changeStatusProduksi($id, $statusProduksi)
	{
		$spJson = json_encode($statusProduksi);
		
		$this->sql->setWheres(array('nomor' => $id));
		
		$this->sql->setSets(array('status_produksi' => $spJson));
		
		$sql = $this->sql->createUpdate();
		
		$this->databaseAccess->executeUpdate($sql);
	}
	
	public function createStatusProduksiCheckbox($statusProduksi = "[]")
	{
		$arrStatus = json_decode($statusProduksi, true);
		
		if(empty($arrStatus) || $arrStatus == null)
		    $arrStatus = array();
	
		$arrStatusNames = $this->getStatusProduksiNames();
	
		$chkHtml = '';
	
		foreach ($arrStatusNames as $status) {
				
			$checked = in_array($status, $arrStatus) ? 'checked="checked"' : '';
				
			$chktml = <<< PHREDOC
<tr>
	<td class="status_td" style="width: 175px;"><label>$status</label></td>
	<td class="status_td"><input type="checkbox" name="status_produksi[]" value="$status" $checked /></td>
</tr>
PHREDOC;
				
			$chkHtml .= $chktml;
				
		}
	
		$html = <<< PHREDOC
<style type="text/css">
<!--
td.status_td{
	border: 1px solid black;
	padding: 4px;
}
-->
</style>
<table>
	$chkHtml
</table>
PHREDOC;
	
		return $html;
	
	}
}

?>