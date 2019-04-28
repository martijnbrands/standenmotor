<template>
  <div>
    <div v-if="loading">
      <v-progress-linear :indeterminate="true"></v-progress-linear>
    </div>
    <div v-if="!loading">
      <v-card >
        <v-card-text class="py-0">
          <v-timeline align-top dense v-for="match in matches" :key="match.matchId">
            <v-timeline-item color="warning" small>
              <v-layout wrap pt-3>
                <v-flex xs5>
                  <strong class="font-weight-bold">{{ formatDate(match.matchDate) }}</strong>
                  <div class="font-weight-medium">{{ formatTime(match.matchTime) }}</div>
                  <div class="font-weight-light">{{ match.field }}</div>
                </v-flex>
                <v-flex>
                  <strong class="d-block pb-3 font-weight-bold">{{ match.homeTeam }}</strong>
                    <!-- <div
                    v-for="player in players"
                    :key="player.id"
                    class="mb-2"
                  >{{ player.name }}</div> -->
                </v-flex>
              </v-layout>
              <v-btn flat small right color="warning" @click="dialog = !dialog">
                <v-icon>mdi-plus</v-icon>
              </v-btn>
            </v-timeline-item>
            <v-dialog v-model="dialog" max-width="500px" :fullscreen="true">
              <v-card>
                <v-card-text>
                    <!-- <v-alert :value="true" type="error" v-if="hasError" v-text="errorMessage"></v-alert> -->
                    <v-select
                      :items="players"
                      item-text="name"
                      item-value="id"
                      :menu-props="{ maxHeight: '300' }"
                      label="Select"
                      multiple
                      hint="Rijders toevoegen"
                      persistent-hint
                      single-line
                      v-model="selectedPlayers"
                    ></v-select>
                    <!-- <v-text-field v-model="playerName" label="Speler naam:"></v-text-field> -->
                </v-card-text>
                
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn small flat color="error" @click="dialog = !dialog">Annuleren</v-btn>
                    <v-btn flat color="primary" @click="addDrivers(match);">Opslaan</v-btn>
                </v-card-actions>
              </v-card>
          </v-dialog>
          </v-timeline>
        </v-card-text>
        
      </v-card>
      
      <v-card-text style="height: 100px;" position="relative">
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
        loading: true,
        teamId: null,
         dialog: false,
        checkedMatches: [],
        matches: [],
        players: [],
        selectedPlayers: []
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

      addDrivers(match) {
        axios.post('/matches/drivers',{
          'match': match,
          'players': this.selectedPlayers
        })
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
            this.loading = false
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