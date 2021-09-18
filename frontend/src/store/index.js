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
  },
  actions: {

    signIn({ commit }, user) {
      axios
        .post("http://localhost:3000/api/user/login", {
          email: user.email,
          password: user.password,
        })
        .then((response) => {
          console.log(response)
          localStorage.setItem("token", response.data.token)
          axios.defaults.headers.common['auth-token'] = response.data.token
          commit("SET_AUTHENTICATION", true);
          router.push("/")
        })
        .catch((err) => {
          commit("SET_AUTHENTICATION", false);
          console.error(err);
        });
    },

    signOut({ commit }) {
      commit("SET_AUTHENTICATION", false);
      localStorage.removeItem('token')
      delete axios.defaults.headers.common['auth-token']
      router.push("/login")
    },

    getPlayers({ commit }) {
      axios
        .get(`http://localhost:3000/api/players`)
        .then((response) => {
          commit("SET_PLAYERS", response.data);
        })
        .catch((err) => {
          console.error(err);
        });
    },
    addPlayer(_, name){
      axios
        .post("http://localhost:3000/api/players", {
          name: name,
        })
        .catch((err) => {
          console.error(err);
        });

    },
    getMatches({ commit }) {
      axios
        .get(`http://localhost:3000/api/matches`)
        .then((response) => {
          commit("SET_MATCHES", response.data);
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
});
