<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>博客首页</title>
</head>

<body>
    <div id="app-container">
    	<div class="ub-container-header">
    		<ul>
    			<li class="ub-search"><input type="text" placeholder="搜索关键字"></li>
    			<li><a href="javascript:;">首页/</a></li>
    			<li><a href="javascript:;">所有文章/</a></li>
    			<li><a href="javascript:;">后台体验/</a></li>
    			<li><a href="./about.html">关于</a></li>
    		</ul>
    	</div>
        <div class="ub-content-container ub-article-container">
        	<h2 class="ub-container-title">2018</h2>
        	<ul class="ub-article-list">
        		<li><a href="javascript:;" class="ub-article-title"><span class="ub-blue">[原创]</span> 去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title"><span class="ub-red">[转载]</span> 去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title"><span class="ub-blue">[原创]</span> 去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title"><span class="ub-red">[转载]</span> 去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title"><span class="ub-red">[转载]</span> 去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title"><span class="ub-red">[转载]</span> 去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title"><span class="ub-blue">[原创]</span> 去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        	</ul>
        	<h2 class="ub-container-title">2017</h2>
        	<ul class="ub-article-list">
        		<li><a href="javascript:;" class="ub-article-title">去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title">去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title">去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title">去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title">去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title">去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li><a href="javascript:;" class="ub-article-title">去往拉萨的火车</a><span class="ub-article-time">31 Dec 2017</span></li>
        		<li class="ub-article-more"><a href="javascript:;">更多...</a></li>
        	</ul>
        </div>
        <div id="app-footer"><p>京ICP备16016622号</p></div>
    </div>
    <style>
    html, body {
		height: 100%;
    }
    html, body, h1, h2, h3, h4, h5, div, p, ul, li, ol, table, tr, td, dd {
    	margin: 0px;
    	padding: 0px;
    	font-family: inherit;
    	line-height: 1.1;
    	color: inherit;
    }
    body {
        font-size: 14px;
        font-family: "Hiragino Sans GB", "Microsoft YaHei", "WenQuanYi Micro Hei", sans-serif;
        line-height: 1.6em;
        background-color: #eee;
        text-align: center;
    }
    li {
    	list-style: none;
    }
    a {
    	text-decoration: none;
    }
    .ub-red {
    	color: red;
    }
    .ub-blue {
    	color: blue;
    }
    #app-container {

    }
    #app-footer {
		color: #999;
		font-size: 0.7em;
		text-align: center;
    }
    .ub-container-header {
    	max-width: 900px;
    	text-align: justify;
	    margin: 1em auto;
    }
    .ub-container-header ul {
    	text-align: right;
    }
    .ub-container-header li {
		display: inline-block;
    }
    .ub-container-header a {
		color: #999;
		font-size: 0.7em;
    }
    .ub-container-header .ub-search input {
    	font-size: 0.7em;
    	color: #999;
    }
    .ub-article-container {
    	box-sizing: border-box;
    	max-width: 900px;
    	text-align: justify;
    	line-height: 1.75em;
	    padding: 2rem;
	    background-color: #fff;
	    margin: 1em auto;
    }
    .ub-article-container .ub-container-title {
		margin-bottom: 25px;
    }
    .ub-article-container .ub-article-list {
		margin-bottom: 30px;
    }
    .ub-article-container .ub-article-list li {
    	margin-bottom: 15px;
    }
    .ub-article-container .ub-article-title {
		color: rgb(46, 65, 92);
    }
    .ub-article-container .ub-article-time {
		color: #aaa;
	    font-family: "Courier New", monospace;
	    float: right;
	    font-size: 0.9em;
    }
    .ub-article-more a {
    	color: #296bcc;
    }
    </style>
</body>

</html>