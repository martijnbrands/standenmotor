import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';

import Score from "./views/Score.vue";
import Drivers from "./views/Drivers.vue";
import Arbiters from "./views/Arbiters.vue";

import Register from "./views/Register.vue";
import Login from "./views/Login.vue";


Vue.prototype.$http = axios;

Vue.use(Vuetify, {
    theme: {
    primary: "#304FFE",
    secondary: "#304FFE",
    accent: "#FFD600",
    error: "#f44336",
    warning: "#FFC107",
    info: "#2196f3",
    success: "#4caf50",
    },
    iconfont: 'mdi'} 
);

Vue.use(VueAxios, axios)
Vue.use(VueRouter)

window.baseUrl = document.getElementsByTagName('base')[0].href;
axios.defaults.baseURL = window.baseUrl + 'api';

const router = new VueRouter({
    mode: "hash",
    base: process.env.BASE_URL,
    routes: [
        {
          path: "/",
          name: "Score",
          component: Score,
          meta: {
            auth: true
          }
        },
        {
          path: "/rijschema",
          name: "Drivers",
          component: Drivers,
          meta: {
            auth: true
          }
        },
        {
          path: "/fluitschema",
          name: "Arbiters",
          component: Arbiters,
          meta: {
            auth: true
          }
        },
        {
          path: "/login",
          name: "Login",
          component: Login
        },
        {
          path: "/register",
          name: "Register",
          component: Register
        },      
      ]
});

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
});

new Vue({
    el: '#app',
    router: router,
    render: app => app(App)
});