import WebsiteUserInfo from '../../components/common/websiteUserInfo.vue';
export default {
    components: {
        WebsiteUserInfo
    },
    data() {
        return {
            websiteData: {
                showNotice: false
            }
        };
    },
    mounted() {
        this.initWebsite();
    },
    methods: {
        initWebsite() {
            let _this = this;
            axios.get('/website').then((response) => {
                let { data, message } = response.data;
                _this.websiteData = data.list;
            })
        }
    }
}