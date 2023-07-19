import { createStore } from 'vuex';
import { reactive} from 'vue';
const store = createStore({
    state: {
        user: JSON.parse(localStorage.getItem('user')) || null,
        token: localStorage.getItem('token') || null,
        isAuthenticated: false,
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
            localStorage.setItem('user', JSON.stringify(user));
        },
        SET_TOKEN(state, token) {
            state.token = token;
            localStorage.setItem('token', token);
        },
        CLEAR_USER(state) {
            state.user = null;
            localStorage.removeItem('user');
        },
        CLEAR_TOKEN(state) {
            state.token = null;
            localStorage.removeItem('token');
        },
        SET_AUTHENTICATED(state, value) {
            state.isAuthenticated = value;
          },
    },
    actions: {
        setUser({ commit }, user) {
            commit('SET_USER', user);
        },
        setToken({ commit }, token) {
            commit('SET_TOKEN', token);
        },
        clearUser({ commit }) {
            commit('CLEAR_USER');
        },
        clearToken({ commit }) {
            commit('CLEAR_TOKEN');
        }
    }
});

export default store;
