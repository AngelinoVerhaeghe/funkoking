/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//require('../../resources/assets/admin_assets/jquery/jquery.min.js');
require('jquery/dist/jquery.min.js');
require('../../resources/assets/admin_assets/jquery-ui/jquery-ui.js');
//require('../../resources/assets/admin_assets/bootstrap/js/bootstrap.bundle.min.js');
require('bootstrap/dist/js/bootstrap.bundle.min.js');
//require('../../resources/assets/admin_assets/datatables/jquery.dataTables.min.js');
//require('../../resources/assets/admin_assets/datatables-bs4/js/dataTables.bootstrap4.min.js');
//require('../../resources/assets/admin_assets/datatables-responsive/js/dataTables.responsive.min.js');
//require('../../resources/assets/admin_assets/datatables-responsive/js/responsive.bootstrap4.min.js');//Niet in node-file??
require('datatables.net/js/jquery.dataTables.min.js');
require('datatables.net-bs4/js/dataTables.bootstrap4.min.js');
require('datatables.net-responsive/js/dataTables.responsive.min.js');
//require('../../resources/assets/admin_assets/chart.js/Chart.min.js');
require('chart.js/dist/Chart.min.js');
require('../../resources/assets/admin_assets/js/script.js');
require('../../resources/assets/admin_assets/js/adminlte.js');

window.Vue = require('vue');

import moment from 'moment'
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const routes = [
    {
        path : '/users',
        name : 'users',
        component : require('./components/Users.vue').default
    },
];

const router = new VueRouter({
    routes
});

Vue.filter('customDate', function (created) {
    return moment(created).format('MMMM Do YYYY');
})


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
//Vue.component('create-product', require('./components/CreateProduct.vue').default);
//Vue.component('users', require('./components/Users.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});

