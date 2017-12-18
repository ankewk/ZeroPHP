<?php

namespace Zero;

class Request
{
	private $params;
	private $server;

	public function __construct() 
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET') {
			$this->params = $_GET;
		} else {
			$this->params = $_POST;
		}
		$this->server = $_SERVER;
	}

	public function getServer(){
		return $this->server;
	}

	public function getDomain() {
		$domain = $_SERVER['HTTP_HOST'];
		$port = strpos($domain, ':');
		if ( $port !== false ) $domain = substr($domain, 0, $port);
		return $domain;
	}
}