<template>
  <div v-if="drivers.length > 0">
    <v-expansion-panel>
      <v-expansion-panel-content v-for="driver in drivers" :key="driver.id" >
        <div class="team font-weight-medium" slot="header">{{ driver.team }}</div>
        <div class="date" slot="header">{{ driver.time }}</div>
        <v-card class="driver_body">
          <v-card-text class="driver_names" v-for="driverName in driver.driver" :key="driverName.id" >{{ driverName }}</v-card-text>
        </v-card>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </div>
  <div v-else>
    <v-progress-linear :indeterminate="true"></v-progress-linear>
  </div>
</template>

<script>
import axios from 'axios'
import db from '@/firebase'

  export default {
    data () {
      return {
        drivers: []
      }
    },
    created(){
      db.collection('/drivers').onSnapshot(res =>{
        const changes = res.docChanges();

        changes.forEach(change => {
          if (change.type === 'added'){
            this.drivers.push({
              ...change.doc.data(),
              id: change.doc.id
            })
          }  
        });
      })
    },
    mounted () {
    axios
      .get('https://mhc-oss-api.herokuapp.com/api/teams/Heren2')
      // .get('https://mhc-oss-api.herokuapp.com/api/teams/Heren1_Zaal')
      .then(response => (this.matches = response.data.matches))
      //.then( response => console.log(response.data.matches))
    }
  }
</script>

<style lang="sass">
.driver_body
  padding: 16px
.driver_names
  padding: 0 0 0 16px
</style>