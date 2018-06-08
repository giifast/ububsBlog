export default {
    data() {
        return {
            search: {
                created_at: {
                    'value': [],
                    'type': 'between'
                }
            },
            columns: [{
                type: 'selection',
                width: 60,
                align: 'center'
            }, {
                title: '文件名',
                key: 'title',
            }, {
                title: '文件路径',
                key: 'path',
            }, {
                title: '导出时间',
                key: 'created_at',
                render: (h, params) => {
                    let time = Vue.parseTime(params.row.created_at, '{y}-{m}-{d}');
                    return h('div', [
                        h('span', {}, time),
                    ]);
                }
            }, {
                title: '导出用户',
                key: 'admin_id',
                width: 80
            }, {
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
                                    this.download(params.row.id);
                                }
                            }
                        }, '下载'),
                        h('Button', {
                            props: {
                                type: 'error',
                                size: 'small'
                            },
                            on: {
                                click: () => {
                                    this.delete(params.row.id)
                                }
                            }
                        }, '删除')
                    ]);
                }
            }],
            data: [],
            selectIds: '',
            pagination: {
                total: 0,
                currentPage: 1,
                pageSize: 20,
                sizeOptions: [20, 50, 100]
            },
        };
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
            axios.get('/backend/website/dump', { params: paramsData }).then((response) => {
                let { data, message } = response.data;
                _this.data = data.lists;
                _this.pagination.total = data.total;
            })
        },
        lists() {
            let _this = this;
            let search = Vue.deepCopy(_this.search);
            search.created_at.value = [
                Vue.parseTimeStamp(_this.search.created_at.value[0]),
                Vue.parseTimeStamp(_this.search.created_at.value[1])
            ];
            let paramsData = {
                'search': Vue.parseSearch(search),
                'pagination': _this.pagination
            };
            axios.get('/backend/website/dump/lists', { params: paramsData }).then((response) => {
                let { data, message } = response.data;
                _this.data = data.lists;
                _this.pagination.total = data.total;
            });
        },
        delete(id) {
            let _this = this;
            _this.$Modal.confirm({
                title: '删除操作',
                content: '<p>确定要将这个备份文件删除吗？</p>',
                onOk: () => {
                    axios.delete('/backend/website/dump/' + id).then(response => {
                        let { message } = response.data;
                        _this.$Message.info(message);
                        _this.lists();
                    });
                }
            });
        },
        batchDelete() {
            if (!this.selectIds) {
                this.$Message.error('请勾选需要处理的数据');
                return false;
            }
            this.delete(this.selectIds);
        },
        download(id) {
            axios.get('/download/key/website-dump/' + id).then((response) => {
                let { data } = response.data;
                window.open("/download?key=" + data.data);  
            })
        },
        selectChange(selection) {
            let selectIds = [];
            selection.forEach(response => {
                selectIds.push(response.id);
            });
            this.selectIds = selectIds.join(',');
        },
        currentPageChange: function(currentPage) {
            this.pagination.currentPage = currentPage;
            this.lists();
        },
        pageSizeChange: function(pageSize) {
            this.pagination.pageSize = pageSize;
            this.lists();
        }
    }
}