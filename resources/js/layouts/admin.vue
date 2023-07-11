<template>
    <HeaderVue/>
    Layouts Admin
    <router-view></router-view>
</template>

<script>
    import HeaderVue from '../components/Header.vue';

    export default{
        components:{
            HeaderVue
        }
    }
</script>