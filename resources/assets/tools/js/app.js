/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');
import store from './vuex';
import './axios';
import router from './router';
import './plugin';
import * as filters from './filter';
import iView from 'view-design';
import 'view-design/dist/styles/iview.css';

Vue.use(iView);

//注册全局的过滤函数
Object.keys(filters).forEach(key => {
  Vue.filter(key, filters[key]);
});

const app = new Vue({
  router,
  store
}).$mount('#app');