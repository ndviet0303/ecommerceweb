<template>
    <div class="container m-auto">
        <h1 class="text-center text-5xl font-bold mt-5"> Đăng Nhập</h1>
        <ul class="error flex flex-col gap-2" v-if="success.status">
            <span class="text-green-600 capitalize">{{ success.message }}</span>
        </ul>
        <ul class="error flex flex-col gap-2" v-if="error.status">
            <span class="text-red-600 capitalize">Có Lỗi Xảy Ra : </span>
            <div v-for="(err, index) in error.message" :key="index">
                <li class="text-red-600 capitalize" v-for="(errMess, indexes) in err" :key="indexes">
                    - {{ errMess }}
                </li>
            </div>
        </ul>
        <form @submit.prevent="submitForm">
            <div class="mt-5">
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 capitalize">email của bạn</label>
                    <input type="email" id="email" v-model="formData.email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="name@gmail.com" autocomplete="email" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Mật khẩu</label>
                    <input type="password" id="password" v-model="formData.password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required placeholder="****************" autocomplete="current-password">
                </div>
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value=""
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                            v-model="formData.remember">
                    </div>
                    <label for="remember" class="ml-2 text-sm font-medium text-gray-900">Remember
                        me</label>
                </div>
                <div v-if="isLoading">
                    <button disabled
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Loading....</button>
                </div>
                <div v-else>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center capitalize">Đăng
                        nhập</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import axios from "axios";
import { reactive, ref } from "vue";
import { useStore } from "vuex";
import router from "../../../router";

const store = useStore();

const success = reactive({
    status: false,
    message: "Đăng Nhập Thành Công",
});

const error = reactive({
    status: false,
    message: "",
});

const formData = reactive({
    email: "",
    password: "",
    remember: false,
});

const isLoading = ref(false);


const isLoggingIn = ref(false);

async function submitForm() {
    if (isLoggingIn.value) return;
    try {
        isLoggingIn.value = true;
        const response = await axios.post('/api/login', {
            email: formData.email,
            password: formData.password,
        });
        if (response.status === 200) {
            store.dispatch('setUser', response.data.user);
            store.dispatch('setToken', response.data.token);
            router.push({ name: 'Home' });
        } else {
            console.error('Login failed: Invalid response status');
        }
    } catch (err) {
        console.error('Login failed:', err.message);
    } finally {
        isLoggingIn.value = false;
    }
}
</script>
