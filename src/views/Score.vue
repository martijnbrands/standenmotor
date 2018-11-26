<template>
  <div>
    <v-subheader>Score</v-subheader>
    <ScoreTable />
  </div>
</template>

<script>
  import ScoreTable from '../components/ScoreTable'

  export default {
    components: {
      ScoreTable
    }
  }
</script>
