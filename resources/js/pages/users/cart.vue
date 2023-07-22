<template>
    <div class="container m-auto">
        <h1 class="title">giỏ hàng</h1>
        <div v-if="productList.length > 0">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                tên sản phẩm
                            </th>
                            <th scope="col" class="px-6 py-3">
                                đơn giá
                            </th>
                            <th scope="col" class="px-6 py-3">
                                thời hạn
                            </th>
                            <th scope="col" class="px-6 py-3">
                                số lượng
                            </th>
                            <th scope="col" class="px-6 py-3">
                                thành tiền
                            </th>
                            <th scope="col" class="px-6 py-3">
                                thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b " v-for="product in productList" :key="product.id">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ product.product_name }}
                            </th>
                            <td class="px-6 py-4" v-if="product.product_price != null">
                                {{ formatPrice(product.product_price) }} đ
                            </td>
                            <td class="px-6 py-4" v-if="product.product_type == 1">
                                {{ product.quantity }} Tháng
                            </td>
                            <td class="px-6 py-4" v-else>
                                Vĩnh Viễn
                            </td>
                            <td class="px-6 py-4">
                                <input class="max-w-[40px] boder-2" type="number" v-model="product.quantity"
                                    @input="updateCartItem(product)" />
                            </td>
                            <td class="px-6 py-4">
                                {{ formatPrice(product.quantity * product.product_price) }} đ
                            </td>
                            <td class="px-6 py-4 boder-2">
                                <button class="text-green-600 borderBox px-4 py-2"
                                    @click="addToCart(product)"><font-awesome-icon :icon="['fas', 'plus']" /></button>
                                <button class="text-orange-600 borderBox  px-4 py-2"
                                    @click="reduceQuantityCartItem(product)"><font-awesome-icon
                                        :icon="['fas', 'minus']" /></button>
                                <button class="text-red-600 borderBox  px-4 py-2"
                                    @click="removeCartItem(product)"><font-awesome-icon :icon="['fas', 'trash']" /></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-2 flex justify-end gap-5">
                    <button @click='clearCartItem' class="text-white bg-red-600 p-2 rounded">Xoá Toàn Bộ Giỏ Hàng</button>
                    <button @click='continueBuy' class="text-white bg-blue-600 p-2 rounded">Tiếp Tục Mua Hàng</button>
                    <button class="text-white bg-green-600 p-2 rounded">Thanh Toán</button>
                </div>
            </div>
        </div>
        <div v-else>
            Giỏ Hàng Trống
        </div>

    </div>
</template>
<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';
import router from '../../router';


const store = useStore();
// Lấy danh sách sản phẩm trong giỏ hàng từ Vuex store
const productList = computed(() => store.getters.getCartItems);
console.log(productList);
function addToCart(product) {
    store.dispatch('addToCart', product);
}

function reduceQuantityCartItem(product) {
    store.dispatch('reduceQuantityCartItem', product);
}
function removeCartItem(product) {
    store.dispatch('removeFromCart', product.id);
}

function updateCartItem(product) {
    store.dispatch('updateFromCart', product);
}
function formatPrice(price) {
    return price.toLocaleString("vi-VN", { currency: "VND" });
}

function clearCartItem() {
    store.dispatch('clearCart');
}

function continueBuy() {
    router.push({ name: 'Home' });
}

</script>