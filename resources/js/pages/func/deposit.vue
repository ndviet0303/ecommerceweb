<template>
    <div class="container m-auto">
        <div class="text-center">
            <p>Nạp Hoặc Donate</p>
            <p>Momo/Mb Bank: 0963792413</p>
            <p>Chủ Tài Khoản: Nghiêm Đức Việt</p>
            <p>Nội Dung: {{ isAuthorized ? 'nap_'  + this.$store.state.user.id : 'Đăng Nhập Để Xem'  }}</p>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';
const store = useStore();
const user = computed(() => store.state.user);
const token = computed(() => store.state.token);
const isAuthorized = computed(() => user.value !== null && token.value !== null);
</script>