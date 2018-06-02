<template>
    <div>
        <div id="canvas-container"></div>
        <div id="screen-mask" v-show="this.$store.state.screenMaskVisit"></div>
        <div id="main-container">
            <websiteUserInfo v-on:toggleCollapse="toggleCollapse"></websiteUserInfo>
            <div class="website-content-container">
                <div class="content-container">
                	<router-view></router-view>
                    <websiteFooter></websiteFooter>
                </div>
            </div>
            <websiteBounced ref="websiteBouncedRef"></websiteBounced>
        </div>
    </div>
</template>
<style rel="stylesheet/sass" lang="sass">
@import "../../../sass/common/main.scss";
</style>
<script src="../../components-js/common/main.js"></script>