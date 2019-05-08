---
layout: post
title: "var_export() and var_dump()"
date: 2018-05-02
tag: php
---

var_export()和var_dump（）

var_export() 函数返回关于传递给该函数的变量的结构信息，它和 var_dump() 类似，不同的是其返回的表示是合法的 PHP 代码。var_export必须返回合法的php代码， 也就是说，var_export返回的代码，可以直接当作php代码赋值个一个变量。 而这个变量就会取得和被var_export一样的类型的值。看下面一个简单的例子：

```
1	<?php
3	    $arr = array ( 1 , 2 , array ( "apple" , "banana" , "orange" ));
4	    var_export ( $arr );
5	     
程序输出

01	array (
02	  0 => 1,
03	  1 => 2,
04	  2 =>
05	  array (
06	    0 => 'apple',
07	    1 => 'banana',
08	    2 => 'orange',
09	  ),
10	)

注意，上面的输出是合法的PHP代码。假如用var_dump()，则输出为

01	array(3) {
02	  [0]=>
03	  int(1)
04	  [1]=>
05	  int(2)
06	  [2]=>
07	  array(3) {
08	    [0]=>
09	    string(5) "apple"
10	    [1]=>
11	    string(6) "banana"
12	    [2]=>
13	    string(6) "orange"
14	  }
15	}

可以通过将函数的第二个参数设置为 TRUE，从而返回变量的表示

1	<?php
2	     
3	    $v = 'nowamagic';
4	    $rs = var_export ( $v, TRUE );
5	     
6	    echo $rs;
程序运行结果：

1	'nowamagic'
```

### PHP返回变量或数组的字符串表示：var_export()

　　使用var_export()函数可以在服务端程序没有在打印的情况下，配合 *file_put_contents* 方便的调试程序，查看变量和数组的内容

　　在开发过程中，我们常用var_dump()来打印数组内容，但有时候我们不方便通过浏览器查看调试信息，这时候可以将信息输出到文件中查看，var_export()可以打印或返回变量的字符串表示，返回值是一个 **字符串**，形式类似var_dump()打印的字符串，使用var_export()可以将POST、GET和SESSION等数据写入文件，方便查看

　　下面是php文档中的描述：

`mixed var_export ( mixed $expression [, bool $return ] )`

此函数返回关于传递给该函数的变量的结构信息，它和 var_dump() 类似，不同的是其返回的表示是合法的 PHP 代码

可以通过将函数的第二个参数设置为 TRUE，从而返回变量的表示

简而言之，第二个参数为TRUE时，有返回值，不打印；为FALSE时，打印变量，默认为FALSE

　　下面的示例使用var_export()将变量转换成字符串后输出

```
<?php
$num = 255;
$str = 'abc def';
$bool = true;
$arr = array('value1', 'value2', 1, 'key1'=>'value3', 'key2'=>array(2, 3));
echo var_export($num, TRUE);
echo "\n";
echo var_export($str, TRUE);
echo "\n";
echo var_export($bool, TRUE);
echo "\n";
echo var_export($arr, TRUE);
echo "\n";

/*输出
255
'abc def'
true
array (
  0 => 'value1',
  1 => 'value2',
  2 => 1,
  'key1' => 'value3',
  'key2' =>
  array (
    0 => 2,
    1 => 3,
  ),
)
```

　　var_export()返回的是合法的php代码，非常方便生成配置文件或缓存文件，下面用简单的缓存文件示例来讲一下

```
<?php
// $cache的值是更新缓存时从数据库中取出来的
$cache = array(
    'LOG_RECORD'            =>  false,
    'LOG_TYPE'              =>  'File',
    'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',
    'LOG_FILE_SIZE'         =>  2097152,
    'LOG_EXCEPTION_RECORD'  =>  false,
);

// 将从数据库中读到的数据写入缓存文件
$content = "<?php\nreturn ".var_export($cache);    //这里使用var_export()
file_put_contents('./cache.php', $content);

　　我们的缓存文件cache.php内容如下：

<?php
return array(
    'LOG_RECORD'            =>  false,
    'LOG_TYPE'              =>  'File',
    'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',
    'LOG_FILE_SIZE'         =>  2097152,
    'LOG_EXCEPTION_RECORD'  =>  false,
);

　　调用缓存文件的时候只需要使用require() 即可将缓存文件的内容复制给一个变量

<?php
$cache = require('./cache.php');
　　缓存文件中的数组赋值给了$cache变量，phpcms的缓存文件就是采用这种方式的缓存
```

在PHPCMS的源码里，可以看到很多配置的参数都用数组记录的，包括它们的频道、内容等等

```
01	function cache_write($file, $string, $type = 'array')
02	{
03	    if(is_array($string))
04	    {
05	        $type = strtolower($type);
06	        if($type == 'array')
07	        {
08	            $string = "<?php\n return ".var_export($string,TRUE).";\n?>";
09	        }
10	        elseif($type == 'constant')
11	        {
12	            $data='';
13	            foreach($string as $key => $value) $data .="define('".strtoupper($key)."','".
14	addslashes($value)."');\n";
15	            $string = "<?php\n".$data."\n?>";
16	        }
17	    }
18	    $strlen = file_put_contents(PHPCMS_CACHEDIR.$file, $string);
19	    chmod(PHPCMS_CACHEDIR.$file, 0777);
20	    return $strlen;
21	}
```

```
1、var_dump是php用来 打印 变量的 函数 用作 调试

2、dump ThinkPHP 框架 自定义的 用作框架变量 调试用的输出 功能可以说和 var_dump一样的
```
