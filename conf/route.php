<?php
$route = [];

//System
$route['/'] = ['Index', 'indexZero'];  // 默认路由指向indexZero方法
$route['/index'] = ['Index', 'indexZero'];  // 增加/index路由作为备用访问路径

// 用户管理路由
$route['/user'] = ['User', 'indexZero'];  // 获取用户列表
$route['/user/create'] = ['User', 'createZero'];  // 创建用户
$route['/user/{id}'] = ['User', 'getZero'];  // 获取用户详情
$route['/user/{id}/update'] = ['User', 'updateZero'];  // 更新用户
$route['/user/{id}/delete'] = ['User', 'deleteZero'];  // 删除用户

// API路由
$route['/api/users'] = ['Api', 'usersZero'];  // 获取用户列表API
$route['/api/user'] = ['Api', 'userZero'];  // 获取用户详情API
$route['/api/string'] = ['Api', 'stringZero'];  // 字符串响应示例

// 404 路由
$route['404'] = ['Error', 'notFound'];