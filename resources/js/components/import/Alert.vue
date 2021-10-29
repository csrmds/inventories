<template>
    <transition name="fade"> 

        <div class="alert alert-dismissible fade show" :class="type" role="alert" v-show="this.$store.state.alertView">
            <h4>{{ title }}</h4>
            <p>{{ msg }}</p>
            <button v-if="dismissible" type="button" class="close" aria-label="Close" @click="alertClose">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    </transition>
</template>

<script>
    export default {
        props: {
            title: null,
            msg: null,
            type: null,
            dismissible: false,
            timeToClose: 3000
        },
        
        computed: {
            //alertView() { return this.$store.state.alertView }
        },

        methods: {
            alertClose() {
				this.$store.commit('alertShow')
			},
        },


    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s;
    }
    .fade-enter, .fade-leave-to  {
        opacity: 0;
    }
</style>
