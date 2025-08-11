<?php

/**
 * 创建用户表迁移
 */
class CreateUsersTableMigration
{
    /**
     * 运行迁移
     * @return void
     */
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        // 执行SQL语句
        $db = \Zero\DB::getInstance();
        $db->exec($sql);
        echo "Users table created successfully.\n";
    }

    /**
     * 回滚迁移
     * @return void
     */
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS users;";

        // 执行SQL语句
        $db = \Zero\DB::getInstance();
        $db->exec($sql);
        echo "Users table dropped successfully.\n";
    }
}
?>