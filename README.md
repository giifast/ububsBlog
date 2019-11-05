## 前言 ##
- 本项目属业余时间开发，纯属为了交流与学习，代码质量与性能等优化持续进行，如果这个项目对你有帮助，请给个star，谢谢！（7/02/2018 15:41:37 AM ）
- 这个博客项目是我在自己开发的swoole框架（ububs）基础上实现的，博客基本实现了比较常用的功能、界面，前后台。
- QQ：**292304400**，微信：**Ruizhenger**，邮箱：**linlm1994@gmail.com**，欢迎交流
- 持续更新ing
- 博客线上地址：[http://www.ububs.com](http://www.ububs.com "http://www.ububs.com")

## 项目完成部功能 ##
- 文章的增删改查，阅读量等
- 管理员增删改查
- 用户增删改查（第三方登陆准备）
- 管理员、用户日志增删改查
- 网站设置
- 留言，定位
- markdown 编辑器
- mysql数据库备份、导出
- ...

## 项目安装 ##
<pre>

# 项目环境
mysql + php7 + swoole (我自己做了一个docker容器，可供使用，具体在博客里面有介绍)

# 克隆项目
git clone git@github.com:codeMingo/ububsBlog.git

# 安装依赖
composer install
npm install

# 编译文件
npm run build

# 配置数据库参数等
config/*.php

# 执行database文件，创建数据库
php vendor/linlm/ububs/bin/ububs.php db:migration
php vendor/linlm/ububs/bin/ububs.php db:seed

# 启动项目
php vendor/linlm/ububs/bin/ububs.php server:start

# 完成

</pre>

## 感谢阅读，如果这个项目对你有帮助，请给个star，谢谢！ ##
