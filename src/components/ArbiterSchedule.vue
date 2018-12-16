<template>
  <div v-if="arbiters.length > 0">
    <v-layout>
    <v-flex>
      <v-card tile v-for="(arbiter) in arbiters" :key="arbiter.id">
        <v-card-title primary-title>
          <div>
            <h3 class="subheading font-weight-bold">{{ arbiter.matchDate }}</h3>
            <div class="font-weight-thin">{{ arbiter.teams }}</div>
            <div class="font-weight-medium">{{ arbiter.matchTime }}</div>
            <div class="font-weight-light">{{ arbiter.umpires }}</div>
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
      </v-alert> -->
  </div>

</template>

<script>
import axios from 'axios'
  export default {
    data () {
      return {
        arbiters:[],
        items: [
          {
            header: 'Zaterdag 17 November'
          },
          { divider: true },
          {
            title: "JA3 – Liempde JA1",
            time: "13:45",
            subtitle: "Martijn Brands, Joep de Vet"
          },
          {
            header: 'Zaterdag 24 november'
          },
          { divider: true },
          {
            title: "MA4 – Den Bosch MA3",
            time: "15:30",
            subtitle: "Joep van Rooij, Thorold Verwijlen"
          },
          {
            title: "JB3 – Dommel JB1",
            time: "17:15",
            subtitle: "Levi Tulkens, Stan Vos"
          }         
        ]
      }
    },
    mounted () {
    axios
      .get('https://mhc-oss-api.herokuapp.com/api/teams/Heren1_Zaal')
      .then(response => (this.arbiters = response.data.arbiters))
      // .then( response => console.log(response.data.arbiters))
    }
  }
</script>