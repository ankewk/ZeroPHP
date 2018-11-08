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
composer global require "ankewk/zerophp:dev-master"
```

---

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