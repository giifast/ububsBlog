<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=csrf_token();?>
    <title>测试一下</title>
    <link rel="stylesheet" href="<?=webpackLoad('frontend/app.css');?>">
</head>
<body>
    <div id="app" style="height: 100%;">
        <router-view></router-view>
    </div>
    <script src="<?=webpackLoad('frontend/app.js');?>"></script>
</body>
</html>