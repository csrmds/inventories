<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h4>Responsável</h4>
                <table v-if="peopleId!=null" class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ people.id }}</td>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <td>{{ people.first_name+" "+people.last_name }}</td>
                        </tr>
                        <tr>
                            <th>Categoria</th>
                            <td>{{ people.category }}</td>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-sm btn-secondary" @click="modalPeopleSearch">Busca</button>
                <button class="btn btn-sm btn-outline-secondary" @click="peopleClean">Limpar</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() { 
        return {
            x: null
        } 
    },

    computed: {
        people() { return this.$store.state.people },
        peopleId() { return this.$store.state.people.id }
    },

    methods: {
        modalPeopleSearch() {
            this.$bvModal.show('modal-people-search')
        },

        peopleClean() {
            this.$store.commit('people/cleanPeople')
            this.$store.commit('people/cleanResp')
        }
    }
}
</script>

<style scoped>
thead {
    float: left
}

thead th {
    display: block
}

tbody {
    float: left
}

.card-body {
    padding: 10px
}
</style>