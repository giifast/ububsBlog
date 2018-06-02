// 引入 ECharts 主模块
const echarts = require('echarts/lib/echarts');
// 引入柱状图
require('echarts/lib/chart/line');
// 引入提示框和标题组件
require('echarts/lib/component/tooltip');
require('echarts/lib/component/title');
export default {
    data() {
        return {
            userId: this.$route.params.id,
            userData: {},
            readData: {},
            activeData: {},
            onlineData: {},
            options: {
                status: [{
                    'text': '禁用',
                    'value': 0
                }, {
                    'text': '正常',
                    'value': 1
                }],
                gender: []
            },
        };
    },
    mounted() {
        this.initDetail();
        this.initEChart();
    },
    methods: {
        initDetail() {
            this.getUserDetail();
            this.getReadHistory();
            this.getActiveHistory();
            this.getOnlineHistory();
        },
        getUserDetail() {
            let _this = this;
            axios.get('/backend/user/detail/' + _this.userId).then((response) => {
                let { data } = response.data;
                _this.userData = data.list;
                _this.options.gender = data.options.gender;
            });
        },
        getReadHistory() {
            let _this = this;
            axios.get('/backend/user/read/' + _this.userId).then((response) => {
                let { data } = response.data;
                _this.readData = data.list;
            });
        },
        getActiveHistory() {
            let _this = this;
            axios.get('/backend/user/active/' + _this.userId).then((response) => {
                let { data } = response.data;
                _this.activeData = data.list;
            });
        },
        getOnlineHistory() {
            let _this = this;
            axios.get('/backend/user/online/' + _this.userId).then((response) => {
                let { data } = response.data;
                _this.onlineData = data.list;
            });
        },
        initEChart() {
            let myChart = echarts.init(document.getElementById('main'));
            myChart.setOption({
                color: ['#3398DB'],
                title: {
                    text: '在线时间统计'
                },
                tooltip: {
                    trigger: 'axis'
                },
                xAxis: {
                    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                    data: [820, 932, 901, 934, 1290, 1330, 1320],
                    type: 'line'
                }]
            });
        }
    }
}