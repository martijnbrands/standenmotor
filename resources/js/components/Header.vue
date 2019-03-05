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
         <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>

      <!-- <v-list>
        <v-list-tile>
          <router-link to="/login">
            <ul>
                <li v-if="!$auth.check()" class="pull-right">
                  <router-link :to="{ name: 'login' }">Login</router-link>
                </li>
              <li v-if="!$auth.check()" class="pull-right">
                        <router-link :to="{ name: 'register' }">Register</router-link>
            <li v-if="$auth.check()" class="pull-right">
                        <a href="#" @click.prevent="$auth.logout()">Logout</a>
                    </li>
              </ul>
          </router-link>
        </v-list-tile>
      </v-list> -->
    </v-menu>
  </v-toolbar>
</template>