<template>
    <v-app>
        <Navbar />
        <LeftBar/>
        <Distributor/>
        <Footer/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import Distributor from '@/components/Distributor.vue'
import Footer from '@/components/Footer.vue'
import Navbar from '@/components/NavBar.vue'
export default {
    components:{
        LeftBar,
        Distributor,
        Footer,
        Navbar
    }
}
</script>

<style>

</style>