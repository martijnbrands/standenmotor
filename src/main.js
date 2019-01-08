import Vue from "vue";
import "./plugins/axios";
import "./plugins/vuetify";
import App from "./App.vue";
import router from "./router";
import "./registerServiceWorker";
import "@mdi/font/css/materialdesignicons.css"; // Ensure you are using css-loader

import VueFire from "vuefire";
import firebase from "firebase/app";
import "firebase/firestore";

Vue.use(VueFire);
firebase.initializeApp({
  apiKey: "AIzaSyBzxzU0otHLRpYNm04NLbfosZ16rko8ums",
  authDomain: "fir-86cac.firebaseapp.com",
  databaseURL: "https://fir-86cac.firebaseio.com",
  projectId: "fir-86cac",
  storageBucket: "fir-86cac.appspot.com",
  messagingSenderId: "618984433812"
});

export const db = firebase.firestore();
db.settings({ timestampsInSnapshots: true });

Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App)
}).$mount("#app");
