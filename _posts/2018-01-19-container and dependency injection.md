---
layout: post
title: Container and Dependency injection
date: 2018-01-19 19:00:00
tag: ThinkPHP5.1
--- 
<h1 align="center">容器 和 依赖注入</h1>

## 容器与依赖注入原理

	1. 任何url的访问 最终都是定位到控制器 由控制器中某个具体的方法去执行
	2. 一个控制器对应一个类 若这些类需要统一管理 怎办？
	3. 容器来进行类管理 还可将类的实例(对象)做为参数 传递给类方法 自动触发依赖注入
	4. 依赖注入：将对象类型的数据以参数的方式传到方法的参数列表
	5. URL访问：get传参到方法 只能传字符串 数值
	6. 对象传入方法呢？
	7. 依赖注入：向类中方法传对象的问题

```application\index\controller\Demo1.php
dir	: application\index\controller\Demo1.php
<?php
namespace app\index\controller;

class Demo1
{
	...
}

```

> url get 方式传参到方法中
![](/images/posts/tp5.1/urlget.png)

> common模块 temp类
![](/images/posts/tp5.1/classPara.png)

> 对方法中的一个参数类型约束为对象 自动实例化对象
![](/images/posts/tp5.1/classPara1.png)

> 绑定一个类到容器
![](/images/posts/tp5.1/bindClass.png)

![](/images/posts/tp5.1/bingclass.png)


> 绑定一个闭包到容器
![](/images/posts/tp5.1/bindclosure.png)

