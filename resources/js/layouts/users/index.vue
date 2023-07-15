<template>
    <body class="flex flex-col min-h-screen">
        <HeaderVue />
        <main class="flex-1">
            <router-view></router-view>
        </main>
        <Footer />
    </body>
</template>

<script>
import HeaderVue from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
export default {
    components: {
        HeaderVue,
        Footer
    }
}
</script>