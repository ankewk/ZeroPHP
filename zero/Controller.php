<?php

namespace Zero;

class Controller
{

	public $request;

	public function __construct() 
	{
		$this->request = new Request();
	}

	public function Request() 
	{
		return new Request();
	}

	public function Response($response = '') 
	{
		return new Response($response);
	}

	public function statusPrint($status, $msg = '') 
	{
		$this->Response()->statusPrint($status, $msg);
	}

	public function redirect($uri) 
	{
		$this->Response()->redirect($uri);
	}

}