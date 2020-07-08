/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vuex from "vuex";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const employeStore = new Vuex.Store({
    state: {
        employees: [],
        employeeProps:{
            firstName: "",
            middleName: "",
            lastName: "",
            birthday: "",
            address: "",
            employeeNumber:"",
            number:"",
        }
    },
    getters: {
        getEmployees: state => state.employees,
    }
    ,
    mutations:{
        setEmployees(state, payload){
            state.employees = payload;
            console.log(state.employees, "mutators");
        }
    },
    actions: {
        increment ({ commit, state }) {
            commit('increment')
        }
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store: employeStore
});
