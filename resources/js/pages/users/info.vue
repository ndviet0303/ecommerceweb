<template>
    <div class="container m-auto">
        <div class="flex flex-col">
            <p class="text-center text-5xl capitalize font-bold">thông tin tài khoản</p>
            <div class="flex justify-center mt-5">
                <div class=" flex flex-col capitalize text-3xl">
                    <span class="line-space-bot">chức vụ</span>
                    <span class="line-space-bot">tên</span>
                    <span class="line-space-bot">tiền</span>
                    <span class="line-space-bot">email</span>
                </div>
                <div class="flex flex-col capitalize text-3xl">
                    <span class="line-space-bot"> :{{ user.role_name }}</span>
                    <span class="line-space-bot"> :{{ user.name }}</span>
                    <span class="line-space-bot"> :{{ user.cash.toLocaleString() }} đ</span>
                    <div class="flex">
                        <span class="line-space-bot"> :{{ user.email }} </span>

                        <div v-if="user.email_verified_at === null" class="text-red-600 line-space-bot">
                            <font-awesome-icon :icon="['fas', 'x']" />
                        </div>
                        <div v-else class="text-green-600 line-space-bot">
                            <font-awesome-icon :icon="['fas', 'check']" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import { useStore } from 'vuex';
export default defineComponent({
    setup() {
        const store = useStore();
        const user = store.state.user;
        return { user }
    }
});
</script>