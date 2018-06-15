<?php

namespace Zero;

class Request
{
	private $param;
	private $server;

	public function __construct() 
	{
		switch($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				$this->param = $_GET;
				break;
			case 'POST':
				$this->param = $_POST;
				break;
			default :
				return 'HTTP Methods is not exits';
				break;
		}
		$this->server = $_SERVER;
	}

	public function validation($rules)
	{
		$validate = new Validate();
		foreach($rules as $k=>$v) {
			if(!isset($this->param[$k]))
				die(json_encode(['status' => 101, 'msg' => '参数不能为空!'], 1));
			$validate->feild = $this->param[$k];
			switch($v) {
				case 'string':
					if(!$validate->STRING())
						die(json_encode(['status' => 102, 'msg'=> "参数{$k}不是字符串"], 1));
					break;
			}
		}
	}

	public function getParam($key)
	{
		return $this->param[$key];
	}

	public function getServer()
	{
		return $this->server;
	}

	public function getDomain() 
	{
		$domain = $_SERVER['HTTP_HOST'];
		$port = strpos($domain, ':');
		if ( $port !== false ) $domain = substr($domain, 0, $port);
		return $domain;
	}
}