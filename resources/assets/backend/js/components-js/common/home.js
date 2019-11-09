// 引入 ECharts 主模块
const echarts = require('echarts/lib/echarts');
// 引入柱状图
require('echarts/lib/chart/bar');
// 引入折线图
require('echarts/lib/chart/line');
// 引入提示框和标题组件
require('echarts/lib/component/tooltip');
require('echarts/lib/component/title');
import InforCard from '../../components/widget/inforCard.vue';
export default {
    components: {
        InforCard,
    },
    data() {
        return {
            adminId: this.$store.state.adminData.id,
            adminData: {},
            readData: {},
            activeData: {},
            onlineData: {},
            newRegister: {
                number: 0
            }
        };
    },
    mounted() {
        let _this = this;
        this.initDetail();
        this.initOnlineEChart();
        setInterval(function () {
            _this.newRegister.number += Math.ceil(Math.random() * 10);
        }, 1000);
    },
    methods: {
        initDetail() {
            this.getAdminInfo();
            this.getReadHistory();
            this.getActiveHistory();
            this.getOnlineHistory();
        },
        getAdminInfo() {
            let _this = this;
            axios.get('/backend/admin/' + _this.adminId).then((response) => {
                let { data } = response.data;
                _this.adminData = data.list;
            });
        },
        getReadHistory() {
            let _this = this;
            axios.get('/backend/user/read').then((response) => {
                let { data } = response.data;
                _this.readData = data.list;
            });
        },
        getActiveHistory() {
            let _this = this;
            axios.get('/backend/user/active').then((response) => {
                let { data } = response.data;
                _this.activeData = data.list;
            });
        },
        getOnlineHistory() {
            let _this = this;
            axios.get('/backend/user/online').then((response) => {
                let { data } = response.data;
                _this.onlineData = data.list;
            });
        },
        initOnlineEChart() {
            let myChart = echarts.init(document.getElementById('onlineChart'));
            myChart.setOption({
                color: ['#3398DB'],
                tooltip: {
                    trigger: 'axis',
                    axisPointer: { // 坐标轴指示器，坐标轴触发有效
                        type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [{
                    type: 'category',
                    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    axisTick: {
                        alignWithLabel: true
                    }
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                    name: '直接访问',
                    type: 'bar',
                    barWidth: '60%',
                    data: [10, 52, 200, 334, 390, 330, 220]
                }]
            });
        }
    }
}