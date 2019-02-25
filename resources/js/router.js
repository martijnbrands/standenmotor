import Vue from "vue";
import Router from "vue-router";
import Score from "./pages/Score.vue";

Vue.use(Router);

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/test',
            name: 'score',
            component: Score
        }
    ]
});

export default router;


// import Vue from "vue";
// import Router from "vue-router";
// import Score from "./views/Score.vue";
// import Drivers from "./views/Drivers.vue";
// import Arbiters from "./views/Arbiters.vue";

// Vue.use(Router);

// export default new Router({
//   mode: "hash",
//   base: process.env.BASE_URL,
//   routes: [
//     {
//       path: "/",
//       name: "Score",
//       component: Score
//     },
//     {
//       path: "/rijschema",
//       name: "Drivers",
//       component: Drivers
//     },
//     {
//       path: "/fluitschema",
//       name: "Arbiters",
//       component: Arbiters
//     }
//   ]
// });