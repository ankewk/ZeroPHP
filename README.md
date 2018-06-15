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
Route MVC PDO
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

## 应用
```
1.ZeroPHP 文档与使用
https://github.com/ankewk/ZeroPHPDoc
2.ZeroCms 基于ZeroPHP开发的微信管理后台
https://github.com/ankewk/ZeroCms
3.easypay 基于ZeroPHP研发的中国支付API composer包
https://github.com/ankewk/easypay
```
