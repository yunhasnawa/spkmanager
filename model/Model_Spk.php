<?php

namespace model;

use framework\icf\pattern\Model;
use framework\icf\library\Sql;
use framework\icf\library\Base;

class Model_Spk extends Model{
	
	public function __construct()
	{
		parent::__construct('spk');
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
		
		$this->databaseAccess->executeUpdate($sql);
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
}

?>