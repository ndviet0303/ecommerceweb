<template>
    <div class="container m-auto">
        <div v-if="!loading">
            <h1 class="text-center font-bold capitalize text-5xl items-center mt-4">
                {{ product.product_name }}
            </h1>
            <div class="flex justify-center capitalize text-3xl p-16">
                <span>giá :</span>
                <span>{{ formatPrice(product.product_price) }} / </span>
                {{ getExpirType(product.product_type, productType) }}
            </div>

            <button @click="addToCart(product)"
                class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-3xl px-4 py-2 ">Thêm
                Vào Giỏ Hàng
            </button>


            <div id="information_tool" v-if="product.product_description !== null">
                <h1 class="text-center font-bold capitalize text-3xl">
                    một số thông tin của tool
                </h1>
                <span>
                    {{ product.product_description }}
                </span>
            </div>

            <div id="image_tool" v-if="product.product_img !== null">
                <h1 class="text-center font-bold capitalize text-3xl">
                    một số hình ảnh tool
                </h1>
                <img v-for="(img, index) in JSON.parse(product.product_img)" :key="index" :src="img"
                    alt="Image Description" />
            </div>

            <div id="vid_tool" v-if="product.product_vid !== null">
                <h1 class="text-center font-bold capitalize text-3xl">
                    một số video tool
                </h1>
                <div v-for="(youtubeUrl, index) in JSON.parse(product.product_vid)" :key="index">
                    <iframe v-if="validateUrl(youtubeUrl)" width="560" height="315" :src="youtubeUrl" frameborder="0"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div v-else>
            Loading.....
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
import { useFunction } from '../../../lib/function';

const store = useStore();
const route = useRoute();
const { getExpirType } = useFunction();
const product = ref(null);
const loading = ref(true);
const productType = ref(null);

function validateUrl(inputUrl) {
    const urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/;
    const isValidUrl = urlPattern.test(inputUrl);
    return isValidUrl;
}
fetch("/api/product/" + route.params.id)
    .then((response) => response.json())
    .then((data) => {
        product.value = data.product;
        productType.value = data.enumExpir,
            loading.value = false;
    })
    .catch((error) => {
        console.log(error.message);
        loading.value = false;
    });

function formatPrice(price) {
    return price.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });
}

function addToCart(product) {
    product.expir = getExpirType(product.product_type, productType.value);
    store.dispatch('addToCart', product);
}


</script>