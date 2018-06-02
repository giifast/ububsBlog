export default {
    data() {
        // 特殊验证
        const checkRepassword = (rule, value, callback) => {
            if (value !== this.formData.password) {
                callback(new Error('两次密码输入不一致'));
            } else {
                callback();
            }
        };
        return {
            pwText: '',
            options: {
                status: [{
                    'text': '禁用',
                    'value': 0
                }, {
                    'text': '正常',
                    'value': 1
                }],
                roles: []
            },
            formData: {
                username: '',
                password: '',
                status: '',
                gender: '',
                mail: ''
            },
            rules: {
                username: [
                    { required: true, message: '用户名不得为空', trigger: 'blur' }
                ],
                mail: [
                    { required: true, message: '邮箱地址不得为空', trigger: 'blur' },
                    { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur' }
                ],
                repassword: [
                    { validator: checkRepassword, trigger: 'blur' }
                ],
            },
            passwordRules: [
                { required: true, message: '密码不得为空', trigger: 'blur' }
            ],
        }
    },
    methods: {
        handleView(name) {
            this.imgName = name;
            this.visible = true;
        },
        handleRemove(file) {
            const fileList = this.$refs.upload.fileList;
            this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
        },
        handleSuccess(res, file) {
            file.url = 'https://o5wwk8baw.qnssl.com/7eb99afb9d5f317c912f08b5212fd69a/avatar';
            file.name = '7eb99afb9d5f317c912f08b5212fd69a';
        },
        handleFormatError(file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
            });
        },
        handleMaxSize(file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit',
                desc: 'File  ' + file.name + ' is too large, no more than 2M.'
            });
        },
        handleBeforeUpload() {
            const check = this.uploadList.length < 5;
            if (!check) {
                this.$Notice.warning({
                    title: 'Up to five pictures can be uploaded.'
                });
            }
            return check;
        }
    }
}