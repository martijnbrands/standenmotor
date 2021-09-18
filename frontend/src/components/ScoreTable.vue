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
    <v-dialog v-model="newPlayerDialog" width="500">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-if="authenticated"
          block
          color="secondary"
          class="mt-4"
          v-bind="attrs"
          v-on="on"
        >
          Speler toevoegen
        </v-btn>
      </template>

      <v-card>
        <v-card-title> Speler toevoegen </v-card-title>

        <v-divider />
        <v-form>
          <v-container>
            <v-text-field
              v-model="newPlayerName"
              label="Naam"
              placeholder="John Doe"
            ></v-text-field>
          </v-container>
        </v-form>

        <v-divider />

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="grey" text @click="newPlayerDialog = false">
            Annuleren
          </v-btn>
          <v-btn color="primary" text @click="addPlayer"> Toevoegen </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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

    const newPlayerDialog = ref(false);
    const newPlayerName = ref("");

    onMounted(async () => {
      try {
        await store.dispatch("getPlayers");
      } catch (error) {
        console.error(error);
      }
    });

    const addPlayer = async () => {
      try {
        await store.dispatch("addPlayer", newPlayerName.value);
        newPlayerDialog.value = false;
        newPlayerName.value = "";
        await store.dispatch("getPlayers");
      } catch (error) {
        console.error(error);
      }
    };

    return {
      headers,
      newPlayerDialog,
      newPlayerName,
      addPlayer,
      authenticated: computed(() => store.state.authenticated),
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
