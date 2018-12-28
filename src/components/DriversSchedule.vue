<template>
  <!-- <v-card v-if="drivers.length > 0">
    <v-card-text class="py-0">
      <v-timeline align-top dense v-for="driver in drivers" :key="driver.id">
        <v-timeline-item color="warning" small>
          <v-layout wrap pt-3>
            <v-flex xs5>
              <strong>{{ moment.unix(driver.time.seconds).format("DD-MM-YYYY") }}</strong>
            </v-flex>
            <v-flex>
              <strong class="d-block pb-3">{{ driver.team }}</strong>
              <div
                v-for="driverName in driver.driver"
                :key="driverName.id"
                class="mb-2"
              >{{ driverName }}</div>
            </v-flex>
          </v-layout>
        </v-timeline-item>
      </v-timeline>
    </v-card-text>
  </v-card>
  <div v-else>
    <v-progress-linear :indeterminate="true"></v-progress-linear>
  </div> -->
  <v-card v-if="drivers.length > 0">
    <v-card-text class="py-0">
      <v-timeline align-top dense v-for="driver in drivers" :key="driver.id">
        <v-timeline-item color="warning" small>
          <v-layout wrap pt-3>
            <v-flex xs5>
               <strong>{{ moment.unix(driver.playTime.seconds).format("DD-MM-YYYY") }}</strong>
            </v-flex>
            <v-flex>
              <strong class="d-block pb-3">{{ driver.homeTeam }}</strong>
              <div
                v-for="driverName in driver.driverNames"
                :key="driverName.id"
                class="mb-2"
              >{{ driverName }}</div>
            </v-flex>
              
            
          </v-layout>
        </v-timeline-item>
      </v-timeline>
    </v-card-text>
  </v-card>
  <div v-else>
    <v-progress-linear :indeterminate="true"></v-progress-linear>
  </div>
</template>

<script>
import axios from "axios";
import db from "@/firebase";
var moment = require("moment");

export default {
  data() {
    return {
      moment: moment,
      drivers: []
    };
  },
  created() {
    db.collection("/users")
      .orderBy("playTime", "asc")
      .onSnapshot(res => {
        const changes = res.docChanges();

        changes.forEach(change => {
          if (change.type === "added") {
            this.drivers.push({
              ...change.doc.data(),
              id: change.doc.id
            });
          }
        });
      });
  },
  mounted() {
    axios
      .get("https://mhc-oss-api.herokuapp.com/api/teams/Heren2")
      .then( response => {

        for (let index = 0; index < response.data.matches.length; index++) {
           db.collection("users").doc(response.data.matches[index].gameId).set({
            playTime: new Date(moment(response.data.matches[index].playTime, "DD-MM-YYYY").format("MM-DD-YYYY")),
            homeTeam: response.data.matches[index].homeTeam,
            awayTeam: response.data.matches[index].awayTeam
        },{merge: true})
                  
        }
          
      })
      
  }
};
</script>