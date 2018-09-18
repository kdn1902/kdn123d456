
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import axios from 'axios';

Vue.component('employees-component', require('./components/EmployeesComponent.vue'));
Vue.component('employee-component', require('./components/EmployeeComponent.vue'));
Vue.component('newemployee-component', require('./components/NewEmployeeComponent.vue'));
Vue.component('mydatepicker', require('./components/MyDatepicker.vue'));

Vue.directive('focus', {
  inserted: function (el) {
    el.focus();
  }
})


import {ServerTable, ClientTable, Event} from 'vue-tables-2';
Vue.use(ServerTable, {}, false, 'bootstrap4', 'default');


const app = new Vue({
    el: '#app'
});
