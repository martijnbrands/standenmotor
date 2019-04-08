<template>
  <div>
    <div v-if="loading">
      <v-progress-linear :indeterminate="true"></v-progress-linear>
    </div>
    <div v-if="!loading">
      <v-card >
        <v-btn flat color="primary" @click="checkMatches();">Check wedstrijden</v-btn>

        <v-card-text class="py-0">
          <v-timeline align-top dense>
            <v-timeline-item color="warning" small>
              <v-layout wrap pt-3>
                <v-flex xs5>
                  <strong>12-01-2019</strong>
                  <div>12:00</div>
                </v-flex>
                <v-flex>
                  <strong class="d-block pb-3">Oss H2</strong>
                  <!-- <div
                    v-for="driverName in driver.driverNames"
                    :key="driverName.id"
                    class="mb-2"
                  >{{ driverName }}</div> -->
                </v-flex>
              </v-layout>
            </v-timeline-item>
          </v-timeline>
        </v-card-text>
      </v-card>
    </div>
  </div>
</template>

<script>
  import axios from "axios";
  export default {
    data() {
      return {
        loading: true,
        teamId: null,
        checkedMatches: [],
        matches: []
      }
    },
    created() {
      this.getTeamId();
    },
    methods: {
      checkMatches() {
        axios.get('https://mhc-oss-api.herokuapp.com/api/teams/' + this.teamId)
        .then((response) => {
            let checkedMatches = response.data.matches;
            this.checkedMatches = checkedMatches;
            this.updateMatches(checkedMatches);
        })
        .catch((error) => { });
      },

      updateMatches(checkedMatches) {
        axios.post('/matches/create', checkedMatches)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => { });
      },

      getSchedule() {
        axios.get('/matches/' + this.teamId)
          .then((response) => {
            console.log(response)
            this.loading = false
          })
          .catch((error) => {
            //
          });
      },

      getTeamId(){
      this.loading = true
      axios.get('/teamId')
        .then(response => {
          this.teamId = response.data;
          this.getSchedule();
        });
    },
    }
  }
</script>