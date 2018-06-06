import { mavonEditor } from 'mavon-editor';
import 'mavon-editor/dist/css/index.css';
export default {
    components: {
        MavonEditor: mavonEditor
    },
    data() {
        return {
            description: '',
            formData: {
                title: '',
                thumbnail: '',
                description: []
            },
            uploadConfig: {
                type: 'drag',
                maxSize: 100,
                accept: 'image/*',
                format: ['jpg','jpeg','png'],
                defaultFile: [],
                action: "/upload/image/website-thumbnail"
            },
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
            axios.get('/backend/website/setting').then((response) => {
                let { data } = response.data;
                data.list['description'] = data.list['description'].split(',');
                _this.formData = data.list;
            });
        },
        save: function(name) {
            let _this = this;
            _this.$refs[name].validate((valid) => {
                if (valid) {
                    axios.put('/backend/website/setting', _this.formData).then((response) => {
                        let { message } = response.data;
                        _this.$Message.success(message);
                    });
                }
            })
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
                url: '/upload/image/website-about',
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
        changeStatus(status) {
            this.$Message.info('开关状态：' + status);
        },
        addDescription () {
            if (this.description === '') {
                this.$Message.error('关键字不得为空');
                return false;
            }
            this.formData.description.push(this.description);
            this.description = '';
        },
        deleteDescription (event, name) {
            const index = this.formData.description.indexOf(name);
            this.formData.description.splice(index, 1);
        }
    }
}