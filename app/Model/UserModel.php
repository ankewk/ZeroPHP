<?php
namespace Model;

use Zero\Model\Model;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        // 设置表名
        $this->table = 'users';
    }

    /**
     * 获取所有用户
     * @return array 用户列表
     */
    public function getAllUsers()
    {
        $sql = "SELECT id, username, email, created_at FROM {$this->table}";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * 根据ID获取用户
     * @param int $id 用户ID
     * @return array|false 用户信息或false（如果不存在）
     */
    public function getUserById($id)
    {
        $sql = "SELECT id, username, email, created_at FROM {$this->table} WHERE id = ?";
        return $this->db->query($sql, [$id])->fetch();
    }

    /**
     * 创建新用户
     * @param array $data 用户数据
     * @return int|false 新创建用户的ID或false（如果创建失败）
     */
    public function createUser($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    /**
     * 更新用户
     * @param int $id 用户ID
     * @param array $data 要更新的数据
     * @return bool 是否更新成功
     */
    public function updateUser($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    /**
     * 删除用户
     * @param int $id 用户ID
     * @return bool 是否删除成功
     */
    public function deleteUser($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
?>