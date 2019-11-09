<template>
  <div style="height: 100%;">
    <div id="canvas-container"></div>
    <div id="screen-mask" v-show="this.$store.state.screenMaskVisit"></div>
    <div id="main-container">
      <websiteUserInfo></websiteUserInfo>
      <div class="website-content-container">
        <div class="website-notice" v-if="websiteData.showNotice">
          <div class="website-notice-content">
            <p>本站已经运营2年了，感谢大家的来访！</p>
          </div>
        </div>
        <div class="content-container">
          <router-view></router-view>
        </div>
        <div class="website-link">
          <p>
            <span>友情链接：</span>
            <ul>
              <li><a href="https://wiki.swoole.com/" target="_blank">swoole 官网</a></li>
              <li><a href="http://php.net/" target="_blank">php 官网</a></li>
              <li><a href="https://github.com/" target="_blank">github</a></li>
              <li><a href="http://www.ububs.com/" target="_blank">ububs技术博客</a></li>
              <li><a href="http://psr.phphub.org/" target="_blank">php标准规范</a></li>
            </ul>
          </p>
        </div>
        <div class="website-number">
          <p>闽ICP备16033573号-1</p>
        </div>
      </div>
    </div>
  </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/main.scss";
</style>
<script src="../../components-js/common/main.js"></script>