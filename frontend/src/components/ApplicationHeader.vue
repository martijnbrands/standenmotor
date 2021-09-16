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
          >
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item
            v-for="n in 5"
            :key="n"
            @click="() => {}"
          >
            <v-list-item-title>Option {{ n }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
  </v-app-bar>
</template>