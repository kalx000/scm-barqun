<template>
    <v-app>
        <Navbar />
        <LeftBar/>
        <Customers/>
        <Footer/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import Customers from '@/views/pages/customer/Index.vue'
import Footer from '@/components/Footer.vue'
import Navbar from '@/components/NavBar.vue'
export default {
    components:{
        LeftBar,
        Customers,
        Footer,
        Navbar
    }
}
</script>

<style>

</style>