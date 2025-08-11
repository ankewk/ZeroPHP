<?php
require_once __DIR__ . '/../vendor/autoload.php';

use OpenApi\Annotations as OA;
use OpenApi\Generator;

// 创建Swagger文档配置
$openapi = Generator::scan([__DIR__ . '/../app/Controller']);

// 设置文档基本信息
$openapi->info->title = 'ZeroPHP API文档';
$openapi->info->description = 'ZeroPHP框架自动生成的API文档';
$openapi->info->version = '1.0.0';
$openapi->info->contact = new OA\Contact(['name' => 'Anke Wang', 'email' => '171640567@qq.com']);

// 设置服务器信息
$openapi->servers = [
    new OA\Server(['url' => 'http://localhost:8888', 'description' => '开发环境']),
    new OA\Server(['url' => 'http://uat.example.com', 'description' => '测试环境']),
    new OA\Server(['url' => 'http://prod.example.com', 'description' => '生产环境'])
];

// 生成Swagger JSON文件
file_put_contents(__DIR__ . '/swagger.json', $openapi->toJson());

// 生成Swagger YAML文件
file_put_contents(__DIR__ . '/swagger.yaml', $openapi->toYaml());

echo 'Swagger文档生成成功！';
?>