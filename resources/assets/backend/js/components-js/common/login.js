export default {
    data() {
        return {
            loginForm: {
                account: '',
                password: '',
                remeber: true
            },
            loading: false,
            ruleValidate: {
                account: [
                    { required: true, message: 'The account cannot be empty', trigger: 'blur' },
                    { type: 'string', min: 2, message: 'The account no less than 2 words', trigger: 'blur' }
                ],
                password: [
                    { required: true, message: 'Password cannot be empty', trigger: 'blur' },
                ],
            }
        }
    },
    methods: {
        login(name) {
            let _this = this;
            _this.$refs[name].validate((valid) => {
                if (valid) {
                    _this.$store.commit('setStateValue', { 'loading': true });
                    axios.post('/backend/login', _this.loginForm).then((response) => {
                        let { data, message } = response.data;
                        localStorage.setItem('ububsAdminData', JSON.stringify(data.list));
                        _this.$store.commit('setStateValue', { 'loading': false, 'adminData': JSON.parse(localStorage.getItem('ububsAdminData')) });
                        _this.$Message.success(message);
                        _this.$router.push({ path: '/home' });
                    }).catch((error) => {
                        _this.$store.commit('setStateValue', { 'loading': false });
                    });
                }
            })
        },
        visitLogin() {
            let _this = this;
            _this.loading = true;
            axios.post('/backend/visit-login', _this.loginForm).then((response) => {
                let { data, message } = response.data;
                localStorage.setItem('ububsAdminData', JSON.stringify(data.list));
                _this.$store.commit('setStateValue', { 'loading': false, 'adminData': JSON.parse(localStorage.getItem('ububsAdminData')) });
                _this.$Message.success(message);
                _this.$router.push({ path: '/home' });
                _this.loading = true;
            }).catch((error) => {
                _this.loading = true;
            });
        },
        reset(name) {
            this.$refs[name].resetFields();
        }
    },
}