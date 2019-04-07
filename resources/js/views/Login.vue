<template>
  <div>
    <v-subheader class="page_title">Login</v-subheader>
    <v-card class="pa-3">
      <v-alert
        :value="true"
        type="error" 
        v-if="error && !success"
        >
      There was an error, unable to complete registration
      </v-alert>
      <v-form ref="form" lazy-validation @submit.prevent="login" method="post" action="/login">
        <v-text-field type="text" v-model="email" label="E-mail"></v-text-field>
        <v-text-field type="password" v-model="password" label="Password"></v-text-field>
        <v-btn @click.prevent="login" color="primary">Login</v-btn>
      </v-form>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
		return {
			email: null,
			password: null,
			error: false
		};
	},
	methods: {
		login() {
			var app = this;
			this.$auth.login({
				params: {
				email: app.email,
				password: app.password
				},
				success: function() {},
				error: function() {},
				rememberMe: true,
				redirect: "/",
				fetchUser: true
			});
		}
	}
};
</script>

<style lang="sass">
.page_title
  padding: 0
</style>