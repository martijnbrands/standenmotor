<template>
  <div v-if="drivers.length > 0">
    <v-expansion-panel>
      <v-expansion-panel-content v-for="driver in drivers" :key="driver.id">
        <div class="team font-weight-medium" slot="header">{{ driver.team }}</div>
        <div class="date" slot="header">{{ moment.unix(driver.time.seconds).format("DD-MM-YYYY") }}</div>
        <!-- {{ moment.unix(driver.time.seconds).format("DD-MM-YYYY") }} -->
        <v-card class="driver_body">
          <v-card-text
            class="driver_names"
            v-for="driverName in driver.driver"
            :key="driverName.id"
          >{{ driverName }}</v-card-text>
        </v-card>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </div>
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
    db.collection("/drivers").orderBy('time', "asc").onSnapshot(res => {
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
      .then(response => (this.matches = response.data.matches));
  }
};
</script>

<style lang="sass">
.v-expansion-panel__header > *:not(.v-expansion-panel__header__icon)
  flex: 1 1

.driver_body
  padding: 16px
  
.driver_names
  padding: 0 0 0 16px
</style>