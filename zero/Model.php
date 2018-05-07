<?php

namespace Zero;

class Model
{
	public $db;

	public function __construct() 
	{
		$this->db = DB::getInstance();
	}
	
}