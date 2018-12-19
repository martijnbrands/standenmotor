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
        <td class="text-xs-center font-weight-bold">{{ props.item.points }}</td>
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
      players: []
    };
  },
  created() {
    db.collection("/2018-2019/data/players").onSnapshot(res => {
      const changes = res.docChanges();

      changes.forEach(change => {
        if (change.type === "added") {
          this.players.push({
            ...change.doc.data()
          });
        }
        if (change.type === "modified") {
          var goalsCount = change.doc.data().goals;
          var assistsCount = change.doc.data().assists;

          var goalsToInt = parseInt(goalsCount);
          var assistsToInt = parseInt(assistsCount);
          var pointsCount = goalsToInt * 2 + assistsToInt;

          db.collection("/2018-2019/data/players")
            .doc(change.doc.id)
            .update({
              points: pointsCount
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
table.v-table tbody td
  padding: 0 12px !important
</style>