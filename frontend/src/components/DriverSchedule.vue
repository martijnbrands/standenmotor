<template>
  <v-card class="px-4">
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
        </v-row>
        <div v-if="authenticated">
          <v-select
            v-model="match.driverIDs"
            :items="players"
            label="Select"
            multiple
            item-text="name"
            return-object
          />

          <v-btn @click="updateMatch(match)" color="secondary">Opslaan</v-btn>
        </div>
      </v-timeline-item>
    </v-timeline>
  </v-card>
</template>

<script>
import { onMounted, computed } from "@vue/composition-api";
import store from "@/store";

export default {
  setup() {
    const updateMatch = async (match) => {
      try {
        await store.dispatch("updateMatch", match);
        await store.dispatch("getMatches");
      } catch (error) {
        console.log(error);
      }
    };

    onMounted(async () => {
      try {
        await store.dispatch("getMatches");
        await store.dispatch("getPlayers");
      } catch (error) {
        console.log(error);
      }
    });

    return {
      updateMatch,
      matches: computed(() => store.state.matches),
      players: computed(() => store.state.players),
      authenticated: computed(() => store.state.authenticated),
    };
  },
};
</script>
