<template>
  <div>
    <v-subheader class="page_title">Login</v-subheader>
    <v-card class="pa-3">
      <v-form ref="form" lazy-validation>
        <v-text-field type="text" v-model="email" label="E-mail"></v-text-field>
        <v-text-field
          v-model="password"
          :append-icon="show1 ? 'visibility_off' : 'visibility'"
          :type="show1 ? 'text' : 'password'"
          name="input-10-1"
          label="Password"
          @click:append="show1 = !show1"
        ></v-text-field>
        <v-btn @click.prevent="login" color="primary">Login</v-btn>
      </v-form>
    </v-card>
  </div>
</template>

 <script>
import { auth } from "../main";

export default {
  data() {
    return {
      email: "",
      password: "",
      show1: false,
      rules: {
        required: value => !!value || "Verplicht."
      }
    };
  },
  methods: {
    /* eslint-disable no-console */
    login: function() {
      auth
        .signInWithEmailAndPassword(this.email, this.password)
        .then(user => {
          alert("fjelafjlasfkjsad");
          console.log(user);
          this.$router.replace("/");
        })
        .catch(err => {
          console.log(err);
        });

      /* eslint-enable no-console */
      // this.$router.replace("/");
      // auth.signInWithEmailAndPassword(this.email, this.password).then(
      //   () => {
      //     this.$router.replace("/");
      //   }
      //   this.$router.replace("/");
      // );
    },
    logout: function() {
      auth.signOut().then(() => {
        this.$router.replace("login");
      });
    }
  }
};
</script>



 <style lang="sass">
.page_title
  padding: 0
</style>