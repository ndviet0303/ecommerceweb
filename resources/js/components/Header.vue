<template>
    <header class="header-section">
        <div class="header-top">
            <div class="container m-auto">
                <div class="flex flex-row justify-around">
                    <div class="flex flex-row">
                        <a href="mailto:contact@ziet.dev" class="py-4 pr-5 line-space-right">
                            <font-awesome-icon :icon="['fas', 'envelope']" />
                            contact@ziet.dev
                        </a>
                        <a href="tel:+84345694088" class="py-4 pl-5">
                            <font-awesome-icon :icon="['fas', 'phone']" />
                            +84 3456.940.88
                        </a>
                    </div>
                    <div class="items-end flex">
                        <div class="top-social line-space-right pr-5 gap-2 flex py-4">
                            <a href="#"><font-awesome-icon :icon="['fab', 'facebook']" /></a>
                            <a href="https://github.com/ndviet0303"><font-awesome-icon :icon="['fab', 'github']" /></a>
                            <a href="https://t.me/+84345694088"><font-awesome-icon :icon="['fab', 'telegram']" /></a>
                        </div>
                        <div v-if="!isAuthorized" class="flex">
                            <router-link :to="{ name: 'login' }"
                                class="login-panel pl-5 flex gap-2 items-center line-space-right pr-5 py-4">
                                <font-awesome-icon :icon="['fas', 'user']" />
                                Đăng Nhập</router-link>
                            <router-link :to="{ name: 'register' }"
                                class="login-panel pl-5 flex gap-2 items-center line-space-right pr-5 py-4">
                                <font-awesome-icon :icon="['fas', 'user-plus']" />
                                Đăng Ký </router-link>
                        </div>
                        <div v-else class="dropdown pl-5 pr-5 py-4">
                            <button> {{ user.name + ' ' + user.cash.toLocaleString() + 'đ '
                            }}<font-awesome-icon :icon="['fas', 'caret-down']" /></button>
                            <div class="dropdown-content capitalize">
                                <router-link v-if="user.user_role >= 2"
                                    :to="{ name: 'admin.dashboard' }"><span>Admin</span></router-link>
                                <router-link :to="{ name: 'information' }">tT tài khoản</router-link>
                                <router-link :to="{ name: 'license' }">license</router-link>
                                <router-link :to="{ name: 'changepass' }">đổi mật khẩu</router-link>
                                <a href="#" @click="logout">đăng xuất</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mid w-full">
            <div class="container py-10 flex flex-row flex-wrap justify-between m-auto">
                <div class="flex-1 text-center justify-center">
                    <div class="flex h-full items-center justify-center">
                        <router-link :to="{ name: 'Home' }">
                            <p class="text-5xl">Logo</p>
                            <!-- <img src="img/logo.png" alt=""> -->
                        </router-link>
                    </div>
                </div>
                <div class="flex-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
                        </div>
                        <input type="search" id="default-search" v-model="nameTool"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none"
                            placeholder="Tìm Tên Tool" required @keyup.enter="SendSearch">
                        <button type="submit" @click="SendSearch"
                            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Tìm</button>
                    </div>
                </div>
                <div class="flex-1 text-center">
                    <router-link :to="{ name: 'cart' }" class="flex h-full items-center justify-center" href="#">
                        <font-awesome-icon :icon="['fas', 'cart-shopping']" />
                        <span>Giỏ Hàng Hiện Có :{{ cartItemCount }}</span>
                    </router-link>
                </div>
            </div>
        </div>
        <nav class="bg-gray-800 border-gray-700">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <button data-collapse-toggle="navbar-solid-bg" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm  rounded-lg md:hidden  focus:outline-none focus:ring-2  text-gray-400 hover:bg-gray-700 focus:ring-gray-600"
                    aria-controls="navbar-solid-bg" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <font-awesome-icon :icon="['fas', 'bars']" />
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
                    <ul
                        class="flex flex-col font-medium mt-4 rounded-lg  md:flex-row md:space-x-8 md:mt-0 md:border-0  bg-gray-800 md:bg-transparent border-gray-700">
                        <li>
                            <router-link :to="{ name: 'Home' }"
                                class="block py-2 pl-3 pr-4 text-white rounded md:p-0 md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent"
                                :class="{ 'md:text-blue-500 bg-blue-600 md:bg-transparent': $route.name === 'Home' }">Trang
                                Chủ</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'products' }"
                                class="block py-2 pl-3 pr-4 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent"
                                :class="{ 'md:text-blue-500 bg-blue-600 md:bg-transparent': $route.name === 'products' }">Tool</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'deposit' }"
                                class="block py-2 pl-3 pr-4 rounded md:border-0 md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent"
                                :class="{ 'md:text-blue-500 bg-blue-600 md:bg-transparent': $route.name === 'deposit' }">Nạp
                                Tiền</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import axios from 'axios';
axios.defaults.withCredentials = true;
export default {
    setup() {
        const router = useRouter();
        const store = useStore();
        const user = computed(() => store.getters['getUserData']);
        // user = computed(() => store.getters['']);
        const isAuthorized = computed(() => store.getters['isAuthenticated']);
        const cartItemCount = computed(() => store.getters['cartItemCount']);
        const nameTool = ref("");

        function SendSearch() {
            router.push({ name: 'search', params: { name: nameTool.value } });
        }
        const logout = async () => {
            if (isAuthorized.value) {
                axios.post('/api/logout', {}, {
                    headers: {
                        Authorization: `Bearer ${store.state.token}`
                    }
                }).then(response => {
                    // Remove the token from local storage and redirect to the login page
                    store.dispatch('clearUser');
                    store.dispatch('clearToken');
                    router.push('/login'); // Replace '/login' with your login page route
                }).catch(error => {
                    //console.error(error);
                });
            }
        };

        const fetchUserData = async () => {
            if (isAuthorized.value) {
                await axios.post('/api/user', {}, {
                    headers: {
                        Authorization: `Bearer ${store.state.token}`
                    }
                }).then((response) => {
                    store.dispatch('setUser', response.data.user);
                }).catch(() => {
                    store.dispatch('clearUser');
                    store.dispatch('clearToken');
                    // store.state.isAuthenticated = false;
                });
            }
        };

        onMounted(fetchUserData);

        return {
            user,
            isAuthorized,
            logout,
            cartItemCount,
            SendSearch,
            nameTool
        };
    },
    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    }
};
</script>