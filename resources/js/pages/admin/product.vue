<template>
    <div class="container p-5">
        <button type="button" @click="toggleModal"
            class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Thêm
            SP</button>
        <!-- Main modal -->
        <div v-if="isModalVisible" id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="fixed z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <button type="button" @click="toggleModal"
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
                        <h3 class="mb-4 text-xl font-medium text-gray-900 ">Thêm Tool</h3>
                        <div class="space-y-6">
                            <div>
                                <InputField v-model="formData.name" label="Tên Sản Phẩm" type="text" name="product_name"
                                    placeholder="Tool X" required />
                                <InputField v-model="formData.price" label="Giá Sản Phẩm" name="product_name" type="number"
                                    required />
                                <SelectEnumField v-model="formData.type" label="Loại Time" name="select_option"
                                    :options="enumExpir" required />
                                <InputField v-model="formData.infor" label="Thông Tin
                                    cơ Bản" name="product_price" type="text" placeholder="tool ghẻ , tool sida"
                                    required />
                                <InputField v-model="formData.img" label="hình
                                    ảnh" name="product_img" type="text" placeholder="link , link" required />
                                <InputField v-model="formData.vid" label="video" name="product_vid" type="text"
                                    placeholder="link , link" required />
                                <TextAreaField v-model="formData.description" label="Mô tả" name="description" required />
                                <SelectField v-model="formData.typeclassify" label="Loại
                                Tool" name="product_type_app" :options="product_type" required />
                            </div>
                            <ButtonPrimary label="Gửi" :onClick="SendData" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="isModalVisible" class="fixed top-0 left-0 right-0 bottom-0 bg-black opacity-50 z-40"
            @click="toggleModal"></div>

        <div v-if="isModalChangeShow"
            class="fixed z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <button type="button" @click="isModalChangeShow = false"
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
                        <h3 class="mb-4 text-xl font-medium text-gray-900 ">Sửa Tool</h3>
                        <div class="space-y-6">
                            <div>
                                <InputField v-model="productChange.product_name" label="Tên Sản Phẩm" type="text"
                                    name="product_name" placeholder="Tool X" required />
                                <InputField v-model="productChange.product_price" label="Giá Sản Phẩm" name="product_name"
                                    type="number" required />
                                <SelectEnumField v-model="productChange.product_type" label="Loại Time" name="select_option"
                                    :options="enumExpir" required />
                                <InputField v-model="productChange.product_info" label="Thông Tin
                                    cơ Bản" name="product_price" type="text" placeholder="tool ghẻ , tool sida"
                                    required />
                                <InputField v-model="productChange.product_img" label="hình
                                    ảnh" name="product_img" type="text" placeholder="link , link" required />
                                <InputField v-model="productChange.product_vid" label="video" name="product_vid" type="text"
                                    placeholder="link , link" required />
                                <TextAreaField v-model="productChange.product_description" label="Mô tả" name="description"
                                    required />
                                <SelectField v-model="productChange.type_id" label="Loại
                                Tool" name="product_type_app" :options="product_type" required />
                            </div>
                            <ButtonPrimary label="Sửa" :onClick="SendChange" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="isModalYNShow" @click="cancelDeletePrd"
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
                        <h3 class="mb-5 text-lg font-normal text-gray-500 capitalize">chắc là xoá '{{ selectedItem === null
                            ? '' : selectedItem.product_name }}' chưa
                        </h3>
                        <button @click="deletePrd" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Chắc
                        </button>
                        <button @click="cancelDeletePrd" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">Đéo</button>
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
                            Tên
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Giá
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hạn Dùng
                        </th>
                        <th scope="col" class="px-6 py-3">
                            TT Chung
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ảnh
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Video
                        </th>
                        <th scope="col" class="px-6 py-3">
                            TT Tool
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lượt Xem
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lượt Mua
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Loại
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Duyệt
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Update At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Function
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products.value" :key="product.id" class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ product.id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ product.product_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ product.product_price.toLocaleString() }}đ
                        </td>
                        <td class="px-6 py-4"> {{ Object.keys(enumExpir).find(key =>
                            enumExpir[key] === product.product_type) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ parseJsonString(product.product_info) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ parseJsonString(product.product_img) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ parseJsonString(product.product_vid) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ truncateText(product.product_description, 10) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ product.product_view }}
                        </td>
                        <td class="px-6 py-4">
                            {{ product.product_bought }}
                        </td>

                        <td class="px-6 py-4">
                            {{ product_type[product.type_id - 1].name }}
                        </td>

                        <td class="px-6 py-4">
                            <p
                                :class="product.is_show ? 'text-green-500 bg-green-300 rounded-xl p-2' : 'text-red-500 bg-red-300 rounded-xl p-2'">
                                {{ product.is_show ? 'Đã Duyệt' :
                                    'Chưa Duyệt' }}</p>
                        </td>

                        <td class="px-6 py-4">
                            {{ formatDateTime(product.created_at) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ formatDateTime(product.updated_at) }}
                        </td>

                        <td class="px-6 py-4">
                            <ButtonColor :class="`bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300`"
                                @click="Change(product)" label="Sửa" />
                            <ButtonColor :class="`bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300`"
                                @click="showModalYN(product)" label="Xoá" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, ref, reactive } from 'vue';
import { useStore } from 'vuex';
import InputField from '../../components/Field/InputField.vue';
import SelectEnumField from '../../components/Field/SelectEnumField.vue';
import SelectField from '../../components/Field/SelectField.vue'
import TextAreaField from '../../components/Field/TextAreaField.vue';
import ButtonPrimary from '../../components/button/ButtonPrimary.vue';
import ButtonColor from '../../components/button/ButtonColor.vue';

const isModalVisible = ref(false);
const isModalYNShow = ref(false);
const isModalChangeShow = ref(false);
const productChange = ref(null);
const selectedItem = ref(null);
const products = reactive({});
const enumExpir = ref({});
const product_type = ref({});
const formData = reactive({
    name: "",
    price: 0,
    type: 0,
    infor: "",
    img: "",
    vid: "",
    description: "",
    typeclassify: 0,
});
const store = useStore();

function showModalYN(product) {
    selectedItem.value = product;
    isModalYNShow.value = true;
}
function parseJsonString(jsonString) {
    try {
        const jsonArray = JSON.parse(jsonString);
        if (Array.isArray(jsonArray) && jsonArray.length > 0) {
            return jsonArray.join(',');
        }
    } catch (error) {
        console.error('Error parsing JSON:', error);
    }
    return ''; // Return empty string on error or empty array
}
const formatDateTime = (dateTimeStr) => {
    const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    };

    const formattedDateTime = new Date(dateTimeStr).toLocaleString(undefined, options);
    return formattedDateTime;
};
const truncateText = (text, maxLength) => {
    if (text.length > maxLength) {
        return text.slice(0, maxLength) + '...';
    } else {
        return text;
    }
};
async function deletePrd() {
    const data = selectedItem.value;
    await axios.post('/api/admin/product/remove', { data }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {

    }).catch((error) => {
        window.location.reload();
    });
    await getProduct();
}

function cancelDeletePrd() {
    isModalYNShow.value = false;
}
function toggleModal() {
    isModalVisible.value = !isModalVisible.value;
}

function Change(product) {
    productChange.value = {
        ...product,
        product_img: parseJsonString(product.product_img),
        product_info: parseJsonString(product.product_info),
        product_vid: parseJsonString(product.product_vid)
    };
    isModalChangeShow.value = true;
}


async function SendChange() {
    const product = productChange.value;
    await axios.post('/api/admin/product/change', { product }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {
        isModalChangeShow.value = false;
    }).catch((error) => {
        // isModalVisible.value = false;
    });
    await getProduct();
}
async function getProduct() {
    await axios.get('/api/admin/products', {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {
        products.value = response.data.products;
        enumExpir.value = response.data.enumExpir;
        product_type.value = response.data.product_type;
    }).catch((error) => {
        console.log(error);
    });
}

async function SendData() {
    await axios.post('/api/admin/product/add', { formData }, {
        headers: {
            Authorization: `Bearer ${store.state.token}`
        }
    }).then((response) => {
        isModalVisible.value = false;
    }).catch((error) => {
        isModalVisible.value = false;
    });
    await getProduct();
}

onMounted(getProduct);
</script>

<style></style>