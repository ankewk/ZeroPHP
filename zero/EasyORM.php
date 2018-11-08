<?php

namespace Zero;

class EasyORM
{
    protected static $db;
    protected static $path;
    protected static $sqlMap;
    protected function __construct() 
    {

    }

    public static function config($config,$path)
    {
        if (!isset(self::$db)){
            $pdo = new \PDO('mysql:host='.$config['dbhost'].';dbname='.$config['dbname'], $config['dbuser'], $config['dbpassword']);    
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);    
            $pdo->exec('set names utf8'); 
            self::$db = $pdo;
        }
        self::$path = $path;
        return;
    }

    public static function create()
    {
        
    }

    public static function alter($file)
    {
        $filePath = self::$path.'/'.$file . '.json';
        $json = '{
    "table":"",
    "opration":"alter",
    "feilds":[
        {
            "name":"",
            "type":"",
            "length":"",
            "default":"",
            "comment":"",
            "after":""
        }
    ]
}';
        file_put_contents($filePath,$json);
    }

    public static function run($file)
    {
        $filePath = self::$path.'/'.$file . '.json';
        $dbContent = json_decode(file_get_contents($filePath));
        self::convertSql($dbContent);
        self::querySqlMap();
    }

    private function querySqlMap()
    {
        foreach(self::$sqlMap as $sql){
            self::$db->exec($sql);
        }
    }

    private function convertSql($dbContent)
    {
        switch($dbContent->opration){
            case 'alter':
                self::$sqlMap = [];
                foreach($dbContent->feilds as $feild){
                    $sql = "alter table `{$dbContent->table}` add {$feild->name} {$feild->type}({$feild->length}) default {$feild->default} comment '{$feild->comment}' after {$feild->after}";
                    self::$sqlMap[] = $sql;
                }
                break;
            case 'create':
                break;
        }
    }

    public static function shellList()
    {   
        self::outShell("EasyORM Command Line Interface", '', false);
        self::outShell(" v1.0", 'green');
        self::outShell("Welcome to use EasyORM",'green');
        self::outShell("orm", 'yellow');
        self::outShell("    orm:create:name",'green',false);
        self::outShell("        Create the crate table json file of name in your db path!");
        self::outShell("    orm:alter:name",'green',false);
        self::outShell("         Create the alter table json file of name in your db path!");
        self::outShell("    orm:run:name",'green',false);
        self::outShell("           run the orm file into the database!");
        exit;
    }
}