<template>
    <v-app>
        <Navbar />
        <LeftBar/>
        <Product/>
        <Footer/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import Product from '@/components/Product.vue'
import Footer from '@/components/Footer.vue'
import Navbar from '@/components/NavBar.vue'
export default {
    components:{
        LeftBar,
        Product,
        Footer,
        Navbar
    }
}
</script>

<style>

</style>