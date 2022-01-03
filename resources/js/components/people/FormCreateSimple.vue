<template>
    <div>
        <div class="form-row">
            <div class="col-sm">
                <label for="">Nome Completo</label>
                <input 
                    v-model="name"
                    :class="$v.name.$error ? 'is-invalid' : null"
                    type="text" 
                    class="form-control form-control-sm"
                    aria-describedby="name-invalid">
                <div id="name-invalid" class="invalid-feedback">
                    {{ $v.name.required.$message }}
                    {{ $v.name.minLength.$message }}
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <label for="">Email</label>
                <input 
                    v-model="email" 
                    :class="$v.email.$error ? 'is-invalid' : null"
                    type="text" 
                    class="form-control form-control-sm"
                    aria-describedby="email-invalid">
                <div id="name-email" class="invalid-feedback">
                    {{ $v.email.required.$message }}
                    {{ $v.email.email.$message }}
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <label for="">Senha</label>
                <input 
                    v-model="password" 
                    :class="$v.password.$error ? 'is-invalid' : null"
                    type="password" 
                    class="form-control form-control-sm"
                    aria-describedby="password-invalid">
                <div id="password-invalid" class="invalid-feedback">
                    {{ $v.password.minLenght.$message }}
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm">
                <label for="">Confirmação de Senha</label>
                <input 
                    v-model="confirmPassword" 
                    :class="$v.confirmPassword.$error ? 'is-invalid' : null"
                    type="password" 
                    class="form-control form-control-sm"
                    aria-describedby="confirm-password-invalid">
                <div id="confirm-password-invalid" class="invalid-feedback">
                    {{ $v.confirmPassword.$message }}
                </div>
            </div>
        </div>
        <br>

        <div class="form-row">
            <div class="col-sm">
                <button @click="saveUser" class="btn btn-sm btn-primary">SALVAR</button>
            </div>
            <div class="col-sm">
                <button @click="switchLdapUser" class="btn btn-sm btn-primary">Usuário AD</button>
            </div>
            <div class="col-sm">
                <button @click="validate" class="btn btn-sm btn-primary">Validar</button>
            </div>
        </div>
    </div>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required, email, minLength, sameAs } from '@vuelidate/validators'

export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            confirmPassword: "",
            isLdapUser: true,
        }
    },

    validations() {
        return {
            name: {
                required,
                minLength: minLength(5) 
            },
            email: {
                required,
                email
            },
            password: {
                required,
                minLenght: minLength(3)
            },
            confirmPassword: {
                sameAsPassword: sameAs(this.password)
            }
                
        }
    },

    setup () {
		return { $v: useVuelidate() }
	},

    computed: {
        people() { return this.$store.state.people },
        ldapUser() { return this.$store.state.ldapUser }
    },

    methods: {
        validate(e) {
            e.preventDefault()
            this.$v.$touch()
            if (this.$v.$invalid) {
                console.log(this.$v)
                return false
            }

            this.saveUser()
        },

        async saveUser() {
            const resp= await this.$store.dispatch('people/save', {
                people: this.people,
                ldapUser: this.ldapUser
            })
            console.log(resp)
        },

        switchLdapUser() {
            this.isLdapUser= !this.isLdapUser
        }
    }
}
</script>
