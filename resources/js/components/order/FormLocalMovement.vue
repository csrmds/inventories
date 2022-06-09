<template>
    <div>
        <div class="form-row">
            <div class="col-sm-3">
                <c-autocomplete-axios 
					:input-value="people.first_name"
					@itemSelected="setRequester($event)"
                    column="full_name"
					label="Solicitante" 
					source="people/search" 
					id="requester" 
				/>
            </div>

            <div class="col-sm-2 offset-sm-2">
                <label for="">Data</label>
                <input v-model="orderDate" type="text" class="form-control form-control-sm" data-mask='dd/mm/yyyy'>
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
					<option v-for="(location, i) in locationList" :key="i" :value="location.id">{{ location.name }}</option>
				</select>
            </div>
            
            <div class="col-sm-3">
                <c-autocomplete-axios 
					:input-value="people.first_name"
					@itemSelected="setResponsible($event)"
                    column="full_name"
					label="Responsável" 
					source="people/search" 
					id="requester" 
				/>
            </div>
        </div>
        <hr>
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
                <c-alert dismissible="true"></c-alert>
            </div>
        </div>
    </div>
</template>

<script>
import eventbus from '../eventbus'

export default {
    props: {
        //locationList: String, Object
    },

    data() {
        return {
            peopleWord: null,
            productWord: null,
            locationList: null,
            orderDate: null,
            error: false,
            errorList: []
        }
    },

    computed: {
        people() { return this.$store.state.people },
        ldapUser() { return this.$store.state.ldapUser },
        product() { return this.$store.state.product },
        order() { return this.$store.state.order },
        orderItem() { return this.$store.state.orderItem },
        alert() { return this.$store.state.alert },
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
                this.$store.dispatch('product/getById', param.id)
                param.location_id!=null ? this.order.location_origin= param.location_id : null
                param.people_id!=null ? this.order.people_origin= param.people_id : null
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

        dateConvert(param) {
            if (param!=null && param.length<10) {
                // console.log("error...")
                // console.log(param)
                this.error= true
                let errorCount= {
                    msg: "Formato de data inválido"
                }
                this.errorList.push(errorCount)
                return false
            }

            if (param==null) {
                param= new Date()
                param= param.getDate()+'/'+(param.getMonth()+1)+'/'+param.getFullYear()
                console.log("param Date: "+param)
            }
            this.error= false
            let date= param.split('/')
            date[2]= date[2].substr(0, 4)
            date= date[2]+'-'+date[1]+'-'+date[0]
            this.orderDate= date
        },

        async save() {
            this.dateConvert(this.orderDate)
            if (this.error) {
                this.errorList.forEach(element => {
                    this.alert.msg= element.msg
                });
                this.alert.classType= "alert-danger"
                this.$store.dispatch('alert/showAlert', this.alert)
                return false
            }

            this.order.location_destiny= this.product.location_id
            this.order.status= "ABERTO"
            this.order.category= "TRANSFERENCIA"
            this.order.created_at= this.orderDate
            const resp= await axios.post('order/save', {order: this.order})
            // console.log(resp);
            // console.log("add item ao pedido...")
            this.itemOrderSave(resp.data)
        },

        async itemOrderSave(order) {
            // console.log("itemOrderSave: "+order.id)
            // console.log("productID: "+this.product.id)
            this.orderItem.order_id= order.id
            this.orderItem.product_id= this.product.id
            this.$store.dispatch('orderItem/save', { 
                orderItem: this.orderItem,
                order: order
                })

            this.checkOrder(order.id)
        },

        async loadLocationList() {
            const resp= await this.$store.dispatch('location/search')
            // console.log('locationList')
            // console.log(resp)
            this.locationList= resp
        },

        inputsClean() {
            this.$store.commit('orderItem/cleanOrderItem')
            this.$store.commit('order/cleanOrder')
            this.$store.commit('product/cleanProduct')
            eventbus.$emit('cleanAutocomplete')
            this.error= false
            this.errorList= []
            this.orderDate= null
        },

        async checkOrder(order) {
            const resp= await this.$store.dispatch('order/getById', order)
            this.$store.dispatch('order/loadInputs', resp)
            if (this.order.status=="CONCLUIDO") {
                this.alert.msg= "Pedido concluido."
                this.alert.classType= "alert-info"
                this.$store.dispatch('alert/showAlert', this.alert)
                this.inputsClean()
            } else {
                this.alert.msg= this.orderItem.resp+"\n"+this.orderItem.error
                this.alert.classType= "alert-danger"
                this.$store.dispatch('alert/showAlert', this.alert)
            }
        }
    },

    mounted() {
        this.loadLocationList()
    }
}
</script>
