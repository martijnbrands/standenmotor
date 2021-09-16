import Vue from 'vue'
import VueRouter from 'vue-router'
import Score from '@/views/Score.vue'
import Drivers from '@/views/Drivers.vue'
import Arbiters from '@/views/Arbiters.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Score',
    component: Score
  },
  {
    path: '/drivers',
    name: 'Drivers',
    component: Drivers
  },
  {
    path: '/arbiters',
    name: 'Arbiters',
    component: Arbiters
  },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
