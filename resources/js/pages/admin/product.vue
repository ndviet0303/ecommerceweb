<template>
    <div class="container p-5">
        <button type="button" @click="toggleModal"
            class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Thêm
            SP</button>
        <!-- Main modal -->
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
                        <form class="space-y-6" action="#">
                            <div>
                                <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 ">Tên Sản
                                    Phẩm</label>
                                <input type="text" name="product_name" id="product_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    required placeholder="Tool X">
                                <label for="product_price" class="block mb-2 text-sm font-medium text-gray-900 ">Giá Sản
                                    Phẩm</label>
                                <input type="number" name="product_price" id="product_price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    required placeholder="5000">
                                <label for="product_type" class="block mb-2 text-sm font-medium text-gray-900 ">Hạn Sử Dụng
                                    Sản
                                    Phẩm</label>

                                <select type="number" name="product_type" id="product_type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    required>
                                    <option v-for="(expir, index) in enumExpir" :value="expir" :key="index">
                                        {{ Object.keys(enumExpir).find(key => enumExpir[key] === expir) }}
                                    </option>

                                </select>

                                <label for="product_price" class="block mb-2 text-sm font-medium text-gray-900 ">Thông Tin
                                    cơ Bản</label>
                                <input type="text" name="product_info" id="product_info"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    required placeholder="tool ghẻ , tool sida">

                                <label for="product_price" class="block mb-2 text-sm font-medium text-gray-900 ">hình
                                    ảnh</label>
                                <input type="text" name="product_img" id="product_img"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="link , link">
                                <label for="product_price"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">video</label>
                                <input type="text" name="product_vid" id="product_vid"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="link , link">

                                <label for="product_infor" class="block mb-2 text-sm font-medium text-gray-900 ">TT đầy
                                    đủ</label>
                                <textarea type="text" name="product_infor" id="product_infor"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="á á ki mô chi" />
                                <label for="product_type_app" class="block mb-2 text-sm font-medium text-gray-900 ">Loại
                                    Tool</label>
                                <select type="number" name="product_type_app" id="product_type_app"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    required>
                                    <option v-for="(product, index) in product_type" :value="product.id" :key="index">
                                        {{ product.name }}
                                    </option>

                                </select>

                            </div>
                            <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="isModalVisible" class="fixed top-0 left-0 right-0 bottom-0 bg-black opacity-50 z-40"
            @click="toggleModal"></div>
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
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            1
                        </th>
                        <td class="px-6 py-4">
                            Silver
                        </td>
                        <td class="px-6 py-4">
                            Laptop
                        </td>
                        <td class="px-6 py-4">
                            $2999
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

const isModalVisible = ref(false);
const products = ref({});
const enumExpir = ref({});
const product_type = ref({});

function toggleModal() {
    isModalVisible.value = !isModalVisible.value;
}

async function getProduct() {
    const store = useStore();
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

onMounted(getProduct);
</script>

<style></style>