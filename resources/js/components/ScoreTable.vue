<template>
  	<div>
    	<v-data-table
      :headers="headers"
			v-bind:pagination.sync="pagination"
			:items="players"
			hide-actions
			:expand="expand"
			:loading="isLoading"
			class="elevation-1"
    	>
      	
			<v-progress-linear v-slot:progress color="primary" indeterminate></v-progress-linear>
			
			<template slot="items" slot-scope="props">
				<tr @click="props.expanded = !props.expanded">
					<td>{{ props.item.name }}</td>
					<td class="text-xs-center">{{ props.item.goals }}</td>
					<td class="text-xs-center">{{ props.item.assists }}</td>
          <td class="text-xs-center font-weight-bold">{{ props.item.points }}</td>
				</tr>
			</template>
		
			<template v-slot:expand="props">
				<v-card class="py-3" flat>
					<v-text-field label="Naam:" v-model="props.item.name"></v-text-field>
					<v-text-field
						type="tel"
						label="Goals:"
						v-bind:value="props.item.goals"
            v-model="props.item.goals"
            :min="0"
            placeholder="0"
            v-on:keyup="playerChanged(props.item)"
					></v-text-field>
					<v-text-field
						type="tel"
						label="Assists:"
						v-bind:value="props.item.assists"
            v-model="props.item.assists"
            :min="0"
            placeholder="0"
            v-on:keyup="playerChanged(props.item)"
					></v-text-field>
					
					<v-card-actions>
						<v-spacer></v-spacer>
				
						<v-btn small flat color="error" @click="removePlayer(props.item);">Verwijderen</v-btn>
						<v-btn small color="primary" @click="updatePlayer(props.item)">Opslaan</v-btn>
					</v-card-actions>
				</v-card>
			</template>
    	</v-data-table>
    
		<v-card-text style="height: 100px;" position="relative">
      		<v-btn fixed fab bottom right color="warning" @click="dialog = !dialog">
        		<v-icon>mdi-plus</v-icon>
      		</v-btn>
    	</v-card-text>
    
		<v-dialog v-model="dialog" max-width="500px">
      		<v-card>
        		<v-card-text>
          			<v-alert :value="true" type="error" v-if="hasError" v-text="errorMessage"></v-alert>
          			<v-text-field v-model="playerName" label="Speler naam:"></v-text-field>
        		</v-card-text>
        		
				<v-card-actions>
          			<v-spacer></v-spacer>
          			<v-btn flat color="primary" @click="addPlayer();">Opslaan</v-btn>
        		</v-card-actions>
      		</v-card>
    	</v-dialog>
  	</div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      expand: false,
      dialog: false,
      playerName: "",
      hasError: false,
      errorMessage: "",
      teamId: null,
      isLoading: true,
      pagination: { sortBy: "points", descending: true, rowsPerPage: -1 },
      headers: [
        {
          text: "Spelers",
          align: "left",
          sortable: true,
          value: "name"
        },
        {
          text: "Goals",
          value: "goals",
          align: "center"
        },
        {
          text: "Assists",
          value: "assists",
          align: "center"
        },
        {
          text: "Punten",
          value: "points",
          align: "center"
        }
      ],
      players: []
    };
  },
  created() {
    this.getTeamId();
  },
  methods: {
    getTeamId() {
      axios.get("/teamId").then(response => {
        this.teamId = response.data;
        this.getPlayers();
      });
    },
    getPlayers() {
      this.isLoading = true;
      axios.get("/teams/" + this.teamId + "/players").then(response => {
        const {
          data: { data }
        } = response;
        this.players = data;
        this.isLoading = false;
      });
    },
    addPlayer() {
      axios
        .post("/players/create", {
          name: this.playerName
        })
        .then((response) => {
          this.players.push(response.data);
          this.playerName = "";
          this.dialog = false;
          this.hasError = false;
          this.errorMessage = "";
        })
        .catch(error => {
          this.hasError = true;
          this.errorMessage = error.response.data.errors.name[0];
        });
    },
    updatePlayer(player) {
      axios
        .patch("/players/update/" + player.id, {
          name: player.name,
          goals: player.goals,
          assists: player.assists
        })
        .then((response) => {
          this.hasError = false;
          this.errorMessage = "";
        })
        .catch(error => {
          this.hasError = true;
          this.errorMessage = error.response.data.errors.name[0];
        });

    },
    removePlayer(player) {
      const index = this.players.indexOf(player);
      confirm('Weet je zeker dat je deze speler wilt verwijderen?') && axios
          .delete("/players/delete/" + player.id)
          .then((response) => { this.players.splice(index, 1); })
          .catch((error) => { });
    },
    playerChanged(player) {

      if(player.goals && player.assists){
        player.points = ((player.goals * 2) + parseInt(player.assists));
      } else if(player.assists) {
        player.points = player.assists;
      } else {
        player.points = (player.goals * 2);
      }
    }
  }
};
</script>

<style lang="sass">
.v-datatable thead th.column.sortable
  padding: 0 12px

table.v-table tbody td
  padding: 0 12px !important

.v-btn--bottom:not(.v-btn--absolute)
  bottom: 74px
</style>