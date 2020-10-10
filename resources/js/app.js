/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { ClientTable } from "vue-tables-2";
import { rutFilter, rutInputDirective } from 'vue-dni';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';



window.Vue = require('vue');


Vue.use(ClientTable,{
    texts: {
        count: "Mostrando {from} a {to} de {count} registros|{count} registros|Un registro",
        filter: "",
        filterPlaceholder: "Buscar",
        limit: "Limite:",
        noResults: "No se encuntraron resultados",
    }
});
Vue.filter('rutFilter', rutFilter);
Vue.component('v-select', vSelect)
Vue.directive('rut', rutInputDirective);

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
Vue.component('crud-component', require('./components/CrudComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
