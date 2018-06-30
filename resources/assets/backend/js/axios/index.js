window.axios = require('axios');
import store from '../vuex';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';
import router from '../router';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = localStorage.getItem('__UBUBS_TOKEN__');
if (!token) {
    let authToken = document.head.querySelector('meta[name="Authrization"]');
    token = authToken.content;
}
window.axios.defaults.headers.common['X-Authrization'] = token;

//axios拦截器
axios.interceptors.request.use((config) => {
    NProgress.start();
    return config;
}, (error) => {
    return Promise.reject(error);
});

axios.interceptors.response.use((response) => {
    NProgress.done();
    if (typeof response.data === 'string') {
        router.push({ path: '/login' });
        return false;
    }
    let { status, data, message } = response.data;
    // 重定向
    if (!status) {
        // 返回失败直接处理
        new Vue().$Message.error(message);
        return Promise.reject(response);
        // return new Promise(() => {});
    }
    if (data != undefined && data.token != undefined) {
        localStorage.setItem('__UBUBS_TOKEN__', data.token);
        window.axios.defaults.headers.common['X-Authrization'] = data.token;
    }

    return response;
}, (error) => {
    new Vue().$Message.error('很遗憾，发生未知错误！');
    NProgress.done();
    return Promise.reject(error);
});