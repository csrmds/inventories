<template>
    <div>
        <div class="form-row">
            <div class="col-sm input-group">
                <input 
                    v-model="word"
                    @keydown.enter="search"
                    class="form-control form-control-sm"
                    placeholder="Busca Pessoas"
                    type="text">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" @click="search">Busca</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Categoria</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr v-for="(p, i) in list" :key="i">
                            <td>{{ p.id }}</td>
                            <td>{{ p.first_name+" "+p.last_name }}</td>
                            <td>{{ p.type }}</td>
                            <td>{{ p.category }}</td>
                            <td>
                                <button class="btn btn-sm btn-success" @click="select(p)">Select</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            people: this.$store.state.people,
            word: null,
            list: null,
            filterPaginate: null
        }
    },

    methods: {
        async search() {
            const resp= await this.$store.dispatch('people/search', {word: this.word} )
            this.filterPaginate= resp.data
            this.list= this.filterPaginate.data
        },

        select(param) {
            this.$store.commit('people/setPeople', param)
            this.$bvModal.hide('modal-people-search')
        }
    }
}
</script>
