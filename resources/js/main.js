import Vue from "vue";
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from "./App.vue";



import Score from "./views/Score.vue";
import Drivers from "./views/Drivers.vue";
import Arbiters from "./views/Arbiters.vue";
import Register from "./views/Register.vue";
import Login from "./views/Login.vue";

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

Vue.use( Vuetify, {
  theme: {
  primary: "#304FFE",
  secondary: "#304FFE",
  accent: "#FFD600",
  error: "#f44336",
  warning: "#FFC107",
  info: "#2196f3",
  success: "#4caf50",
},
  iconfont: 'mdi',
});


const router = new VueRouter({
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
      component: Arbiters,
      meta: {
        auth: true
      }
    },
    {
      path: "/register",
      name: "Register",
      component: Register,
      meta: {
        auth: false
      }
    },
    {
      path: "/login",
      name: "Login",
      component: Login,
      meta: {
        auth: false
      }
    },

  ]
});

Vue.router = router;

Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
});

App.router = Vue.router;

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app');