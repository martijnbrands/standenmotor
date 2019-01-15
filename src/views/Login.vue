<template>
  <div>
    <v-subheader class="page_title">Login</v-subheader>
    <v-form ref="form" lazy-validation>
      <v-text-field label="E-mail"></v-text-field>
      <v-text-field
        :append-icon="show1 ? 'visibility_off' : 'visibility'"
        :type="show1 ? 'text' : 'password'"
        name="input-10-1"
        label="Password"
        @click:append="show1 = !show1"
      ></v-text-field>
      <v-btn color="primary">Login</v-btn>
    </v-form>
  </div>
</template>

 <script>
export default {
  data() {
    return {
      show1: false,
      rules: {
        required: value => !!value || "Verplicht."
      }
    };
  }
};
</script>



 <style lang="sass">
.page_title
  padding: 0
</style>