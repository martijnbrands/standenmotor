<template>
  <div v-if="players.length > 0">
    <v-data-table
      :headers="headers"
      v-bind:pagination.sync="pagination"
      :items="players"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.name }}</td>
        <td class="text-xs-center">{{ props.item.goals }}</td>
        <td class="text-xs-center">{{ props.item.assists }}</td>
        <td class="text-xs-center">{{ props.item.points }}</td>
      </template>
    </v-data-table>
  </div>
  <div v-else>
    <v-progress-linear :indeterminate="true"></v-progress-linear>
  </div>
</template>

<script>
import db from "@/firebase";
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
      // players: [
      //   {
      //     value: false,
      //     name: 'Martijn Brands',
      //     goals: 1,
      //     assists: 2,
      //     points: 4
      //   },
      //   {
      //     value: false,
      //     name: 'Sander Brands',
      //     goals: 2,
      //     assists: 4,
      //     points: 1
      //   }
      //   ,
      //   {
      //     value: false,
      //     name: 'Job van Rosmalen',
      //     goals: 4,
      //     assists: 4,
      //     points: 6
      //   }
      //   ,
      //   {
      //     value: false,
      //     name: 'Dennis Erren',
      //     goals: 6,
      //     assists: 4,
      //     points: 10
      //   }
      //   ,
      //   {
      //     value: false,
      //     name: 'Joep Erren',
      //     goals: 2,
      //     assists: 1,
      //     points: 7
      //   }
      //   ,
      //   {
      //     value: false,
      //     name: 'Wout Cox',
      //     goals: 1,
      //     assists: 10,
      //     points: 4
      //   }
      // ]
      players: []
    };
  },
  created() {
    db.collection("/2018-2019/data/players").onSnapshot(res => {
      const changes = res.docChanges();

      changes.forEach(change => {
        if (change.type === "added") {
          this.players.push({
            ...change.doc.data(),
            id: change.doc.id
          });
        }
      });
    });
  }
};
</script>

<style lang="sass">
.v-datatable thead th.column.sortable
  padding: 0 12px
table.v-table tbody tr:nth-child(odd)
  background: rgba(242,242,242,0.5)
table.v-table tbody td
  padding: 0 12px !important
</style>