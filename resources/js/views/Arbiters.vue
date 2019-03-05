<template>
  	<div>
    	<v-subheader class="page_title">Fluitschema</v-subheader>
    	<ArbiterSchedule/>
  	</div>
</template>

<script>

import ArbiterSchedule from "../components/ArbiterSchedule";

export default {
	components: {
		ArbiterSchedule
	}
};

</script>

<style lang="sass">
.page_title
	padding: 0
</style>