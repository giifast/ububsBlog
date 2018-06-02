export default {
    data() {
        return {
            isCollapsed: false,
            showCo: false,
            iconColor: 'white',
        };
    },
    computed: {
        menuitemClasses() {
            return [
                'menu-item',
                this.isCollapsed ? 'collapsed-menu' : ''
            ]
        }
    },
    mounted() {},
    methods: {
        toggleCollapse() {
            this.showCo = !this.showCo;
            this.$refs.side.toggleCollapse();
        }
    }
}