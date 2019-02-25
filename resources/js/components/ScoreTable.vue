<template>
    <v-data-table
      :headers="headers"
      v-bind:pagination.sync="pagination"
      :items="players"
      hide-actions
      item-key="name"
      class="elevation-1"
    >
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
        this.getPlayers()
  },
  methods: {
    getPlayers(){
      axios
        .get('/players')
        .then(response =>{
          const {data:{data}} = response
          this.players = data
          console.log(response)
        } )
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