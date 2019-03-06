<template>
    <v-data-table
      :headers="headers"
      v-bind:pagination.sync="pagination"
      :items="players"
      hide-actions
      :loading="isLoading"
      item-key="name"
      class="elevation-1"
    >
        <v-progress-linear v-slot:progress color="blue" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="props">
            <tr>
                <td>{{ props.item.name }}</td>
                <td class="text-xs-center">{{ props.item.goals }}</td>
                <td class="text-xs-center">{{ props.item.assists }}</td>
                <td class="text-xs-center font-weight-bold">{{ props.item.points }}</td>
            </tr>
        </template>
    </v-data-table>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
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
      players: [
    
      ]
    };
  },
  created() {
        this.getTeamId();
  },
  methods: {
    getTeamId(){
      axios
        .get('/teamId')
        .then(response => {
          this.teamId = response.data.teamId;
          this.getPlayers();
        });
    },
    getPlayers(){
    this.isLoading = true
        axios
            .get('/api/' + this.teamId + '/players')
            .then(response =>{
            const {data:{data}} = response
            this.players = data
            console.log(response)
            this.isLoading = false
        })
    }
  }

};
</script>

<style lang="sass">
.v-datatable thead th.column.sortable
  padding: 0 12px

table.v-table tbody td
  padding: 0 12px !important
</style>