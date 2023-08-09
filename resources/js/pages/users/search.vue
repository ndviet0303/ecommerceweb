<template>
    <div class="container p-5">
        <div v-if="products">
            <div class="grid sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 p-20 gap-5">
                <div class="" v-for="product in products" :key="product.id">
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8">
                        <h5 class="mb-4 text-xl font-medium text-gray-500">{{ product.product_name }}</h5>
                        <div class="flex items-baseline text-gray-900 ">
                            <span class="text-5xl font-extrabold tracking-tight">{{
                                product.product_price.toLocaleString() }}đ</span>
                            <span class="ml-1 text-xl font-normal text-gray-500">/{{
                                getExpirType(product.product_type, productType) }}
                            </span>
                        </div>
                        <ul role="list" class="space-y-5 my-7">
                            <li v-for="(info, index) in JSON.parse(product.product_info)" :key="index"
                                class="flex space-x-3 items-center">
                                <svg class="flex-shrink-0 w-4 h-4 text-blue-600 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                </svg>
                                <span class="text-base font-normal leading-tight text-gray-500">{{
                                    info
                                }}</span>
                            </li>
                        </ul>
                        <div>
                            <!-- <span class="text-cyan-500"> Người Bán {{ product.product_author }}</span> -->
                            <div class="flex flex-row justify-between text-purple-400">
                                <span>Lượt Mua :{{ product.product_bought }}</span>
                                <span>Lượt Xem :{{ product.product_view }}</span>
                            </div>
                        </div>
                        <router-link class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none
                                            focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full
                                            text-center" :to="{ name: 'product.detail', params: { id: product.id } }">
                            Xem
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import axios from 'axios';
import { ref, computed, watchEffect } from 'vue';
import { useRoute } from 'vue-router';
import { useFunction } from "../../lib/function";

const route = useRoute();
const searchName = computed(() => route.params.name);
const products = ref(null);
const productType = ref(null);

const { getExpirType } = useFunction();
// Use watchEffect to watch for changes in searchName and trigger actions
watchEffect(() => {
    GetDataSearch();
});

async function GetDataSearch() {
    const response = await axios.get(`/api/search/${searchName.value}`);

    if (response.status === 200) {
        products.value = response.data.products;
        productType.value = response.data.enumExpir;
        // Perform any additional actions you need with the response data
    }
}
</script>
  