<template>
    <div class="container m-auto">
        <div class="text-center">
            <p>Thanh Toán VnPay</p>
        </div>
        <InputField v-model="formData.nd" label="Nội Dung" type="text" name="user_id" required disabled />
        <InputField v-model="formData.money" label="Số Tiền" type="Nunber" name="user_id" required />
        <!-- <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 ">Select an option</label> -->
        <!-- <select id="countries"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            <option selected>Chọn Bank</option>
            <option value="NCB">NCB</option>
        </select> -->
        <br>
        <ButtonPrimary label="Nạp" :onClick="SendDeposit" />
    </div>
</template>
<script setup>
import { ref, computed, onMounted, reactive } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import InputField from '../../components/Field/inputfield.vue';
import ButtonPrimary from '../../components/button/ButtonPrimary.vue'
import axios from 'axios';
const store = useStore();
const router = useRouter();
const user = store.getters['getUserData'];
const formData = ref({
    nd: 'NapCash_' + user.id,
    money: 0,
    BankCode: ''
})
async function SendDeposit() {
    const Data = formData.value;
    const response = await axios.post('/api/deposit', { Data }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    });
    if (response.data.code == "00") {
        window.location.href = response.data.data;
    }
}
</script>