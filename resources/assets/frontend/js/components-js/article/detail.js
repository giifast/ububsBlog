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
            list: {},
            prev: {},
            next: {},
        };
    },
    created() {
        this.initDetail();
    },
    watch: {
        '$route' (to, from) {  
            this.id = to.params.id;
            this.initDetail();
        }  
    },
    methods: {
        initDetail: function() {
            let _this = this;
            axios.get('/article/' + this.id).then((response) => {
                let { data } = response.data;
                if (!data.list || Object.keys(data.list).length === 0) {
                    _this.$router.push({ path: '/404' });
                    return false;
                }
                data.list['create_time'] = Vue.parseTime(data.list['create_time']);
                _this.list = data.list;
                _this.prev = data.prev ? data.prev : {};
                _this.next = data.next ? data.next : {};
            });
        }
    }
}