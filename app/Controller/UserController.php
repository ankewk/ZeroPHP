<?php
namespace Zero\Controller;

use Zero\Controller\Controller;
use Model\UserModel;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    /**
     * @OA\Get(
     *     path="/user",
     *     summary="获取用户列表",
     *     tags={"用户管理"},
     *     responses={
     *         @OA\Response(
     *             response=200,
     *             description="返回用户列表",
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 example={"code":0,"msg":"success","data":[{"id":1,"username":"admin","email":"admin@example.com"}]}
     *             )
     *         )
     *     }
     * )
     */
    public function indexZero()
    {
        $users = $this->userModel->getAllUsers();
        return $this->jsonResponse(0, 'success', $users);
    }

    /**
     * @OA\Get(
     *     path="/user/{id}",
     *     summary="获取用户详情",
     *     tags={"用户管理"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     responses={
     *         @OA\Response(
     *             response=200,
     *             description="返回用户详情",
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 example={"code":0,"msg":"success","data":{"id":1,"username":"admin","email":"admin@example.com"}}
     *             )
     *         ),
     *         @OA\Response(
     *             response=404,
     *             description="用户不存在",
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 example={"code":404,"msg":"User not found"}
     *             )
     *         )
     *     }
     * )
     */
    public function getZero($id)
    {
        $user = $this->userModel->getUserById($id);
        if ($user) {
            return $this->jsonResponse(0, 'success', $user);
        } else {
            return $this->jsonResponse(404, 'User not found');
        }
    }

    /**
     * @OA\Post(
     *     path="/user",
     *     summary="创建用户",
     *     tags={"用户管理"},
     *     @OA\Parameter(
     *         name="username",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     responses={
     *         @OA\Response(
     *             response=201,
     *             description="用户创建成功",
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 example={"code":0,"msg":"User created successfully","data":{"id":1,"username":"admin"}}
     *             )
     *         ),
     *         @OA\Response(
     *             response=400,
     *             description="参数错误",
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 example={"code":400,"msg":"Invalid parameters"}
     *             )
     *         )
     *     }
     * )
     */
    public function createZero()
    {
        $username = $this->request->get('username');
        $email = $this->request->get('email');
        $password = $this->request->get('password');

        if (empty($username) || empty($email) || empty($password)) {
            return $this->jsonResponse(400, 'Invalid parameters');
        }

        // 密码加密
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userId = $this->userModel->createUser([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        if ($userId) {
            return $this->jsonResponse(0, 'User created successfully', ['id' => $userId, 'username' => $username]);
        } else {
            return $this->jsonResponse(500, 'Failed to create user');
        }
    }

    /**
     * @OA\Put(
     *     path="/user/{id}",
     *     summary="更新用户",
     *     tags={"用户管理"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="username",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     responses={
     *         @OA\Response(
     *             response=200,
     *             description="用户更新成功",
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 example={"code":0,"msg":"User updated successfully"}
     *             )
     *         ),
     *         @OA\Response(
     *             response=404,
     *             description="用户不存在",
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 example={"code":404,"msg":"User not found"}
     *             )
     *         )
     *     }
     * )
     */
    public function updateZero($id)
    {
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            return $this->jsonResponse(404, 'User not found');
        }

        $data = [];
        if ($this->request->has('username')) {
            $data['username'] = $this->request->get('username');
        }
        if ($this->request->has('email')) {
            $data['email'] = $this->request->get('email');
        }
        if ($this->request->has('password')) {
            $data['password'] = password_hash($this->request->get('password'), PASSWORD_DEFAULT);
        }

        if (empty($data)) {
            return $this->jsonResponse(400, 'No data to update');
        }

        $result = $this->userModel->updateUser($id, $data);
        if ($result) {
            return $this->jsonResponse(0, 'User updated successfully');
        } else {
            return $this->jsonResponse(500, 'Failed to update user');
        }
    }

    /**
     * @OA\Delete(
     *     path="/user/{id}",
     *     summary="删除用户",
     *     tags={"用户管理"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     responses={
     *         @OA\Response(
     *             response=200,
     *             description="用户删除成功",
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 example={"code":0,"msg":"User deleted successfully"}
     *             )
     *         ),
     *         @OA\Response(
     *             response=404,
     *             description="用户不存在",
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 example={"code":404,"msg":"User not found"}
     *             )
     *         )
     *     }
     * )
     */
    public function deleteZero($id)
    {
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            return $this->jsonResponse(404, 'User not found');
        }

        $result = $this->userModel->deleteUser($id);
        if ($result) {
            return $this->jsonResponse(0, 'User deleted successfully');
        } else {
            return $this->jsonResponse(500, 'Failed to delete user');
        }
    }

    // 辅助方法：返回JSON响应
    private function jsonResponse($code, $msg, $data = [])
    {
        $response = new \Zero\Response();
        $response->setHeader('Content-Type', 'application/json');
        $response->setContent(json_encode([
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ]));
        return $response;
    }
}
?>