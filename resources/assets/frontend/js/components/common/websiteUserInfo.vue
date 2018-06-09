<template>
    <div class="user-info-container">
        <div class="header-info-container">
            <p class="user-face"><a class="user-link" href="#"><img src="/resources/images/face.jpg" alt=""></a></p>
        </div>
        <div class="footer-info-container">
            <h1 class="website-title">linlm</h1>
            <div class="website-sign">Do more and say less</div>
            <div class="website-menu">
                <p><router-link to="/">主页</router-link></p>
                <p><router-link to="/article/index">技术博文</router-link></p>
                <p><router-link to="/leave/index">留言</router-link></p>
                <p><a href="https://github.com/linlianmin" target="_blank">github地址</a></p>
                <p class="footer-menu"><a href="/backend">后台体验</a> <router-link to="/about">关于</router-link></p>
            </div>
            <div class="website-menu-mobile">
                <ul>
                    <li class="active"><router-link to="/">主页</router-link></li>
                    <li><router-link to="/article/index">技术博文</router-link></li>
                    <li><router-link to="/leave/index">留言</router-link></li>
                    <li><router-link to="/about">关于</router-link></li>
                </ul>
            </div>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/websiteUserInfo.scss";
</style>
<script src="../../components-js/common/websiteUserInfo.js"></script>