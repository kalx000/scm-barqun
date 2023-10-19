<template>
    <v-app>
        <Navbar />
        <LeftBar/>
        <User/>
        <Footer/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import User from '@/components/User.vue'
import Footer from '@/components/Footer.vue'
import Navbar from '@/components/NavBar.vue'
export default {
    components:{
        LeftBar,
        User,
        Footer,
        Navbar
    }
}
</script>

<style>

</style>