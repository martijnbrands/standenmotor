import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import VueRouter from 'vue-router';
import App from './App.vue';

import Score from "./views/Score.vue";
import Drivers from "./views/Drivers.vue";
import Arbiters from "./views/Arbiters.vue";
import Register from "./views/Register.vue";
import Login from "./views/Login.vue";

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
Vue.use(VueRouter)

const router = new VueRouter({
    mode: "hash",
    base: process.env.BASE_URL,
    routes: [
        {
          path: "/",
          name: "Score",
          component: Score
        },
        {
          path: "/rijschema",
          name: "Drivers",
          component: Drivers
        },
        {
          path: "/fluitschema",
          name: "Arbiters",
          component: Arbiters
        }
      ]
});

new Vue({
    el: '#app',
    router: router,
    render: app => app(App)
});