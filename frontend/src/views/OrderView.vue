<template>
    <v-app>
        <Navbar />
        <LeftBar/>
        <Order/>
        <Footer/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import Order from '@/components/Order.vue'
import Footer from '@/components/Footer.vue'
import Navbar from '@/components/NavBar.vue'
export default {
    components:{
        LeftBar,
        Order,
        Footer,
        Navbar
    }
}
</script>

<style>

</style>