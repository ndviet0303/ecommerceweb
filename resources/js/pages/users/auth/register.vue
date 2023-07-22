<template>
    <div class="container m-auto">
        <h1 class="text-center text-5xl font-bold mt-5"> Đăng Ký Tài Khoản</h1>
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
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Tên Của Bạn</label>
                    <input type="name" id="name" v-model="formData.name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Nguyễn Văn A" required>
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                    <input type="email" id="email" v-model="formData.email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="name@ziet.dev" autocomplete="email" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Mật khẩu</label>
                    <input type="password" id="password" v-model="formData.password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required placeholder="****************" autocomplete="current-password">
                </div>
                <div v-if="isLoading">
                    <button disabled
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Loading....</button>
                </div>
                <div v-else>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Đăng
                        Ký</button>
                </div>
            </div>
        </form>
    </div>
</template>


<script lang="ts">
import axios from 'axios';
import { defineComponent, reactive, ref } from "vue";
import { useRecaptcha } from '../../../lib/reCaptcha';
export default defineComponent({
    setup() {
        const formData = reactive({
            name: "",
            email: "",
            password: "",
        });
        const isLoading = ref(false);
        const success = reactive({
            status: false,
            message: "Chúc mừng bạn đã đăng ký thành công, bạn sẽ được chuyển đến trang đăng nhập",
        });
        const error = reactive({
            status: false,
            message: [],
        });
        const { getToken } = useRecaptcha();
        async function submitForm() {
            isLoading.value = true;
            const token = await getToken();
            const data = {
                name: formData.name,
                email: formData.email,
                password: formData.password,
                token: token,
            };
            try {
                const response = await axios.post("/api/register", data);
                if (response.data.success) {
                    success.status = true;
                    isLoading.value = false;
                    this.$router.push({ name: 'login' });
                }
                else {
                    error.status = true;
                    error.message = response.data.errors;
                    isLoading.value = false;
                }

            }
            catch (err) {
                error.status = true;
                error.message = err.message;
                isLoading.value = false;
            }
        }


        return { isLoading, success, error, formData, submitForm };

    }

});
</script>  

