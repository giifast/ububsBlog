import { mavonEditor } from 'mavon-editor';
import 'mavon-editor/dist/css/index.css';
export default {
    components: {
        MavonEditor: mavonEditor
    },
    data() {
        return {
            preview: 'preview',
            data: {}
        };
    },
    mounted() {
    	this.initAbout();
    },
    methods: {
    	initAbout() {
            let _this = this;
            axios.get('/about').then((response) => {
                let { data } = response.data;
                _this.data = data.list;
            });
        }
    }
}