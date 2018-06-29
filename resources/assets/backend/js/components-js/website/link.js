export default {
    data() {
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
                    'value': '',
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
                }]
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
                                        this.$router.push({ path: '/admin/detail/' + params.row.id });
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
                                        this.$router.push({ path: '/admin/edit/' + params.row.id });
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
            pagination: {
                total: 0,
                currentPage: 1,
                pageSize: 20,
                sizeOptions: [20, 50, 100]
            }
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
            axios.get('/backend/admin', { params: paramsData }).then((response) => {
                let { data, message } = response.data;
                _this.data = data.lists;
                _this.pagination.total = data.total;
            })
        },
        lists() {
            let _this = this;
            let paramsData = {
                'search': Vue.parseSearch(_this.search),
                'pagination': _this.pagination
            };
            axios.get('/backend/admin/lists', { params: paramsData }).then((response) => {
                let { data, message } = response.data;
                _this.data = data.lists;
                _this.pagination.total = data.total;
            });
        },
        delete(index) {
            let _this = this;
            _this.$Modal.confirm({
                title: '删除操作',
                content: '<p>确定要删除这个管理员吗？</p>',
                onOk: () => {
                    axios.delete('/backend/admin/' + _this.data[index].id).then(response => {
                        let { message } = response.data;
                        _this.$Message.info(message);
                        _this.lists();
                    });
                }
            });
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
                content: '<p>确定要删除这些管理员？</p>',
                onOk: () => {
                    axios.delete('/backend/admin/' + _this.selectIds).then(response => {
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
        reset() {
            Vue.resetSearch(this.search);
            this.lists();
        }
    }
}