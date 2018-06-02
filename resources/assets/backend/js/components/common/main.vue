<template>
    <div class="layout">
        <Layout>
            <SidebarMenu ref="sidebarMenuRef"></SidebarMenu>
            <Layout style="-webkit-transition: margin .25s ease-in-out;-moz-transition: margin .25s ease-in-out;" :style="{marginLeft: rightContainerLeft}">
                <HeaderMenu ref="headerMenuRef" v-on:toggleCollapse="toggleCollapse"></HeaderMenu>
                <FastMenu></FastMenu>
                <Content>
                    <router-view></router-view>
                </Content>
                <Footer class="layout-footer-center">
                    <p>版权所有：2018 &copy; www.ububs.com</p>
                    <p>联系邮箱：linlm1994@gmail.com</p>
                </Footer>
            </Layout>
        </Layout>
        <BackTop></BackTop>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/main.scss";
</style>
<script src="../../components-js/common/main.js"></script>