<template>
    <div>
        <table class="table table-striped table-sm">
            <thead>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Gr Pai</th>
                <th>Tabela</th>
                <th>-</th>
            </thead>
            <tbody>
                <tr v-for="(grupo, i) in groups" :k="i">
                    <td>{{ group.name }}</td>
                    <td>{{ group.description }}</td>
                    <td>{{ group.hierarchy_name }}</td>
                    <td>{{ group.table }}</td>
                    <td>Edit - Del</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {

        },

        data() {
            return {
                groups: null
            }
        },

        methods: {
            // async list() {
            //     this.isLoading= true
            //     this.groups= []
            //     cons resp= await this.$store.dispach('group/search', this)
            // }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
