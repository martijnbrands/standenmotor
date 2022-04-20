<template>
  <div>
    <div v-if="loading">
      <v-progress-linear indeterminate></v-progress-linear>
    </div>
    <v-card class="px-4" v-if="matches.length && !loading">
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
              <strong class="subtitle-2">{{
                moment(match.matchDateTime)
                  .format("DD/MM/YYYY")
              }}</strong>
              <p class="subtitle-2 font-weight-light">
                {{ moment(match.matchDateTime).format("H:mm") }}
              </p>
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
              label="Select drivers"
              multiple
              item-text="name"
              return-object
            />
            <v-row>
              <v-col cols="6">
                <v-select
                  :items="shirtColors"
                  label="Select shirt"
                  item-text="name"
                />
              </v-col>
              <v-col cols="6">
                <v-select
                  :items="sockColors"
                  label="Select socks"
                  item-text="name"
                />
              </v-col>
            </v-row>

            <v-btn @click="updateMatch(match)" color="secondary">Opslaan</v-btn>
          </div>
        </v-timeline-item>
      </v-timeline>
    </v-card>
     <div v-if="!matches.length && !loading">
      <v-alert type="warning">
        Er zijn op dit moment geen rijbeurten.
      </v-alert>
    </div>
  </div>
</template>

<script>
import { onMounted, computed, ref, onBeforeMount } from "@vue/composition-api";
import store from "@/store";
import moment from "moment";

export default {
  setup() {
    const loading = ref(true);
    const shirtColors = ref(["white", "yellow"]);
    const sockColors = ref(["blue", "white"]);

    const updateMatch = async (match) => {
      try {
        await store.dispatch("updateMatch", match);
        await store.dispatch("getMatches");
      } catch (error) {
        console.log(error);
      }
    };

    const databaseMatches = computed(() => {
      return store.state.matches.map((match) => {
        return match.matchId;
      });
    });

    const apiMatches = computed(() => {
      return store.state.apiMatches;
    });

    const matchCheck = async () => {
      apiMatches.value.forEach((match) => {
        if (databaseMatches.value.includes(match.matchId)) {
          // HIER NOG DE DATUM EN TIJD UPDATE ALS DEZE GEWIJZIGD IS
          console.log(match.matchId + "  Wedstrijd bestaat al");
        } else {
          store.dispatch("createMatch", match);
          store.dispatch("getMatches");
        }
      });
    };
    onBeforeMount(async () => {
      try {
        await store.dispatch("getMatches");
        await store.dispatch("getApiMatches");
      } catch (error) {
        console.log(error);
      } finally {
        loading.value = false;
      }
    });
    onMounted(async () => {
      matchCheck();
    });

    return {
      loading,
      shirtColors,
      sockColors,
      databaseMatches,
      apiMatches,
      updateMatch,
      moment,
      matches: computed(() => store.state.matches),
      players: computed(() => store.state.players),
      authenticated: computed(() => store.state.authenticated),
    };
  },
};
</script>
