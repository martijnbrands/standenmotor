<template>
  <div>
      <v-card >
        <v-card-text class="py-0">
          <v-timeline align-top dense v-for="match in matches" :key="match.matchId">
            <v-timeline-item color="warning" small>
              <v-layout wrap pt-3>
                <v-flex xs5>
                  <strong>{{ formatDate(match.matchDate) }}</strong>
                  <div>{{ formatTime(match.matchTime) }}</div>
                </v-flex>
                <v-flex>
                  <strong class="d-block pb-3">{{ match.homeTeam }}</strong>
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
      <v-card-text style="height: 100px;" position="relative">
      		<v-btn fixed small fab bottom right color="warning" @click="checkMatches();">
        		<v-icon>mdi-refresh</v-icon>
      		</v-btn>
    </v-card-text>
  </div>
</template>

<script>
  import moment from 'moment';
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
        .catch((error) => {
           console.log(error);
         });
      },

      updateMatches(checkedMatches) {
        axios.post('/matches/create', checkedMatches)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
         });
      },

      getSchedule() {
        axios.get('/matches/' + this.teamId)
          .then((response) => {
            console.log(response)
            this.loading = false
            this.matches = response.data;
          })
          .catch((error) => {
            //
          });
      },

      getTeamId(){
      this.loading = false;
      axios.get('/teamId')
        .then(response => {
          this.teamId = response.data;
          this.getSchedule();
        });
      },

      formatDate: function(date) {
        return moment(date).format("DD-MM-YYYY");
      },
      formatTime: function(time) {
        return moment(time, "HH:mm:ss").format("HH:mm");
      },
    }
  }
</script>