<?php
// 多环境配置加载器
// 默认环境为开发环境
$env = getenv('APP_ENV') ?: 'dev';

// 确保环境是有效的
$validEnvs = ['dev', 'uat', 'prod'];
if (!in_array($env, $validEnvs)) {
    $env = 'dev';
}

// 加载对应的环境配置
$configFile = dirname(__FILE__) . '/env/config_' . $env . '.php';
if (file_exists($configFile)) {
    $config = require $configFile;

    // 设置常量
    define("BASE_URL", $config['base_url']);
    define("VENDOR_ROOT", $config['vendor_root']);
    define("TEMPLATE_ROOT", $config['template_root']);
    define("DBHOST", $config['db']['host']);
    define("DBUSER", $config['db']['user']);
    define("DBPASS", $config['db']['pass']);
    define("DBNAME", $config['db']['name']);
    define("DBPORT", $config['db']['port']);
    define("DEBUG", $config['debug']);
} else {
    // 如果配置文件不存在，使用默认值
    define("BASE_URL", 'http://127.0.0.1:9002/');
    define("VENDOR_ROOT", dirname(__FILE__) . '/../vendor');
    define("TEMPLATE_ROOT", dirname(__FILE__) . '/../app/View');
    define("DBHOST", 'mysql');
    define("DBUSER", 'root');
    define("DBPASS", 'root');
    define("DBNAME", 'zero');
    define("DBPORT", 3306);
    define("DEBUG", true);
}