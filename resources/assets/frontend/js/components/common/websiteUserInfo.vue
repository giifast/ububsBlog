<template>
  <div class="user-info-container">
    <div class="header-info-container">
      <p class="user-face"><a class="user-link" href="#"><img src="/resources/images/logo.jpeg" alt="logo"></a></p>
    </div>
    <div class="footer-info-container">
      <h1 class="website-title">mingo Lin</h1>
      <div class="website-sign">Do more and say less</div>
      <div class="website-menu">
        <p>
          <router-link to="/index" :class="$route.path === '/index' ? 'active' : ''">主页</router-link>
        </p>
        <p>
          <router-link to="/article/index" :class="$route.path === '/article/index' ? 'active' : ''">技术博文</router-link>
        </p>
        <p>
          <router-link to="/leave/index" :class="$route.path === '/leave/index' ? 'active' : ''">留言</router-link>
        </p>
        <p>
          <router-link to="/tools" :class="$route.path === '/tools' ? 'active' : ''">工具集合</router-link>
        </p>
        <p>
          <router-link to="/about" :class="$route.path === '/about' ? 'active' : ''">关于本站</router-link>
        </p>
        <p class="footer-menu">
          <a href="/backend">后台体验</a>
          <a href="https://github.com/codeMingo" target="_blank">github地址</a>
        </p>
      </div>
      <div class="website-menu-mobile">
        <ul>
          <li :class="$route.path === '/index' ? 'active' : ''">
            <router-link to="/index">主页</router-link>
          </li>
          <li :class="$route.path === '/article/index' ? 'active' : ''">
            <router-link to="/article/index">技术博文</router-link>
          </li>
          <li :class="$route.path === '/leave/index' ? 'active' : ''">
            <router-link to="/leave/index">留言</router-link>
          </li>
          <li :class="$route.path === '/about' ? 'active' : ''">
            <router-link to="/about">关于</router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/websiteUserInfo.scss";
</style>
<script src="../../components-js/common/websiteUserInfo.js"></script>