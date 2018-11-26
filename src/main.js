import Vue from 'vue'
import './plugins/axios'
import './plugins/vuetify'
import App from './App.vue'
import router from './router'
import './registerServiceWorker'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
