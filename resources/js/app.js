/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//require('./commom');

window.Vue = require('vue').default;

import store from './components/store/store'

import useVuelidate from '@vuelidate/core'
Vue.use(useVuelidate)

import VueCompositionAPI from '@vue/composition-api'
Vue.use(VueCompositionAPI)

//import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// This imports <b-modal> as well as the v-b-modal directive as a plugin:
import { ModalPlugin } from 'bootstrap-vue'
Vue.use(ModalPlugin)

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
//Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
//Vue.use(IconsPlugin)

// The Mask input for Vue.js
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('c-select', require('./components/form/Select.vue').default);
Vue.component('c-autocomplete', require('./components/form/Autocomplete.vue').default);
Vue.component('c-autocomplete-axios', require('./components/form/AutocompleteAxios.vue').default);
Vue.component('c-cep', require('./components/form/Cep.vue').default);

Vue.component('c-people-table-list', require('./components/people/TableList.vue').default);
Vue.component('c-people-form-edit', require('./components/people/FormEdit.vue').default);

Vue.component('c-product-search', require('./components/product/InputSearch.vue').default);
Vue.component('c-product-form-create', require('./components/product/FormCreate.vue').default);

Vue.component('c-group-search', require('./components/group/InputSearch.vue').default);
Vue.component('c-group-table-list', require('./components/group/TableList.vue').default);

Vue.component('c-alert', require('./components/import/Alert.vue').default);

Vue.component('c-ocs-form-search', require('./components/ocs/FormSearch.vue').default);
Vue.component('c-ocs-card-info', require('./components/ocs/CardInfo.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    el: '#app',
});
