export default {
  data() {
    return {
      search: {
        title: {
          'value': '',
          'type': 'like'
        },
        author: {
          'value': '',
          'type': 'like'
        },
        category_menu_id: {
          'value': '',
          'type': '='
        },
        status: {
          'value': [10, 20],
          'type': 'in',
        },
      },
      options: {},
      statusColorConfig: {
        '0': '#FF7F00',
        '10': '#698B22',
        '20': '#2d8cf0',
        '30': '#ed3f14',
      },
      columns: [{
        type: 'selection',
        width: 60,
        align: 'center'
      }, {
        title: '标题',
        key: 'title',
      }, {
        title: '类别',
        key: 'category_menu_id',
        render: (h, params) => {
          let result = '';
          for (let i in this.options.categoryMenus) {
            if (this.options.categoryMenus[i]['id'] == params.row.category_menu_id) {
              result = this.options.categoryMenus[i]['name'];
              break;
            }
          }
          return h('div', [
            h('span', {}, result),
          ]);
        }
      }, {
        title: '作者',
        key: 'author'
      }, {
        title: '创建时间',
        key: 'created_at',
        render: (h, params) => {
          let time = Vue.parseTime(params.row.created_at, '{y}-{m}-{d}');
          return h('div', [
            h('span', {}, time),
          ]);
        }
      }, {
        title: '状态',
        key: 'status',
        width: 80,
        render: (h, params) => {
          let result = '';
          for (let i in this.options.article_status) {
            if (this.options.article_status[i]['value'] == params.row.status) {
              result = this.options.article_status[i]['text'];
              break;
            }
          }
          return h('div', [
            h('span', {
              style: {
                color: this.statusColorConfig[params.row.status]
              }
            }, result),
          ]);
        }
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
                  this.$router.push({ path: '/article/detail/' + params.row.id });
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
                  this.$router.push({ path: '/article/edit/' + params.row.id });
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
      axios.get('/backend/article', { params: paramsData }).then((response) => {
        let { data, message } = response.data;
        _this.data = data.lists;
        _this.options = data.options;
        _this.pagination.total = data.total;
      })
    },
    lists() {
      let _this = this;
      let paramsData = {
        'search': Vue.parseSearch(_this.search),
        'pagination': _this.pagination
      };
      axios.get('/backend/article/lists', { params: paramsData }).then((response) => {
        let { data, message } = response.data;
        _this.data = data.lists;
        _this.pagination.total = data.total;
      });
    },
    delete(id) {
      let _this = this;
      _this.$Modal.confirm({
        title: '删除操作',
        content: '<p>确定要将这篇文章加入回收站吗？</p>',
        onOk: () => {
          axios.post('/backend/article/recycle/' + id).then(response => {
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
        content: '<p>确定要将这些文章加入回收站吗？</p>',
        onOk: () => {
          axios.post('/backend/article/recycle/' + _this.selectIds).then(response => {
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
    }
  }
}