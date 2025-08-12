<?php

namespace Zero;

/**
 * 迁移管理器类
 */
class Migrate
{
    /**
     * 运行所有未运行的迁移
     * @return void
     */
    public static function up()
    {
        // 确保迁移表存在
        self::createMigrationTable();

        // 获取所有迁移文件
        $migrationFiles = glob(dirname(dirname(__FILE__)) . '/migrations/*.php');
        sort($migrationFiles);

        // 已运行的迁移
        $db = DB::getInstance();
        $ranMigrations = $db->query('SELECT migration FROM migrations')->fetchAll(\PDO::FETCH_COLUMN);

        foreach ($migrationFiles as $file) {
            $migrationName = basename($file, '.php');

            if (!in_array($migrationName, $ranMigrations)) {
                // 加载迁移文件
                require_once $file;

                // 创建迁移实例并运行up方法
                $className = str_replace('_', '', ucwords($migrationName, '_')) . 'Migration';
                if (class_exists($className)) {
                    $migration = new $className();
                    $migration->up();

                    // 记录迁移
                    $db->exec("INSERT INTO migrations (migration, batch) VALUES ('$migrationName', 1)");
                    CLI::out("迁移 $migrationName 已运行成功.", 'green');
                } else {
                    CLI::out("未找到迁移类 $className.", 'red');
                }
            }
        }
    }

    /**
     * 回滚最近的迁移
     * @return void
     */
    public static function down()
    {
        // 确保迁移表存在
        self::createMigrationTable();

        $db = DB::getInstance();

        // 获取最近运行的迁移
        $lastMigration = $db->query('SELECT migration FROM migrations ORDER BY id DESC LIMIT 1')->fetchColumn();

        if ($lastMigration) {
            // 加载迁移文件
            $file = dirname(dirname(__FILE__)) . '/migrations/' . $lastMigration . '.php';
            if (file_exists($file)) {
                require_once $file;

                // 创建迁移实例并运行down方法
                $className = str_replace('_', '', ucwords($lastMigration, '_')) . 'Migration';
                if (class_exists($className)) {
                    $migration = new $className();
                    $migration->down();

                    // 删除迁移记录
                    $db->exec("DELETE FROM migrations WHERE migration = '$lastMigration'");
                    CLI::out("迁移 $lastMigration 已回滚成功.", 'green');
                } else {
                    CLI::out("未找到迁移类 $className.", 'red');
                }
            } else {
                CLI::out("未找到迁移文件 $file.", 'red');
            }
        } else {
            CLI::out("没有可回滚的迁移.", 'yellow');
        }
    }

    /**
     * 运行种子文件
     * @return void
     */
    public static function seed()
    {
        // 获取所有种子文件
        $seedFiles = glob(dirname(dirname(__FILE__)) . '/seeds/*.php');

        foreach ($seedFiles as $file) {
            // 加载种子文件
            require_once $file;

            // 创建种子实例并运行run方法
            $className = basename($file, '.php');
            if (class_exists($className)) {
                $seeder = new $className();
                $seeder->run();
                CLI::out("种子 $className 已运行成功.", 'green');
            } else {
                CLI::out("未找到种子类 $className.", 'red');
            }
        }
    }

    /**
     * 创建迁移表
     * @return void
     */
    private static function createMigrationTable()
    {
        $db = DB::getInstance();
        $db->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            batch INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    }
}