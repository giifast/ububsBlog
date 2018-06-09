import { mavonEditor } from 'mavon-editor';
import 'mavon-editor/dist/css/index.css';
export default {
    components: {
        MavonEditor: mavonEditor
    },
    data() {
        return {
            articleId: this.$route.params.id,
            formData: {
                tags: []
            },
            uploadConfig: {
                type: 'drag',
                maxSize: 100,
                accept: 'image/*',
                format: ['jpg','jpeg','png'],
                defaultFile: [],
                action: "/upload/image/article-thumbnail"
            },
            options: {},
            rules: {
                title: [
                    { required: true, message: '文章标题不得为空', trigger: 'blur' }
                ],
                content: [
                    { required: true, message: '文章正文不得为空', trigger: 'change' }
                ],
                category_menu_id: [
                    { required: true, message: '文章所属类别不得为空', trigger: 'change' }
                ],
            },
            loadingSave: false,
            loadingDraft: false,
        };
    },
    mounted() {
        this.initForm();
    },
    methods: {
        initForm: function() {
            let _this = this;
            axios.get('/backend/article/options').then((response) => {
                let { data } = response.data;
                _this.options = data.options;
            });
            if (this.articleId) {
                this.getArticleDetail(this.articleId);
            }
        },
        getArticleDetail(id) {
            let _this = this;
            axios.get('/backend/article/' + id).then((response) => {
                let { data } = response.data;
                data.list['created_at'] = Vue.parseTime(data.list['created_at'], '{y}-{m}-{d}');
                data.list.reprinted = !!Number(data.list.reprinted);
                _this.formData = data.list;
            });
        },
        save: function(name) {
            let _this = this;
            _this.$refs[name].validate((valid) => {
                if (valid) {
                    let saveData = _this.formData;
                    let method = !_this.articleId ? 'post' : 'put';
                    let url = !_this.articleId ? '/backend/article' : '/backend/article/' + _this.articleId;
                    axios[method](url, saveData).then((response) => {
                        let { message } = response.data;
                        _this.$Message.success(message);
                        _this.$router.push({ path: '/article/lists' });
                    });
                }
            })
        },
        draft: function() {
            let _this = this;
            let saveData = _this.formData;
            saveData.draft = true;
            axios.post('/backend/article', saveData).then((response) => {
                let { message } = response.data;
                _this.$Message.success(message);
                _this.$router.push({ path: '/article/lists' });
            });
        },
        // 绑定@imgAdd event
        $imgAdd(pos, $file) {
            // 第一步.将图片上传到服务器.
            let formData = new FormData();
            formData.append('image', $file);
            // axios.post('/upload', formData, config).then((url) => {
            //     // 第二步.将返回的url替换到文本原位置![...](./0) -> ![...](url)
            //     *
            //      * $vm 指为mavonEditor实例，可以通过如下两种方式获取
            //      * 1. 通过引入对象获取: `import {mavonEditor} from ...` 等方式引入后，`$vm`为`mavonEditor`
            //      * 2. 通过$refs获取: html声明ref : `<mavon-editor ref=md ></mavon-editor>，`$vm`为 `this.$refs.md`

            //     $vm.$img2Url(pos, url);
            // });
            axios({
                url: '/upload/image/article-thumbnail',
                method: 'post',
                data: formData,
                headers: { 'Content-Type': 'multipart/form-data' },
            }).then((response) => {
                let {data} = response.data;
                 // 第二步.将返回的url替换到文本原位置![...](./0) -> ![...](url)
                 // $vm 指为mavonEditor实例，可以通过如下两种方式获取
                 // 1. 通过引入对象获取: `import {mavonEditor} from ...` 等方式引入后，`$vm`为`mavonEditor`
                 // 2. 通过$refs获取: html声明ref : `<mavon-editor ref=md ></mavon-editor>，`$vm`为 `this.$refs.md`
                 this.$refs.maEdit.$img2Url(pos, data.url);
            });
        },
        clearThumbnail() {
            this.formData.thumbnail = '';
        },
        uploadProgress(event, file, fileList) {

        },
        uploadSuccess(response, file, fileList) {
            this.formData.thumbnail = response.data.url;
            this.$refs.upload.clearFiles();
        },
        uploadRemove(file, fileList) {
            this.formData.thumbnail = '';
        },
        uploadFormatError(file, fileList) {
            this.$Message.error('文件格式不符，请上传正确的图片');
        },
        uploadExceedSize(file, fileList) {
            this.$Message.error('文件大小超出' + this.uploadConfig.maxSize + 'KB，请重新上传');
        },
        changeReprinted(status) {
            // this.formData.reprinted = !false;
        }
    }
}