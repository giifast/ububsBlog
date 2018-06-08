export default {
    data() {
        // 特殊验证
        const checkRepassword = (rule, value, callback) => {
            if (value !== this.fromData.password) {
                callback(new Error('两次密码输入不一致'));
            } else {
                callback();
            }
        };
        return {
            search: {
                account: {
                    'value': '',
                    'type': 'like'
                },
                mail: {
                    'value': '',
                    'type': 'like'
                },
                status: {
                    'value': 0,
                    'type': '='
                },
            },
            options: {
                status: [{
                    'text': '禁用',
                    'value': 0
                }, {
                    'text': '正常',
                    'value': 1
                }],
                gender: []
            },
            columns: [{
                    type: 'selection',
                    width: 60,
                    align: 'center'
                }, {
                    title: '帐号',
                    key: 'account',
                },
                {
                    title: '邮箱',
                    key: 'mail'
                },
                {
                    title: '最后登录ip',
                    key: 'last_login_ip',
                    render: (h, params) => {
                        if (params.row.last_login_ip === '') {
                            return '未登录';
                        }
                        return params.row.last_login_ip;
                    }
                },
                {
                    title: '最后登录时间',
                    key: 'last_login_time',
                    render: (h, params) => {
                        if (!params.row.last_login_time) {
                            return '未登录';
                        }
                        return Vue.parseTime(params.row.last_login_time);
                    }
                },
                {
                    title: '状态',
                    key: 'status',
                    width: 80,
                    render: (h, params) => {
                        return h('span', {
                            style: {
                                color: params.row.status == '1' ? '#19be6b' : '#ed3f14'
                            },
                        }, params.row.status == '1' ? '正常' : '已禁用');
                    }
                },
                {
                    title: '操作',
                    key: 'action',
                    align: 'center',
                    render: (h, params) => {
                        return h('div', [
                            h('Button', {
                                props: {
                                    type: 'info',
                                    size: 'small'
                                },
                                style: {
                                    marginRight: '5px'
                                },
                                on: {
                                    click: () => {
                                        this.$router.push({ path: '/user/detail/' + params.row.id });
                                    }
                                }
                            }, '详情'),
                            h('Button', {
                                props: {
                                    type: 'warning',
                                    size: 'small'
                                },
                                style: {
                                    marginRight: '5px'
                                },
                                on: {
                                    click: () => {
                                        let _this = this;
                                        _this.pwText = '为空表示不修改';
                                        _this.modal.title = '编辑';
                                        delete _this.rules.password;
                                        _this.modal.show = true;
                                        axios.get('/backend/user/' + params.row.id).then((response) => {
                                            let { data } = response.data;
                                            _this.fromData = data.list;
                                            _this.fromData.status = parseInt(_this.fromData.status);
                                        });
                                    }
                                }
                            }, '编辑'),
                            h('Button', {
                                props: {
                                    type: 'error',
                                    size: 'small'
                                },
                                on: {
                                    click: () => {
                                        this.delete(params.index)
                                    }
                                }
                            }, '删除')
                        ]);
                    }
                }
            ],
            data: [],
            selectIds: '',
            loading: true,
            pwText: '',
            pagination: {
                total: 0,
                currentPage: 1,
                pageSize: 20,
                sizeOptions: [20, 50, 100]
            },
            modal: {
                show: false,
                title: ''
            },
            fromData: {
                account: '',
                password: '',
                status: '',
                gender: '',
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
        this.initIndex();
    },
    methods: {
        initIndex() {
            let _this = this;
            let paramsData = {
                'search': Vue.parseSearch(_this.search),
                'pagination': _this.pagination
            };
            axios.get('/backend/user', { params: paramsData }).then((response) => {
                let { data, message } = response.data;
                _this.data = data.lists;
                _this.options.gender = data.options.gender;
                _this.pagination.total = data.total;
            })
        },
        lists() {
            let _this = this;
            let paramsData = {
                'search': Vue.parseSearch(_this.search),
                'pagination': _this.pagination
            };
            axios.get('/backend/user/lists', { params: paramsData }).then((response) => {
                let { data, message } = response.data;
                _this.data = data.lists;
                _this.pagination.total = data.total;
            });
        },
        delete(index) {
            let _this = this;
            _this.$Modal.confirm({
                title: '删除操作',
                content: '<p>确定要删除这个用户吗？</p>',
                onOk: () => {
                    axios.delete('/backend/user/' + _this.data[index].id).then(response => {
                        let { message } = response.data;
                        _this.$Message.info(message);
                        _this.lists();
                        // _this.data.splice(index, 1);
                        // _this.pagination.total--;
                    });
                }
            });
        },
        reset() {
            Vue.resetSearch(this.search);
            this.lists();
        },
        selectChange(selection) {
            let selectIds = [];
            selection.forEach(response => {
                selectIds.push(response.id);
            });
            this.selectIds = selectIds.join(',');
        },
        batchDelete() {
            let _this = this;
            if (!_this.selectIds) {
                this.$Message.error('请勾选需要处理的数据');
                return false;
            }
            _this.$Modal.confirm({
                title: '删除操作',
                content: '<p>确定要删除这些用户？</p>',
                onOk: () => {
                    axios.delete('/backend/user/' + _this.selectIds).then(response => {
                        let { message } = response.data;
                        _this.$Message.info(message);
                        _this.lists();
                    });
                }
            });
        },
        currentPageChange: function(currentPage) {
            this.pagination.currentPage = currentPage;
            this.lists();
        },
        pageSizeChange: function(pageSize) {
            this.pagination.pageSize = pageSize;
            this.lists();
        },
        store() {
            this.pwText = '请输入密码';
            this.modal.title = '新增';
            this.fromData = {};
            if (!this.rules.password) {
                this.rules.password = this.passwordRules;
            }
            this.modal.show = true;
        },
        save: function(name) {
            let _this = this;
            _this.$refs[name].validate((valid) => {
                if (valid) {
                    let saveData = {
                        'account': _this.fromData.account,
                        'mail': _this.fromData.mail,
                        'gender': _this.fromData.gender,
                        'status': _this.fromData.status,
                    };
                    if (_this.fromData.password || !_this.fromData.id) {
                        saveData.password = _this.fromData.password;
                    }
                    let method = !_this.fromData.id ? 'post' : 'put';
                    let url = !_this.fromData.id ? '/backend/user' : '/backend/user/' + _this.fromData.id;
                    axios[method](url, saveData).then((response) => {
                        let { message } = response.data;
                        _this.$Message.success(message);
                        _this.modal.show = false;
                        _this.lists();
                        _this.$store.commit('setStateValue', { 'loading': false });
                    }).catch((error) => {
                        _this.loading = false;
                        _this.$nextTick(() => { _this.loading = true; });
                    });
                } else {
                    _this.loading = false;
                    _this.$nextTick(() => { _this.loading = true; });
                }
            })
        },
        cancel: function(name) {
            this.$refs[name].resetFields();
        }
    }
}