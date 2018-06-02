<template>
    <div class="layout-fast-menu">
        <Tag type="dot" color="yellow" @click.native="$router.push('/home')" :color="$route.path === '/home' ? 'yellow' : ''">首页</Tag>
        <template v-for="item in this.$store.state.fastMenus">
            <Tag type="dot" :name="item.text" closable color="yellow" @click.native="$router.push(item.path)" @on-close="closeTag" :color="item.path === $route.path ? 'yellow' : ''">{{ item.text }}</Tag>
        </template>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/fastMenu.scss";
</style>
<script src="../../components-js/common/fastMenu.js"></script>