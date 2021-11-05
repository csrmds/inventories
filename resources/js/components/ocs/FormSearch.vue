<template>
    <div>
        <div class="row">
            <div class="col-sm input-group">
                <input 
                    v-model="word"
                    @keydown.enter="search"
                    type="text" 
                    name="ocs-search" 
                    class="form-control form-control-sm" 
                    placeholder="Busca OCS">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" @click="search">Busca OCS</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>ID</th>
                        <th>TAG</th>
                        <th>Hostname</th>
                        <th>OS</th>
                        <th>IP</th>
                        <th>UserID</th>
                        <th> - </th>
                    </thead>
                    <tbody>
                        <tr v-for="(result, i) in results" :key="i">
                            <td>{{ result.id }}</td>
                            <td>{{ result.tag }}</td>
                            <td>{{ result.name }}</td>
                            <td>{{ result.osname }}</td>
                            <td>{{ result.ipaddr }}</td>
                            <td>{{ result.userid }}</td>
                            <td>
                                <button class="btn btn-sm btn-success" @click="select(result)">Select</button>
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
                ocsHardware: this.$store.state.ocsHardware,
                word: null,
                results: null
            }
        },

        computed: {
            error() { return null },
            resp() { return null }
        },

        methods: {
            async search() {
                const resp= await this.$store.dispatch('ocsHardware/search', this.word)
                this.results= resp.data
                //console.log(resp.data)
            },

            select(ocsHardware) {
                this.$store.commit('ocsHardware/setOcsHardware', ocsHardware)
                this.$bvModal.hide('modal-ocs-search')
                //console.log(this.ocsHardware)
            }
        },

        mounted() {
            //console.log('Component mounted.')
        }
    }
</script>
