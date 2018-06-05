export default {
    data() {
        return {
            pagination: {
                currentPage: 1,
                pageSize: 20,
            },
        	data: [],
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
            axios.get('/articles', {params: paramsData}).then((response) => {
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
        }
    }
}