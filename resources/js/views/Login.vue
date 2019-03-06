<template>
    <div>
        <v-subheader class="page_title">Login</v-subheader>
        <v-card class="pa-3">
            <v-form ref="form" lazy-validation @submit.prevent="login" method="post" action="/login">
                <v-text-field type="text" v-model="email" label="E-mail"></v-text-field>
                <v-text-field type="password"  v-model="password" label="Password"></v-text-field>
                <v-btn @click.prevent="login" color="primary">Login</v-btn>
            </v-form>
        </v-card>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        email: null,
        password: null,
        error: false
      }
    }
  } 
</script>

<style lang="sass">
.page_title
  padding: 0
</style>