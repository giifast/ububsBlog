export default {
    components: {},
    data() {
        return {
        };
    },
    mounted() {
    },
    methods: {
        toggleCollapse(type) {
            this.$emit('toggleCollapse', type);
        }
    }
}