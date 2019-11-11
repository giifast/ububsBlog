import { create } from "domain";

export default {
    data() {
        return {
            name: '',
            rooms: [],
        }
    },
    methods: {
        search(name) {
            let _this = this;
            if (!name || name.length < 2) {
                _this.rooms = [];
                return;
            } else {
                let params = {
                    'search': Vue.parseSearch({
                        name: {
                            'value': name,
                            'type': 'like'
                        },
                    }),
                };
                axios.get('/tools/chatrooms', { 'params': params }).then((response) => {
                    let { data, message } = response.data;
                    if (data.lists.length == 0) {
                        data.lists = [{
                            'id': -1,
                            'name': _this.name,
                        }];
                    }
                    _this.rooms = data.lists;
                });
            }
        },
        join() {
            let _this = this;
            for (let i in this.rooms) {
                if (this.rooms[i]['name'] == this.name) {
                    if (this.rooms[i]['id'] == -1) {
                        axios.post('/tools/chatroom', { 'name': _this.name }).then((response) => {
                            let { data, message } = response.data;
                            _this.$Message.success(message);
                            _this.$router.push({ path: '/tools/chatroom/' + data.list.id });
                        });
                    }
                    _this.$router.push({ path: '/tools/chatroom/' + this.rooms[i]['id'] });
                    break;
                }
            }
        },
        filterSearch(value, option) {
            return option.toUpperCase().indexOf(value.toUpperCase()) !== -1;
        }
    },
}