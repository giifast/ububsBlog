export default {
    data() {
        return {
            value1: '123123',
            data1: []
        }
    },
    methods: {
        handleSearch(value) {
            this.data1 = !value ? [] : [
                value,
                value + value,
                value + value + value
            ];
        }
    },
}