<template>
  <v-layout justify-center>
    
    <v-flex>
      <v-alert v-if="arbiters == ''"
        :value="true"
        type="warning">
        Er zijn op dit moment geen wedstrijden ingepland.
      </v-alert>
      <v-card>

        <v-list three-line>
          <template v-for="(arbiter, index) in arbiters">
            <v-subheader v-if="arbiter.matchDate" :key="arbiter.matchDate">
              {{ arbiter.matchDate }}
            </v-subheader>

            <v-divider
              v-else
              :key="index"
              
            ></v-divider>


            <v-list-tile
              :key="arbiter.teams"
            >
              <v-list-tile-content>
                <v-list-tile-title v-html="arbiter.teams"></v-list-tile-title>
                <v-list-tile-sub-title v-html="arbiter.matchTime"></v-list-tile-sub-title>
                <v-list-tile-sub-title v-html="arbiter.umpires"></v-list-tile-sub-title>
              </v-list-tile-content>
            </v-list-tile>
          </template>
        </v-list>
      </v-card>
    </v-flex>
  </v-layout>

</template>

<script>
  import axios from 'axios';

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
      .get('https://mhc-oss-api.herokuapp.com/api/teams/Heren3')
      .then(response => (this.arbiters = response.data.arbiters))
      // .then( response => console.log(response.data.arbiters))
    }
  }
</script>