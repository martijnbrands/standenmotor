<template>
  <div>
    <div v-if="loading">
      <v-progress-linear
      indeterminate
    ></v-progress-linear>
    </div>
    <div v-if="arbiters.length && !loading">
      <div v-for="match in arbiters" :key="match.id">
        <v-card class="mb-4" :class="!match.matchDate ? 'mt-n6 rounded-t-0' : ''">
          <v-card-text>
            <h4 class="text-h6 font-weight-bold">
              {{ match.matchDate }}
            </h4>
            <p class="subtitle-1 font-weight-bold">{{ match.matchTime }}</p>
            <p class="body-1 mb-0">
              {{ match.teams }}
            </p>
            <p class="body-2 font-italic">
              {{ match.umpires }}
            </p>
            <p class="body-2 font-weight-medium">
              {{ match.field }}
            </p>
          </v-card-text>
        </v-card>
      </div>
    </div>
    <div v-if="!arbiters.length && !loading">
      <v-alert type="warning">
        Er zijn op dit moment geen wedstrijden om te fluiten.
      </v-alert>
    </div>
  </div>
</template>

<script>
import { onMounted, computed, ref } from "@vue/composition-api";
import store from "@/store";

export default {
  setup() {
    const loading = ref(true);

    onMounted(async () => {
      try {
        await store.dispatch("getArbiters");
       
      } catch (error) {
        console.log(error);
      }
      finally{
        loading.value = false;
      }
    });

    return {
      loading,
      arbiters: computed(() => store.state.arbiters),
      authenticated: computed(() => store.state.authenticated),
    };
  },
};
</script>
