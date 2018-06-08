<template>
    <Header :style="{padding: 0}" class="layout-header-bar">
        <Row>
            <Col span="12">
            <div class="header-container header-collapsed">
                <Icon @click.native="toggleCollapse" :class="rotateIcon" :style="{}" type="navicon-round" size="24"></Icon>
            </div>
            <div class="header-container header-breadcrumb">
                <Breadcrumb>
                    <BreadcrumbItem to="/index">首页</BreadcrumbItem>
                    <template v-for="item in this.$store.state.breadcrumbs">
                        <BreadcrumbItem :to="item.path" v-if="item.path === $route.path">{{item.text}}</BreadcrumbItem>
                        <BreadcrumbItem v-else>{{item.text}}</BreadcrumbItem>
                    </template>
                </Breadcrumb>
            </div>
            </Col>
            <Col span="12">
            <div class="header-container header-menu">
<!--                 <div class="menu-container">
                    <a href="#">
                        <Icon type="arrow-expand" size="26"></Icon>
                    </a>
                </div> -->
                <div class="menu-container">
                    <Tooltip content="网站首页" placement="bottom">
                        <a href="/home" target="__blank">
                            <Icon type="ios-home" size="26"></Icon>
                        </a>
                    </Tooltip>
                </div>
                <div class="menu-container">
                    <Tooltip content="备份整个数据库" placement="bottom">
                        <a href="javascript:;" @click="dumpDatabase">
                            <Icon type="ios-cloud-download" size="26"></Icon>
                        </a>
                    </Tooltip>
                </div>
                <div class="menu-container">
                    <Badge dot>
                        <Tooltip content="您有 10 条未读消息" placement="bottom">
                            <a href="#">
                                <Icon type="ios-bell-outline" size="26"></Icon>
                            </a>
                        </Tooltip>
                    </Badge>
                </div>
                <div class="menu-container">
                    <a href="#">
                        <Icon type="clipboard" size="26"></Icon>
                    </a>
                </div>
                <div class="menu-container">
                    <a href="#">
                        <Icon type="gear-a" size="26"></Icon>
                    </a>
                </div>
                <div class="menu-container">
                    <Dropdown>
                        <a href="javascript:void(0)">{{this.$store.state.adminData.account}}&nbsp;&nbsp;<Icon type="arrow-down-b"></Icon></a>
                        <DropdownMenu slot="list">
                            <DropdownItem>个人中心</DropdownItem>
                            <DropdownItem>设置</DropdownItem>
                            <DropdownItem>刷新缓存</DropdownItem>
                            <DropdownItem @click.native="logout">退出</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            </div>
            </Col>
        </Row>
    </Header>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/common/headerMenu.scss";
</style>
<script src="../../components-js/common/headerMenu.js"></script>