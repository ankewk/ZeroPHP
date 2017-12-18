<?php

namespace Zero;

class DB
{
	protected static $instance = NULL;
    protected function __construct() 
    {

    }

    public static function getInstance() 
    {
	    if (!isset(static::$instance)) {
	      $pdo = new \PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASS);    
	      $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);    
	      $pdo->exec('set names utf8'); 
	      static::$instance = $pdo;
	    }
	    return static::$instance;
    }
}