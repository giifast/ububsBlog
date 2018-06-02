<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="apple-mobile-app-capable" content="yes">
    <meta name="description" content="">
    <!-- 页面关键词 -->
    <meta name="keywords" content="h5，前端，编程，web，设计">
    <!-- 忽略页面中的数字识别为电话，忽略email识别 -->
    <meta name="format-detection" content="telphone=no, email=no" />
    <?=csrf_token();?>
    <title>测试一下</title>
    <link rel="stylesheet" href="<?=webpackLoad('frontend/app.css');?>">
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script src="<?=webpackLoad('frontend/app.js');?>"></script>
</body>
</html>