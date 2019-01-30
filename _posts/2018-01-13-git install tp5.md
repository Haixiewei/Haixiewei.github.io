---
layout: post
title: git install tp5.1
date: 2018-01-13 19:00:00
tag: gitTips
--- 

[git install thinkphp5.1](https://www.kancloud.cn/manual/thinkphp5_1/353948)
The first step in solving any problems is recongnizing there is one

使用git版本库安装和更新，ThinkPHP5.1主要分为应用和核心两个仓库，主要包括：

		应用项目：https://github.com/top-think/think
		核心框架：https://github.com/top-think/framework

> 之所以设计为应用和核心仓库的分离，是为了支持Composer单独更新核心框架。

1. 安装也需要分两步操作，首先克隆下载应用 `项目仓库` [Project warehouse]
```
git clone https://github.com/top-think/think tp5
```
--------------------------------------------------
2. 然后 * **`切换到tp5目录`**  *下面，再克隆 `核心框架` [core framework] 仓库（注意目录名称不要改变）：
```
git clone https://github.com/top-think/framework thinkphp
```

> 如果你访问github速度比较慢，可以考虑下面两个国内GIT仓库（国内仓库以稳定版本为主，不确保实时更新）：

[ 码云 ]

		应用项目：https://gitee.com/liu21st/thinkphp5.git
		核心框架：https://gitee.com/liu21st/framework.git
[ Coding ]

		应用项目：https://git.coding.net/liu21st/thinkphp5.git
		核心框架：https://git.coding.net/liu21st/framework.git
> 由于目前仓库默认分支还不是5.1版本，你需要切换到5.1分支（首先进入thinkphp目录后执行下面的命令）

	 git checkout 5.1
> 两个仓库克隆完成后，就完成了ThinkPHP5.1的Git方式下载，如果需要更新核心框架的时候，只需要切换到thinkphp核心目录下面，然后执行：

```
 git pull 
 请不要在应用目录下执行git更新操作。
```


>…or create a new repository on the command line

	echo "# wblog" >> README.md
	git init
	git add README.md
	git commit -m "first commit"
	git remote add origin https://github.com/Haixiewei/wblog.git
	git push -u origin master
	
>…or push an existing repository from the command line

	git remote add origin https://github.com/Haixiewei/wblog.git
	git push -u origin master
	
>…or import code from another repository

	You can initialize this repository with code from a Subversion, Mercurial, or TFS project.

