<template>
  <v-toolbar app fixed dark color="primary">
    <router-link to="/">
          <v-toolbar-title>
          Heren 2
          <div class="subheading">Doelpunten & Assists</div>
        </v-toolbar-title>
      </router-link>
    <v-spacer></v-spacer>
    <v-menu :nudge-width="100">
        <v-toolbar-title slot="activator">
          <span>2018/2019</span>
          <v-icon dark>arrow_drop_down</v-icon>
        </v-toolbar-title>

        <v-list>
          <v-list-tile
            v-for="item in items"
            :key="item"
            on-click=""
            to="/#"
          >
            <v-list-tile-title v-text="item"></v-list-tile-title>
          </v-list-tile>
        </v-list>
    </v-menu>
  </v-toolbar>
</template>

<script>
  export default {
    data: () => ({
      items: [
        '2018/2019', '2017/2018', '2016/2017'
      ]
    })
  }
</script>

<style module lang="sass">
</style>
