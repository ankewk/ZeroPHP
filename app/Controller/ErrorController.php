<?php

use Zero\Controller;

class ErrorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function notFound()
    {
        // 设置 HTTP 状态码为 404
        http_response_code(404);
        
        // 渲染 404 视图
        $this->render('Error/404', [
            'title' => '页面未找到',
            'message' => '对不起，您访问的页面不存在。'
        ]);
    }
}