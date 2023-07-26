<template>
    <HeaderVue/>
    <div class="flex">
        <sideBar>        
        </sideBar>
        <router-view></router-view>
    </div>
    <Footer/>
</template>

<script>
    import HeaderVue from '../components/Header.vue';
    import Footer from '../components/Footer.vue';
    import sideBar from '../components/admin/sideBar.vue';
    export default{
        components:{
            HeaderVue,
            Footer,
            sideBar
        }
    }
</script>