FROM php:7.4-apache

# 安装必要的 PHP 扩展
RUN docker-php-ext-install pdo_mysql

# 启用 Apache 重写模块
RUN a2enmod rewrite

# 设置工作目录
WORKDIR /var/www/html

# 复制项目文件到容器中
COPY . /var/www/html

# 安装系统依赖
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# 安装PHP zip扩展
RUN docker-php-ext-install zip

# 安装 Composer（增加重试机制和详细日志）
RUN echo '开始安装Composer...' \
&& (curl -sS -m 300 https://getcomposer.org/installer || curl -sS -m 300 https://getcomposer.org/installer) | php -- --install-dir=/usr/local/bin --filename=composer \
&& echo 'Composer安装完成，版本信息...' \
&& composer --version \
&& echo '配置镜像源...' \
&& composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
&& echo '镜像源配置完成，查看配置...' \
&& composer config -g -l

# 安装项目依赖（增加超时设置和详细错误处理）
RUN echo '正在安装项目依赖...' \
&& export COMPOSER_PROCESS_TIMEOUT=300 \
&& composer install --no-dev --optimize-autoloader --prefer-dist --verbose --no-plugins --no-scripts \
&& echo '依赖安装完成，查看vendor目录...' \
&& ls -la /var/www/html/vendor \
&& echo '查看autoload.php文件...' \
&& ls -la /var/www/html/vendor/autoload.php || (echo 'autoload.php不存在，输出composer错误日志...' && cat /root/.composer/composer.json && exit 1)

# 修改 Apache 配置以允许 .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# 暴露端口 80
EXPOSE 80

# 启动 Apache 服务
CMD ["apache2-foreground"]