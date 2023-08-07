<template>
    <div class="container p-5">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mail
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cash
                        </th>
                        <th scope="col" class="px-6 py-3">
                            verify Mail
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ban
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Function
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id" class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ user.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ user.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.cash.toLocaleString() }}đ
                        </td>
                        <td class="px-6 py-4">
                            <p
                                :class="user.email_verified_at === null ? 'text-red-500 bg-red-300 rounded-xl p-2' : 'text-green-500 bg-green-300 rounded-xl p-2'">
                                {{ user.email_verified_at === null ? 'Chưa Xác Thực' : 'Đã Xác Thực' }}
                            </p>
                        </td>

                        <td class="px-6 py-4">
                            {{ userRole[user.user_role - 1].name }}
                        </td>

                        <td class="px-6 py-4">
                            <p
                                :class="user.blocked === 1 ? 'text-red-500 bg-red-300 rounded-xl p-2' : 'text-green-500 bg-green-300 rounded-xl p-2'">
                                {{ user.blocked === 1 ? 'Cút' : 'Còn Sống' }}
                            </p>
                        </td>

                        <td class="px-6 py-4">
                            <ButtonColor :class="`bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300`"
                                @click="ModalChange(user)" label="Sửa" />
                            <ButtonColor :class="`bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300`"
                                @click="ModalDel(user)" label="Xoá" />
                            <ButtonColor :class="`bg-orange-400 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300`"
                                @click="SendVerified(user)" label="Xác Thực" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div v-if="isModalChange"
        class="fixed z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <button type="button" @click="isModalChange = false"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                    <font-awesome-icon :icon="['fas', 'xmark']" />
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 ">Sửa Tool</h3>
                    <div class="space-y-6">
                        <div>
                            <InputField v-model="userSave.name" label="Name" type="text" name="user_name" required />
                            <InputField v-model="userSave.email" label="Mail" type="text" name="user_mail" required />
                            <InputField v-model="userSave.cash" label="Cash" type="number" name="user_cash" required />
                            <SelectField v-model="userSave.user_role" label="Role" name="user_role" :options="userRole"
                                required />
                            <label for="user_block"
                                class="block mb-2 text-sm font-medium text-gray-900 capitalize">Role</label>
                            <select v-model="userSave.blocked" name="user_block"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required>
                                <option value="0" :selected="userSave.blocked == 0">Chưa Bị Ban</option>
                                <option value="1" :selected="userSave.blocked == 1">Đã Bị Ban</option>
                            </select>
                        </div>
                        <ButtonPrimary label="Sửa" :onClick="SendUserChange" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="isModalDel" @click="isModalDel = false"
        class="fixed top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow ">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 capitalize">chắc là xoá '{{ userSave === null
                        ? '' : userSave.name }}' chưa
                    </h3>
                    <button @click="SendDelUser" type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Chắc
                    </button>
                    <button @click="isModalDel = false" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">Đéo</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useStore } from 'vuex';
import ButtonColor from '../../components/button/ButtonColor.vue';
import ButtonPrimary from '../../components/button/ButtonPrimary.vue';
import InputField from '../../components/Field/InputField.vue';
import SelectField from '../../components/Field/SelectField.vue';

const users = ref(null);
const userSave = ref(null);
const userRole = ref(null);
const isLoading = ref(false);
const isModalChange = ref(false);
const isModalDel = ref(false);

const store = useStore();

function ModalChange(user) {
    userSave.value = user;
    isModalChange.value = true;
}

function ModalDel(user) {
    userSave.value = user;
    isModalDel.value = true;
}

async function SendVerified(user) {
    await axios.post('/api/admin/user/verify', { user }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {
        isModalChange.value = false;
        userData.value = null;
    }).catch((error) => {
        console.log(error);
    });
    await GetUserData();
}

async function SendDelUser() {
    const userData = userSave.value;
    await axios.post('/api/admin/user/del', { userData }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {
        isModalChange.value = false;
        userData.value = null;
    }).catch((error) => {
        console.log(error);
    });
    await GetUserData();
}
async function SendUserChange() {
    const userData = userSave.value;
    await axios.post('/api/admin/user/change', { userData }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {
        isModalChange.value = false;
        userData.value = null;
    }).catch((error) => {
        console.log(error);
    });
    await GetUserData();
}
async function GetUserData() {
    await axios.get('/api/admin/users', {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {
        users.value = response.data.users;
        userRole.value = response.data.role;
        isLoading.value = false;
    }).catch((error) => {
        console.log(error);
        isLoading.value = false;
    });
}
onMounted(GetUserData);
</script>