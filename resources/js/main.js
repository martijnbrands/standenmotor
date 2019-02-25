/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Vue from 'vue';
import "./plugins/vuetify";
import Vuetify from 'vuetify';

import router from "@/js/router.js";
import App from "@/js/views/App.vue";


Vue.use(Vuetify);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    render: h => h(App),
});

export default app;

// window.Vue = require('vue');
// // import Vue from "vue";
// import Vuetify from 'vuetify'
// import App from "./views/App.vue";
// import router from "./router";
// // import "@mdi/font/css/materialdesignicons.css"; // Ensure you are using css-loader


// Vue.config.productionTip = false

// new Vue({
//   router,
//   render: h => h(App)
// }).$mount('#app')

