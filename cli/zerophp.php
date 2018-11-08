<?php
error_reporting(0);
use Zero\CLI;
use Zero\EasyORM;
use Zero\Controller;

if(!isset($argv[1]))
    welcomeShell();
callMethod($argv[1]);

function callMethod($command)
{
    try{
        $res = $input = explode(":",$command);
        if($res == false)
            throw new Exception('The command failed');  
        $class = '';
        switch($input[0]){
            case 'controller':
                $class = 'Zero\Controller';
                break;
            case 'model':
                $class = 'Zero\Model';
                break;
            case 'view':
                $class = 'Zero\View';
                break;
            case 'orm':
                include_once dirname(dirname(__FILE__)) . "/conf/config.php";
                $config = [
                    'dbhost' => DBHOST,
                    'dbname' => DBNAME,
                    'dbuser' => DBUSER,
                    'dbpassword' => DBPASS,
                ];
                $class = 'Zero\EasyORM';
                $path = dirname(dirname(__FILE__)).'/db';
                EasyORM::config($config,$path);
                break;
            default:
                throw new Exception('The command method failed');  
                break;
        }
        $callRes = call_user_func_array([$class,$input[1]],[$input[2]]);
        if($callRes === false)
            throw new Exception('The command param failed');
        CLI::out("{$command} is exec ok",'green',true);
    }catch(Exception $e){
        CLI::out($e->getMessage(),'red',true);
    }
}

function welcomeShell()
{
    CLI::out(' _____                    _____ __    __ _____  ','green',true);
    CLI::out('/__  /  ___ __   ______  |  _  |  |  |  |  _  | ','green',true);
    CLI::out('  / /  / _ \| |_/ /| _ | | (_) |  |--|  | (_) | ','green',true);
    CLI::out(' / /__/  __/| |__/ |(_)| |  ___|  |--|  |  ___| ','green',true);
    CLI::out('/____/\___/ |_|    |___| |_|   |__|  |__|_|     ','green',true);
    CLI::out('','',true);
    CLI::out('Welcome to ZeroPHP Command','yellow',true);
    CLI::out('Author Anke  Version v1.0 2018-11-08','yellow',true);
    CLI::out('','',true);
    CLI::out('Model','red',true);
    CLI::out('  model:create             Create new Model file in app','green',true);
    CLI::out('','',true);
    CLI::out('View','red',true);
    CLI::out('  view:create              Create new View file in app','green',true);
    CLI::out('','',true);
    CLI::out('Controller','red',true);
    CLI::out('  controller:create        Create new controller file in app','green',true);
    CLI::out('','',true);
    CLI::out('Orm','red',true);
    CLI::out('  orm:create:name          Create the crate table json file of name in your db path','green',true);
    CLI::out('  orm:alter:name           Create the alter table json file of name in your db path','green',true);
    exit;
}

