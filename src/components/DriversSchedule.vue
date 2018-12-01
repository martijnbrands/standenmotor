<template>
  <div v-if="matches.length > 0">
    <v-expansion-panel>
      <v-expansion-panel-content v-for="item in matches" :key="item.date" >
        <div class="team" slot="header">{{ item.homeTeam }}</div>
        <div class="date" slot="header">{{ item.playTime }}</div>
        <v-card >
          <v-card-text class="driver_names" v-for="item in matches" :key="item.name" >{{item.playTime}}</v-card-text>
        </v-card>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </div>
  <div v-else>
    <v-alert
        :value="true"
        type="warning">
        Er zijn op dit moment geen wedstrijden bekend.
      </v-alert>
  </div>
</template>

<script>

  export default {
    data () {
      return {
        matches: [],
        driverList: [
          {
            date: 'Zaterdag 23 Oktober', 
            drivers: [
              {
                name: 'Martijn Brands'
              },
              { 
                name: 'Sander Brands'
              }
            ]
          },
          {
            date: 'Zondag 17 November', 
            drivers: [
              {
                name: 'Sander Brands'
              },
              { 
                name: 'Martijn Brands'
              }
            ]
          }
        ]
      }
    },
    mounted () {
    axios
      .get('https://mhc-oss-api.herokuapp.com/api/teams/Heren1_Zaal')
      .then(response => (this.matches = response.data.matches))
      //.then( response => console.log(response.data.matches))
    }
  }
</script>

<style module lang="sass">
  .v-card__text.driver_names
    padding: 5px 0 !important
</style>