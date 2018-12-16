import Vue from 'vue'
import Router from 'vue-router'


Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'Score',
      component: () => import(/* webpackChunkName: "Score" */ './views/Score.vue')
    },
    {
      path: '/rijschema',
      name: 'Drivers',
      component: () => import(/* webpackChunkName: "Drivers" */ './views/Drivers.vue')
    },
    {
      path: '/fluitschema',
      name: 'Arbiters',
      component: () => import(/* webpackChunkName: "Arbiters" */ './views/Arbiters.vue')
    }
  ]
})
