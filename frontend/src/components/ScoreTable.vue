<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="players"
      :items-per-page="-1"
      hide-default-footer
      mobile-breakpoint="0"
      sort-by="points"
      sort-desc
      class="elevation-1"
    />
  </div>
</template>

<script>
import { onMounted, computed, ref } from "@vue/composition-api";
import store from "@/store";

export default {
  setup() {
    const headers = ref([
      {
        text: "Naam",
        align: "start",
        sortable: true,
        value: "name",
      },
      {
        text: "Goals",
        sortable: true,
        value: "goals",
      },
      {
        text: "Assists",
        sortable: true,
        value: "assists",
      },
      {
        text: "Punten",
        sortable: true,
        value: "points",
      },
    ]);
    onMounted(() => {
      store.dispatch("getPlayers");
    });
    return {
      headers,
      players: computed(() => store.state.players),
    };
  },
};
</script>
<style lang="scss" scoped>
.v-subheader {
  padding: 0 16px 0 0;
}
</style>
