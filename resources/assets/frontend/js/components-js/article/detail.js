import { mavonEditor } from 'mavon-editor';
import 'mavon-editor/dist/css/index.css';
export default {
    components: {
        MavonEditor: mavonEditor
    },
    data() {
        return {
            preview: 'preview',
            id: this.$route.params.id,
            list: {}
        };
    },
    mounted() {
        this.initDetail();
    },
    methods: {
        initDetail: function() {
            let _this = this;
            axios.get('/article/' + this.id).then((response) => {
                let { data } = response.data;
                data.list['create_time'] = Vue.parseTime(data.list['create_time']);
                _this.list = data.list;
            });
        }
    }
}