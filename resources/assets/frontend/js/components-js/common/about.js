import { mavonEditor } from 'mavon-editor';
import 'mavon-editor/dist/css/index.css';
export default {
    components: {
        MavonEditor: mavonEditor
    },
    data() {
        return {
            preview: 'preview',
            code_style: 'solarized-dark',
            externalLink: {
                markdown_css: function() {
                    // 这是你的markdown css文件路径
                    return '/public/common/dist/markdown/github-markdown.min.css';
                },
                hljs_js: function() {
                    // 这是你的hljs文件路径
                    return '/public/common/dist/highlightjs/highlight.min.js';
                },
                hljs_css: function(css) {
                    // 这是你的代码高亮配色文件路径
                    return '/public/common/dist/highlightjs/styles/' + css + '.min.css';
                },
                hljs_lang: function(lang) {
                    // 这是你的代码高亮语言解析路径
                    return '/public/common/dist/highlightjs/languages/' + lang + '.min.js';
                },
                katex_css: function() {
                    // 这是你的katex配色方案路径路径
                    return '/public/common/dist/katex/katex.min.css';
                },
                katex_js: function() {
                    // 这是你的katex.js路径
                    return '/public/common/dist/katex/katex.min.js';
                },
            },
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