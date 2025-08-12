<?php
// UAT环境配置
return [
    'base_url' => 'http://uat.zerophp.example.com/',
    'vendor_root' => dirname(__FILE__) . '/../../vendor',
    'template_root' => dirname(__FILE__) . '/../../app/View',
    'db' => [
        'host' => 'uat-mysql',
        'user' => 'uat_user',
        'pass' => 'uat_password',
        'name' => 'zero_uat',
        'port' => 3306
    ],
    'debug' => false
];