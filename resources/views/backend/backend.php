<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=csrf_token();?>
    <title>ububs个人博客--后台管理</title>
    <link rel="stylesheet" href="<?=webpackLoad('backend/app.css');?>">
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script src="<?=webpackLoad('backend/app.js');?>"></script>
</body>
</html>