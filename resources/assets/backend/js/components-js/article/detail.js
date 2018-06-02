import { mavonEditor } from 'mavon-editor';
import 'mavon-editor/dist/css/index.css';
export default {
    components: {
        MavonEditor: mavonEditor
    },
    data() {
        return {
            preview: 'preview',
            articleId: this.$route.params.id,
            detailData: {
                tags: []
            },
            options: {},
            statusColorConfig: {
                '0': '#ed3f14',
                '10': '#ed3f14',
                '20': '#ff9900',
                '30': '#495060',
                '40': '#2d8cf0',
                '50': '#19be6b'
            },
            statusColor: '#ed3f14'
        };
    },
    mounted() {
        this.initDetail();
    },
    methods: {
        initDetail: function() {
            let _this = this;
            axios.get('/backend/article/options').then((response) => {
                let { data } = response.data;
                _this.options = data.options;
            });
            axios.get('/backend/article/' + this.articleId).then((response) => {
                let { data } = response.data;
                data.list['create_time'] = Vue.parseTime(data.list['create_time']);
                _this.detailData = data.list;
                _this.statusColor = _this.statusColorConfig[_this.detailData.status];
            }).catch((error) => {});
        },
        loadMore: function(type) {

        }
    }
}