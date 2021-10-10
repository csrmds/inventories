<template>
    <div>
        <label v-if="label" >{{ label }}</label>
        <select name="" id="" class="form-control">
            <option 
                v-for="(option, i) in options" 
                :key="i" 
                :value="option.id" 
            >
                {{ option }}
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
            label: { 
                type: String 
            },
            source: {
                type: String,
            }
        },

        data() {
            return {
                info: null
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
