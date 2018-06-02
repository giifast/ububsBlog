<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>博客首页</title>
    <script src="http://127.0.0.1/resources/assets/frontend/js/app.js"></script>
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
            <h1 class="article-title"><?= $list['title']?></h1>
            <div class="article-other">
            	<p>
            		<span>作者：<?= $list['author']?></span>
            		<span>发表时间：<?= date('d M Y', $list['create_time'])?></span>
            	</p>
            </div>
            <div class="article-content"><?= $list['content']?></div>
        </div>
        <div id="app-footer"><p>京ICP备16016622号</p></div>
    </div>
</body>

</html>