<template>
  <v-toolbar app fixed color="primary">
    <router-link to="/" color="secondary">
      <v-toolbar-title class="subheading font-weight-bold white--text">Heren 2
        <div class="body-1">Doelpunten & Assists</div>
      </v-toolbar-title>
    </router-link>
    <v-spacer></v-spacer>
    <v-menu bottom left origin="center center" transition="slide-y-transition">
      <v-btn slot="activator" dark icon>
        <v-icon>more_vert</v-icon>
      </v-btn>

      <v-list>
        <v-list-tile>
          <router-link to="/login">
            <v-list-tile-title>Login</v-list-tile-title>
          </router-link>
        </v-list-tile>
      </v-list>
    </v-menu>
  </v-toolbar>
</template>