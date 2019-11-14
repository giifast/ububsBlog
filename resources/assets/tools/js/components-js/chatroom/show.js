export default {
  data() {
    return {
      id: this.$route.params.id,
      ws: null,
      timeout: 10000,
      content: '',
      loading: true,
      send_loading: false,
      lists: [],
      lockReconnect: false, //是否真正建立连接
      timeoutObj: null, //心跳心跳倒计时
      serverTimeoutObj: null, //心跳倒计时
      timeoutnum: null, //断开 重连倒计时
      pagination: {
        currentPage: 1,
        pageSize: 20,
      },
      search: {
        id: {
          'value': '',
          'type': '<'
        },
      }
    }
  },
  beforeMount() {
    let _this = this;
    _this.chatroom();
    _this.chatLists();
    if ('WebSocket' in window) {
      _this.websocketInit();
    } else {
      _this.$Message.error('当前浏览器不支持websocket');
    }
  },
  mounted() {
    let _this = this;
  },
  watch: {
    '$route'(to, from) {
      let _this = this;
      _this.id = to.params.id;
      _this.lists = [];
      _this.search.id['value'] = '';
      _this.ws.close();
      _this.chatroom();
      _this.chatLists();
      if ('WebSocket' in window) {
        _this.websocketInit();
      } else {
        _this.$Message.error('当前浏览器不支持websocket');
      }
    }
  },
  methods: {
    chatroom: function() {
      let _this = this;
      axios.get('/tools/chatroom/' + _this.id).then((response) => {}).catch((error) => {
        _this.$Message.error(error);
        _this.$router.push({ path: '/404' });
      });
    },
    chatLists: function() {
      let _this = this;
      let paramsData = {
        'pagination': _this.pagination,
        'search': Vue.parseSearch(_this.search)
      };
      axios.get('/tools/chatroom/chats/' + _this.id, { params: paramsData }).then((response) => {
        let { data, message } = response.data;
        for (let i = 0; i < Object.keys(data.lists).length; i++) {
          _this.lists.unshift(data.lists[i]);
        }
        if (_this.search.id.value == '' && Object.keys(_this.lists).length > 0) {
          _this.search.id['value'] = _this.lists[0]['id'];
          _this.scrollBottom();
        }
        _this.loading = false;
      });
    },
    websocketInit: function() {
      let _this = this;
      _this.ws = new WebSocket('ws://0.0.0.0:9501/' + _this.id);
      _this.ws.onopen = _this.onOpen;
      _this.ws.onmessage = _this.onMessage;
      _this.ws.onerror = _this.onError;
      _this.ws.onclose = _this.onClose;
    },
    reconnectWebsocket() {
      var _this = this;
      if (_this.lockReconnect) {
        return;
      };
      _this.lockReconnect = true;
      //没连接上会一直重连，设置延迟避免请求过多
      _this.timeoutnum && clearTimeout(_this.timeoutnum);
      _this.timeoutnum = setTimeout(function() {
        //新连接
        _this.websocketInit();
        _this.lockReconnect = false;
      }, 5000);
    },
    resetWebsocketCheck() {
      //重置心跳
      var _this = this;
      //清除时间
      clearTimeout(_this.timeoutObj);
      clearTimeout(_this.serverTimeoutObj);
      //重启心跳
      _this.websocketCheck();
    },
    websocketCheck() {
      var _this = this;
      _this.timeoutObj && clearTimeout(_this.timeoutObj);
      _this.serverTimeoutObj && clearTimeout(_this.serverTimeoutObj);
      _this.timeoutObj = setTimeout(function() {
        if (_this.ws.readyState == 1) {
          console.log('heartCheck');
          _this.ws.send("heartCheck");
        } else {
          _this.reconnectWebsocket();
        }
        _this.serverTimeoutObj = setTimeout(function() {
          _this.ws.close();
        }, _this.timeout);

      }, _this.timeout)
    },
    onOpen: function(evt) {
      let _this = this;
      if (_this.ws.readyState == 1) {
        console.log('WebSocket 连接成功...');
      } else {
        _this.$Message.error('WebSocket 连接失败...');
        console.log('WebSocket 连接失败...');
      }
      _this.websocketCheck();
    },
    onMessage: function(evt) {
      let _this = this;
      let data = evt.data;
      if (data instanceof Blob) {
        let reader = new FileReader();
        reader.readAsText(data, "UTF-8");
        reader.onload = function(e) {
          try {
            let datas = JSON.parse(reader.result);
            if (datas.login) {
              _this.$Message.success('有新用户加入群聊');
              return false;
            }
            if (!datas.fd) {
              return false;
            }
            _this.lists.push({
              'ip': datas.ip,
              'content': datas.msg
            });
            _this.scrollBottom();
          } catch (error) {
            return false;
          }
        };
      } else {
        try {
          let datas = JSON.parse(data);
          if (!datas.fd) {
            return false;
          }
          _this.lists.push({
            'ip': datas.ip,
            'content': datas.msg
          });
        } catch (e) {
          return false;
        }
      }
      _this.resetWebsocketCheck();
    },
    onError: function(evt) {
      let _this = this;
      console.log("WebSocket连接发生错误");
      _this.reconnectWebsocket();
    },
    onClose: function(evt) {
      let _this = this;
      console.log('连接断开');
      _this.reconnectWebsocket();
    },
    send: function() {
      let _this = this;
      if (!_this.content) {
        _this.$Message.error('请填写发送消息内容');
        return false;
      }
      if (_this.ws.readyState != 1) {
        _this.$Message.error('连接已经断开');
        return false;
      }
      _this.send_loading = true;
      _this.ws.send(_this.content);
      _this.lists.push({
        'ip': '我',
        'content': _this.content,
        'created_at': parseInt(new Date().getTime() / 1000),
        'isme': true
      });
      _this.content = '';
      _this.scrollBottom();
      _this.send_loading = false;
    },
    scrollBottom: function() {
      this.$nextTick(function() {
        let oj = document.getElementsByClassName('ivu-scroll-container');
        oj[0].scrollTop = oj[0].scrollHeight;
      })
    },
    handleReachTop() {
      let _this = this;
      return new Promise(resolve => {
        _this.pagination.currentPage++;
        _this.chatLists();
        resolve();
      });
    },
    generateAvatar: function(str) {
      var sum = 0;
      for (var i = 0; i < str.length; i++) {
        sum += str.charCodeAt(i);
      }
      return (sum % 10) + 1;
    }
  }
}