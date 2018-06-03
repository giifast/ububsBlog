<template>
    <div class="user-info-container">
        <div class="header-info-container">
            <a class="mobile-menu-btn" href="javascript:;" @click.stop="toggleCollapse('mobile')">菜单</a>
            <p class="user-face"><a class="user-link" href="#"><img src="/resources/images/face.jpg" alt=""></a></p>
        </div>
        <div class="footer-info-container">
            <h1 class="website-title">linlm</h1>
            <div class="website-sign">Do more and say less</div>
            <div class="website-menu">
                <p><router-link to="/">主页</router-link></p>
                <p><router-link to="/article">技术博文</router-link></p>
                <p><router-link to="/photo">相册</router-link></p>
                <p><router-link to="/leave">留言</router-link></p>
                <p class="footer-menu"><router-link to="/backend">后台体验</router-link> <router-link to="/about">关于</router-link></p>
            </div>
            <div class="website-fastmenu">
                <p>
                    <a href="#">github</a>
                    <a href="#">weibo</a>
                    <a href="#">rss</a>
                </p>
            </div>
            <div class="website-menu-mobile">
                <ul>
                    <li class="active"><a href="javascript:;">主页</a></li>
                    <li><a href="javascript:;">技术博文</a></li>
                    <li><a href="javascript:;">相册</a></li>
                    <li><a href="javascript:;">留言板</a></li>
                </ul>
            </div>
            <div class="website-other">
                <p class="website-online"@click="toggleCollapse('pc')">当前在线：<a href="javascript:;">201</a> 人</p>
                <p class="website-online">今日在线：<a href="javascript:;">34543</a> 次</p>
            </div>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/websiteUserInfo.scss";
</style>
<script src="../../components-js/common/websiteUserInfo.js"></script>