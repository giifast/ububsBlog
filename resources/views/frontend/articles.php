<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>博客首页</title>
    <link rel="stylesheet" href="http://127.0.0.1/resources/assets/frontend/css/app.css">
</head>

<body>
    <div id="app-container">
    	<div class="ub-container-header">
    		<ul>
    			<li><a href="/">首页/</a></li>
    			<li><a href="/all">所有文章/</a></li>
    			<li><a href="http://127.0.0.1/backend/">后台体验/</a></li>
    			<li><a href="/about">关于</a></li>
    		</ul>
    	</div>
        <div class="ub-content-container ub-article-container">
            <?php foreach($lists as $year => $articles) {?>
        	<h2 class="ub-container-title"><?= $year?></h2>
        	<ul class="ub-article-list">
        		<?php foreach($articles as $index => $article) {?>
                <li>
                    <a href="/article/<?= $article['id']?>" class="ub-article-title"><span class="ub-blue">[原创]</span> <?= $article['title']?></a>
                    <span class="ub-article-time"><?= date('d M Y', $article['create_time'])?></span>
                </li>
                <?php }?>
        	</ul>
            <?php }?>
            <ul>
                <li class="ub-article-more"><a href="javascript:;">更多...</a></li>
            </ul>
        </div>
        <div id="app-footer"><p>京ICP备16016622号</p></div>
    </div>
</body>

</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>博客首页</title>
    <link rel="stylesheet" href="http://127.0.0.1/resources/assets/frontend/css/app.css">
</head>
<body>
    <div id="app-container">
        <div class="ub-container-header">
            <ul>
                <li><a href="/">首页/</a></li>
                <li><a href="/articles">所有文章/</a></li>
                <li><a href="http://127.0.0.1/backend/">后台体验/</a></li>
                <li><a href="/about">关于</a></li>
            </ul>
        </div>
        <div class="ub-content-container ub-article-container">
            <?php foreach($lists as $year => $articles) {?>
            <h2 class="ub-container-title"><?= $year?></h2>
            <ul class="ub-article-list">
                <?php foreach($articles as $index => $article) {?>
                <li>
                    <a href="/article/<?= $article['id']?>" class="ub-article-title"><span class="ub-blue">[原创]</span> <?= $article['title']?></a>
                    <span class="ub-article-time"><?= date('d M Y', $article['create_time'])?></span>
                </li>
                <?php }?>
            </ul>
            <?php }?>
            <ul>
                <li class="ub-article-more"><a href="javascript:;">更多...</a></li>
            </ul>
        </div>
        <div id="app-footer"><p>京ICP备16016622号</p></div>
    </div>
</body>

</html>