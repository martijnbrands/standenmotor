<template>
<div>
  <v-subheader>Rijschema</v-subheader>
  <driver-schedule />
</div>
</template>

<script>
import DriverSchedule from '@/components/DriverSchedule.vue'

export default {
  components:{
    DriverSchedule
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