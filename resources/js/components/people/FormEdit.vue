<template>
    <div class="container-fluid">
        
        <div class="form-row">
            <div class="col-sm">
                
                <ul class="nav nav-tabs" id="peopleTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a 
                            class="nav-link active" 
                            id="data-tab" 
                            data-toggle="tab" 
                            href="#data" 
                            role="tab" 
                            aria-controls="data" 
                            aria-selected="true">
                            Dados
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a 
                            class="nav-link" 
                            id="produtcs-tab" 
                            data-toggle="tab" 
                            href="#products" 
                            role="tab" 
                            aria-controls="products" 
                            aria-selected="false">
                            Produtos
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="peopleTabContent">
                    
                    <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                        <div class="form-row">

                            <div class="col-sm-2">
                                <label for="type">Tipo</label>
                                <select 
                                    v-model="people.type"
                                    name="type" 
                                    id="type" 
                                    class="form-control form-control-sm"
                                    :class="validation.type.invalid ? 'is-invalid' : null"
                                    aria-describedby="type-invalid">
                                    <option value="F">Física</option>
                                    <option value="J">Jurídica</option>
                                </select>
                                <div id="type-invalid" class="invalid-feedback">
                                    {{ validation.type.msg }}
                                </div>

                            </div>

                            <div class="col-sm-3">
                                <template v-if="people.type=='F'">
                                    <label for="">Nome</label>
                                    <input 
                                        v-model="people.first_name" 
                                        type="text" 
                                        :class="validation.first_name.invalid ? 'is-invalid' : null"
                                        class="form-control form-control-sm"
                                        aria-describedby="first_name-invalid">
                                </template>
                                <template v-else>
                                    <label for="">Razão Social</label>
                                    <input 
                                        v-model="people.first_name" 
                                        type="text" 
                                        :class="validation.first_name.invalid ? 'is-invalid' : null"
                                        class="form-control form-control-sm"
                                        aria-describedby="first_name-invalid">
                                </template>
                                <div id="first_name-invalid" class="invalid-feedback">
                                    {{ validation.first_name.msg }}
                                </div>

                            </div>

                            <div class="col-sm-2">
                                <label for="">Categoria</label>
                                <c-autocomplete 
                                    :input-value="people.category" 
                                    :list="categories" 
                                    column="name" >
                                </c-autocomplete>
                            </div>

                            <div class="col-sm-2">
                                <label for="">Nascimento</label>
                                <input v-if="people.type=='F'" v-model="birth_date" v-mask="'##/##/####'" type="text" class="form-control form-control-sm">
                                <input v-else type="text" class="form-control form-control-sm" disabled>
                            </div>

                            <div class="col-sm-2">
                                <template v-if="people.type=='F'">
                                    <label for="">CPF</label>
                                    <input v-model="people.cpf" v-mask="'###.###.###-##'" type="text" class="form-control form-control-sm">
                                </template>
                                <template v-else>
                                    <label for="">CNPJ</label>
                                    <input v-model="people.cnpj" v-mask="'##.###.###/####-##'" type="text" class="form-control form-control-sm">
                                </template>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-sm-2">
                                <c-cep
                                    :input-value="people.zipcode"
                                    @ibge="loadCep($event)"
                                    label="CEP">
                                </c-cep>
                            </div>

                            <div class="col-sm-3">
                                <label for="">Logradouro</label>
                                <input v-model="people.address" type="text" class="form-control form-control-sm">
                            </div>

                            <div class="col-sm-1">
                                <label for="">Número</label>
                                <input v-model="people.number" type="text" class="form-control form-control-sm">
                            </div>

                            <div class="col-sm-2">
                                <label for="">Complemento</label>
                                <input v-model="people.complement" type="text" class="form-control form-control-sm">
                            </div>

                            <div class="col-sm-2">
                                <label for="">Bairro</label>
                                <input v-model="people.district" type="text" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-2">
                                <label for="">Cidade</label>
                                <input v-model="people.city" type="text" class="form-control form-control-sm">
                            </div>

                            <div class="col-sm-2">
                                <label for="">UF</label>
                                <select v-model="people.state" name="state" id="state" class="form-control form-control-sm">
                                    <option v-for="(uf, i) in ufs" :key="i" :value="uf.uf">{{ uf.uf }}</option>
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <label for="">UserLogin</label>
                                <input type="text" readonly class="form-control form-control-sm" v-model="userLogin.name">
                            </div>
                            <div class="col-sm-2">
                                <label for="">AD User</label>
                                <input type="text" readonly class="form-control form-control-sm" v-model="ldapUser.samaccountname">
                            </div>
                            <div class="col-sm-2">
                                <label for="">DN</label>
                                <input type="text" readonly class="form-control form-control-sm" v-model="ldapUser.distinguishedname">
                            </div>
                        </div>

                    </div>
                    
                    <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="produtcs-tab">
                        <c-people-product-list :people-id="people.id" />
                    </div>
                </div>

            </div>
            

        </div>

        
        <br>

        <div class="row">
            <div class="col-sm">
                <c-alert dismissible="true"></c-alert>
            </div>
        </div>
        <hr>


        <div class="row">
            <div class="col-sm-2">
                <button class="btn btn-sm btn-primary container-fluid" @click="validate">Salvar</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-secondary container-fluid" @click="ldapUserModal">Add LDAP User</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-sm btn-secondary container-fluid" @click="removeLdapUser">Remover LDAP User</button>
            </div>
            
        </div>

        <div class="row">
            <div class="col-sm-6">
				<b-modal
					id="modal-user-search"
					title="Ad User"
					size="xl">
					<c-ldapuser-table-list />
				</b-modal>
			</div>
        </div>


    </div>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required, requiredUnless } from '@vuelidate/validators'

export default {

    data() {
        return {
            ufs: this.$store.state.ufs,
            birth_date: null,
            toggle: true,

            validation: {
                type: {
                    msg: "Campo obrigatório",
					invalid: false
                },
                first_name: {
                    msg: "Campo obrigatório",
					invalid: false
                }
            }
        }
    },

    validations() {
        return {
            type: { required },
            first_name: { required }
        }
    },

    setup () {
		return { $v: useVuelidate() }
	},

    computed: {
        people() { return this.$store.state.people },
        ldapUser() { return this.$store.state.ldapUser },
        userLogin() { return this.$store.state.user },
        error() { return this.$store.state.people.error },
        resp() { return this.$store.state.people.resp },
        alert() { return this.$store.state.alert },
        categories() { return this.$store.state.people.categories },
        type() { return this.people.type },
        first_name() { return this.people.first_name }
    },

    mounted() {
        this.loadCategory()
        //this.birthDate()
        this.loadUser()

        // var triggerTabList = [].slice.call(document.querySelectorAll('#myTab button'))
        // triggerTabList.forEach(function (triggerEl) {
        //     var tabTrigger = new bootstrap.Tab(triggerEl)

        //     triggerEl.addEventListener('click', function (event) {
        //         event.preventDefault()
        //         tabTrigger.show()
        //     })
        // })

    },

    methods: {

        async save() {
            if (this.people.id>0) {
                await this.$store.dispatch('people/update', {
                    people: this.people,
                    ldapUser: this.ldapUser
                })
            } else {
                await this.$store.dispatch('people/save', {
                    people: this.people,
                    ldapUser: this.ldapUser
                })
            }
        },

        async validate() {
            if (this.birth_date!=null) {
                let date= this.birth_date.split('/')
                this.people.birth_date= date[2]+'-'+date[1]+'-'+date[0]
            }

            this.$v.$touch()
            if (this.$v.$invalid) {
                this.$v.first_name.$invalid ? this.validation.first_name.invalid= true : this.validation.first_name.invalid= false
                this.$v.type.$invalid ? this.validation.type.invalid= true : this.validation.type.invalid= false
                return false
            }

            this.validation.first_name.invalid= false
            this.validation.type.invalid= false
            this.save()
        },

        loadCep(param) {
            this.$store.dispatch('people/loadAddress', param)
        },

        async loadCategory() {
            await this.$store.dispatch('people/listCategory')
        },

        birthDate() {
            let date= this.$store.state.people.birth_date.split("-")
            this.birth_date= date[2]+"/"+date[1]+"/"+date[0]
        },

        ldapUserModal(e) {
			e.preventDefault()
            this.$bvModal.show('modal-user-search')
        },

        ldapUserClean() {
            this.$store.commit('ldapUser/cleanLdapUser')
        },

        async loadUser() {
            const resp= await this.$store.dispatch('people/getUser', this.people.id)
            console.log('loadUser formedit: '+this.people.id)
            if (resp.data) {
                await this.$store.commit('user/setUser', resp.data)
                let getLdapUser= await this.$store.dispatch('ldapUser/getLdapUser', resp.data.id)
                if (getLdapUser.data.distinguishedname) {
                    this.$store.commit('ldapUser/setLdapUser', getLdapUser.data)
                }
            } else {
                this.$store.commit('user/cleanUser')
                this.$store.commit('ldapUser/cleanLdapUser')
            }
            
        },

        async removeLdapUser(e) {
            e.preventDefault()
            const resp= await this.$store.dispatch('people/removeLdapUser', this.ldapUser)
            if (resp.data=="1") {
                this.alert.msg= "Usuário removido com sucesso."
                this.alert.classType= "alert-info"
                this.$store.dispatch('alert/showAlert', this.alert)
                this.ldapUserClean
            } else {
                this.alert.msg= resp.data
                this.alert.classType= "alert-danger"
                this.$store.dispatch('alert/showAlert', this.alert)
            }
        }

        // async convertBirthDate() {
        //     this.$store.state.people.birth_date= await this.$store.dispatch('convertData', this.birthDate())
            
        // }
    },

    watch: {
        // error: function(newValue) {
        //     this.alert.msg= newValue
        //     this.alert.classType= "alert-danger"
        //     this.$store.dispatch('alert/showAlert', this.alert)
        // },

        // resp: function(newValue) {
        //     this.alert.msg= newValue
        //     this.alert.classType= "alert-info"
        //     this.$store.dispatch('alert/showAlert', this.alert)
        // },
    }
}
</script>
