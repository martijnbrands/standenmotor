<template>
<div>
  <v-subheader>Fluitschema</v-subheader>
  <arbiter-schedule />
</div>
</template>

<script>
import ArbiterSchedule from '@/components/ArbiterSchedule.vue'

export default {
  components:{
    ArbiterSchedule
  },
  setup() {
    
  },
}
</script>


<style lang="scss" scoped>
.v-subheader {
  padding: 0 16px 0 0;
}
</style>