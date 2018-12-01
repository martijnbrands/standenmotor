<template>
  <v-data-table :headers="headers" v-bind:pagination.sync="pagination" :items="players" hide-actions class="elevation-1">
    <template slot="items" slot-scope="props">
      <td>{{ props.item.name }}</td>
      <td class="text-xs-center">{{ props.item.goals }}</td>
      <td class="text-xs-center">{{ props.item.assists }}</td>
      <td class="text-xs-center">{{ props.item.goals * 2 + props.item.assists }}</td>
    </template>
  </v-data-table>
</template>

<script>
  export default {
    
    data () {
      return {
        pagination:{'sortBy': 'points', 'descending': true, 'rowsPerPage': -1},
        headers: [
          {
            text: 'Players',
            align: 'left',
            sortable: true,
            value: 'name'
          },
          { 
            text: 'Goals', 
            value: 'goals', 
            align: 'center'
          },
          { 
            text: 'Assists', 
            value: 'assists', 
            align: 'center'
          },
          { 
            text: 'Points', 
            value: 'points', 
            align: 'center'
          }
        ],
        players: [
          {
            value: false,
            name: 'Martijn Brands',
            goals: 1,
            assists: 2,
            points: 4
          },
          {
            value: false,
            name: 'Sander Brands',
            goals: 2,
            assists: 4,
            points: 1
          }
          ,
          {
            value: false,
            name: 'Job van Rosmalen',
            goals: 4,
            assists: 4,
            points: 6
          }
          ,
          {
            value: false,
            name: 'Dennis Erren',
            goals: 6,
            assists: 4,
            points: 10
          }
          ,
          {
            value: false,
            name: 'Joep Erren',
            goals: 2,
            assists: 1,
            points: 7
          }
          ,
          {
            value: false,
            name: 'Wout Cox',
            goals: 1,
            assists: 10,
            points: 4
          }
        ]
      }
    },
    computed: {
    fullName: function () {
      return this.name + ' ' + this.goals
    }
    }
  }
</script>