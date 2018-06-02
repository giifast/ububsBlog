import Vue from 'vue';

const plugins = {
    install: function(Vue, options) {
        //获取X轴坐标
        Vue.getX = function(evt) {
            evt = evt || window.event;
            return evt.clientX;
        };
        //获取Y轴坐标
        Vue.getY = function(evt) {
            evt = evt || window.event;
            return evt.clientY
        };
    }
};
Vue.use(plugins);
export default plugins;