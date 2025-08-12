<?php
// 开发环境配置
return [
    'base_url' => 'http://127.0.0.1:9002/',
    'vendor_root' => dirname(__FILE__) . '/../../vendor',
    'template_root' => dirname(__FILE__) . '/../../app/View',
    'db' => [
        'host' => 'mysql',
        'user' => 'root',
        'pass' => 'root',
        'name' => 'zero',
        'port' => 3306
    ],
    'debug' => true
];