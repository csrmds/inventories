<template>
	
	<div class="autocomplete">
		<input 
			v-model="search" 
			@input="list" 
			@blur="blur"
			@keydown.down="onArrowDown"
			@keydown.up="onArrowUp"
			@keydown.enter="onEnter"
			type="text" 
			class="form-control" 
		/>
		<ul
			v-show="isOpen" 
			class="autocomplete-results">

			<li
				v-if="isLoading"
				class="loading"
			>
				Carregando lista...
			</li>

			<li
				v-else
				v-for= "(result, i) in results"
				:key= "i"
				@click= "setResult(result)"
				class= "autocomplete-result"
				:class="{'is-active': i===arrowCounter}">
				{{ result }}
			</li>

		</ul>
	</div>


</template>


<script>
import { mapGetters, mapState } from 'vuex'

export default {
	name: 'SearchAutocomplete',
	props: {
		items: {
			type: Array,
			required: false,
			default: ()=> ['maça', 'banana', 'melancia', 'jaca', 'morango', 'uva', 'maracuja', 'abacaxi', 'manga', 'limão', 'pepino', 'baunilha'],
		},
		isAsync: {
			type: Boolean,
			required: false,
			default: false
		}
	},

	data() {
		return {
			search: '',
			results: [],
			isOpen: false,
			arrowCounter: -1,
			isLoading: false
		};
	},

	methods: {
		filterResult() {
			this.results= this.items.filter(
				item=> item.toLowerCase().indexOf(this.search.toLowerCase()) > -1
			);
		},

		list() {
			this.$store.commit('product/search', this.search)
			if (this.$store.product.resp) {
				console.log("resp: "+this.$store.product.resp)
			} else {
				console.log("error: "+this.$store.product.error)
			}
		},

		onChange() {
			this.$emit('input', this.search);

			if (this.isAsync) {
				this.isLoading= true;
			} else {
				this.filterResult();
				this.isOpen= true;	
			}
			
		},

		setResult(result) {
			console.log("chamou set result")
			this.search= result;
			this.isOpen= false;
		},

		handleClickOutside(event) {
			if (!this.$el.contains(event.target)) {
				this.arrowCounter= -1;
				this.isOpen= false;
			}
		},

		onArrowDown() {
			if (this.arrowCounter < this.results.length) {
				this.arrowCounter= this.arrowCounter +1;
			}
		},

		onArrowUp() {
			if (this.arrowCounter > 0) {
				this.arrowCounter= this.arrowCounter -1;
			}
		},

		onEnter() {
			this.search= this.results[this.arrowCounter];
			this.arrowCounter= -1;
			this.isOpen= false
		},

		blur() {
			console.log('blur')
			//this.isOpen= false
		}

	},

	watch: {
		items: function (value, oldValue) {
			if (this.isAsync) {
				this.results= value;
				this.isOpen= true;
				this.isLoading= false;
			}
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

<style>

.autocomplete { position: relative; }

.autocomplete-results {
	padding: 0;
	margin: 0;
	border: 1px solid #eeeeee;
	height: 160px;
	min-height: 1em;
	/*max-height: 6em;*/
	overflow: auto;
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