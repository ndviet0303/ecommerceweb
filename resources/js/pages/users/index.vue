<template>
    <div v-if="products.data">
        <div class="grid grid-cols-4 p-20">
            <div class="" v-for="product in products.data" :key="product.id">
                <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8">
                    <h5 class="mb-4 text-xl font-medium text-gray-500">{{ product.product_name }}</h5>
                    <div class="flex items-baseline text-gray-900 ">
                        <span class="text-5xl font-extrabold tracking-tight">49</span>
                        <div v-if="product.product_type == 1">
                            <span class="ml-1 text-xl font-normal text-gray-500">/Tháng
                            </span>
                        </div>
                        <div v-else-if="product.product_type == 2">
                            <span class="ml-1 text-xl font-normal text-gray-500">/Vĩnh Viễn
                            </span>
                        </div>
                    </div>
                    <ul role="list" class="space-y-5 my-7">
                        <li class="flex space-x-3 items-center">
                            <svg class="flex-shrink-0 w-4 h-4 text-blue-600 " aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <span class="text-base font-normal leading-tight text-gray-500">{{ product.product_info
                            }}</span>
                        </li>
                    </ul>
                    <button type="button"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200  font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center"
                        :href="/product/ + product.id">Xem</button>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex justify-center gap-2">

            <button @click="previousPage" :disabled="products.current_page === 1"
                class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">
                Trang Trước
            </button>

            <span class="flex items-center justify-center">{{ products.current_page }} / {{ products.last_page }}</span>


            <button @click="nextPage" :disabled="products.current_page === products.last_page"
                class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">
                Trang Sau
            </button>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
        };
    },
    created() {
        fetch("/api/products")
            .then((response) => response.json())
            .then((data) => (this.products = data))
            .catch((error) => console.log(error));
    },
    methods: {
        previousPage() {
            if (this.products.current_page > 1) {
                this.fetchPage(this.products.current_page - 1);
            }
        },
        nextPage() {
            if (this.products.current_page < this.products.last_page) {
                this.fetchPage(this.products.current_page + 1);
            }
        },
        fetchPage(page) {
            fetch(`/api/products?page=${page}`)
                .then((response) => response.json())
                .then((data) => {
                    this.products = data;
                })
                .catch((error) => console.log(error));
        },
    },
};
</script>

<style></style>