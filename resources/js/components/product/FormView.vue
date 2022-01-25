<template>
    <div>
        <div class="form-row">
            <div class="col-sm-1">
                <strong>ID: </strong> {{ prpProduct.id }}
            </div>
            <div class="col-sm-2">
                <strong>Patrimônio</strong> {{ prpProduct.property_id }}
            </div>
            <div class="col-sm-3">
                <strong>Nome: </strong> {{ prpProduct.name }}
            </div>
            <div class="col-sm-3">
                <strong>Descrição: </strong> {{ prpProduct.description }}
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <strong>Tipo: </strong> {{ prpProduct.type }}
            </div>
            <div class="col-sm">
                <strong>Categoria: </strong> {{ prpProduct.category }}
            </div>
            <div class="col-sm">
                <strong>Marcar: </strong> {{ prpProduct.brand }}
            </div>
            <div class="col-sm">
                <strong>Modelo: </strong> {{ prpProduct.model }}
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <strong>SN: </strong> {{ prpProduct.sn }}
            </div>
            <div class="col-sm">
                <strong>TAG: </strong> {{ prpProduct.tag }}
            </div>
            <div class="col-sm">
                <strong>Responsável: </strong> {{ prpProduct.people }}
            </div>
            <div class="col-sm">
                <strong>Localização: </strong> {{ prpProduct.location }}
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <strong>OCS: </strong> {{ prpProduct.ocs_hw_id }}
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <strong>OBS:</strong><br>
                <textarea cols="40" rows="2" readonly v-model="prpProduct.obs"></textarea>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        prpProduct: null
    },

    data() {
        return {
            historyList: null
        }
    },

    methods: {
        async getProductHistory() {

        }
    }
    
}
</script>
