<?php

namespace Zero;

class Cache
{
    public static $expriceTime;
    public static $instance;

    public function __construct()
    {
        
    }

    public static function init($type,$expriceTime)
    {
        self::$expriceTime = $expriceTime;
        switch($type){
            case 'redis':
                self::$instance = new \Redis();
                self::$instance->connect('127.0.0.1', 6379);
                break;
            case 'file':
                break;
            case 'mongo':
                break;
        }
    }

    public static function set($key,$value)
    {
        self::$instance->set($key,$value,self::$expriceTime);
    }

    public static function get($key)
    {
        return self::$instance->get($key);
    }

}