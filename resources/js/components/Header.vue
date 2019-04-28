<template>
	<v-toolbar app fixed color="primary">
		<router-link to="/" color="secondary">
			<v-toolbar-title  v-if="!$auth.check()" class="subheading font-weight-bold white--text">MHC Oss
				<div class="body-1">Doelpunten & Assists</div>
			</v-toolbar-title>
			<v-toolbar-title v-if="$auth.check()" class="subheading font-weight-bold white--text">
				{{ $auth.user().team.name }}
				<div class="body-1">Doelpunten & Assists</div>
			</v-toolbar-title>
		</router-link>
		<v-spacer></v-spacer>
		<v-menu bottom left origin="center center" transition="slide-y-transition">
			<v-btn slot="activator" dark icon>
				<v-icon>mdi-dots-vertical</v-icon>
			</v-btn>

			<v-list>
				<v-list-tile to="/login" v-if="!$auth.check()">
					<v-list-tile-title>Login</v-list-tile-title>
				</v-list-tile>
				<v-list-tile to="/logout" v-if="$auth.check()">
					<v-list-tile-title @click="$auth.logout()">Logout</v-list-tile-title>
				</v-list-tile>
			</v-list>
		</v-menu>
	</v-toolbar>
</template>

<style lang="sass">
</style>