<template>
  <v-bottom-nav :value="true" app fixed color="primary">
    <v-btn to="/" color="white" flat value="standen">
      <span class="mdi mdi-format-list-numbered"></span>
    </v-btn>

    <v-btn to="/rijschema" color="white" flat value="rijschema">
      <span class="mdi mdi-car"></span>
    </v-btn>

    <v-btn to="/fluitschema" color="white" flat value="fluitschema">
      <span class="mdi mdi-whistle"></span>
    </v-btn>
  </v-bottom-nav>
</template>


<style lang="sass">
span
  font-size: 24px
</style>