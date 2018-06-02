import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        screenMaskVisit: false
    },
    mutations: {
        toggleScreenMaskVisit(state, flag = '') {
        	if (flag === '') {
        		state.screenMaskVisit = !state.screenMaskVisit;
        	} else {
        		state.screenMaskVisit = flag;
        	}
        }
    }
});

export default store;