<template>
    <div>
        <label v-if="label">{{ label }}</label>
        <select class="form-control">
            <template v-for="(option, i) in options2">
                <option 
                    v-if="option.selected" 
                    :key="i" 
                    :value="option.id"
                    selected
                >
                    {{ option.name }}
                </option>
                <option 
                    v-else
                    :key="i" 
                    :value="option.id"
                >
                    {{ option.name }}
                </option>
            </template>
        </select>
        <button class="btn btn-warning" @click="searchOption">+</button>
    </div>
</template>

<script>
    export default {
        props: {
            options: { required: true },
            label: null,
            source: null,
            option_selected: null
        },

        data() {
            return {
                info: null,
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
            setOption() {
                console.log('set option...')
                this.options[3].selected= true
                this.$forceUpdate()
            },

            searchOption() {
                this.options2.forEach((element, i)=> {
                    if (element.name== this.option_selected.toUpperCase()) {
                        element.selected= true
                        this.$forceUpdate()
                    }
                })
            }
        },

        beforeMount() {
            // console.log("typeof: options before")
            // console.log(typeof(this.options))
            // if (typeof(this.options)=="string") {
            //     this.options= JSON.parse(this.options)
            // }
        },

        mounted() {

        },

        watch: {
			option_selected: function(newVal) {
                //console.log("ouviu mudança searchOoption")
                this.searchOption()
			}
		},
    }
</script>
