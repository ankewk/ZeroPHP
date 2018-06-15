<?php

namespace Zero;

class Validate
{
	public $feild;

	public function __construct() 
	{
		if(!isset($this->feild))
			return 'Valedate Param Faild';
	}

	public function NULL()
	{
		if(is_null($this->feild))
			return TRUE;
		return FALSE;
	}

	public function INT()
	{
		if(is_int($this->feild))
			return TRUE;
		return FALSE;
	}

	public function STRING()
	{
		if(is_string($this->feild) && $this->feild != '')
			return TRUE;
		return FALSE;
	}

	public function ARRAY()
	{
		if(is_array($this->feild))
			return TRUE;
		return FALSE;
	}

	public function JSON()
	{
		if(json_decode($this->feild))
			return TRUE;
		return FALSE;
	}

	public function EMAIL()
	{

	}

	public function PHONE()
	{

	}

	public function URL()
	{

	}
}