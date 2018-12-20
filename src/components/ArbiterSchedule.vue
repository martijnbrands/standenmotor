<template>
  <div v-if="arbiters.length > 0">
    <v-layout>
      <v-flex>
        <v-card tile v-for="(arbiter) in arbiters" :key="arbiter.id">
          <v-card-title primary-title>
            <div>
              <div v-if="arbiter.matchDate">
                <h3 class="subheading font-weight-bold">{{ arbiter.matchDate }}</h3>
              </div>

              <div class="team font-weight-medium">{{ arbiter.teams }}</div>
              <div class="match_time font-weight-medium">{{ arbiter.matchTime }}</div>
              <div class="umpires font-weight-regular">{{ arbiter.umpires }}</div>
              <div class="location font-weight-light">{{ arbiter.location }}</div>
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

<style lang="sass">
.subheading
  padding-bottom: 12px
.match_time
    background: #f1f1f1
    padding: 4px
    border-radius: 4px
.team
  margin-right: 16px
.team,
.match_time
  display: inline-block 
</style>