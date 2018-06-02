export default {
    data() {
        return {}
    },
    methods: {
        closeTag(event, name) {
            this.$store.commit('deleteFastMenu', name);
        }
    }
}