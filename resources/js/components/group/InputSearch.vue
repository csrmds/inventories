<template>
	<div class="input-group">
		<input 
			v-model="word"
			@keydown.enter="search"
			type="text" 
			name="group-find" 
			class="form-control input-control input-sm" 
			placeholder="Busca" />
		<div class="input-group-append">
			<button class="btn btn-sm btn-primary" @click="search">Busca</button>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			word: null
		}
	},

	methods: {
		search() { this.$store.dispatch('group/search', this.word) }
	},

	mounted() {
		console.log('Component mounted.')
	}
}
</script>
