import HeaderMenu from '../../components/common/headerMenu.vue';
import SidebarMenu from '../../components/common/sidebarMenu.vue';
import FastMenu from '../../components/common/fastMenu.vue';
export default {
    components: {
        HeaderMenu,
        SidebarMenu,
        FastMenu
    },
    data() {
        return {
            rightContainerLeft: '200px'
        }
    },
    mounted() {},
    computed: {
        rotateIcon() {
            return [
                'menu-icon',
                this.isCollapsed ? 'rotate-icon' : ''
            ];
        },
        menuitemClasses() {
            return [
                'menu-item',
                this.isCollapsed ? 'collapsed-menu' : ''
            ]
        }
    },
    methods: {
        toggleCollapse() {
            this.$refs.sidebarMenuRef.toggleCollapse();
            this.rightContainerLeft = this.rightContainerLeft === '60px' ? '200px' : '60px';
        }
    }
}