# ZeroPHP
PHP Framework

---

## 设计思想
```
简而不是其华，麻雀虽小，五脏俱全。
是ZeroPHP这个微框架的设计思想
天下武功，唯快不破。
在Web领域JS的快速发展，使得H5等Web应用的REST API程度越来越高。
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
ZeroPHP是一个PHP轻框架
适合小型项目的快速搭建
集成Route MVC PDO
开发者 : Anke
```

---

## 目录说明：
- app ：项目目录
 - Controller : 控制器
 - View ：视图
  - public ：js css img 资源目录
 - Model ：数据模型
- conf : 配置文件
 - config.php : 程序参数
 - route.php : 路由配置
- db : 数据库
- zero : 框架内核
- vendor : 第三方扩展

---

## demo
在 路由：Domain/hello 页面下输出Hello ZeroPHP FrameWork!
```
1.配置路由
conf/route.php文件下配置如下路由：
$route['/hello'] = ['Hello', 'hello']; 
找到Hello的控制器下面的helloZero的方法实现业务逻辑。

2.逻辑编写
/app/Controller/HelloController.php 的 helloZero() 方法：
代码如下：
public function helloZero()
{
    $helloModel = new HelloModel();
    $page_text = $helloModel->getText();
    $this->render('Hello', ["page_text" => $page_text]);
}

3.数据抽象层编写
/app/Model/HelloModel.php 的 getText() 方法
代码如下：
public function getText()
{
    return HELLO_TEXT; //这里是把输出的Hello ZeroPHP FrameWork!进行配置化，便于日后灵活更改。
}

4.视图层编写
/app/View/Hello.tpl.php
代码如下：
<html>
    <body>
    <span><?php echo $page_text;?></span>
    </body>
</html>

5.效果查看
浏览器打开 domain/hello 页面就会输出Hello ZeroPHP FrameWork! [这里domain是指你的主机]
```

---

## 应用
```
1.基于PHP开发的微信管理后台ZeroCms 
https://github.com/ankewk/ZeroCms
```
