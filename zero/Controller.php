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

	public function dataPrint($data)
	{
		$this->Response()->dataPrint($data);
	}

	public function statusPrint($status, $msg = '') 
	{
		$this->Response()->statusPrint($status, $msg);
	}

	public function render($tpl_name, $params = array()) {
		ob_start();
		extract($params);
		include_once(TEMPLATE_ROOT . '/' . $tpl_name . '.tpl.php');
		$string = ob_get_contents();
		ob_end_clean();
		$response = new Response($string);
		$response->send();
	}

	public function redirect($uri) 
	{
		$this->Response()->redirect($uri);
	}

}