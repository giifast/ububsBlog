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
    join(name) {
      let _this = this;
      if (typeof name != 'string') {
        name = _this.name;
      }
      for (let i in _this.rooms) {
        if (_this.rooms[i]['name'] == name) {
          if (_this.rooms[i]['id'] == -1) {
            axios.post('/tools/chatroom', { 'name': name }).then((response) => {
              let { data, message } = response.data;
              _this.$Message.success('房间创建成功');
              _this.$router.push({ path: '/chatroom/show/' + data.list['id'] });
            });
          } else {
            _this.$router.push({ path: '/chatroom/show/' + _this.rooms[i]['id'] });
          }
          break;
        }
      }
    },
    filterSearch(value, option) {
      return option.toUpperCase().indexOf(value.toUpperCase()) !== -1;
    }
  },
}