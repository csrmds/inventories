<template>
    <div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">IP: </label>
            <div class="col-sm-2 col-form-label">
                <input type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Nome DB: </label>
            <div class="col-sm-2 col-form-label">
                <input type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">User DB: </label>
            <div class="col-sm-2 col-form-label">
                <input type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Senha DB: </label>
            <div class="col-sm-2 col-form-label">
                <input type="password" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Porta DB: </label>
            <div class="col-sm-2 col-form-label">
                <input type="text" class="form-control form-control-sm" value="3306">
            </div>
        </div>
        <br>

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
    margin-bottom: 10px;
}
</style>