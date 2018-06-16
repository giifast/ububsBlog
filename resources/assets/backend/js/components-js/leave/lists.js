export default {
    data() {
        return {
            search: {
                ip_address: {
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
                    'text': '隐藏',
                    'value': 0
                }, {
                    'text': '显示',
                    'value': 1
                }]
            },
            columns: [{
                    type: 'selection',
                    width: 60,
                    align: 'center'
                },
                {
                    title: '邮箱',
                    key: 'mail'
                },
                {
                    title: '内容',
                    key: 'content'
                }, {
                    title: 'ip地址',
                    key: 'ip_address',
                }, {
                    title: '网友地址',
                    key: 'address',
                },
                {
                    title: '留言时间',
                    key: 'created_at',
                    render: (h, params) => {
                        return h('span', {}, Vue.parseTime(params.row.created_at));
                    }
                },
                {
                    title: '状态',
                    key: 'status',
                    width: 80,
                    render: (h, params) => {
                        return h('i-switch', {  
                          props: {  
                              value: !!parseInt(params.row.status),   
                              disabled: false     
                              },
                              on: {
                                'on-change': () => { 
                                    this.changeStatus(params.row.id, parseInt(params.row.status));
                                }
                              }
                        })
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
                                        this.$router.push({ path: '/leave/detail' + params.row.id });
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
                                        axios.get('/backend/leave/' + params.row.id).then((response) => {
                                            let { data } = response.data;
                                            _this.fromData = data.list;
                                            _this.fromData.status = parseInt(_this.fromData.status);
                                        });
                                    }
                                }
                            }, '回复')
                        ]);
                    }
                }
            ],
            data: [],
            selectIds: '',
            loading: true,
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
                id: '',
                content: ''
            },
            rules: {
                content: [
                    { required: true, message: '回复内容不得为空', trigger: 'blur' }
                ]
            }
        }
    },
    mounted() {
        this.initIndex();
    },
    methods: {
        initIndex() {
            this.lists();
        },
        lists() {
            let _this = this;
            let paramsData = {
                'search': Vue.parseSearch(_this.search),
                'pagination': _this.pagination
            };
            axios.get('/backend/leave/lists', { params: paramsData }).then((response) => {
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
                    axios.delete('/backend/leave/' + _this.data[index].id).then(response => {
                        let { message } = response.data;
                        _this.$Message.info(message);
                        _this.lists();
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
                content: '<p>确定要删除这些留言？</p>',
                onOk: () => {
                    axios.delete('/backend/leave/' + _this.selectIds).then(response => {
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
        save: function(name) {
        },
        cancel: function(name) {
            this.$refs[name].resetFields();
        },
        changeStatus: function(id, status) {
            let _this = this;
            axios.put('/backend/leave/' + id, {'status': !status}).then(response => {
                let { message } = response.data;
                _this.$Message.info(message);
            })
        }
    }
}