<template>
  <div>
    <div v-if="loading">
      <v-progress-linear :indeterminate="true"></v-progress-linear>
    </div>
    <v-dialog
          v-model="loadingIndicator"
          persistent
          width="300"
        >
          <v-card
            color="primary"
            dark
          >
            <v-card-text>
             Een moment geduld a.u.b.
              <v-progress-linear
                indeterminate
                color="white"
                class="mb-0"
              ></v-progress-linear>
            </v-card-text>
          </v-card>
        </v-dialog>
    <div v-if="!loading">
      <v-card >
        <v-card-text class="py-0">
          <v-timeline align-top dense v-for="(match, index) in matches" :key="match.index">
            <v-timeline-item color="warning" small>
              <v-layout wrap pt-3>
                <v-flex xs5>
                  <strong class="font-weight-bold">{{ formatDate(match.matchDate) }}</strong>
                  <div class="font-weight-medium">{{ formatTime(match.matchTime) }}</div>
                  <div class="font-weight-light">{{ match.field }}</div>
                </v-flex>
                <v-flex>
                  <strong class="d-block pb-3 font-weight-bold">{{ match.homeTeam }}</strong>
                  <div v-if="$auth.user().account_type =! 'team_admin'">
                    <div v-for="driver in match.players" :key="driver.id" class="mb-2">{{ driver.name }}</div>
                  </div>
                </v-flex>
                
              </v-layout>
              <div v-if="$auth.user().account_type = 'team_admin'">
                   <v-select class="d-block"
                        clearable
                        :items="players"
                        item-text="name"
                        item-value="id"
                        :menu-props="{ maxHeight: '300' }"
                        label="Select"
                        multiple
                        single-line
                        hint="Rijders toevoegen"
                        v-model="match.players"
                      >
                      </v-select>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn small color="primary" @click="addDrivers(match, match.players, index);">Opslaan</v-btn>
                    </v-card-actions>
              </div>
            </v-timeline-item>
          </v-timeline>
        </v-card-text>
      </v-card>
      
      <v-card-text  v-if="$auth.user().account_type = 'team_admin'" style="height: 100px;" position="relative">
      		<v-btn fixed small fab bottom right color="warning" @click="checkMatches();">
        		<v-icon>mdi-refresh</v-icon>
      		</v-btn>
    </v-card-text>
  </div>
  </div>
</template>

<script>
  import moment from 'moment';
  import axios from "axios";
  export default {
    data() {
      return {
        loadingIndicator: false,
        loading: true,
        teamId: null,
        dialog: false,
        checkedMatches: [],
        matches: [],
        players: []
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
      addDrivers(match, players, index) {
        this.loadingIndicator = true;
        axios.post('/matches/drivers',{
          'match': match,
          'players': players
        })
        .then((response) => {
          this.matches[index].players = response.data.players;
          setTimeout(() => (this.loadingIndicator = false), 1000)
        })
        .catch((error) => {
          console.log(error);
         });
      },


      getSchedule() {
        axios.get('/matches/' + this.teamId)
          .then((response) => {
            this.loading = false;
            this.matches = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      },

      getTeamId(){
        axios.get('/teamId')
          .then(response => {
            this.teamId = response.data;
            this.getSchedule();
            this.getPlayers();
          });
        },
        getPlayers() {
          axios.get("/teams/" + this.teamId + "/players")
          .then((response) => {
            console.log(response.data)
            this.players = response.data.data;
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

<style>
</style>
