import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routers.js';
import store from '../vuex';

Vue.use(VueRouter);

// 404 处理
routes.push({
    path: '*',
    redirect: '/404',
    component: resolve => require(['../components/common/main.vue'], resolve),
    hidden: true
});
const router = new VueRouter({
    routes
});

function isLogin() {
    if (!localStorage.hasOwnProperty('ububsAdminData') || !localStorage.hasOwnProperty('__FWSWOOLE_TOKEN__')) {
        return false;
    }
    return true;
}

//vue-router拦截器
router.beforeEach((to, from, next) => {
    if (to.path === '/login') {
        localStorage.removeItem('ububsAdminData');
        localStorage.removeItem('__FWSWOOLE_TOKEN__');
        store.commit('clearFastMenus');
        next();
        return false;
    }
    let targetPath = isLogin() ? to.path : '/login';
    if (targetPath !== to.path) {
        next({
            path: targetPath
        });
        return true;
    }
    next();
});
router.afterEach((to, from, next) => {
    if (to.path === '/login') {
        return true;
    }
    // 不需要记录面包屑的 path
    let notRecordCrumb = new Array('', '/', '/home');
    // 面包屑
    let breadcrumbData = [];
    if (to.matched && to.matched.length > 0) {
        for (let matchedRouter in to.matched) {
            if (notRecordCrumb.indexOf(to.matched[matchedRouter].path) != -1) {
                continue;
            }
            breadcrumbData.push({ 'path': to.matched[matchedRouter].path, 'text': to.matched[matchedRouter].name });
        }
    }
    store.commit('changeBreadcrumb', breadcrumbData);
    // 不需要记录快捷菜单的 path
    let notRecordMenu = new Array('', '/', '/home', '/404');
    // 快捷菜单
    if (notRecordMenu.indexOf(to.path) == -1 && !to.meta.hidden) {
        let addMenuFalg = true;
        if (store.state.fastMenus.length > 0) {
            for (let iMenu in store.state.fastMenus) {
                if (store.state.fastMenus[iMenu].path === to.path) {
                    addMenuFalg = false;
                }
            }
        }
        if (addMenuFalg) {
            store.commit('addFastMenu', { 'path': to.path, 'text': to.name });
        }
    }
});
export default router;