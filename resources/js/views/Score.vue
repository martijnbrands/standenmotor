<template>
  <div>
    <v-subheader class="page_title">Score</v-subheader>
    <ScoreTable/>
  </div>
</template>

<script>
import ScoreTable from "../components/ScoreTable";

export default {
  components: {
    ScoreTable
  }
};
</script>

<style lang="sass">
.page_title
  padding: 0
</style>