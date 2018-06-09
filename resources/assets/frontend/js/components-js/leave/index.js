export default {
    data() {
        return {
            pagination: {
                currentPage: 1,
                pageSize: 20,
            },
        	data: [],
            formData: {
                content: '',
                mail: ''
            },
            // toolbars: {
            //     bold: true, // 粗体
            //     italic: true, // 斜体
            //     underline: true, // 下划线
            //     strikethrough: true, // 中划线
            //     mark: true, // 标记
            //     superscript: true, // 上角标
            //     subscript: true, // 下角标
            //     quote: true, // 引用
            //     ol: true, // 有序列表
            //     ul: true, // 无序列表
            //     link: true, // 链接
            //     fullscreen: true, // 全屏编辑
            //     readmodel: true, // 沉浸式阅读
            //     undo: true, // 上一步
            //     redo: true, // 下一步
            //     trash: true, // 清空
            //     save: true, // 保存（触发events中的save事件）
            //     preview: true, // 预览
            // },
            hasMore: true
        };
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
                'pagination': _this.pagination
            };
            axios.get('/leaves', {params: paramsData}).then((response) => {
                let { data, message } = response.data;
                if (Object.keys(data.lists).length === 0) {
                    _this.hasMore = false;
                }
                _this.data.push(data.lists);console.log(_this.data);
            })
        },
        loadMore() {
            this.pagination.currentPage++;
            this.lists();
        },
        save() {
            let _this = this;
            axios.post('/leave', _this.formData).then((response) => {
                let { message } = response.data;
                _this.formData = {
                    content: '',
                    mail: ''
                };
            });
        }
    }
}