---
layout: post
title: "echo print"
date: 2019-05-09
tag: php
---

echo和print都是语言结构 不算函数

主要区别：`print只支持一个参数 并总是返回1`

echo比print速度稍快一点

echo 和 print 只能输出 字符串，整型跟int型浮点型数据<br>
不能打印复合型和资源型数据

----------------------

echo输出多个字符串时，用逗号隔开

<span style='color:yellow'>没有返回值</span>

`向echo传递一个以上的参数，使用括号将会生成解析错误`

```
echo ( string $arg1 [, string $... ] ) : void
```

-----------------------

```
print ( string $arg ) : int

// 也可以使用数组
$bar = array("value" => "foo");
print "this is {$bar['value']} !"; // this is foo !

// 使用单引号将打印变量名，而不是变量的值
print 'foo is $foo'; // foo is $foo

// 如果没有使用任何其他字符，可以仅打印变量
print $foo;          // foobar

Note: 因为是一个语言构造器而不是一个函数，不能被 可变函数 调用
```

--------------------------

<h3>可变函数</h3>

php支持可变函数概念<br>
意味着如果一个变量名后又圆括号<br>
php将寻找与变量的值同名的函数 并尝试执行<br>
可变函数可用来实现包括回调函数 函数表在内的一些用途<br>

可变函数不能用于<br>
echo、print、unset()、isset()、empty()、include、require<br>
以及类似的语言结构<br>
需要i使用自己的包装函数来将这些结构用作可变函数<br>

```
// 使用 echo 的包装函数
function echoit($string)
{
    echo $string;
}
```
