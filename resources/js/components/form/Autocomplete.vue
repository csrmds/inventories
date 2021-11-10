<template>
    <div class="autocomplete">
        <label v-if="label">{{ label }}</label>
        <div class="input-group">
            <input 
                v-model="word"
                :id="id"
                @input="filter"
                @keydown.down="onArrowDown"
                @keydown.up="onArrowUp"
                @keydown.enter="onEnter"
                @keydown.esc="cleanResults"
                @keydown.tab="cleanResults"
                type="text"
                class="form-control form-control-sm"
                autocomplete="off"
            />
        </div>
        

        <ul v-show="divList" class="autocomplete-results">
            <li v-if="isLoading" class="loading">
                Carregando lista...
            </li>

            <li
                v-else
                v-for= "(result, i) in listFiltred"
                :key= "i"
                :id="'li_'+i"
                :class= "{'is-active': i===arrowCounter}"
                @click= "setItem(result)"
                class="autocomplete-result"
            >
                {{ result[column] }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            list: null,
            column: null,
            label: null,
            id: null
        },

        data() {
            return {
                word: null,
                divList: false,
                arrowCounter: -1,
                isLoading: false,
                itemSelected: false,
                listFiltred: null,
            }
        },

        computed: {
            listObj() {
                if (typeof(this.list)=="object") {
                    return this.list
                } else {
                    return JSON.parse(this.list)
                }
            }
        },

        methods: {
            

            filter() {
                let word= this.word.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "")
                let col= this.column.toLowerCase()
                this.listFiltred= this.listObj.filter(function(item, i) {
                    let name= item[col].toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "")
                    return name.indexOf(word)>-1 ? item : false
                })
            },

            setItem(param) {
                this.word= param[this.column]
                this.itemSelected= param
                this.divList= false
                this.arrowCounter= -1

                //this.$emit('itemSelected', this.itemSelected)
            },

            handleClickOutside(event) {
                if (!this.$el.contains(event.target)) {
                    this.arrowCounter= -1
                    this.divList= false
                }
            },

            onArrowUp() {
                if (this.arrowCounter>0) {
                    this.arrowCounter--
                    $("#li_"+this.arrowCounter)[0].scrollIntoViewIfNeeded(false)
                }
            },

            onArrowDown() {
                this.divList==false ? this.divList=true : false
                if (this.arrowCounter < this.listFiltred.length-1) {
                    this.arrowCounter++
                    $("#li_"+this.arrowCounter)[0].scrollIntoViewIfNeeded(false)
                }
            },

            onEnter() {
                this.word= this.listFiltred[this.arrowCounter][this.column]
                this.itemSelected= this.listFiltred[this.arrowCounter]
                this.arrowCounter= -1
                this.divList= false
            },

            cleanResults() {
                this.arrowCounter= -1
                this.divList= false
            }

            // filtro2() {
            //     let word= this.word.toLowerCase()
            //     this.listFiltred= this.listObj.filter(function(item, i) {
            //         let name= item.first_name.concat(" ", item.last_name).toLowerCase()
            //         return name.indexOf(word)>-1 ? item : false
            //     })
            // },

        },

        watch: {
            listFiltred: function(newValue, oldValue) {
                this.divList= true
            }
        },

        mounted() {
            document.addEventListener('click', this.handleClickOutside);
        },

        destroyed() {
            document.removeEventListener('click', this.handleClickOutside);
        },


    }
</script>

<style scoped>
.autocomplete { position: relative; }

.autocomplete-results {
	padding: 0;
	margin: 0;
	border: 1px solid #eeeeee;
	height: 160px;
	min-height: 1em;
	min-width: 170px;
	width: auto;
	/*max-height: 6em;*/
	overflow: auto;
	z-index: 1000;
	position: absolute;
	background-color: white;
}

.autocomplete-result {
	list-style: none;
	text-align: left;
	padding: 4px 2px;
	cursor: pointer;
	
}

.autocomplete-result.is-active,
.autocomplete-result:hover {
	background-color: #4aae9b;
	color: white;
}
</style>