import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routers.js';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

Vue.use(VueRouter);

// 404 处理
routes.push({
    path: '*',
    redirect: '/404',
    component: resolve => require(['../components/common/main.vue'], resolve),
    hidden: true
});

//vue-router
const router = new VueRouter({
    routes
});



//vue-router拦截器
router.beforeEach((to, from, next) => {
    NProgress.start();
	if (to.path === '/') {
        next({
            path: '/index'
        });
        return false;
    }
    next();
});
router.afterEach(() => {
    NProgress.done();
});
export default router;