<template>
    <div>
        <label v-if="label" >{{ label }}</label>
        <select name="" id="" class="form-control">
            <option 
                v-for="(option, i) in options" 
                :key="i" 
                :value="option.id" 
            >
                {{ option.name }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            options: {
                type: Array,
                required: true
            },
            label: null,
            source: null
        },

        data() {
            return {
                info: null
            }
        },

        beforeMount() {
            if (typeof(this.options)=="string") {
                this.options= JSON.parse(this.options)
            }
        },

        mounted() {
            console.log('Component select mounted.')
        }
    }
</script>
