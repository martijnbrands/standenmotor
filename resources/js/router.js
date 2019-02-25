import Vue from "vue";
import Router from "vue-router";
import Score from "./views/Score.vue";
import Drivers from "./views/Drivers.vue";
import Arbiters from "./views/Arbiters.vue";
import Register from "./views/Register.vue";
import Login from "./views/Login.vue";

Vue.use(Router);

export default new Router({
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

Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
});