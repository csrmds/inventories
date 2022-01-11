<template>
    <div>
        <div class="form-row">
            <div class="col-sm-3">
                <c-autocomplete-axios 
					:input-value="people.first_name"
					@itemSelected="setRequester($event)"
                    column="first_name"
					label="Solicitante" 
					source="people/search" 
					id="requester" 
				/>
            </div>

            <div class="col-sm-2 offset-sm-3">
                <label for="">Data</label>
                <input type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm-3">
                <c-autocomplete-axios 
					:input-value="product.property_id"
					@itemSelected="setProduct($event)"
                    column="property_id"
					label="Produto" 
					source="product/searchBy" 
					id="product" 
				/>
            </div>
            
            <div class="col-sm-3">
                <label for="location">Destino</label>
				<select v-model="product.location_id" name="location" id="location" class="form-control form-control-sm">
					<option v-for="(location, i) in JSON.parse(locationList)" :key="i" :value="location.id">{{ location.name }}</option>
				</select>
            </div>
            
            <div class="col-sm-3">
                <c-autocomplete-axios 
					:input-value="people.first_name"
					@itemSelected="setResponsible($event)"
                    column="first_name"
					label="Responsável" 
					source="people/search" 
					id="requester" 
				/>
            </div>
        </div>
        <br>

        <div class="form-row">
            <div class="col-sm">
                <c-product-card-info/>
            </div>
        </div>
        <br>

        <div class="form-row">
            <div class="col-sm">
                <button class="btn btn-sm btn-primary" @click="save">Salvar</button>
            </div>
        </div>
        <br>

        <div class="form-row">
            <div class="col-sm">
                <p>mensagens...</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        locationList: String, Object
    },

    data() {
        return {
            peopleWord: null,
            productWord: null
        }
    },

    computed: {
        people() { return this.$store.state.people },
        ldapUser() { return this.$store.state.ldapUser },
        product() { return this.$store.state.product },
        order() { return this.$store.state.order },
        orderItem() { return this.$store.state.orderItem }
    },

    methods: {
        setRequester(param) {
            if (param!==null) {
                this.order.request_from= param.id 
                //console.log(this.order)
            } else {
                this.order.request_from= null
                //console.log(this.order)
            }
            
        },

        setResponsible(param) {
            if (param!==null) {
                this.order.people_destiny= param.id 
                this.product.people_id= param.id
            } else {
                this.order.people_destiny= null
                this.product.people_id= null
            }
        },

        setProduct(param) {
            if (param!==null) {
                this.$store.dispatch('product/loadInputs', param)
            } else {
                this.$store.commit('product/cleanProduct')
            }
        },

        autoComplete(param) {
			if (param) {
				this.$store.dispatch('ldapUser/loadInputs', param)
			} else {
				this.$store.commit('ldapUser/cleanLdapUser')
			}
		},

        async save() {
            this.order.location_destiny= this.product.location_id
            this.order.status= "ABERTO";
            this.order.category= "TRANSFERENCIA";
            const resp= await axios.post('order/save', {order: this.order})
            console.log(resp);
            console.log("add item ao pedido...")
            this.itemOrderSave(resp.data.id)
        },

        async itemOrderSave(orderId) {
            console.log("itemOrderSave: "+orderId)
            console.log("productID: "+this.product.id)
            this.orderItem.order_id= orderId
            this.orderItem.product_id= this.product.id
            this.$store.dispatch('orderItem/save', this.orderItem)
        }
    }
}
</script>
