<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=csrf_token();?>
    <title>ububs个人博客--后台管理</title>
    <meta name="keywords" content="个人博客,ububs个人博客,个人博客模板,ububs,php,php7,swoole,swoole框架,php技术,vuejs,javascript" />
    <meta name="description" content="ububs个人博客，基于php和swoole扩展开发的技术站，记录了一个十八线小程序员的成长过程。" />
    <link rel="stylesheet" href="<?=webpackLoad('backend/app.css');?>">
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script src="<?=webpackLoad('backend/app.js');?>"></script>
</body>
</html>