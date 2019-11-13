export default {
  data() {
    return {
      data: []
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
      axios.get('/articles').then((response) => {
        let { data, message } = response.data;
        _this.data = data.lists;
      })
    }
  }
}