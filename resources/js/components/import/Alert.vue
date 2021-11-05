<template>
    <transition name="fade"> 

        <div class="alert alert-dismissible fade show" :class="classType" role="alert" v-show="this.$store.state.alert.view">
            <h4>{{ title }}</h4>
            <p>{{ msg }}</p>
            <button v-if="dismissible" type="button" class="close" aria-label="Close" @click="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    </transition>
</template>

<script>
    export default {
        props: {
            // title: null,
            // msg: null,
            // type: null,
            dismissible: false
        },
        
        computed: {
            title() { return this.$store.state.alert.title },
            msg() { return this.$store.state.alert.msg },
            classType() { return this.$store.state.alert.classType }
        },

        methods: {
            close() { this.$store.dispatch('alert/closeAlert') }
        },

        watch: {
            classType: function(newValue) {    
                if (newValue=="alert-success" || newValue=="alert-info") {
                    setTimeout(()=>{
                        this.$store.dispatch('alert/closeAlert')
                    }, 4000)
                }
            }
        }


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
