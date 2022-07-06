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
                moment(match.matchDateTime).format("DD/MM/YYYY")
              }}</strong>
              <p class="subtitle-2 font-weight-light mb-1">
                {{
                  moment
                    .parseZone(match.matchDateTime)
                    .utc()
                    .format("HH:mm")
                }}
              </p>
              <p class="caption font-weight-light">
                {{
                 match.field
                }}
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
            <v-col cols="1" class="px-0">
              <v-chip class="mr-1" x-small color="primary" :text-color="match.shirtColor === 'uit' ? 'yellow darken-1' : 'white'">
                <v-icon>
                  fa-solid fa-shirt
                </v-icon>
              </v-chip>
              <v-chip x-small color="primary" :text-color="match.sockColor === 'blauw' ? 'primary' : 'white'" :outlined="match.sockColor === 'blauw' ? true : false">
                <v-icon>
                  fa-solid fa-socks
                </v-icon>
              </v-chip>
            </v-col>
          </v-row>
          <div v-if="authenticated">
            <v-select
              v-model="match.driverIDs"
              :items="players"
              :disabled="updating"
              label="Select drivers"
              multiple
              item-text="name"
              return-object
            />
            <v-row>
              <v-col cols="6">
                <v-select
                  v-model="match.shirtColor"
                  :items="shirtColors"
                  :disabled="updating"
                  label="Select shirt"
                  item-text="name"
                  return-object
                />
              </v-col>
              <v-col cols="6">
                <v-select
                  v-model="match.sockColor"
                  :items="sockColors"
                  :disabled="updating"
                  label="Select socks"
                  item-text="name"
                  return-object
                />
              </v-col>
            </v-row>

            <v-btn
              :loading="updating"
              @click="updateMatch(match)"
              color="secondary"
              >Opslaan</v-btn
            >
          </div>
        </v-timeline-item>
      </v-timeline>
    </v-card>
    <div v-if="!matches.length && !loading">
      <v-alert type="warning">
        Er zijn op dit moment geen rijbeurten.
      </v-alert>
    </div>
    <v-snackbar
      v-model="snackbar.visible"
      :timeout="3000"
      :color="snackbar.color"
      rounded="pill"
      content-class="text-center"
    >
      {{ snackbar.text }}
    </v-snackbar>
  </div>
</template>

<script>
import {
  onMounted,
  computed,
  ref,
  reactive,
  onBeforeMount
} from "@vue/composition-api";
import store from "@/store";
import moment from "moment";

export default {
  setup() {
    const loading = ref(true);
    const updating = ref(false);
    const shirtColors = ref(["thuis", "uit"]);
    const sockColors = ref(["blauw", "wit"]);

    const snackbar = reactive({
      visible: false,
      color: "",
      text: ""
    });

    const updateMatch = async match => {
      try {
        updating.value = true;
        await store.dispatch("updateMatch", match);
        await store.dispatch("getMatches");

        snackbar.visible = true;
        snackbar.color = "success";
        snackbar.text = `Wedstrijd ${match.homeTeam} succesvol aangepast.`;
      } catch (error) {
        snackbar.visible = true;
        snackbar.color = "error";
        snackbar.text = `Het is niet gelukt om wedstrijd ${match.homeTeam} aan te passen.`;
        console.log(error);
      } finally {
        updating.value = false;
      }
    };

    const databaseMatches = computed(() => {
      return store.state.matches.map(match => {
        return match.matchId;
      });
    });

    const apiMatches = computed(() => {
      return store.state.apiMatches;
    });

    const matchCheck = async () => {
      apiMatches.value.forEach(match => {
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
      updating,
      snackbar,
      shirtColors,
      sockColors,
      databaseMatches,
      apiMatches,
      updateMatch,
      moment,
      matches: computed(() => store.state.matches),
      players: computed(() => store.state.players),
      authenticated: computed(() => store.state.authenticated)
    };
  }
};
</script>
