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
                _this.data.push(data.lists);
            })
        },
        loadMore() {
            this.pagination.currentPage++;
            this.lists();
        },
        save() {
            let _this = this;
            axios.post('/leave', _this.formData).then((response) => {
                let { data, message } = response.data;
                _this.data.unshift([data.data]);
                _this.formData = {
                    content: '',
                    mail: ''
                };
            });
        }
    }
}