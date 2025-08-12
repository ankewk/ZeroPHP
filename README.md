# ZeroPHP
PHP Framework

---

## 设计思想
```
简而不失其华。
ZeroPHP这个微框架的设计思想。
天下武功，唯快不破。
在Web领域JS的快速发展下，使得H5等Web应用的REST API程度越来越高。
如果你只是做一些非大型Web项目的。
例如基于PHP做微信Campain、H5 APP、Min Web Application等。 
ZeroPHP就是你的绝佳选型框架。
它很轻，并且很灵活。因为它遵循PSR-4。
你可以非常自由的选择Composer你需要的包。
让你的程序更优雅，更容易维护。
当然如果你的程序很迷你，那么极少的文件加载无疑会是性能上的提升。
```
---

## 框架
```
ZeroPHP是一个PHP轻框架。
适合小型项目的快速搭建。
Route MVC PDO CLI
集成EasyCSV EasyApi
开发者 : Anke
```

---

## 安装
```
v1.0 release
```

---

## 使用 Docker 运行

本指南将帮助您使用 Docker 快速启动 ZeroPHP 项目。

### 前提条件
- 已安装 Docker 和 Docker Compose

### 启动步骤

1. **克隆项目**
   ```bash
   git clone https://github.com/ankewk/ZeroPHP.git
   cd ZeroPHP
   ```

2. **启动容器**
   使用 Docker Compose 启动服务：
   ```bash
   docker-compose up -d
   ```
   这将启动两个容器：
   - MySQL 容器 (端口 33306)
   - Apache + PHP 容器 (端口 8888)

3. **访问应用**
   在浏览器中访问：
   ```
   http://localhost:8888
   ```

4. **数据库连接**
   - 主机: mysql (在容器内部) 或 localhost (从宿主机连接)
   - 端口: 33306
   - 用户名: root
   - 密码: (空)
   - 数据库名: zero

### 停止服务
```bash
 docker-compose down
```

### 数据持久化
- MySQL 数据存储在 `mysql_data` 卷中，即使删除容器，数据也会保留
- 项目文件通过绑定挂载同步，对本地文件的更改会立即反映到容器中

### 注意事项
1. 确保端口 33306 和 8888 在您的主机上没有被占用
2. 首次启动时，MySQL 容器会初始化数据库，可能需要几秒钟时间
3. 如果需要重新构建 Web 容器，可以使用：
   ```bash
   docker-compose up -d --build
   ```

---

## 多环境配置

### 环境介绍
ZeroPHP 支持三种环境配置：

1. **开发环境 (dev)**：本地开发使用，默认启用调试模式
2. **测试环境 (uat)**：用户验收测试使用，禁用调试模式
3. **生产环境 (prod)**：正式上线使用，禁用调试模式

### 配置文件结构
配置文件位于 `conf/env/` 目录下：

```
conf/
├── env/
│   ├── config_dev.php    # 开发环境配置
│   ├── config_uat.php    # 测试环境配置
│   └── config_prod.php   # 生产环境配置
├── config.php            # 主配置文件，负责加载环境配置
└── route.php
```

### 如何切换环境

#### 方法 1：设置环境变量 (推荐)
在启动应用前设置 `APP_ENV` 环境变量：

```bash
# 开发环境
export APP_ENV=dev

# 测试环境
export APP_ENV=uat

# 生产环境
export APP_ENV=prod
```

#### 方法 2：修改配置文件
在 `conf/config.php` 文件中直接修改默认环境：

```php
// 默认环境为开发环境
$env = getenv('APP_ENV') ?: 'dev';  // 将 'dev' 改为 'uat' 或 'prod'
```

### 自定义配置
您可以根据需要在各环境的配置文件中添加或修改配置项。所有配置项会被加载到 `$config` 数组中，并通过 `define` 函数定义为常量。

### 注意事项
1. 生产环境请确保 `debug` 设置为 `false`，避免暴露敏感信息
2. 数据库密码等敏感信息建议通过环境变量设置，不要硬编码在配置文件中
3. 新增配置项时，请确保在所有环境的配置文件中都添加相应的配置

---

## 自动路由功能

ZeroPHP框架支持自动路由机制，无需手动配置路由即可访问控制器和方法。

### 最近更新
- 将TestController中的helloZero方法迁移到IndexController中，现在可以通过`/index/hello`访问该方法。

### 自动路由规则
1. URL路径格式: `/控制器名/方法名`
2. 控制器名会自动转换为大写开头，并添加`Controller`后缀
3. 方法名会自动添加`Zero`后缀
4. 默认为`Index`控制器和`index`方法

### 示例
- 访问 `/test/hello` 会自动路由到 `TestController` 的 `helloZero` 方法
- 访问 `/` 会自动路由到 `IndexController` 的 `indexZero` 方法

### 注意事项
1. 自动路由会在手动配置的路由之后生效，若两者冲突，以手动配置的路由为准
2. 控制器文件名和类名必须遵循`XxxController.php`和`XxxController`的命名规范
3. 方法名必须以`Zero`结尾

## 框架结构
  ```
  - app ：项目
   - Model ：数据模型
   - Controller : 控制器
   - View ：视图
  - public ：公共资源
  - conf : 配置文件
 - config.php : 配置
 - route.php : 路由
- db : 数据库
- zero : 内核
- vendor : 扩展
```
---

## 命令行工具
```
执行 php zerophp
 _____                    _____ __    __ _____
/__  /  ___ __   ______  |  _  |  |  |  |  _  |
  / /  / _ \| |_/ /| _ | | (_) |  |--|  | (_) |
 / /__/  __/| |__/ |(_)| |  ___|  |--|  |  ___|
/____/\___/ |_|    |___| |_|   |__|  |__|_|

Welcome to ZeroPHP Command
Author Anke  Version v1.0 2018-11-08

Model
  model:create             Create new Model file in app

View
  view:create              Create new View file in app

Controller
  controller:create        Create new controller file in app

Orm
  orm:create:name          Create the crate table json file of name in your db path
  orm:alter:name           Create the alter table json file of name in your db path

```
---

## 应用
```
1.ZeroPHP 文档与使用
https://github.com/ankewk/ZeroPHPDoc
2.ZeroCms 基于ZeroPHP开发的开源微信CMS系统
https://github.com/ankewk/ZeroCms
3.ZeroCms 基于ZeroPHP开发的博客系统
https://github.com/ankewk/ZeroBlog
```
---

## FAQ
```
Q:为什么ZeroPHP框架看起来很小?
A:因为它的初衷是微框架，当然它是基于组件化的，你可以在它的基础上构建适合你的大型框架结构。
比如说你觉得laravel的migration很好用，那么你可以在ZeroPHP里面加入Doctrine。
具体可以参考ZeroCms、ZeroBlog这两个项目，就是用doctrine来构建数据持久化。
```