<template>
    <div class="container m-auto">
        <h1 class="text-center text-5xl font-bold mt-5 capitalize">đổi mật khẩu</h1>
        <ul class="error flex flex-col gap-2" v-if="success.status">
            <span class="text-green-600 capitalize">{{ success.message }}</span>
        </ul>
        <ul class="error flex flex-col gap-2" v-if="error.status">
            <span class="text-red-600 capitalize">đổi mật khẩu không thành công : {{ error.message }}</span>
        </ul>
        <form @submit.prevent="submitForm">
            <div class="mt-5">
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Mật khẩu cũ</label>
                    <input type="password" id="password" v-model="formData.curr_password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required placeholder="****************" autocomplete="current-password">
                </div>
                <div class="mb-6">
                    <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900">Mật khẩu mới</label>
                    <input type="new_password" id="new_password" v-model="formData.new_password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required placeholder="****************" autocomplete="current-password">
                </div>
                <div class="mb-6">
                    <label for="re_new_password" class="block mb-2 text-sm font-medium text-gray-900">xác nhận mật khẩu
                        mới</label>
                    <input type="re_new_password" id="re_new_password" v-model="formData.confirm_password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required placeholder="****************" autocomplete="current-password">
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

<script>
import { reactive, defineComponent, ref } from 'vue';
export default defineComponent({
    setup() {
        const error = reactive({
            status: false,
            message: "",
        });
        const success = reactive({
            status: false,
            message: "",
        });
        const isLoading = ref(false);
        const formData = reactive({
            curr_password: "",
            new_password: "",
            confirm_password: "",
        });
        const submitForm = async () => {

            try {
                const token = localStorage.getItem('token');
                const response = await axios.post('/api/change-password', {

                    curr_password: formData.curr_password,
                    new_password: formData.new_password,
                    new_password_confirmation: formData.confirm_password,
                }, {
                    headers: {
                        Authorization: `Bearer ${token}`, // Thêm token vào header của yêu cầu
                    },
                });
                if (response.status == 200) {
                    success.status = true;
                    isLoading.value = response.message;
                }
                else {
                    error.status = true;
                    error.message = response.message.error;
                    isLoading.value = false;
                }

            }
            catch (err) {
                error.status = true;
                error.message = err.message;
                isLoading.value = false;
            }
        }
        return { error, success, formData, isLoading, submitForm };
    }
});
</script>