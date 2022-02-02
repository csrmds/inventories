<template>
    <div>
        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Alias</label>
            <div class="col-sm-2 col-form-label">
                <input type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">IP: </label>
            <div class="col-sm-2 col-form-label">
                <input type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Domínio: </label>
            <div class="col-sm-2 col-form-label">
                <input type="text" class="form-control form-control-sm" placeholder="dominio.com">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Usuário: </label>
            <div class="col-sm-2 col-form-label">
                <input type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Senha: </label>
            <div class="col-sm-2 col-form-label">
                <input type="password" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group form-row">
            <label for="" class="col-sm-2 col-form-label">Porta: </label>
            <div class="col-sm-2 col-form-label">
                <input type="text" class="form-control form-control-sm" value="389" placeholder="389">
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm-2">
                <button class="btn btn-sm btn-outline-primary">Teste Conexão</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-outline-primary">Editar</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-outline-success">Salvar</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        
    }
}
</script>


<style scoped>
.form-group {
    margin-bottom: 0px;
}
</style>