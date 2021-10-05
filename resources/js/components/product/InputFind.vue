<template>
    <div class="input-group">
        <input type="text" name="product-find" class="form-control input-control input-sm" placeholder="Busca">
        <div class="input-group-append">
            <button class="btn btn-sm btn-primary">Busca</button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
