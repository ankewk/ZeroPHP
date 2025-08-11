<?php
// 生产环境配置
return [
    'base_url' => 'http://zerophp.example.com/',
    'vendor_root' => dirname(__FILE__) . '/../../vendor',
    'template_root' => dirname(__FILE__) . '/../../app/View',
    'db' => [
        'host' => 'prod-mysql',
        'user' => 'prod_user',
        'pass' => 'prod_password',
        'name' => 'zero_prod',
        'port' => 3306
    ],
    'debug' => false
];