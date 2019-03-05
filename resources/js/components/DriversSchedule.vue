<template>
  <v-card >
    <v-card-text class="py-0">
      <v-timeline align-top dense>
        <v-timeline-item color="warning" small>
          <v-layout wrap pt-3>
            <!-- <v-flex xs5>
              <strong>{{ moment.unix(driver.playTime.seconds).format("DD-MM-YYYY") }}</strong>
              <div>{{ moment.unix(driver.playTime.seconds, 'Europe/Amsterdam').format("HH:mm") }}</div>
            </v-flex>
            <v-flex>
              <strong class="d-block pb-3">{{h }}</strong>
              <div
                v-for="driverName in driver.driverNames"
                :key="driverName.id"
                class="mb-2"
              >{{ driverName }}</div>
            </v-flex> -->
          </v-layout>
        </v-timeline-item>
      </v-timeline>
    </v-card-text>
  </v-card>
</template>