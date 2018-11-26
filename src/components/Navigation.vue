<template>
    <v-bottom-nav :value="true" fixed color="primary">
      <v-btn to="/"
        color="white"
        flat
        value="standen"
      >
        <span style="font-size: 24px;" class="mdi mdi-format-list-numbers"></span>
      </v-btn>

      <v-btn to="/rijschema"
        color="white"
        flat
        value="rijschema"
      >
        <span style="font-size: 24px;" class="mdi mdi-car"></span>
      </v-btn>

      <v-btn to="/fluitschema"
        color="white"
        flat
        value="fluitdienst"
      >
        <span style="font-size: 24px;" class="mdi mdi-whistle"></span>
      </v-btn>
    </v-bottom-nav>
</template>