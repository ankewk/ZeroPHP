<?php

/**
 * 用户表种子文件
 */
class UsersTableSeeder
{
    /**
     * 运行种子
     * @return void
     */
    public function run()
    {
        // 测试数据
        $data = [
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'  // 密码: password
        ];

        // 插入数据
        $db = \Zero\DB::getInstance();
        $existingUser = $db->query("SELECT id FROM users WHERE username = ?", [$data['username']])->fetch();

        if (!$existingUser) {
            $db->insert('users', $data);
            echo "Admin user created successfully.\n";
        } else {
            echo "Admin user already exists.\n";
        }
    }
}
?>