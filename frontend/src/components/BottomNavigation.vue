<template>
  <v-bottom-navigation
    background-color="primary"
    color="white"
    grow
    shift
    app
  >

    <v-btn to="/">
      <span>Standen</span>

      <v-icon>mdi-format-list-numbered</v-icon>
    </v-btn>

    <v-btn to="/drivers">
      <span>Rijschema</span>

      <v-icon>mdi-car</v-icon>
    </v-btn>

    <v-btn to="/arbiters">
      <span>Fluitschema</span>

      <v-icon>mdi-whistle</v-icon>
    </v-btn>
  </v-bottom-navigation>
</template>

<style lang="scss" scoped>
.theme--light.v-bottom-navigation .v-btn:not(.v-btn--active){
    color: white !important;
}
</style>