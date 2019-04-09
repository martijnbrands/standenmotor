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
                  <div class="mb-2">Martijn Brands</div>
                  <div class="mb-2">Danny Klaren</div>
                  <div class="mb-2">Martijn Brands</div>
                  <div class="mb-2">Danny Klaren</div>
                  <div class="mb-2">Martijn Brands</div>


                  <!-- <div
                    v-for="driverName in driver.driverNames"
                    :key="driverName.id"
                    class="mb-2"
                  >{{ driverName }}</div> -->
                </v-flex>
                <v-select
                  :items="players"
                  :menu-props="{ maxHeight: '400' }"
                  label="Select"
                  multiple
                  hint="Rijders toevoegen"
                  persistent-hint
                  single-line
                ></v-select>
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
        matches: [],
        players: [
          'Alabama', 'Alaska', 'American Samoa', 'Arizona',
          'Arkansas', 'California', 'Colorado', 'Connecticut',
          'Delaware', 'District of Columbia', 'Federated States of Micronesia',
          'Florida', 'Georgia', 'Guam', 'Hawaii', 'Idaho',
          'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky',
          'Louisiana', 'Maine', 'Marshall Islands', 'Maryland',
          'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi',
          'Missouri', 'Montana', 'Nebraska', 'Nevada',
          'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
          'North Carolina', 'North Dakota', 'Northern Mariana Islands', 'Ohio',
          'Oklahoma', 'Oregon', 'Palau', 'Pennsylvania', 'Puerto Rico',
          'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee',
          'Texas', 'Utah', 'Vermont', 'Virgin Island', 'Virginia',
          'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
        ]
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
            this.loading = false
            this.matches = response.data;
            
          })
          .catch((error) => {
            //
          });
      },

      getTeamId(){
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