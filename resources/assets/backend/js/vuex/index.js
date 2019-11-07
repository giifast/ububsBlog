import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        'loading': false,
        // 面包屑{{path: '', text: ''}, {path: '', text: ''}}
        'breadcrumbs': [
            // {path: '/home', text: '測試1'},
            // {path: '', text: '测试2'},
        ],
        'fastMenus': [
            // {path: '/home', text: '測試1'}
        ],
        // 管理员登录信息
        'adminData': {
            id: '',
            account: '',
            email: '',
            permission_text: ''
        },
    },
    mutations: {
        changeBreadcrumb(state, data) {
            state.breadcrumbs = data;
        },
        addFastMenu(state, data) {
            state.fastMenus.push(data);
            localStorage.setItem('ububsFastMenus', JSON.stringify(state.fastMenus));
        },
        deleteFastMenu(state, name) {
            for (let iMenu in state.fastMenus) {
                if (state.fastMenus[iMenu].text === name) {
                    state.fastMenus.splice(iMenu, 1);
                    localStorage.setItem('ububsFastMenus', JSON.stringify(state.fastMenus));
                    break;
                }
            }
        },
        clearFastMenus(state) {
            state.fastMenus = [];
            localStorage.removeItem('ububsFastMenus');
        },
        setStateValue(state, data) {
            for (var item in data) {
                state[item] = data[item];
            }
        }
    }
});

export default store;