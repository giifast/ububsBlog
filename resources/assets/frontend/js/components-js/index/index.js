export default {
    data() {
        return {
        	lists: []
        };
    },
    mounted() {
    	this.initIndex();
    },
    methods: {
    	initIndex() {
    		let _this = this;
            axios.get('/articles').then((response) => {
                let { data, message } = response.data;
                _this.lists = data.lists;
                // for (let i = Object.keys(data.lists).length - 1; i >= 0; i--) {
                // 	if (!result[data.lists[i]['create_time']]) {
                // 		result[data.lists[i]['create_time']] = [];
                // 	}
                // 	result[data.lists[i]['create_time']].push(data.lists[i]);
                // }console.log(result);
                // _this.lists = result;
            })
    	}
    }
}