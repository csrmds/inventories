<template>
    <div>
        <table class="table table-striped table-sm">
            <thead>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Gr Pai</th>
                <th>Tabela</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="(group, i) in groups" :k="i">
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
                groups: null,
                
            }
        },

        computed: {
            error() { return this.$store.state.group.error },
		    resp() { return this.$store.state.group.resp },
        },

        methods: {
            teste() { }
        },

        mounted() {
            console.log('Component mounted.')
            this.$store.dispatch('group/search', "")
        },

        watch: {
            resp: function(newVal) {
                console.log("ouviu carai..")
                this.groups= newVal
            }
        }
    }
</script>
