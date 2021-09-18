<template>
    <v-app-bar app color="primary">
    <v-toolbar-title class="subtitle-1 font-weight-bold">
      <router-link to="/" class="white--text text-decoration-none">
      Heren 2
      <div class="body-2 ">Doelpunten &amp; Assists</div>
      </router-link>
    </v-toolbar-title>
    <v-spacer></v-spacer>

      <v-menu
        left
        bottom
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            icon
            v-bind="attrs"
            v-on="on"
            color="white"
          >
            <v-icon >mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item
          v-if="!authenticated"
            @click="$router.push('/login')"
          >
            <v-list-item-title>Login</v-list-item-title>
          </v-list-item>
          <v-list-item
          v-else
            @click="logout"
          >
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
  </v-app-bar>
</template>

<script>
import { computed } from "@vue/composition-api";
import store from "@/store";

export default {
  setup() {

    const logout = () => {
      store.dispatch("signOut");
    }

    return {
      logout,
      authenticated: computed(() => store.state.authenticated),
    };
  },
};
</script>
