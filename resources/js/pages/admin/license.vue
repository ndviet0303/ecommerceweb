<template>
    <div class="container p-5">
        <button type="button" @click="ToggleModalAdd"
            class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Thêm
            License</button>
        <div v-if="isModalAdd" id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="fixed z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <button type="button" @click="isModalAdd = false"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center "
                        data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 ">Thêm License</h3>
                        <div class="space-y-6">
                            <div>
                                <InputField v-model="licenseSave.user_id" label="User Id" type="number" name="user_id"
                                    required />
                                <InputField v-model="licenseSave.license_key" label="license key" type="text"
                                    name="license_key" required />
                                <InputField v-model="licenseSave.license_type" label="license type" type="text"
                                    name="license_type" required />
                                <SelectEnumField v-model="formData.type" label="Loại Time" name="select_option"
                                    :options="enumExpir" required />
                                <InputField v-if="licenseSave.expiry_date !== null" v-model="licenseDateAdd"
                                    label="expiry date" type="number" name="expiry_date" required />
                            </div>
                            <ButtonPrimary label="Gửi" :onClick="SendLicenseAdd" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Key
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Expiry
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Function
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="license in licenses" :key="license.id" class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ license.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ license.user_id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ license.license_key }}
                        </td>
                        <td class="px-6 py-4">
                            {{ license.license_type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ license.expiry_date === null ? 'Vĩnh Viễn' : license.expiry_date }}
                        </td>

                        <td class="px-6 py-4">
                            <ButtonColor :class="`bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300`"
                                @click="ToggleModalChange(license)" label="Sửa" />
                            <ButtonColor :class="`bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300`"
                                @click="ToggleModalDel(license)" label="Xoá" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

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
                        <h3 class="mb-4 text-xl font-medium text-gray-900 ">Sửa License</h3>
                        <div class="space-y-6">
                            <div>
                                <InputField v-model="licenseSave.user_id" label="User Id" type="number" name="user_id"
                                    required />
                                <InputField v-model="licenseSave.license_key" label="license key" type="text"
                                    name="license_key" required />
                                <InputField v-model="licenseSave.license_type" label="license type" type="text"
                                    name="license_type" required />
                                <SelectEnumField v-model="formData.type" label="Loại Time" name="select_option"
                                    :options="enumExpir" required />
                                <InputField v-if="licenseSave.expiry_date !== null" v-model="formData.day"
                                    label="expiry date" type="number" name="expiry_date" required />
                            </div>
                            <ButtonPrimary label="Sửa" :onClick="SendLicenseChange" />
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
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 " aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 capitalize">chắc là xoá '{{ licenseSave === null
                            ? '' : licenseSave.id }}' chưa
                        </h3>
                        <button @click="SendLicenseDel" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Chắc
                        </button>
                        <button @click="isModalDel = false" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">Đéo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import axios from 'axios';
import { ref, onMounted, reactive } from 'vue';
import { useStore } from 'vuex';

import ButtonColor from '../../components/button/ButtonColor.vue';
import ButtonPrimary from '../../components/button/ButtonPrimary.vue';
import InputField from '../../components/Field/InputField.vue';
import SelectEnumField from '../../components/Field/SelectEnumField.vue';

const store = useStore();

const licenses = ref(null);
const licenseSave = ref({
    'user_id': 0,
    'license_key': '',
    'license_type': '',
});
const enumExpir = ref(null);
const isModalChange = ref(false);
const isModalDel = ref(false);
const isModalAdd = ref(false);
const formData = reactive({
    type: 0,
    day: 0,
});

function ToggleModalAdd() {
    isModalAdd.value = true;
}

function ToggleModalChange(license) {
    licenseSave.value = license;
    isModalChange.value = true;
}

function ToggleModalDel(license) {
    licenseSave.value = license;
    isModalDel.value = true;
}

async function SendLicenseAdd() {
    const license = {
        'license': licenseSave.value,
        'dayAdd': formData
    };
    const response = await axios.post('/api/admin/license/add', { license }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    })
    if (response.status === 200) {
        isModalAdd.value = false;
    }
    await GetLicenseData();
}

async function SendLicenseDel() {
    const license = licenseSave.value;
    const response = await axios.post('/api/admin/license/del', { license }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    })
    if (response.status === 200) {
        isModalDel.value = false;
    }
    await GetLicenseData();
}

async function SendLicenseChange() {
    const licenseData = { 'license': licenseSave.value, 'dayAdd': formData };
    const response = await axios.post('/api/admin/license/change', { licenseData }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    })
    if (response.status === 200) {
        isModalChange.value = false;
    }
    await GetLicenseData();
}
async function GetLicenseData() {
    const response = await axios.get('/api/admin/license', {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    })

    if (response.status === 200) {
        licenses.value = response.data.licenses;
        enumExpir.value = response.data.enumExpir;
    }
}

onMounted(GetLicenseData);

</script>