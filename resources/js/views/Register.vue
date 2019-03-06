<template>
    <div>
        <v-subheader class="page_title">Register</v-subheader>
        <v-card class="pa-3">
            <v-form ref="form" lazy-validation @submit.prevent="register" v-if="!success" method="post">
                <v-text-field type="text" v-model="name" label="Name"></v-text-field>
                <v-text-field type="text" v-model="email" label="E-mail"></v-text-field>
                <v-text-field type="password"  v-model="password" label="Password"></v-text-field>
                <v-btn @click.prevent="register" color="primary">Register</v-btn>
            </v-form>
        </v-card>
    </div>
</template>

<script> 
    export default {
        data(){
            return {
                name: '',
                email: '',
                password: '',
                error: false,
                errors: {},
                success: false
            };
        }
    }
</script>

<style lang="sass">
.page_title
  padding: 0
</style>