<template>
  <div class="layout-fast-menu">
    <Tag type="dot" @click.native="$router.push('/home')" :color="$route.path === '/home' ? 'success' : ''">首页</Tag>
    <template v-for="item in this.$store.state.fastMenus">
      <Tag type="dot" :key="item.id" :name="item.text" closable @click.native="$router.push(item.path)"
        @on-close="closeTag" :color="item.path === $route.path ? 'success' : ''">{{ item.text }}</Tag>
    </template>
  </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/fastMenu.scss";
</style>
<script src="../../components-js/common/fastMenu.js"></script>