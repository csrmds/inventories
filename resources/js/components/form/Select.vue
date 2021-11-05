<template>
    <div>
        <label v-if="label">{{ label }}</label>
        <select class="form-control form-control-sm" @change="eventEmit" :name="name">
            <template v-for="(option, i) in options2">
                <option 
                    v-if="option.selected" 
                    :key="i" 
                    selected
                >
                    {{ option.name }}
                </option>
                <option 
                    v-else
                    :key="i" 
                >
                    {{ option.name }}
                </option>
            </template>
        </select>
    </div>
</template>

<script>
import eventbus from '../eventbus'

export default {
    props: {
        options: { required: true },
        label: null,
        source: null,
        option_selected: null,
        name: null
    },

    data() {
        return {

        }
    },

    computed: {
        options2() { 
            if (typeof(this.options)=="string")  {
                this.options= JSON.parse(this.options)
                this.options.forEach(element => {
                    element.selected= false
                });
                return this.options
            } else {
                this.options.forEach(element => {
                    element.selected= false
                });
                return this.options
            }
        }
    },

    methods: {
        searchOption(payload) {
            this.options2.forEach((element, i)=> {
                if (element.name== payload.toUpperCase()) {
                    element.selected= true
                    this.$forceUpdate()
                } 
            })
        },

        eventEmit() {
            //envia atualização do item selecionado via evento
            let optionValue= document.getElementsByName(this.name)[0].value
            eventbus.$emit('select_'+this.name, optionValue)
        }
    },

    beforeMount() {

    },

    mounted() {

    },

    watch: {
        option_selected: function(newVal) {
            this.searchOption(newVal)
        },

    },
}
</script>
