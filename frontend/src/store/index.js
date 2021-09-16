import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);
Vue.use(axios);

export default new Vuex.Store({
  state: {
    players: [],
  },
  mutations: {
    SET_PLAYERS(state, players) {
      state.players = players;
    },
  },
  actions: {
    getPlayers({ commit }) {
      axios
        .get(`http://localhost:3000/api/players`)
        .then((response) => {
          commit("SET_PLAYERS", response.data);
        })
        .catch((e) => {
          this.errors.push(e);
        });
    },
  },
  modules: {},
});
