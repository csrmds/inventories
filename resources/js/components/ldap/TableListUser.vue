<template>
    <div>
        <div v-if="inputSearch" class="row">
            <div class="col-sm-9 input-group">
                <input 
                    v-model="word"
                    @keydown.enter="filterList"
                    type="text"
                    class="form-control form-control-sm"
                    placeholder="Busca">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-outline-secondary" @click="filterList">Filtar</button>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-sm">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>Conta</th>
                        <th>Descrição</th>
                        <th>GUID</th>
                        <td></td>
                    </thead>
                    <tbody>
                        <tr v-for="(user, i) in list" :key="i">
                            <td>{{ user.samaccountname[0] }}</td>
                            <td v-if="user.description">{{ user.description[0] }}</td>
                            <td v-else></td>
                            <td>{{ user.objectguid[0] }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" @click="selectUser(user)">Selecionar</button>
                                <button class="btn btn-sm btn-outline-primary" @click="teste(user)">Teste</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>



    </div>
</template>

<script>
export default {
    props: {
        inputSearch: { default: true }
    },

    data() {
        return {
            ldapUser: this.$store.state.ldapUser,
            word: null,
            list: null
        }
    },

    computed: {
        error() { return this.$store.state.ldapUser.error },
        resp() { return this.$store.state.ldapUser.resp }
    },

    methods: {
        async filterList() {
            const resp= await this.$store.dispatch('ldapUser/search', this.word)
            this.list= resp.data
        },

        async selectUser(param) {
            this.$store.commit('ldapUser/cleanLdapUser')
            this.$store.commit('ldapUser/setLdapUser', param)
            this.$bvModal.hide('modal-user-search')
        },

        teste(param) {
            console.log(param)
        }
    }
}
</script>
