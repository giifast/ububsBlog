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
import iView from 'iview';
import 'iview/dist/styles/iview.css';

Vue.use(iView);

//注册全局的过滤函数
Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key]);
});

const app = new Vue({
    beforeCreate() {
        // 初始化 adminData
    	if (localStorage.hasOwnProperty('ububsAdminData')) {
    		this.$store.commit('setStateValue', { 'adminData': JSON.parse(localStorage.getItem('ububsAdminData')) });
    	}

        // 初始化 fastMenu
        if (localStorage.hasOwnProperty('ububsFastMenus')) {
            this.$store.commit('setStateValue', { 'fastMenus': JSON.parse(localStorage.getItem('ububsFastMenus')) });
        }
    },
    router,
    store
}).$mount('#app');