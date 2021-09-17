import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);
Vue.use(axios);

export default new Vuex.Store({
  state: {
    players: [],
    matches: [],
  },
  mutations: {
    SET_PLAYERS(state, players) {
      state.players = players;
    },
    SET_MATCHES(state, matches) {
      state.matches = matches;
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
    getMatches({ commit }) {
      axios
        .get(`http://localhost:3000/api/matches`)
        .then((response) => {
          commit("SET_MATCHES", response.data);
        })
        .catch((e) => {
          this.errors.push(e);
        });
    },
  },
  modules: {},
});
