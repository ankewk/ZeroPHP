<?php
namespace Zero\Controller;

use Zero\Controller\Controller;
use Model\CommonModel;
use Zero\Log;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexZero()
    {
        Log::info('IndexController->indexZero method called');

        // 记录不同级别的日志
        Log::debug('这是一条调试日志');
        Log::info('这是一条信息日志');
        Log::notice('这是一条通知日志');
        Log::warning('这是一条警告日志');
        Log::error('这是一条错误日志');
        Log::critical('这是一条严重错误日志');
        Log::alert('这是一条警报日志');
        Log::emergency('这是一条紧急日志');

        // 带上下文信息的日志
        Log::info('用户访问', ['controller' => 'IndexController', 'method' => 'indexZero']);

        $model = new CommonModel();
        Log::debug('CommonModel instance created');

        $conf = $model->getHello();
        Log::info('Data fetched from CommonModel', ['data' => $conf]);

        // 输出日志文件位置
        $logFile = __DIR__ . '/../../logs/app_' . date('Ymd') . '.log';
        Log::info('日志文件位置', ['file' => $logFile]);

        $this->render('Index', ["val" => $conf]);
        Log::debug('Index view rendered');
    }

    public function helloZero()
    {
        Log::info('IndexController->helloZero method called');

        $data = ['message' => 'Hello, this is IndexController->helloZero method!'];
        Log::debug('Data prepared', ['data' => $data]);

        $this->assign('data', $data);
        $result = $this->render('Test/hello');

        Log::info('Test/hello view rendered');
        return $result;
    }
}
