<template>
  <div>
    <div v-if="loading">
      <v-progress-linear :indeterminate="true"></v-progress-linear>
    </div>
    <div v-if="!loading">
        <v-alert v-if="arbiters.length <= 0"
        :value="true"
        type="warning">
        Er zijn op dit moment geen wedstrijden om te fluiten.
        </v-alert>

      <v-flex>
         <v-card tile v-for="(arbiter) in arbiters" :key="arbiter.id">
          <v-card-title primary-title class="py-4">
            <div>
              <div v-if="arbiter.matchDate">
                <h3 class="subheading match_date font-weight-bold pb-3">{{ arbiter.matchDate }}</h3>
              </div>
              <div class="team font-weight-medium d-inline-block mr-4">{{ arbiter.teams }}</div>
              <div class="match_time font-weight-medium d-inline-block">{{ arbiter.matchTime }}</div>
              <div class="umpires font-weight-regular">{{ arbiter.umpires }}</div>
              <div class="location font-weight-light">{{ arbiter.location }}</div>
            </div>
          </v-card-title>
        </v-card>
      </v-flex>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      arbiters: [],
      loading: false
    };
  },
  mounted() {
    this.loading = true

    axios
      .get("https://mhc-oss-api.herokuapp.com/api/teams/Heren2")
      .then(response => {
         this.loading = false
          this.arbiters = response.data.arbiters
          }
        );
  }
};
</script>

<style lang="sass">
.match_time
    background: #f1f1f1
    padding: 4px
    border-radius: 4px
</style>