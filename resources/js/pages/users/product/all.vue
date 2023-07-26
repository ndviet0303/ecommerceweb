<template>
    <div class="container m-auto">
        <div v-if="isLoading">
            <div v-for="(type, index) in dataProducts.typeList" :key="index">
                <h1 class="text-center font-bold text-5xl p-5">{{ type.name }}</h1>

                <div v-for="(product, indexProduct) in dataProducts.products" :key="indexProduct">
                    <div v-if="product.type_id === type.id">
                        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 mb-2">
                            <h5 class="mb-4 text-xl font-medium text-gray-500">{{ product.product_name }}</h5>
                            <div class="flex items-baseline text-gray-900 ">
                                <span class="text-5xl font-extrabold tracking-tight">{{
                                    product.product_price.toLocaleString() }}</span>
                                <span class="ml-1 text-xl font-normal text-gray-500">/ {{ getExpirType(product.product_type,
                                    dataProducts.enumExpir)
                                }}
                                </span>
                            </div>
                            <ul role="list" class="space-y-5 my-7">
                                <li class="flex space-x-3 items-center">
                                    <svg class="flex-shrink-0 w-4 h-4 text-blue-600 " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                    </svg>
                                    <span class="text-base font-normal leading-tight text-gray-500">{{
                                        product.product_info
                                    }}</span>
                                </li>
                            </ul>
                            <div>
                                <!-- <span class="text-cyan-500"> Người Bán :{{ product.product_author }}</span> -->
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
    </div>
</template>

<script>
import { defineComponent, reactive, ref } from "vue";
import { useFunction } from "../../../lib/function";

export default defineComponent({
    setup() {
        const isLoading = ref(false);
        const dataProducts = reactive({});
        const { getExpirType } = useFunction();
        return { isLoading, dataProducts, getExpirType };
    },
    created() {
        fetch("/api/Allproducts")
            .then((response) => response.json())
            .then((data) => {
                this.dataProducts = data;
                this.isLoading = true;
            })
            .catch((error) => {
                console.log(error);
                this.isLoading = true;
            });
    },
});
</script>
