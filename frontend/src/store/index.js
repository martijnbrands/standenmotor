import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import router from "@/router";

Vue.use(Vuex);
Vue.use(axios);

export default new Vuex.Store({
  state: {
    authenticated: false,
    players: [],
    matches: [],
    apiMatches: [],
    arbiters: [],
  },
  mutations: {
    SET_AUTHENTICATION(state, auth) {
      state.authenticated = auth;
    },
    SET_PLAYERS(state, players) {
      state.players = players;
    },
    SET_MATCHES(state, matches) {
      state.matches = matches;
    },
    SET_API_MATCHES(state, apiMatches) {
      state.apiMatches = apiMatches;
    },
    SET_ARBITERS(state, arbiters) {
      state.arbiters = arbiters;
    },
  },
  actions: {
    signIn({ commit }, user) {
      axios
        .post("http://localhost:3000/api/user/login", {
          email: user.email,
          password: user.password,
        })
        .then((response) => {
          localStorage.setItem("token", response.data.token);
          axios.defaults.headers.common["auth-token"] = response.data.token;
          commit("SET_AUTHENTICATION", true);
          router.push("/");
        })
        .catch((err) => {
          commit("SET_AUTHENTICATION", false);
          console.error(err);
        });
    },

    signOut({ commit }) {
      commit("SET_AUTHENTICATION", false);
      localStorage.removeItem("token");
      delete axios.defaults.headers.common["auth-token"];
      router.push("/login");
    },

    async getPlayers({ commit }) {
      try {
        const response = await axios.get('http://localhost:3000/api/players')
        commit("SET_PLAYERS", response.data);
        }
        catch (err) {
          console.log(err)
        }
    },

    addPlayer(_, name) {
      axios
        .post("http://localhost:3000/api/players", {
          name: name,
        })
        .catch((err) => {
          console.error(err);
        });
    },

    updatePlayer(_, player) {
      axios
        .put("http://localhost:3000/api/players/" + player.id, {
          name: player.name,
          goals: parseInt(player.goals),
          assists: parseInt(player.assists),
        })
        .catch((err) => {
          console.error(err);
        });
    },

    deletePlayer(_, id) {
      axios.delete("http://localhost:3000/api/players/" + id).catch((err) => {
        console.error(err);
      });
    },


    createMatch(_, match) {
      axios
        .post("http://localhost:3000/api/matches", match)
        .catch((err) => {
          console.error(err);
        });
    },

    async getMatches({ commit }) {
      try {
        const response = await axios.get('http://localhost:3000/api/matches')
        commit("SET_MATCHES", response.data);
        }
        catch (err) {
          console.log(err)
        }
    },

    getApiMatches({ commit }) {
      axios
        .get(`https://mhc-oss-api.herokuapp.com/api/teams/Heren2`)
        .then((response) => {
          commit("SET_API_MATCHES", response.data.matches);
        })
        .catch((err) => {
          console.error(err);
        });
    },

    updateMatch(_, match) {
      axios
        .put("http://localhost:3000/api/matches/" + match._id, {
          driverIDs: match.driverIDs.map((item) => {
            return item.id;
          }),
        })
        .catch((err) => {
          console.error(err);
        });
    },

      async getArbiters({ commit }) {
        try {
          const response = await axios.get('https://mhc-oss-api.herokuapp.com/api/teams/Heren2')
            commit('SET_ARBITERS', response.data.arbiters)
          }
          catch (err) {
            console.log(err)
          }
      }
  },
});
