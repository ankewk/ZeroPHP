<?php

namespace Zero;

/**
 * 日志类
 * 提供全局日志功能
 */
class Log
{
    // 日志级别
    const DEBUG = 'debug';
    const INFO = 'info';
    const NOTICE = 'notice';
    const WARNING = 'warning';
    const ERROR = 'error';
    const CRITICAL = 'critical';
    const ALERT = 'alert';
    const EMERGENCY = 'emergency';

    // 单例实例
    protected static $instance = null;

    // 日志配置
    protected $config = [
        'log_path' => '',
        'log_level' => 'debug',
        'log_file_prefix' => 'app_',
        'log_date_format' => 'Y-m-d H:i:s',
        'log_max_size' => 5242880, // 5MB
    ];

    /**
     * 构造函数
     */
    protected function __construct()
    {
        // 默认日志路径
        $this->config['log_path'] = dirname(__DIR__) . '/logs/';

        // 确保日志目录存在
        if (!is_dir($this->config['log_path'])) {
            mkdir($this->config['log_path'], 0755, true);
        }
    }

    /**
     * 获取单例实例
     * @return Log
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 配置日志
     * @param array $config 日志配置
     * @return Log
     */
    public function config(array $config)
    {
        $this->config = array_merge($this->config, $config);

        // 确保日志目录存在
        if (!is_dir($this->config['log_path'])) {
            mkdir($this->config['log_path'], 0755, true);
        }

        return $this;
    }

    /**
     * 调试日志
     * @param string $message 日志消息
     * @param array $context 上下文信息
     */
    public function debug($message, array $context = [])
    {
        $this->log(self::DEBUG, $message, $context);
    }

    /**
     * 信息日志
     * @param string $message 日志消息
     * @param array $context 上下文信息
     */
    public function info($message, array $context = [])
    {
        $this->log(self::INFO, $message, $context);
    }

    /**
     * 通知日志
     * @param string $message 日志消息
     * @param array $context 上下文信息
     */
    public function notice($message, array $context = [])
    {
        $this->log(self::NOTICE, $message, $context);
    }

    /**
     * 警告日志
     * @param string $message 日志消息
     * @param array $context 上下文信息
     */
    public function warning($message, array $context = [])
    {
        $this->log(self::WARNING, $message, $context);
    }

    /**
     * 错误日志
     * @param string $message 日志消息
     * @param array $context 上下文信息
     */
    public function error($message, array $context = [])
    {
        $this->log(self::ERROR, $message, $context);
    }

    /**
     * 严重错误日志
     * @param string $message 日志消息
     * @param array $context 上下文信息
     */
    public function critical($message, array $context = [])
    {
        $this->log(self::CRITICAL, $message, $context);
    }

    /**
     * 警报日志
     * @param string $message 日志消息
     * @param array $context 上下文信息
     */
    public function alert($message, array $context = [])
    {
        $this->log(self::ALERT, $message, $context);
    }

    /**
     * 紧急日志
     * @param string $message 日志消息
     * @param array $context 上下文信息
     */
    public function emergency($message, array $context = [])
    {
        $this->log(self::EMERGENCY, $message, $context);
    }

    /**
     * 记录日志
     * @param string $level 日志级别
     * @param string $message 日志消息
     * @param array $context 上下文信息
     */
    protected function log($level, $message, array $context = [])
    {
        // 检查日志级别
        if ($this->shouldLog($level)) {
            // 格式化消息
            $formattedMessage = $this->formatMessage($level, $message, $context);

            // 写入日志文件
            $this->writeLog($formattedMessage);
        }
    }

    /**
     * 检查是否应该记录该级别的日志
     * @param string $level 日志级别
     * @return bool
     */
    protected function shouldLog($level)
    {
        $levels = [
            self::DEBUG => 0,
            self::INFO => 1,
            self::NOTICE => 2,
            self::WARNING => 3,
            self::ERROR => 4,
            self::CRITICAL => 5,
            self::ALERT => 6,
            self::EMERGENCY => 7
        ];

        return $levels[$level] >= $levels[$this->config['log_level']];
    }

    /**
     * 格式化日志消息
     * @param string $level 日志级别
     * @param string $message 日志消息
     * @param array $context 上下文信息
     * @return string
     */
    protected function formatMessage($level, $message, array $context = [])
    {
        $date = date($this->config['log_date_format']);
        $contextString = empty($context) ? '' : ' ' . json_encode($context);

        return "[{$date}] [{$level}] {$message}{$contextString}\n";
    }

    /**
     * 写入日志文件
     * @param string $message 格式化后的日志消息
     */
    protected function writeLog($message)
    {
        $logFile = $this->config['log_path'] . $this->config['log_file_prefix'] . date('Ymd') . '.log';

        // 检查文件大小，如果超过最大限制则备份
        if (file_exists($logFile) && filesize($logFile) > $this->config['log_max_size']) {
            rename($logFile, $logFile . '.1');
        }

        // 写入日志
        file_put_contents($logFile, $message, FILE_APPEND);
    }

    /**
     * 静态调用方法
     * @param string $method 方法名
     * @param array $args 参数
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = self::getInstance();

        if (method_exists($instance, $method)) {
            return call_user_func_array([$instance, $method], $args);
        }

        throw new \BadMethodCallException("Method {$method} does not exist on " . __CLASS__);
    }
}
?>