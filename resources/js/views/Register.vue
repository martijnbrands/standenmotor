<template>
    <div>
        <v-subheader class="page_title">Register</v-subheader>
        <v-card class="pa-3">
            <v-alert
            :value="true"
            type="error" 
            v-if="error && !success"
            >
            There was an error, unable to complete registration
            </v-alert>
            <v-alert
            :value="true"
            type="success" 
            v-if="success"
            >
            Registration completed. You can now <router-link to="/login">login.</router-link>
            </v-alert>
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
        },

        methods: {
            register(){
                var app = this;
                this.$auth.register({
                    data: {
                        name: app.name,
                        email: app.email,
                        password: app.password
                    }, 
                    success: function () {
                        app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });                
            }
        }
    }
</script>

<style lang="sass">
.page_title
  padding: 0
</style>