<template>
  <div>
    <v-subheader>Login</v-subheader>
    <v-card>
      <v-form>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="user.email"
                label="E-mail"
                :rules="emailRules"
                required
              ></v-text-field>
            </v-col>

            <v-col cols="12">
              <v-text-field
                v-model="user.password"
                label="Password"
                :rules="passwordRules"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :type="showPassword ? 'text' : 'password'"
                @click:append="showPassword = !showPassword"
                required
              ></v-text-field>
            </v-col>
            <v-col cols="12">
              <v-btn @click="login" color="primary">Login</v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-form>
    </v-card>
  </div>
</template>

<script>
import { ref, reactive } from "@vue/composition-api";
import store from "@/store";

export default {
  setup() {
    const user = reactive({
      email: "",
      password: "",
    });

    const emailRules = ref([
      (value) => !!value || "E-mail is required",
      (value) => /.+@.+/.test(value) || "E-mail must be valid",
    ]);

    const passwordRules = ref([
        (value) => !!value || "Password is required.",
        (value) => value.length >= 8 || "Min 8 characters",
    ]);

    const showPassword = ref(false);

    const login = async () => {
        store.dispatch("signIn", user);
    };
    return {
      user,
      emailRules,
      passwordRules,
      showPassword,
      login,
    };
  },
};
</script>

<style lang="scss" scoped>
.v-subheader {
  padding: 0 16px 0 0;
}
</style>
