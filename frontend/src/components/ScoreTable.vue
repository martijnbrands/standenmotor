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
      @click:row="showEditDialog($event, payload)"
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
        align: "left",
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

    const showEditDialog = (payload) => {
      console.log("hello", payload);
    };

    return {
      headers,
      showEditDialog,
      players: computed(() => store.state.players),
    };
  },
};
</script>
<style lang="scss" scoped>
.v-subheader {
  padding: 0 16px 0 0;
}
.v-data-table > .v-data-table__wrapper > table > tbody > tr > td,
.v-data-table > .v-data-table__wrapper > table > tbody > tr > th,
.v-data-table > .v-data-table__wrapper > table > tfoot > tr > td,
.v-data-table > .v-data-table__wrapper > table > tfoot > tr > th,
.v-data-table > .v-data-table__wrapper > table > thead > tr > td,
.v-data-table > .v-data-table__wrapper > table > thead > tr > th {
  padding: 0 5px !important;
}
</style>
