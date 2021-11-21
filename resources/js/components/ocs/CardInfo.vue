<template>
    <div>
        <div class="card" >
            <div class="card-body">
                <h4>OCS Info</h4>
                <table class="table table-sm table-borderless" v-if="ocsHardware.id">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>
                                <a :href="linkOcs+ocsHardware.id" target="_blank">{{ ocsHardware.id }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Patrimonio</th>
                            <td>{{ ocsHardware.tag }}</td>
                        </tr>
                        <tr>
                            <th>Hostname</th>
                            <td>{{ ocsHardware.name }}</td>
                        </tr>
                        <tr>
                            <th>OsName</th>
                            <td>{{ ocsHardware.osname }}</td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-sm btn-secondary" @click="modalOcsSearch">Busca</button>
                <button class="btn btn-sm btn-outline-secondary" @click="ocsClean">Limpar</button>
            </div>
        </div> 
    </div>
</template>

<script>
    export default {
        props: {
            //ocshardware: null
        },

        data() {
            return {
                linkOcs: "http://192.168.18.25/ocsreports/index.php?function=computer&head=1&systemid="
            }
        },

        computed: {
            ocsHardware() { return this.$store.state.ocsHardware },
            ocsHardwareId() { return this.$store.state.ocsHardware.id }
        },

        methods: {
            modalOcsSearch() {
                this.$bvModal.show('modal-ocs-search')
            },

            ocsClean() {
                this.$store.commit('ocsHardware/cleanOcsHardware')
                this.$store.commit('ocsHardware/cleanResp')
            },

            teste() {
                console.log(this)
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