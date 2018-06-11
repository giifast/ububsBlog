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
            id: this.$route.params.id,
            pwText: '',
            options: {
                status: [{
                    'text': '禁用',
                    'value': '0'
                }, {
                    'text': '正常',
                    'value': '1'
                }],
                roles: []
            },
            formData: {
                account: '',
                password: '',
                status: '',
                role_id: '',
                mail: ''
            },
            rules: {
                account: [
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
    mounted() {
        this.initForm();
    },
    methods: {
        initForm() {
            let _this = this;
            axios.get('/backend/role/lists').then((response) => {
                let { data } = response.data;
                _this.options.roles = data.lists;
                if (_this.id) {
                    axios.get('/backend/admin/' + _this.id).then((response) => {
                        let { data } = response.data;
                        _this.formData = data.list;
                    });
                }
            });
            
        },
        submitBase(name) {
            let _this = this;
            _this.$refs[name].validate((valid) => {
                if (valid) {
                    let method = !_this.id ? 'post' : 'put';
                    let url = !_this.id ? '/backend/admin' : '/backend/admin/' + _this.id;
                    axios[method](url, _this.formData).then((response) => {
                        let { message } = response.data;
                        _this.$Message.success(message);
                        _this.$router.push('/admin/lists');
                    });
                }
            })
        }
    }
}