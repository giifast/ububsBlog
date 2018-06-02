import Wonder from './wonder';
import WebsiteUserInfo from '../../components/common/websiteUserInfo.vue';
import WebsiteBounced from '../../components/common/websiteBounced.vue';
import websiteFooter from '../../components/common/websiteFooter.vue';
export default {
    components: {
        WebsiteUserInfo,
        WebsiteBounced,
        websiteFooter
    },
    data() {
        return {};
    },
    mounted() {
        /**
         * el {String} 元素id或class
         * dotsNumber {Int} 初始化时页面上点的数量，如不传将根据绘制面积控制点的数量
         * lineMaxLength {Int} 两点之间最大的连接线长度，默认：250
         * dotsAlpha {Float} 点的透明度，取值范围 (0,1]，默认：0.8
         * speed {Float} 点的移动速度，取值范围：大于0，默认：2
         * clickWithDotsNumber {Int} 每次点击产生的点的数量，默认：5
         */
        new Wonder({
            el: '#canvas-container',
            dotsNumber: 100,
            lineMaxLength: 300,
            dotsAlpha: .5,
            speed: 1.5,
            clickWithDotsNumber: 5
        });


        /**
         * 点击除弹框任意位置
         */
        let _this = this;
        let appObj = document.getElementById('app');
        appObj.addEventListener('click', function(e) {
            if (!_this.$refs.websiteBouncedRef.bouncedPcVisit && !_this.$refs.websiteBouncedRef.bouncedMobileVisit) {
                return true;
            }
            let bounced = document.getElementById("website-bounced");
            if (!bounced.contains(e.target)) {
                _this.$refs.websiteBouncedRef.closeCollapse();
            }
        });
    },
    methods: {
        toggleCollapse(type) {
            this.$refs.websiteBouncedRef.toggleCollapse(type);
        }
    }
}