<template>
  <div>
    <v-subheader class="page_title">Rijschema</v-subheader>
    <DriversSchedule/>
  </div>
</template>

<script>
import DriversSchedule from "../components/DriversSchedule";
export default {
  components: {
    DriversSchedule
  }
};
</script>

<style lang="sass">
.page_title
  padding: 0
</style>