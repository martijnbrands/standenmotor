<template>
  <div>
    <div v-if="loading">
      <v-progress-linear :indeterminate="true"></v-progress-linear>
    </div>
    <div v-if="!loading">
      <v-alert
        v-if="arbiters.length <= 0"
        class="black--text"
        :value="true"
        type="warning"
      >Er zijn op dit moment geen wedstrijden om te fluiten.</v-alert>
      <v-flex>
        <v-card>
          <v-card tile flat v-for="arbiter in arbiters" :key="arbiter.id">
            <v-card-title primary-title class="py-4">
              <div>
                <div v-if="arbiter.matchDate">
                  <h3 class="subheading match_date font-weight-bold pb-3">{{ arbiter.matchDate }}</h3>
                </div>
                <div class="team font-weight-medium d-inline-block mr-4">{{ arbiter.teams }}</div>
                <div class="match_time font-weight-medium d-inline-block">{{ arbiter.matchTime }}</div>
                <div class="umpires font-weight-regular">{{ arbiter.umpires }}</div>
                <div class="field font-weight-light">{{ arbiter.field }}</div>
                <div class="location font-weight-light">{{ arbiter.location }}</div>
              </div>
            </v-card-title>
          </v-card>
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
      teamId: null,
      arbiters: [],
      loading: false
    };
  },
  created() {
    this.getTeamId();
  },
  methods: {
    getTeamId() {
      this.loading = true;
      axios.get("/teamId").then(response => {
        this.teamId = response.data;
        this.getArbiters();
      });
    },
    getArbiters() {
      axios
        .get("https://mhc-oss-api.herokuapp.com/api/teams/" + this.teamId)
        .then(response => {
          this.arbiters = response.data.arbiters;
          this.loading = false;
        });
    }
  }
};
</script>

<style lang="sass">
.match_time
    background: #f1f1f1
    padding: 4px
    border-radius: 4px
</style>