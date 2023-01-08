<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="players"
      :items-per-page="-1"
      :loading="loading"
      loading-text="Loading... Please wait"
      hide-default-footer
      mobile-breakpoint="0"
      sort-by="points"
      sort-desc
      class="elevation-1"
    >
      <template v-slot:[`item`]="{ item }">
        <tr @click="authenticated ? editPlayer(item) : null">
          <td>{{ item.name }}</td>
          <td class="text-center">{{ item.goals }}</td>
          <td class="text-center">{{ item.assists }}</td>
          <td class="font-weight-bold text-center">{{ item.points }}</td>
        </tr>
      </template>
    </v-data-table>
    <v-dialog v-model="editPlayerDialog" width="500">
      <v-card>
        <v-card-title> Speler bewerken </v-card-title>
        <v-divider />
         <v-form>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="selectedPlayer.name"
                  label="Naam"
                  placeholder="John Doe"
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="selectedPlayer.goals"
                  label="Goals"
                  type="number"
                  append-outer-icon="mdi-plus"
                  prepend-icon="mdi-minus"
                  :hint="oldGoals + ' ' + '(' + goalsCount + ')'"
                  persistent-hint
                  @click:append-outer="selectedPlayer.goals ++ , goalsCount++"
                  @click:prepend="selectedPlayer.goals --, goalsCount--"  
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  v-model="selectedPlayer.assists"
                  label="Assists"
                  type="number"
                  append-outer-icon="mdi-plus"
                  prepend-icon="mdi-minus"
                  :hint="oldAssists + ' ' + '(' + assistsCount + ')'"
                  persistent-hint
                  @click:append-outer="selectedPlayer.assists ++, assistsCount++"
                  @click:prepend="selectedPlayer.assists --, assistsCount--"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
        <v-divider />
        <v-card-actions>
          <v-btn @click="deletePlayer" icon color="red">
            <v-icon>mdi-delete-outline</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn color="grey" text @click="editPlayerDialog = false">
            Annuleren
          </v-btn>
          <v-btn color="primary" text @click="updatePlayer"> Opslaan </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    
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
        <v-card-title>Speler toevoegen</v-card-title>

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
import { onMounted, computed, ref, reactive } from "@vue/composition-api";
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
        align: "center",
      },
      {
        text: "Assists",
        sortable: true,
        value: "assists",
        align: "center",
      },
      {
        text: "Punten",
        sortable: true,
        value: "points",
        align: "center",
      },
    ]);
    const loading = ref(true);
    const newPlayerDialog = ref(false);
    const newPlayerName = ref("");

    const oldGoals = ref(null);
    const goalsCount = ref(0)

    const oldAssists = ref(null);
    const assistsCount = ref(0)

    const selectedPlayer = ref({});
    const editPlayerDialog = ref(false);

    const snackbar = reactive({
      visible: false,
      color: '',
      text: ''
    })

    onMounted(async () => {
      await store.dispatch("getPlayers");
      loading.value = false;
    });

    const editPlayer = async (currentPlayer) => {
      editPlayerDialog.value = true;
      selectedPlayer.value = currentPlayer;

      oldGoals.value = currentPlayer.goals;
      oldAssists.value = currentPlayer.assists;
    };

    const addPlayer = async () => {
   
      try {
        await store.dispatch("addPlayer", newPlayerName.value);
        
        newPlayerDialog.value = false;

        snackbar.visible = true;
        snackbar.color = 'success';
        snackbar.text = `Speler ${newPlayerName.value} toegevoegd.`;
        

        newPlayerName.value = "";
        await store.dispatch("getPlayers");
      } catch (error) {
        snackbar.visible = true;
        snackbar.color = 'error';
        snackbar.text = `Het is niet gelukt om speler ${newPlayerName.value} toe te voegen.`;
      }
    };

    const updatePlayer = async () => {
      try {
        await store.dispatch("updatePlayer", selectedPlayer.value);
        editPlayerDialog.value = false;

        snackbar.visible = true;
        snackbar.color = 'success';
        snackbar.text = `Speler ${selectedPlayer.value.name} aangepast.`;

        selectedPlayer.value = {};
        await store.dispatch("getPlayers");
      } catch (error) {

        snackbar.visible = true;
        snackbar.color = 'error';
        snackbar.text = `Het is niet gelukt om speler ${selectedPlayer.value.name} aan te passen.`;
      }
    };

    const deletePlayer = async () => {
      try {
        await store.dispatch("deletePlayer", selectedPlayer.value.id);
        
        editPlayerDialog.value = false;
        
        snackbar.visible = true;
        snackbar.color = 'success';
        snackbar.text = `Speler ${selectedPlayer.value.name} verwijderd.`;

        selectedPlayer.value = {};
        await store.dispatch("getPlayers");
      } catch (error) {

        snackbar.visible = true;
        snackbar.color = 'error';
        snackbar.text = `Het is niet gelukt om speler ${selectedPlayer.value.name} te verwijderen.`;
      }
    };

    return {
      headers,
      loading,
      newPlayerDialog,
      newPlayerName,
      selectedPlayer,
      oldGoals,
      goalsCount,
      oldAssists,
    
      assistsCount,

      snackbar,
      editPlayer,
      editPlayerDialog,
      updatePlayer,
      addPlayer,
      deletePlayer,
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
.v-data-table > .v-data-table__wrapper > table > thead > tr > td,
.v-data-table > .v-data-table__wrapper > table > thead > tr > th,
.v-data-table > .v-data-table__wrapper > table > tfoot > tr > td,
.v-data-table > .v-data-table__wrapper > table > tfoot > tr > th {
  padding: 0 4px !important;
}
</style>
