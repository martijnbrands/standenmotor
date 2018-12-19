<template>
  <div v-if="arbiters.length > 0">
    <v-layout>
      <v-flex>
        <v-card tile v-for="(arbiter) in arbiters" :key="arbiter.id">
          <v-card-title primary-title>
            <div>
              <h3 class="subheading font-weight-bold">{{ arbiter.matchDate }}</h3>
              <div class="font-weight-light">{{ arbiter.teams }}</div>
              <div class="font-weight-medium">{{ arbiter.matchTime }}</div>
              <div class="font-weight-regular">{{ arbiter.umpires }}</div>
            </div>
          </v-card-title>
        </v-card>
      </v-flex>
    </v-layout>
  </div>
  <div v-else>
    <v-progress-linear :indeterminate="true"></v-progress-linear>
    <!-- <v-alert
        :value="true"
        type="warning">
        Er zijn op dit moment geen wedstrijden bekend.
    </v-alert>-->
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      arbiters: []
    };
  },
  mounted() {
    axios
      .get("https://mhc-oss-api.herokuapp.com/api/teams/Heren1_Zaal")
      .then(response => (this.arbiters = response.data.arbiters));
    // .then( response => console.log(response.data.arbiters))
  }
};
</script>