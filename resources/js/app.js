/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//require('./commom');

window.Vue = require('vue').default;

import store from './components/store/store'





/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('c-product-find', require('./components/product/InputFind.vue').default);
Vue.component('c-product-form-create', require('./components/product/FormCreate.vue').default);
//Vue.component('c-input-list', require('./components/form/InputList.vue').default);
//Vue.component('c-suggest', require('./components/SimpleSuggest.vue').default);
Vue.component('c-autocomplete', require('./components/form/Autocomplete.vue').default);
Vue.component('c-select', require('./components/form/Select.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    el: '#app',
});
