export default {
    components: {

    },
    data() {
        return {
        	'bouncedPcVisit' : false,
        	'bouncedMobileVisit' : false,
        };
    },
    mounted() {
    },
    methods: {
        closeCollapse() {
            this.bouncedPcVisit = false;
            this.bouncedMobileVisit = false;
            this.$store.commit('toggleScreenMaskVisit', false);
        },
    	toggleCollapse(type) {
            if (type != undefined && type === 'mobile') {
                this.bouncedMobileVisit = !this.bouncedMobileVisit;
                this.bouncedPcVisit = false;
            } else {
                this.bouncedPcVisit = !this.bouncedPcVisit;
                this.bouncedMobileVisit = false;
            }
            this.$store.commit('toggleScreenMaskVisit');
    	}
    }
}