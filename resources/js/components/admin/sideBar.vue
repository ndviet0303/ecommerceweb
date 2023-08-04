<template>
    <aside id="default-sidebar" class="top-0 left-0 z-40 w-64 h-screen transition-transform" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 ">
            <ul class="space-y-2 font-medium">
                <li>
                    <router-link :to="{ name: 'admin.dashboard' }"
                        class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group"
                        :class="{ 'bg-gray-100': $route.name === 'admin.dashboard' }">
                        <font-awesome-icon :icon="['fas', 'chart-line']" />
                        <span class="ml-3">Dashboard</span>
                    </router-link>


                </li>

                <li>
                    <router-link :to="{ name: 'admin.product' }"
                        class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group"
                        :class="{ 'bg-gray-100': $route.name === 'admin.product' }">
                        <font-awesome-icon :icon="['fas', 'gear']" />
                        <span class="ml-3">Product</span>
                    </router-link>


                </li>


                <!-- <li>
                    <button @click="toggleMenuProduct" type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                        aria-controls="dropdown" data-collapse-toggle="dropdown-crud" :aria-expanded="toggle">
                        <font-awesome-icon :icon="['fas', 'gear']" />
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">Product</span>
                        <font-awesome-icon :icon="['fas', 'chevron-down']" />
                    </button>

                    <ul id="dropdown-crud" class="space-y-2 py-2 " :class="toggle ? '' : 'hidden'">
                        <li>
                            <a href="https://flowbite-admin-dashboard.vercel.app/crud/products/"
                                class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 ">Product</a>
                        </li>
                        <li>
                            <a href="https://flowbite-admin-dashboard.vercel.app/crud/users/"
                                class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 ">Users</a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </aside>
</template>

<script setup>
import { ref } from 'vue';
const toggle = ref(false);
function toggleMenuProduct() {
    toggle.value = !toggle.value;
}
</script>