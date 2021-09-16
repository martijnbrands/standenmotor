<template>
<div>
  <v-subheader>Standen</v-subheader>
  <score-table />
</div>
</template>

<script>
import ScoreTable from '@/components/ScoreTable.vue'

export default {
  components: {
    ScoreTable
  },
}
</script>

<style lang="scss" scoped>
.v-subheader {
  padding: 0 16px 0 0;
}
</style>