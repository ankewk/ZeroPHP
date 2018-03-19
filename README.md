# ZeroPHP
PHP Framework

---

>简而不是其华
>是ZeroPHP这个微框架的设计思想
>天下武功，唯快不破。
>在Web领域JS的快速发展，使得H5等应用的REST API程度越来越高。
>如果你只是基于PHP做微信Campain H5的话
>ZeroPHP就是你的绝佳选型框架。
>你可以选择的Composer你的包，让你的程序更优雅，更容易维护。

---

```
ZeroPHP是一个PHP轻框架
适合小型项目的快速搭建
提供路由配置、MVC、PDO
开发者 : Anke Wang
```

---

## 目录说明：
- app ：项目目录
 - controller : 控制器
 - view ：视图
- conf : 配置文件
 - config.php : 程序参数
 - route.php : 路由配置
- zero : 框架内核
- vendor : 第三方扩展

---

## demo
在 路由：Domain/hello 页面下输出Hello PHP!
```
1.在conf/route.php 
下面配置路由如下：
$route['/hello'] = ['Index', 'hello']; //Index控制器下面的helloZero方法实现业务逻辑
2.编写控制器文件 /app/Controller/IndexController.php 
代码如下：
public function helloZero()
{
    $conf = ['page_text' => 'Hello PHP!'];
    $this->render('Hello', ["val" => $conf]); //调用app/View/Hello.tpl.php 视图文件
}
3.浏览器打开 domain/hello 页面就会输出Hello PHP! [这里domain是指你的主机]
```

---

## 插件
后续会编写用于 REST API 的Composer包。
