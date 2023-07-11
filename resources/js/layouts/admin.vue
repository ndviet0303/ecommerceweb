<template>
    <HeaderVue/>
    Layouts Admin
    <router-view></router-view>
    <Footer/>
</template>

<script>
    import HeaderVue from '../components/Header.vue';
    import Footer from '../components/Footer.vue';
    export default{
        components:{
            HeaderVue,
            Footer
        }
    }
</script>