<template>
    <div>
        <div class="form-row">
            <label for="">Usuário</label>
            <input 
                v-model="user"
                type="text" 
                class="form-control form-control-sm">
        </div>

        <div class="form-row">
            <label for="">Senha</label>
            <input 
                v-model="password"
                type="password" 
                class="form-control form-control-sm">
        </div>
        <br>

        <div class="form-row">
            <div class="col-sm">
                <button class="btn btn-sm btn-primary" @click="login">Login</button>
            </div>
            <!-- <div class="col-sm">
                <button class="btn btn-sm btn-primary" @click="logout">Teste</button>
            </div> -->
        </div>
        <br>

        <div class="row container">
            <div class="col-sm">
                <c-alert dismissible="true"></c-alert>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: null,
            password: null,
        }
    },

    computed: {
        alert() { return this.$store.state.alert }
    },

    methods: {
        async login() {
            const resp= await axios.post('/authenticate', {
                user: this.user,
                password: this.password
            })

            if (resp.data.login) {
                this.$store.commit('alert/closeAlert')
                window.location.href= "/people"
            } else {
                this.$store.commit('alert/closeAlert')
                this.alert.msg= resp.data.msg
                this.alert.classType= "alert-warning"
                this.$store.dispatch('alert/showAlert', this.alert)
            }
        },

        // async logout() {
        //     const resp= await axios.get('/authenticate/logout')
        //     window.location.href= "/people"
        // }
    }
}
</script>
