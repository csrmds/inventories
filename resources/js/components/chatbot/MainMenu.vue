<template>
    <div class="container">
        <div class="form row">
            <div class="col-sm-6">
                <div class="card">
                    <template v-for="(item, i) in menuItems" >
                        <p :key="i">{{item.number}} - {{ item.name}}</p>
                    </template>
                </div>
            </div>
        </div>
        <br/>

        <div class="form row">
            <div class="col-sm-2">
                <input type="number" class="form-control form-control-sm" v-model="selectedMenu">
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-primary" @click="setMenu" >Enviar</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-primary" @click="timeTest" >Time</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-secondary" @click="cleanResult" >Limpar resultado</button>
            </div>
        </div>
        <br/>

        <div class="form row">
            <div class="col-sm-10">
                <pre>{{ commandReturn }}</pre>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            selectedMenu: 0,
            menuItems: null,
            commandReturn: null
        }
    },

    methods: {
        async getMenu() {
            const resp= await axios.post('/chatbot/getmenu')
            //console.log(resp.data)
            this.menuItems= resp.data
        },

        async setMenu() {
            const resp= await axios.post('/chatbot/setmenu', {menuItem: this.selectedMenu})
            console.log(resp.data)
            this.commandReturn= resp.data
        },

        async timeTest(zone, success) {
            const resp= await axios.get('http://worldtimeapi.org/api/timezone/America/Sao_Paulo', {headers: {"Access-Control-Allow-Origin": "*"}})
            console.log(resp.data)
        },

        

        cleanResult() {
            this.commandReturn= null
        }
    },

    mounted() {
        this.getMenu()
    }
}
</script>


<style scoped>
.card {
    padding-left: 10px;
    padding-top: 10px;
}

pre {
    padding-left: 10px;
    padding-top: 10px;
    background-color: rgba(63, 63, 63, 0.473);
    word-wrap: break-word;
}
</style>