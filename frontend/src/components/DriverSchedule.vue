<template>
  <v-card>
    <v-timeline align-top dense>
      <v-timeline-item
        v-for="match in matches"
        :key="match._id"
        right
        small
        color="secondary"
      >
        <v-row>
          <v-col cols="5" class="px-0">
            <strong class="subtitle-2">{{ match.matchDate }}</strong>
            <p class="subtitle-2 font-weight-light">{{ match.matchTime }}</p>
          </v-col>
          <v-col cols="6" class="px-0">
            <strong class="subtitle-2 d-block mb-2">{{
              match.homeTeam
            }}</strong>
            <p
              class="caption mb-1"
              v-for="driver in match.driverIDs"
              :key="driver.id"
            >
              {{ driver.name }}
            </p>
          </v-col>
        </v-row></v-timeline-item
      >
    </v-timeline>
  </v-card>
</template>

<script>
import { onMounted, computed } from "@vue/composition-api";
import store from "@/store";

export default {
  setup() {
    onMounted(() => {
      store.dispatch("getMatches");
    });

    return {
      matches: computed(() => store.state.matches),
    };
  },
};
</script>
