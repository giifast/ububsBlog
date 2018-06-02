<template>
    <Sider ref="side" hide-trigger collapsible :collapsed-width="60" v-model="isCollapsed">
        <!-- 未缩放 -->
        <template v-if="!showCo">
            <Menu active-name="1-2" theme="dark" width="auto" :class="menuitemClasses" v-show="!showCo">
                <template v-for="item in $router.options.routes" v-if="!item.hidden">
                    <MenuItem :name="item.name" v-if="item.noDropdown" :key="item.name" @click.native="$router.push(item.path)">
                    <Icon :type="item.icon"></Icon>
                    <span>首页</span>
                    </MenuItem>
                    <Submenu :name="item.name" v-else>
                        <template slot="title">
                            <Icon :type="item.icon"></Icon>
                            <span>{{item.name}}</span>
                        </template>
                        <MenuItem :name="child.name" v-for="child in item.children" @click.native="$router.push(item.path + '/' + child.path)" :key="child.name" v-if="!child.meta || !child.meta.hidden">
                        <span>{{child.name}}</span>
                        </MenuItem>
                    </Submenu>
                </template>
            </Menu>
        </template>
        <!-- 缩放 -->
        <template v-for="(item, index) in $router.options.routes" v-if="showCo">
            <div style="text-align: center;" :key="index" v-if="!item.hidden">
                <Dropdown transfer placement="right-start" :key="index" v-if="item.noDropdown">
                    <Button style="width: 70px;margin-left: -5px;padding:10px 0;" type="text">
                        <Icon :size="20" :color="iconColor" :type="item.icon"></Icon>
                    </Button>
                    <DropdownMenu style="width: 200px;" slot="list">
                        <DropdownItem :name="item.name" :key="'d' + index" @click.native="$router.push(item.path)">
                            <Icon :type="item.icon"></Icon>
                            <span style="padding-left:10px;">{{ item.name }}</span>
                        </DropdownItem>
                    </DropdownMenu>
                </Dropdown>
                <Dropdown transfer placement="right-start" :key="index" v-else>
                    <Button style="width: 70px;margin-left: -5px;padding:10px 0;" type="text">
                        <Icon :size="20" :color="iconColor" :type="item.icon"></Icon>
                    </Button>
                    <DropdownMenu style="width: 200px;" slot="list">
                        <template v-for="(child, i) in item.children">
                            <DropdownItem :name="child.name" :key="i" @click.native="$router.push(item.path + '/' + child.path)" v-if="!child.meta || !child.meta.hidden">
                                <Icon :type="child.icon"></Icon>
                                <span style="padding-left:10px;">{{ child.name }}</span>
                            </DropdownItem>
                        </template>
                    </DropdownMenu>
                </Dropdown>
            </div>
        </template>
    </Sider>
</template>
<style rel="stylesheet/sass" lang="sass" scoped>
@import "../../../sass/common/sidebarMenu.scss";
</style>
<script src="../../components-js/common/sidebarMenu.js"></script>