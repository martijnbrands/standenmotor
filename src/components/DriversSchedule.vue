<template>
  <v-card v-if="drivers.length > 0">
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
    db.collection("/drivers")
      .orderBy("time", "asc")
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
      .then(response => (this.matches = response.data.matches));
  }
};
</script>