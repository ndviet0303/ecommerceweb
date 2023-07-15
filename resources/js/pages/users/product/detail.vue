<template>
    <div class="container m-auto">
        <div v-if="!loading">
            <h1 class="text-center font-bold capitalize text-5xl items-center mt-4">
                {{ product.product_name }}
            </h1>
            <div class="flex justify-center capitalize text-3xl p-16">
                <span>giá :</span>
                <span>{{ formatPrice(product.product_price) }} / </span>
                <div v-if="product.product_type == 1">
                    Một Tháng
                </div>
                <div v-else>
                    Vĩnh Viễn
                </div>
            </div>

            <button
                class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-3xl px-4 py-2 ">Mua
            </button>


            <div id="information_tool" v-if="product.product_information !== null">
                <h1 class="text-center font-bold capitalize text-3xl">
                    một số thông tin của tool
                </h1>
                <span>
                    {{ product.product_information }}
                </span>
            </div>

            <div id="image_tool" v-if="product.product_img !== null">
                <h1 class="text-center font-bold capitalize text-3xl">
                    một số hình ảnh tool
                </h1>
            </div>

            <div id="vid_tool" v-if="product.product_vid !== null">
                <h1 class="text-center font-bold capitalize text-3xl">
                    một số video tool
                </h1>
            </div>
        </div>
        <div v-else>
            Loading.....
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    data() {
        return {
            product: Array,
            loading: Boolean,
        };
    },
    created() {
        this.loading = true;
        fetch("/api/product/" + this.$route.params.id)
            .then((response) => response.json())
            .then((data) => {
                this.product = data;
                this.loading = false;
            })
            .catch((error) => {
                console.log(error);
                this.loading = false;
            });
    },
    methods: {
        formatPrice(price) {
            // Use toLocaleString() to format the price
            return price.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND', // Change the currency code as per your requirement
            });
        },
    },
})
</script>