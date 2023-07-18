<template>
    <header class="header-section">
        <div class="header-top">
            <div class="container m-auto">
                <div class="flex flex-row justify-around">
                    <div class="flex flex-row">
                        <a href="mailto:ndviet.dev@gmail.com" class="py-4 pr-5 line-space-right">
                            <font-awesome-icon :icon="['fas', 'envelope']" />
                            ndviet.dev@gmail.com
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
                        <div v-if="!isAuthenticated">
                            <router-link :to="{ name: 'login' }"
                                class="login-panel pl-5 flex gap-2 items-center line-space-right pr-5 py-4">
                                <font-awesome-icon :icon="['fas', 'user']" />
                                Đăng Nhập</router-link>
                            <router-link :to="{ name: 'register' }"
                                class="login-panel pl-5 flex gap-2 items-center line-space-right pr-5 py-4">
                                <font-awesome-icon :icon="['fas', 'user-plus']" />
                                Đăng Ký </router-link>
                        </div>
                        <div v-else>
                            {{ user.value.name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mid w-full">
            <div class="container py-10 flex flex-row flex-wrap justify-between m-auto">
                <div class="flex-1 text-center justify-center">
                    <div class="flex h-full items-center justify-center">
                        <a href="/">
                            <p>Logo</p>
                            <!-- <img src="img/logo.png" alt=""> -->
                        </a>
                    </div>
                </div>
                <div class="flex-auto">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none"
                            placeholder="Tìm Tên Tool" required>
                        <button type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Tìm</button>
                    </div>
                </div>
                <div class="flex-1 text-center">
                    <a class="flex h-full items-center justify-center" href="#">
                        <font-awesome-icon :icon="['fas', 'cart-shopping']" />
                        <span>3</span>
                    </a>
                </div>
            </div>
        </div>
        <nav class="border-gray-200 bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <button data-collapse-toggle="navbar-solid-bg" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-solid-bg" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <font-awesome-icon :icon="['fas', 'bars']" />
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
                    <ul
                        class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                        <li>
                            <router-link :to="{ name: 'Home' }"
                                class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent">Trang
                                Chủ</router-link>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Tool</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Liên
                                Hệ</a>
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
export default {
    setup() {
        const user = ref(null);
        const token = ref(null);
        const router = useRouter();
        const store = useStore();
        user.value = computed(() => store.state.user);
        token.value = computed(() => store.state.token);
        const isAuthenticated = computed(() => !!user.value && !!token.value);
        const logout = async () => {
            axios.post('/api/logout', {}, {
                headers: {
                    Authorization: `Bearer ${store.state.token}`,
                },
            })
                .then(response => {
                    store.dispatch('clearUser');
                    store.dispatch('clearToken');
                    router.push({ name: 'Login' });
                })
                .catch(error => {
                    console.error('Đăng xuất không thành công:', error);
                });
        };
        return {
            user,
            isAuthenticated,
            logout
        };
    }
};
</script>