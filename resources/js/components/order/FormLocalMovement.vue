<template>
    <div>
        <div class="form-row">
            <div class="col-sm-3">
                <label for="type">Tipo</label>
                <select v-model="order.category" name="type" id="type" class="form-control form-control-sm">
                    <template v-for="(type, i) in types">
                        <option :key="i" v-if="i==0" selected>
                            {{ type.name }}
                        </option>
                        <option :key="i" v-else>
                            {{ type.name }}
                        </option>
                    </template>
                </select>
            </div>

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

<<<<<<< HEAD
            <div class="col-sm-2 offset-sm-2">
                <label for="">Data</label>
                <input v-model="orderDate" type="text" class="form-control form-control-sm" data-mask='dd/mm/yyyy'>
=======
            <div class="col-sm-2">
                <label for="">Data</label>
                <input v-model="order.created_at" v-mask="'##-##-####'" type="data" class="form-control form-control-sm">
>>>>>>> c7f9a8b964a2c29a7634347dfa4b017e1d174c04
            </div>
        </div>

        <div class="form-row">

            <div class="col-sm-3">
                <template v-if="order.category=='INVENTÁRIO'">
                    <label for="">Origem</label>
                    <input type="text" class="form-control form-control-sm" value="INVENTÁRIO" readonly>
                </template>
                <template v-else-if="order.category=='COMPRA'">
                    <c-autocomplete-axios 
                        :input-value="people.first_name"
                        @itemSelected="setProvider($event)"
                        column="full_name"
                        label="Fornecedor" 
                        source="people/search" 
                        id="requester" 
                    />
                </template>
                <template v-else>
                    <label for="">Origem</label>
                    <input v-model="product.location" type="text" class="form-control form-control-sm" readonly>
                </template>
            </div>
            
            <div class="col-sm-3">
                <label for="location">Destino</label>
				<select v-model="orderLocationDestiny" name="location" id="location" class="form-control form-control-sm">
					<option v-for="(location, i) in locationList" :key="i" :value="location.id">{{ location.name }}</option>
				</select>
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
                <c-autocomplete-axios 
					:input-value="people.first_name"
					@itemSelected="setResponsible($event)"
                    column="full_name"
					label="Responsável" 
					source="people/search" 
					id="responsible" 
				/>
            </div>

            <div class="col-sm-2">
                <label>Add</label><br>
                <button class="btn btn-sm btn-primary" @click="addItem(product)" id="addProduct">Add</button>
            </div>

        </div>
        <hr>
        <br>

        <div class="form-row">
            <div class="col-sm">
                <table class="table table-striped table-sm">
                    <thead>
                        <th>Patrimonio</th>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Local Atual</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr v-for="(item, i) in orderItemList" :key="i">
                            <td>{{ item.product_property_id }}</td>
                            <td>{{ item.product_name }}</td>
                            <td>{{ item.product_brand }}</td>
                            <td>{{ item.product_location }}</td>
                            <td><button class="btn btn-sm btn-outline-secondary" @click="delItem(i)">Del</button> </td>
                        </tr>
                    </tbody>
                </table>
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
<<<<<<< HEAD
            orderDate: null,
            error: false,
            errorList: []
=======
            types: null,
            orderItemList: [],
            orderLocationDestiny: null
>>>>>>> c7f9a8b964a2c29a7634347dfa4b017e1d174c04
        }
    },

    computed: {
        people() { return this.$store.state.people },
        ldapUser() { return this.$store.state.ldapUser },
        product() { return this.$store.state.product },
        order() { return this.$store.state.order },
        orderItem() { return this.$store.state.orderItem },
        orderCategory() { return this.$store.state.order.category },
        alert() { return this.$store.state.alert },
    },

    methods: {
        setRequester(param) {
            if (param!==null) {
                this.order.request_from= param.id 
            } else {
                this.order.request_from= null
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

        setProvider(param) {
            if (param!==null) {
                this.order.people_origin= param.id
            } else {
                this.order.people_origin= null
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

<<<<<<< HEAD
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
=======
        addItem(param) {
            console.log(param)
            let itemOrder= this.orderItemList.length+1
            let item= {
                order_id: this.order.id,
                product_id: param.id,
                product_name: param.name,
                description: null,
                order: itemOrder,
                amount: null,
                value: null,
                discount: null,
                category: null,
                created_at: null,
                updated_at: null,
                product_brand: param.brand,
                product_property_id: param.property_id,
                product_location: param.location
            }
            
            this.orderItemList.push(item)
            this.$store.commit('product/cleanProduct')
            eventbus.$emit('cleanAutocomplete', 'product')
        },

        delItem(param) {
            this.orderItemList.splice(param, 1)
        },

        async save() {
            this.order.location_destiny= this.orderLocationDestiny
            this.order.status= "ABERTO";
>>>>>>> c7f9a8b964a2c29a7634347dfa4b017e1d174c04
            const resp= await axios.post('order/save', {order: this.order})
            // console.log(resp);
            // console.log("add item ao pedido...")
            this.orderItemsSave(resp.data)
        },

        async orderItemsSave(order) {
            // console.log("orderItemsSave: "+order.id)
            // console.log("productID: "+this.product.id)
            // this.orderItem.order_id= order.id
            // this.orderItem.product_id= this.product.id
            this.$store.dispatch('orderItem/save', { 
                orderItems: this.orderItemList,
                order: order
                })

            this.checkOrder(order.id)
        },

        async productUpdate() {

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
<<<<<<< HEAD
            eventbus.$emit('cleanAutocomplete')
            this.error= false
            this.errorList= []
            this.orderDate= null
=======
            this.orderItemList= []
            eventbus.$emit('cleanAutocomplete', 'product')
            eventbus.$emit('cleanAutocomplete', 'requester')
            eventbus.$emit('cleanAutocomplete', 'responsible')
>>>>>>> c7f9a8b964a2c29a7634347dfa4b017e1d174c04
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
        },

        async loadType() {
            const resp= await this.$store.dispatch('group/getByTable', 'order type')
            this.types= resp.data
        },

        verifyPeopleOrigin() {
            if (this.order.category!="COMPRA") {
                this.order.people_origin= null
            }
        },

        async teste() {
            const resp= await axios.post('/product/getbyorder', { id: 11 })
            console.log(resp)
        }
    },

    watch: {
        orderCategory: function(newValue, oldValue) {
            //console.log("ouviu: "+newValue)
            if (newValue!="COMPRA") {
                this.order.people_origin= null
            }
        },
    },

    mounted() {
        this.loadLocationList()
        this.loadType()
    }
}
</script>
