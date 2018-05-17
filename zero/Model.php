<?php

namespace Zero;

class Model
{
	public $db;

	public $table;

	public $id;

	public $feild;

	public $value;

	public $upval;

	public $select;

	public $where;

	public function __construct() 
	{
		$this->db = DB::getInstance();
	}

	public function C()
	{
		$sql = "INSERT INTO {$this->table} ({$this->feild}) VALUES ({$this->value})";
		$query = $this->db->prepare($sql);
		$query->execute();
		$id = $this->db->lastInsertId();  
		if($id) 
			return $id;
		return 0;
	}

	public function R()
	{
		$sql = "SELECT {$this->feild} FROM {$this->table} WHERE {$this->where}";
		$query = $this->db->prepare($sql);
		$query->execute();
		$row = $query->fetchAll(\PDO::FETCH_ASSOC);
		if($row)
			return $row;
		return [];
	}

	public function U()
	{
		$sql = "UPDATE {$this->table} SET {$this->upval} WHERE {$this->where}";
		$query = $this->db->prepare($sql);
		$rs = $query->execute();
		if($rs)
			return TRUE;
		return FALSE;
	}

	public function D()
	{
		$sql = "DELETE FROM {$this->table} WHERE id= :id";
		$query = $this->db->prepare($sql);
		$rs = $query->execute([':id' => $this->id]);
		if($rs) 
			return TRUE;
		return FALSE;
	}
	
}