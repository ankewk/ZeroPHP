<?php

namespace Controller;

use Zero\Controller;
use Zero\Log;

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取用户列表API
     * @return array
     */
    public function usersZero()
    {
        Log::info('ApiController::usersZero 方法被调用');

        // 模拟获取用户数据
        $users = [
            ['id' => 1, 'username' => 'admin', 'email' => 'admin@example.com'],
            ['id' => 2, 'username' => 'user1', 'email' => 'user1@example.com'],
            ['id' => 3, 'username' => 'user2', 'email' => 'user2@example.com']
        ];

        Log::debug('获取用户数据成功', ['count' => count($users)]);

        // 直接返回数组，会被自动转换为JSON
        return [
            'status' => 200,
            'message' => 'Success',
            'data' => $users
        ];
    }

    /**
     * 获取用户详情API
     * @return array
     */
    public function userZero()
    {
        Log::info('ApiController::userZero 方法被调用');

        // 获取请求参数
        $userId = $this->request->get('id', 1);

        // 模拟获取用户数据
        $user = [
            'id' => $userId,
            'username' => 'user' . $userId,
            'email' => 'user' . $userId . '@example.com',
            'created_at' => date('Y-m-d H:i:s')
        ];

        Log::debug('获取用户详情成功', ['user_id' => $userId]);

        // 直接返回数组，会被自动转换为JSON
        return [
            'status' => 200,
            'message' => 'Success',
            'data' => $user
        ];
    }

    /**
     * 字符串响应示例
     * @return string
     */
    public function stringZero()
    {
        // 直接返回字符串
        return 'This is a string response from API';
    }
}