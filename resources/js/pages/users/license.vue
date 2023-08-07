<template>
    <div class="container p-5">
        <div class="relative overflow-x-auto" v-if="licenses !== null">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            License Key
                        </th>
                        <th scope="col" class="px-6 py-3">
                            License Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hạn Dùng
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
                            {{ license.license_key }}
                        </td>
                        <td class="px-6 py-4">
                            {{ license.license_type }}
                        </td>

                        <td class="px-6 py-4">
                            {{ license.expiry_date == null ? 'Vĩnh Viễn' : license.expiry_date }}
                        </td>

                        <td class="px-6 py-4">
                            <ButtonColor :class="`bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300`"
                                @click="ModalChange(license)" label="Sửa" />
                            <ButtonColor :class="`bg-teal-400 hover:bg-teal-600 focus:ring-4 focus:ring-teal-300`"
                                @click="ModalDel(user)" label="Gia Hạn" />
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
                        <h3 class="mb-4 text-xl font-medium text-gray-900 capitalize">Sửa license</h3>
                        <div class="space-y-6">
                            <div>
                                <InputField v-model="licenseSave.license_key" label="License" type="text" name="licenseKey"
                                    placeholder="Điền License Ở Đây" required />
                            </div>
                            <ButtonPrimary label="Sửa" :onClick="SendLicenseChange" />
                        </div>
                    </div>
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

const licenses = ref(null);
const isModalChange = ref(false);
const licenseSave = ref(null);

const store = useStore();


function ModalChange(license) {
    licenseSave.value = license;
    isModalChange.value = true;
}

async function SendLicenseChange() {
    await axios.get('api/license/change', {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {
        licenseSave.value = null;
        isModalChange.value = true;
    }).catch((error) => {
    });
    await GetLicenseData();
}


async function GetLicenseData() {
    await axios.get('api/license', {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {
        licenses.value = response.data;
    }).catch((error) => {
    });
}

onMounted(GetLicenseData);

</script>