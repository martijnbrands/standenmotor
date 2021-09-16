<template>
<v-app>
  <application-header />
  <v-main>
    <v-container>
      <router-view></router-view>
    </v-container>
  </v-main>
  <bottom-navigation/>
  </v-app>
</template>

<script>
import ApplicationHeader from '@/components/ApplicationHeader.vue'
import BottomNavigation from '@/components/BottomNavigation.vue'

export default {
  components: {
    ApplicationHeader,
    BottomNavigation
  },
}
</script>
