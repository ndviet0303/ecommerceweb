// src/store/index.js
import { createStore } from 'vuex';
const store = createStore({
    state: {
        user: null, // Thông tin người dùng đã đăng nhập
        token: null // Token của người dùng đã đăng nhập
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        SET_TOKEN(state, token) {
            state.token = token;
        },
        CLEAR_USER(state) {
            state.user = null;
        },
        CLEAR_TOKEN(state) {
            state.token = null;
        }
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
