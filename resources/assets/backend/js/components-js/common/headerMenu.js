export default {
    data() {
        return {};
    },
    computed: {
        rotateIcon() {
            return [
                'menu-icon',
                this.isCollapsed ? 'rotate-icon' : ''
            ];
        },
    },
    mounted() {},
    methods: {
        toggleCollapse() {
            this.$emit('toggleCollapse');
        },
        logout() {
            let _this = this;
            axios.post('/backend/logout').then((response) => {
                let { message } = response.data;
                localStorage.removeItem("admin_data");
                _this.$store.commit('setStateValue', { 'admin_data': {} });
                _this.$Message.success(message);
                _this.$router.push({ path: '/login' });
            });
        }
    }
}