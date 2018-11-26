import Vue from 'vue'
import Vuetify from 'vuetify/lib'
import 'vuetify/src/stylus/app.styl'

Vue.use(Vuetify, {
  theme: {
		primary: "#304FFE",
		secondary: "#304FFE",
		accent: "#FFD600",
		error: "#f44336",
		warning: "#FFC107",
		info: "#2196f3",
		success: "#4caf50"
	},
  iconfont: 'md',
})