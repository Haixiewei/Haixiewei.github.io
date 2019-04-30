---
layout: post
title: "config"
date: 2019-01-23
tag: tp5
---

### thinkphp/library/think/Config.php

2个私有静态属性 ； 7个静态方法 外部访问 Class::静态成员 不用实例化对象

> use think\config;

### 模块配置注意

> 若入口文件自定义config目录后

```
application/index/config.php 配置无效 需config目录下配置
config/index/config.php

模块下的场景配置
config/index/config.php
<?php
return [
  'name' => 'qqq',
  'app_status' => home,
];
?>
新建 config/index/home.php
<?php
  修改app/database.php文件部分内容填入
?>
```

### 其它位置的配置文件

一、如果配置文件是php文件

>Config::load(APP_PATH.'完整文件名'); //使用绝对路径加载,默认返回数组

二、如果配置文件是其它格式: ini、xml、json等

>Config::parse(APP_PATH.'完整文件名','ini'); //使用绝对路径加载,默认返回数组

注意:读取其它位置的配置文件，都是动态加载,需要在控制器中的方法中执行加载。

```
config/newconfig/conf.php
<?php
return [
  'wel' => 'beijing',
];?>
application/index/controller/index.php
use think/Config;
public function index()
{
  Config::load(APP_PATH);
  dump(Config::get());
}
---------------------------------------------
config/newconfig/conf.ini
site = php
domain = www;注释分号

application/index/controller/index.php
use think/Config;
public function index()
{
  Config::parse(APP_PATH.'../config/newconfig/conf.ini',ini);
  dump(Config::get());
}
```

加载任意位置,非php格式的配置文件，不仅提高了灵活性，还为其它应用提供了一个配置接口

### 如何读取配置项

一、读取配置项

1、类方法: **Config::get('配置参数')** ,参数为空则是获取全部配置项；<br>
2、使用助手函数: **config('配置参数')** ,参数说明与Config::get()完全一样;<br>
3、读取二级配置项,参数与值之间用. (点)进行连接。

二、判断某配置项是否存在？

1、类方法: **Config::has('配置参数');** //返回布尔值;<br>
2、助手函数：**config('?配置参数');** //返回布尔值。

### 正确设置配置项

一、类方法:

1、逐个配置: Config::set ('配置参数','参数值')<br>
2、批量配置: Config::set (数组)<br>
3、二级配置: Config::set ('配置参数',数组)

二、助手函数: config()

1、逐个配置: config ('配置参数','参数值')<br>
2、批量配置: config (数组)<br>
3、二级配置: config ('配置参数',数组)

> 在控制器的方法中，**动态设置配置项**，可以临
时改变某个配置项，优先级也是最高的

```
<?php
namespace app\index\controller;
use think\Config;
class Index
{
  public function index()
  {
    // 单个配置
    Config::set('site_domain','www.baidu.cn');
    or
    config('site_domain','www.baidu.cn');

    // 批量配置
    $config = [
      'site_name' => 'baidu',
      'site_tools' => 'browsers',
    ];
    Config::set($config);
    or
    config($config);

    // 二级配置
    Config::set('site_info',$config);
    or
    config('site_info',$config);

    // 获取配置
    dump(Config::get());
    or
    dump(config());
  }
}
?>
```

### 独立配置文件 (扩展配置)

1、用户自定义的独立配置文件 **必须放在应用或模块下面的extra目录下面**<br>
2、默认独立配置文件database.php[数据库],validate.php[验证规则]既可以
放在extra下面，也可放在与应用或模块同级的目录下面。如果放在extra目录
下面，优先级大于放在应用或模块的同级目录下面<br>
3、 文件名就是配置项名称，文件返回一个数组

>独立配置全部是二级配置

将应用或模块中的部分可归类的配置项独立出
来，单独创建配置文件来加载，可以使我们的
主配置文件加载更快，执行效率更高

### 配置文件加载的优先级

> 惯例配置 < 应用配置 < 模块配置 < 动态配置(set方法和助手函数)

> 惯例配置 thinkphp/convension.php

> 模块配置 < 独立配置 < 场景配置

> 应用配置 < 独立配置 < 场景配置

```
application\config.php 中 添加
'info' => ['name' => '应用配置name'],
dump 应用配置name

application\extra\info.php
<?php
  return [
    'name' => '独立配置name',
  ];
?>
dump 独立配置name

application\config.php 中 修改 'app_status' => 'home';
application\home.php
<?php
return [
  'info' => ['name' => '场景配置name'],
];
?>
dump 场景配置name

application\index\controller\index.php 测试
dump(\think\Config::get('info.name'));
```

> 模块中存在独立配置和场景配置也是这样

### 配置项的作用域
1、作用域与命名空间的概念类似，就是配置项的可见范围<br>
2、作用域的表现形式上与二维数组是一样的<br>
3、切换作用域使用:Config::range('作用域')<br>
4、可以将独立配置项归纳到作用域进行管理，也可动态设置

```
$config = [
  'name' => 'www',
  'id' => 111,
];
// 批量设置 写入作用域
Config::set($config,'user');
// 作用域 相当于 二级配置的名称
dump(Config::get());

// 数组方式配置作用域中值
Config::set('user.name','qqq');
dump(Config::get('user'));

// 切换作用域
Config::range('_sys_');
dump(Config::get());
```
