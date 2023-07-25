import { createStore } from 'vuex';
import { reactive } from 'vue';
import createPersistedState from 'vuex-persistedstate';

const store = createStore({
    state: {
        user: null,
        token: null,
        cartItems: [],
    },
    getters: {
        cartItemCount(state) {
            return state.cartItems.reduce((total, product) => total + product.quantity, 0);
        },
        getCartItems(state) {
            return state.cartItems;
        },
        isAuthenticated: (state) => {
            // Kiểm tra xem token và người dùng có tồn tại hay không để xác định trạng thái xác thực.
            return state.token !== null && state.user !== null;
        },
        getUserData: state => state.user,
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
            //localStorage.setItem('user', JSON.stringify(user));
        },
        SET_TOKEN(state, token) {
            state.token = token;
            //localStorage.setItem('token', token);
        },
        CLEAR_USER(state) {
            state.user = null;
            //localStorage.removeItem('user');
        },
        CLEAR_TOKEN(state) {
            state.token = null;
            //localStorage.removeItem('token');
        },
        addToCart(state, item) {
            state.cartItems.push(item);
        },
        addQuantityCartItem(state, { index }) {
            state.cartItems[index].quantity++;
        },
        reduceQuantityCartItem(state, { index }) {
            state.cartItems[index].quantity--;
        },
        updateFromCart(state, { item, index }) {
            state.cartItems[index].quantity = item.quantity;
        },
        removeFromCart(state, itemId) {
            state.cartItems = state.cartItems.filter(item => item.id !== itemId);
        },
        clearCart(state) {
            state.cartItems = [];
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
        },
        addToCart({ commit, state }, item) {
            const existingItem = state.cartItems.find(cartItem => cartItem.id === item.id);
            if (existingItem) {
                const existingItemIndex = state.cartItems.findIndex(cartItem => cartItem.id === item.id);
                commit('addQuantityCartItem', { index: existingItemIndex });
            } else {
                item.quantity = 1;
                commit('addToCart', item);
            }
        },
        reduceQuantityCartItem({ commit, state }, item) {
            const existingItem = state.cartItems.find(cartItem => cartItem.id === item.id);
            if (existingItem.quantity > 1) {
                const existingItemIndex = state.cartItems.findIndex(cartItem => cartItem.id === item.id);
                commit('reduceQuantityCartItem', { index: existingItemIndex });
            } else if (existingItem.quantity == 1) {
                commit('removeFromCart', item.id);
            }
        },
        updateFromCart({ commit, state }, item) {
            const existingItem = state.cartItems.find(cartItem => cartItem.id === item.id);
            //console.log(existingItem);
            if (existingItem) {
                const existingItemIndex = state.cartItems.findIndex(cartItem => cartItem.id === item.id);
                commit('updateFromCart', { item: item, index: existingItemIndex });
            }
        },
        removeFromCart({ commit }, itemId) {
            commit('removeFromCart', itemId);
        },
        clearCart({ commit }) {
            commit('clearCart');
        },
    },
    plugins: [createPersistedState()],
});

export default store;
